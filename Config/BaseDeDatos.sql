-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-09-2024 a las 03:00:50
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fidatbd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arma`
--

CREATE TABLE `arma` (
  `nroDocumento` varchar(30) NOT NULL,
  `tipoDocumento` varchar(16) NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE `calificacion` (
  `id` int(11) NOT NULL,
  `puntMaxima` int(11) DEFAULT NULL,
  `fuerzaMusc` int(11) DEFAULT NULL,
  `resMusc` int(11) DEFAULT NULL,
  `resAnaerobica` int(11) DEFAULT NULL,
  `resilicencia` int(11) DEFAULT NULL,
  `flexibilidad` int(11) DEFAULT NULL,
  `cumpAgenda` int(11) DEFAULT NULL,
  `resMonotonia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `nroDocumento` varchar(30) NOT NULL,
  `tipoDocumento` varchar(16) NOT NULL,
  `altura` double DEFAULT NULL,
  `peso` int(11) DEFAULT NULL,
  `calle` varchar(100) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `esquina` varchar(100) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `patologias` varchar(25) DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `apellido` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_telefono`
--

CREATE TABLE `cliente_telefono` (
  `nroDocumento` varchar(30) NOT NULL,
  `tipoDocumento` varchar(16) NOT NULL,
  `telefono` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comboejercicio`
--

CREATE TABLE `comboejercicio` (
  `nombreCombo` int(11) NOT NULL,
  `cantEjercicios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comboejercicio_idejercicio`
--

CREATE TABLE `comboejercicio_idejercicio` (
  `nombreCombo` int(11) NOT NULL,
  `idEjercicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compone`
--

CREATE TABLE `compone` (
  `nombreCombo` int(11) NOT NULL,
  `id_Ejercicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conserva`
--

CREATE TABLE `conserva` (
  `nroDocumento` varchar(30) NOT NULL,
  `tipoDocumento` varchar(16) NOT NULL,
  `id_Estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contiene`
--

CREATE TABLE `contiene` (
  `nombreCombo` int(11) NOT NULL,
  `id_Ejercicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deporte`
--

CREATE TABLE `deporte` (
  `idDeporte` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deportista`
--

CREATE TABLE `deportista` (
  `nroDocumento` varchar(30) NOT NULL,
  `tipoDocumento` varchar(16) NOT NULL,
  `deporte` varchar(15) NOT NULL,
  `posicion` varchar(15) NOT NULL,
  `estado` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicio`
--

CREATE TABLE `ejercicio` (
  `id_Ejercicio` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `tipoEjercicio` varchar(20) NOT NULL,
  `grupoMuscular` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elige`
--

CREATE TABLE `elige` (
  `nombre` varchar(12) NOT NULL,
  `nroDocumento` varchar(30) NOT NULL,
  `tipoDocumento` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrena`
--

CREATE TABLE `entrena` (
  `idDeporte` int(11) NOT NULL,
  `nroDocumento` varchar(30) NOT NULL,
  `tipoDocumento` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_Estado` int(11) NOT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localgym`
--

CREATE TABLE `localgym` (
  `nombre` varchar(20) NOT NULL,
  `calle` varchar(25) NOT NULL,
  `nroPuerta` varchar(4) NOT NULL,
  `esquina` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obtiene`
--

CREATE TABLE `obtiene` (
  `nroDocumento` varchar(30) NOT NULL,
  `tipoDocumento` varchar(16) NOT NULL,
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `puntEsperado` int(11) DEFAULT NULL,
  `puntObtenido` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `nroDocumento` varchar(30) NOT NULL,
  `tipoDocumento` varchar(16) NOT NULL,
  `fisioterapia` varchar(2) NOT NULL,
  `estado` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `idPago` int(11) NOT NULL,
  `ultimoMesAbonado` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planpago`
--

CREATE TABLE `planpago` (
  `nombre` varchar(12) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `tipoPlan` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posee`
--

CREATE TABLE `posee` (
  `nroDocumento` varchar(30) NOT NULL,
  `tipoDocumento` varchar(16) NOT NULL,
  `id_Estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `practica`
--

CREATE TABLE `practica` (
  `nroDocumento` varchar(30) NOT NULL,
  `tipoDocumento` varchar(16) NOT NULL,
  `idRutina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `realiza`
--

CREATE TABLE `realiza` (
  `fechaPago` date NOT NULL,
  `idPago` int(11) NOT NULL,
  `nombre` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutina`
--

CREATE TABLE `rutina` (
  `idRutina` int(11) NOT NULL,
  `series` int(11) NOT NULL,
  `repeticiones` int(11) NOT NULL,
  `dia` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `selecciona`
--

CREATE TABLE `selecciona` (
  `nroDocumento` varchar(30) NOT NULL,
  `tipoDocumento` varchar(16) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiene`
--

CREATE TABLE `tiene` (
  `idDeporte` int(11) NOT NULL,
  `nombreCombo` int(11) NOT NULL,
  `id_Ejercicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nroDocumento` varchar(30) NOT NULL,
  `rol` varchar(22) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `arma`
--
ALTER TABLE `arma`
  ADD PRIMARY KEY (`nroDocumento`,`tipoDocumento`);

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_calificacion_id` (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`nroDocumento`,`tipoDocumento`);

--
-- Indices de la tabla `cliente_telefono`
--
ALTER TABLE `cliente_telefono`
  ADD PRIMARY KEY (`nroDocumento`,`tipoDocumento`,`telefono`);

--
-- Indices de la tabla `comboejercicio`
--
ALTER TABLE `comboejercicio`
  ADD PRIMARY KEY (`nombreCombo`);

--
-- Indices de la tabla `comboejercicio_idejercicio`
--
ALTER TABLE `comboejercicio_idejercicio`
  ADD PRIMARY KEY (`nombreCombo`,`idEjercicio`);

--
-- Indices de la tabla `compone`
--
ALTER TABLE `compone`
  ADD PRIMARY KEY (`nombreCombo`,`id_Ejercicio`),
  ADD KEY `id_Ejercicio` (`id_Ejercicio`);

--
-- Indices de la tabla `conserva`
--
ALTER TABLE `conserva`
  ADD PRIMARY KEY (`nroDocumento`,`tipoDocumento`,`id_Estado`),
  ADD KEY `id_Estado` (`id_Estado`);

--
-- Indices de la tabla `contiene`
--
ALTER TABLE `contiene`
  ADD PRIMARY KEY (`nombreCombo`,`id_Ejercicio`),
  ADD KEY `id_Ejercicio` (`id_Ejercicio`);

--
-- Indices de la tabla `deporte`
--
ALTER TABLE `deporte`
  ADD PRIMARY KEY (`idDeporte`);

--
-- Indices de la tabla `deportista`
--
ALTER TABLE `deportista`
  ADD PRIMARY KEY (`nroDocumento`,`tipoDocumento`);

--
-- Indices de la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  ADD PRIMARY KEY (`id_Ejercicio`);

--
-- Indices de la tabla `elige`
--
ALTER TABLE `elige`
  ADD PRIMARY KEY (`nombre`),
  ADD KEY `nroDocumento` (`nroDocumento`,`tipoDocumento`);

--
-- Indices de la tabla `entrena`
--
ALTER TABLE `entrena`
  ADD PRIMARY KEY (`idDeporte`),
  ADD KEY `nroDocumento` (`nroDocumento`,`tipoDocumento`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_Estado`);

--
-- Indices de la tabla `localgym`
--
ALTER TABLE `localgym`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `obtiene`
--
ALTER TABLE `obtiene`
  ADD PRIMARY KEY (`nroDocumento`,`tipoDocumento`,`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`nroDocumento`,`tipoDocumento`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`idPago`);

--
-- Indices de la tabla `planpago`
--
ALTER TABLE `planpago`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `posee`
--
ALTER TABLE `posee`
  ADD PRIMARY KEY (`nroDocumento`,`tipoDocumento`,`id_Estado`),
  ADD KEY `id_Estado` (`id_Estado`);

--
-- Indices de la tabla `practica`
--
ALTER TABLE `practica`
  ADD PRIMARY KEY (`nroDocumento`,`tipoDocumento`,`idRutina`),
  ADD KEY `idRutina` (`idRutina`);

--
-- Indices de la tabla `realiza`
--
ALTER TABLE `realiza`
  ADD PRIMARY KEY (`fechaPago`,`idPago`),
  ADD KEY `idPago` (`idPago`),
  ADD KEY `nombre` (`nombre`);

--
-- Indices de la tabla `rutina`
--
ALTER TABLE `rutina`
  ADD PRIMARY KEY (`idRutina`);

--
-- Indices de la tabla `selecciona`
--
ALTER TABLE `selecciona`
  ADD PRIMARY KEY (`nroDocumento`,`tipoDocumento`),
  ADD KEY `nombre` (`nombre`);

--
-- Indices de la tabla `tiene`
--
ALTER TABLE `tiene`
  ADD PRIMARY KEY (`idDeporte`,`nombreCombo`,`id_Ejercicio`),
  ADD KEY `nombreCombo` (`nombreCombo`),
  ADD KEY `id_Ejercicio` (`id_Ejercicio`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`nroDocumento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente_telefono`
--
ALTER TABLE `cliente_telefono`
  ADD CONSTRAINT `cliente_telefono_ibfk_1` FOREIGN KEY (`nroDocumento`,`tipoDocumento`) REFERENCES `cliente` (`nroDocumento`, `tipoDocumento`);

--
-- Filtros para la tabla `compone`
--
ALTER TABLE `compone`
  ADD CONSTRAINT `compone_ibfk_1` FOREIGN KEY (`nombreCombo`) REFERENCES `comboejercicio` (`nombreCombo`),
  ADD CONSTRAINT `compone_ibfk_2` FOREIGN KEY (`id_Ejercicio`) REFERENCES `ejercicio` (`id_Ejercicio`);

--
-- Filtros para la tabla `conserva`
--
ALTER TABLE `conserva`
  ADD CONSTRAINT `conserva_ibfk_1` FOREIGN KEY (`nroDocumento`,`tipoDocumento`) REFERENCES `deportista` (`nroDocumento`, `tipoDocumento`),
  ADD CONSTRAINT `conserva_ibfk_2` FOREIGN KEY (`id_Estado`) REFERENCES `estado` (`id_Estado`);

--
-- Filtros para la tabla `contiene`
--
ALTER TABLE `contiene`
  ADD CONSTRAINT `contiene_ibfk_1` FOREIGN KEY (`nombreCombo`) REFERENCES `comboejercicio` (`nombreCombo`),
  ADD CONSTRAINT `contiene_ibfk_2` FOREIGN KEY (`id_Ejercicio`) REFERENCES `ejercicio` (`id_Ejercicio`);

--
-- Filtros para la tabla `deportista`
--
ALTER TABLE `deportista`
  ADD CONSTRAINT `deportista_ibfk_1` FOREIGN KEY (`nroDocumento`,`tipoDocumento`) REFERENCES `cliente` (`nroDocumento`, `tipoDocumento`);

--
-- Filtros para la tabla `elige`
--
ALTER TABLE `elige`
  ADD CONSTRAINT `elige_ibfk_1` FOREIGN KEY (`nroDocumento`,`tipoDocumento`) REFERENCES `cliente` (`nroDocumento`, `tipoDocumento`),
  ADD CONSTRAINT `elige_ibfk_2` FOREIGN KEY (`nombre`) REFERENCES `planpago` (`nombre`);

--
-- Filtros para la tabla `entrena`
--
ALTER TABLE `entrena`
  ADD CONSTRAINT `entrena_ibfk_1` FOREIGN KEY (`nroDocumento`,`tipoDocumento`) REFERENCES `cliente` (`nroDocumento`, `tipoDocumento`),
  ADD CONSTRAINT `entrena_ibfk_2` FOREIGN KEY (`idDeporte`) REFERENCES `deporte` (`idDeporte`);

--
-- Filtros para la tabla `obtiene`
--
ALTER TABLE `obtiene`
  ADD CONSTRAINT `obtiene_ibfk_1` FOREIGN KEY (`id`) REFERENCES `calificacion` (`id`),
  ADD CONSTRAINT `obtiene_ibfk_2` FOREIGN KEY (`nroDocumento`,`tipoDocumento`) REFERENCES `cliente` (`nroDocumento`, `tipoDocumento`) ON DELETE CASCADE;

--
-- Filtros para la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `paciente_ibfk_1` FOREIGN KEY (`nroDocumento`,`tipoDocumento`) REFERENCES `cliente` (`nroDocumento`, `tipoDocumento`);

--
-- Filtros para la tabla `posee`
--
ALTER TABLE `posee`
  ADD CONSTRAINT `posee_ibfk_1` FOREIGN KEY (`nroDocumento`,`tipoDocumento`) REFERENCES `deportista` (`nroDocumento`, `tipoDocumento`),
  ADD CONSTRAINT `posee_ibfk_2` FOREIGN KEY (`id_Estado`) REFERENCES `estado` (`id_Estado`);

--
-- Filtros para la tabla `practica`
--
ALTER TABLE `practica`
  ADD CONSTRAINT `practica_ibfk_1` FOREIGN KEY (`nroDocumento`,`tipoDocumento`) REFERENCES `cliente` (`nroDocumento`, `tipoDocumento`),
  ADD CONSTRAINT `practica_ibfk_2` FOREIGN KEY (`idRutina`) REFERENCES `rutina` (`idRutina`);

--
-- Filtros para la tabla `realiza`
--
ALTER TABLE `realiza`
  ADD CONSTRAINT `realiza_ibfk_1` FOREIGN KEY (`idPago`) REFERENCES `pago` (`idPago`),
  ADD CONSTRAINT `realiza_ibfk_2` FOREIGN KEY (`nombre`) REFERENCES `planpago` (`nombre`);

--
-- Filtros para la tabla `selecciona`
--
ALTER TABLE `selecciona`
  ADD CONSTRAINT `selecciona_ibfk_1` FOREIGN KEY (`nroDocumento`,`tipoDocumento`) REFERENCES `cliente` (`nroDocumento`, `tipoDocumento`),
  ADD CONSTRAINT `selecciona_ibfk_2` FOREIGN KEY (`nombre`) REFERENCES `localgym` (`nombre`);

--
-- Filtros para la tabla `tiene`
--
ALTER TABLE `tiene`
  ADD CONSTRAINT `tiene_ibfk_1` FOREIGN KEY (`idDeporte`) REFERENCES `deporte` (`idDeporte`),
  ADD CONSTRAINT `tiene_ibfk_2` FOREIGN KEY (`nombreCombo`) REFERENCES `comboejercicio` (`nombreCombo`),
  ADD CONSTRAINT `tiene_ibfk_3` FOREIGN KEY (`id_Ejercicio`) REFERENCES `ejercicio` (`id_Ejercicio`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
