<?php

namespace App\Controllers;

use GuzzleHttp\Client;

class GraficosController
{
    public function crearGrafico($calificaciones)
    {
        // Crear una instancia del cliente HTTP Guzzle
        $client = new Client();

        // Extraer las fechas y los valores de cada elemento
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

        // Formatear los datos para la configuración JSON del gráfico
        $datasets = [];
        $colors = [
            "Puntuación Total" => 'rgba(75, 192, 192, 1)',
            "Fuerza Muscular" => 'rgba(255, 99, 132, 1)',
            "Resistencia Muscular" => 'rgba(54, 162, 235, 1)',
            "Resiliencia" => 'rgba(255, 206, 86, 1)',
            "Flexibilidad" => 'rgba(153, 102, 255, 1)',
            "Cumplimiento Agenda" => 'rgba(255, 159, 64, 1)',
            "Resistencia a la Monotonía" => 'rgba(201, 203, 207, 1)'
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

        // Configuración del gráfico en formato JSON
        $config = [
            'type' => 'line',
            'data' => [
                'labels' => $fechas,
                'datasets' => $datasets
            ],
            'options' => [
                'title' => [
                    'display' => true,
                    'text' => 'Gráfico de Evolución',
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

        // Hacer una solicitud POST a la API de QuickChart
        $response = $client->post('https://quickchart.io/chart/create', [
            'json' => ['chart' => json_encode($config)]
        ]);

        // Decodificar la respuesta JSON
        $body = json_decode($response->getBody(), true);

        return $body['url'];
    }
}