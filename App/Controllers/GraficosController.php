<?php

    namespace App\Controllers;

    use GuzzleHttp\Client;
    use Monolog\Logger;

    class GraficosController
    {
        public function crearGrafico($usuarioId, $calificaciones, Logger $logger)
        {
            $client = new Client();

            $hashCalificaciones = md5(json_encode($calificaciones));
            $cachePath = __DIR__ . "/../../Resources/Images/Graphics/grafico_evolucion_{$usuarioId}.png";

            try {
                $ultimaCalificacion = array_reduce($calificaciones, function ($carry, $item) {
                    return ($carry === null || $item['id'] > $carry['id']) ? $item : $carry;
                });

                if ($ultimaCalificacion === null) {
                    throw new \Exception("No se encontraron calificaciones.");
                }

                $ultimaCalificacionId = $ultimaCalificacion['id'];

            } catch (Exception $e) {
                $logger->error('Error al obtener la calificación con el ID más alto', ['exception' => $e]);
                return;
            }
            $ultimoLogPath = __DIR__ . "/../../Config/logs/usuario.log";
            $ultimaCalificacionRegistrada = null;

            if (file_exists($ultimoLogPath)) {
                $logContents = file_get_contents($ultimoLogPath);
                preg_match_all('/\[\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}\.\d+.*?\] app\.INFO: (.*?)(?=\[\d{4}-\d{2}-\d{2}T|$)/s', $logContents, $logEntries);

                foreach (array_reverse($logEntries[1]) as $logEntry) {
                    if (strpos($logEntry, 'Gráfico generado') !== false && strpos($logEntry, '"usuarioId":"' . $usuarioId . '"') !== false) {
                        preg_match('/"calificacionId":(\d+)/', $logEntry, $matches);
                        if (isset($matches[1])) {
                            $ultimaCalificacionRegistrada = (int)$matches[1];
                            if ($ultimaCalificacionRegistrada >= $ultimaCalificacionId) {
                                return;
                            }
                        }
                    }
                }
            }

            $fechas = array_column($calificaciones, 'fecha');
            $items = [
                "Puntuación Total" => array_column($calificaciones, 'puntObtenido'),
                "Fuerza Muscular" => array_column($calificaciones, 'fuerzaMusc'),
                "Resistencia Muscular" => array_column($calificaciones, 'resMusc'),
                "Resiliencia" => array_column($calificaciones, 'resiliencia'),
                "Flexibilidad" => array_column($calificaciones, 'flexibilidad'),
                "Cumplimiento Agenda" => array_column($calificaciones, 'cumplAgenda'),
                "Resistencia a la Monotonía" => array_column($calificaciones, 'resMonotonia')
            ];

            $datasets = [];
            $colors = [
                "Puntuación Total" => 'rgba(75, 192, 192, 0.6)',
                "Fuerza Muscular" => 'rgba(255, 99, 132, 0.6)',
                "Resistencia Muscular" => 'rgba(54, 162, 235, 0.6)',
                "Resiliencia" => 'rgba(255, 206, 86, 0.6)',
                "Flexibilidad" => 'rgba(153, 102, 255, 0.6)',
                "Cumplimiento Agenda" => 'rgba(255, 159, 64, 0.6)',
                "Resistencia a la Monotonía" => 'rgba(201, 203, 207, 0.6)'
            ];

            foreach ($items as $nombreItem => $valores) {
                $datasets[] = [
                    'label' => $nombreItem,
                    'data' => $valores,
                    'borderColor' => $colors[$nombreItem],
                    'backgroundColor' => $colors[$nombreItem],
                    'fill' => false,
                    'lineTension' => 0.4,
                    'pointBackgroundColor' => $colors[$nombreItem],
                    'pointBorderColor' => '#fff',
                    'pointRadius' => 5
                ];
            }

            $config = [
                'type' => 'line',
                'data' => [
                    'labels' => $fechas,
                    'datasets' => $datasets
                ],
                'options' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Gráfico de Evolución en el Tiempo',
                        'fontSize' => 18,
                        'fontColor' => '#333'
                    ],
                    'legend' => [
                        'display' => true,
                        'position' => 'bottom',
                        'labels' => [
                            'fontColor' => '#333',
                            'fontSize' => 12
                        ]
                    ],
                    'scales' => [
                        'xAxes' => [[
                            'scaleLabel' => [
                                'display' => true,
                                'labelString' => 'Fechas',
                                'fontSize' => 14,
                                'fontColor' => '#333'
                            ],
                            'ticks' => [
                                'fontColor' => '#333'
                            ]
                        ]],
                        'yAxes' => [[
                            'scaleLabel' => [
                                'display' => true,
                                'labelString' => 'Valores',
                                'fontSize' => 14,
                                'fontColor' => '#333'
                            ],
                            'ticks' => [
                                'beginAtZero' => true,
                                'fontColor' => '#333'
                            ]
                        ]]
                    ],
                    'elements' => [
                        'line' => [
                            'borderWidth' => 3
                        ],
                        'point' => [
                            'radius' => 5,
                            'borderWidth' => 2
                        ]
                    ]
                ]
            ];

                $response = $client->post('https://quickchart.io/chart/create', [
                    'json' => ['chart' => json_encode($config), 'format' => 'png']
                ]);

                $body = json_decode($response->getBody(), true);

                $imageUrl = $body['url'];

                if (file_exists($cachePath)) {
                    unlink($cachePath);
                }
                $imageContent = file_get_contents($imageUrl);
                file_put_contents($cachePath, $imageContent);

                $logger->info('Gráfico generado', ['usuarioId' => $usuarioId, 'calificacionId' => $ultimaCalificacionId]);
        }
    }