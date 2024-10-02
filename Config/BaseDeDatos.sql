-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 02-10-2024 a las 01:14:13
-- Versión del servidor: 8.0.32
-- Versión de PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `FidatBD`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Agenda`
--

CREATE TABLE `Agenda` (
  `dia` varchar(10) NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL,
  `agendados` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Calificacion`
--

CREATE TABLE `Calificacion` (
  `idItem` int NOT NULL,
  `nombreItem` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cliente`
--

CREATE TABLE `Cliente` (
  `nroDocumento` varchar(30) NOT NULL,
  `tipoDocumento` varchar(16) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `apellido` varchar(30) DEFAULT NULL,
  `altura` double DEFAULT NULL,
  `peso` int DEFAULT NULL,
  `calle` varchar(100) DEFAULT NULL,
  `numero` int DEFAULT NULL,
  `esquina` varchar(100) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `patologias` varchar(25) DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cliente_Telefono`
--

CREATE TABLE `Cliente_Telefono` (
  `nroDocumento` varchar(30) NOT NULL,
  `tipoDocumento` varchar(16) NOT NULL,
  `telefono` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ComboEjercicio`
--

CREATE TABLE `ComboEjercicio` (
  `nombreCombo` varchar(20) NOT NULL,
  `cantEjercicios` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ComboEjercicio_idEjercicio`
--

CREATE TABLE `ComboEjercicio_idEjercicio` (
  `nombreCombo` varchar(20) NOT NULL,
  `idEjercicio` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Compone`
--

CREATE TABLE `Compone` (
  `idRutina` int NOT NULL,
  `nombreCombo` varchar(20) NOT NULL,
  `idEjercicio` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Conforma`
--

CREATE TABLE `Conforma` (
  `nombre` varchar(20) NOT NULL,
  `dia` varchar(10) NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Contiene`
--

CREATE TABLE `Contiene` (
  `nombreCombo` varchar(20) NOT NULL,
  `idEjercicio` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cumple`
--

CREATE TABLE `Cumple` (
  `nroDocumento` varchar(30) NOT NULL,
  `tipoDocumento` varchar(16) NOT NULL,
  `idEjercicio` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Deporte`
--

CREATE TABLE `Deporte` (
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Deportista`
--

CREATE TABLE `Deportista` (
  `nroDocumento` varchar(30) NOT NULL,
  `tipoDocumento` varchar(16) NOT NULL,
  `posicion` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ejercicio`
--

CREATE TABLE `Ejercicio` (
  `idEjercicio` int NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `tipoEjercicio` varchar(20) NOT NULL,
  `grupoMuscular` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Elige`
--

CREATE TABLE `Elige` (
  `fechaPago` date DEFAULT NULL,
  `idPago` int DEFAULT NULL,
  `nombrePlan` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Entrena`
--

CREATE TABLE `Entrena` (
  `nombre` varchar(20) NOT NULL,
  `nroDocumento` varchar(30) NOT NULL,
  `tipoDocumento` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Estado`
--

CREATE TABLE `Estado` (
  `id_Estado` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `LocalGym`
--

CREATE TABLE `LocalGym` (
  `nombre` varchar(20) NOT NULL,
  `capXturno` int DEFAULT NULL,
  `calle` varchar(25) NOT NULL,
  `nroPuerta` varchar(4) NOT NULL,
  `esquina` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Obtiene`
--

CREATE TABLE `Obtiene` (
  `nroDocumento` varchar(30) NOT NULL,
  `tipoDocumento` varchar(16) NOT NULL,
  `idItem` int NOT NULL,
  `fecha` date DEFAULT NULL,
  `puntEsperado` int DEFAULT NULL,
  `puntObtenido` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Paciente`
--

CREATE TABLE `Paciente` (
  `nroDocumento` varchar(30) NOT NULL,
  `tipoDocumento` varchar(16) NOT NULL,
  `fisioterapia` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pago`
--

CREATE TABLE `Pago` (
  `idPago` int NOT NULL,
  `ultimoMesAbonado` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PlanPago`
--

CREATE TABLE `PlanPago` (
  `nombrePlan` varchar(12) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `tipoPlan` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Practica`
--

CREATE TABLE `Practica` (
  `nroDocumento` varchar(30) NOT NULL,
  `tipoDocumento` varchar(16) NOT NULL,
  `idRutina` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Realiza`
--

CREATE TABLE `Realiza` (
  `fechaPago` date NOT NULL,
  `idPago` int NOT NULL,
  `nombrePlan` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Recibe`
--

CREATE TABLE `Recibe` (
  `nroDocumento` varchar(30) NOT NULL,
  `tipoDocumento` varchar(16) NOT NULL,
  `id_Estado` int DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Rutina`
--

CREATE TABLE `Rutina` (
  `idRutina` int NOT NULL,
  `series` int NOT NULL,
  `repeticiones` int NOT NULL,
  `dia` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SeAgenda`
--

CREATE TABLE `SeAgenda` (
  `nroDocumento` varchar(30) NOT NULL,
  `tipoDocumento` varchar(16) NOT NULL,
  `dia` varchar(10) NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL,
  `fecha` date DEFAULT NULL,
  `asistencia` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tiene`
--

CREATE TABLE `Tiene` (
  `nombre` varchar(20) NOT NULL,
  `nombreCombo` varchar(20) NOT NULL,
  `idEjercicio` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE `Usuario` (
  `nroDocumento` varchar(30) NOT NULL,
  `rol` varchar(35) DEFAULT NULL,
  `passwd` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Agenda`
--
ALTER TABLE `Agenda`
  ADD PRIMARY KEY (`dia`,`horaInicio`,`horaFin`);

--
-- Indices de la tabla `Calificacion`
--
ALTER TABLE `Calificacion`
  ADD PRIMARY KEY (`idItem`);

--
-- Indices de la tabla `Cliente`
--
ALTER TABLE `Cliente`
  ADD PRIMARY KEY (`nroDocumento`,`tipoDocumento`);

--
-- Indices de la tabla `Cliente_Telefono`
--
ALTER TABLE `Cliente_Telefono`
  ADD PRIMARY KEY (`nroDocumento`,`tipoDocumento`,`telefono`);

--
-- Indices de la tabla `ComboEjercicio`
--
ALTER TABLE `ComboEjercicio`
  ADD PRIMARY KEY (`nombreCombo`);

--
-- Indices de la tabla `ComboEjercicio_idEjercicio`
--
ALTER TABLE `ComboEjercicio_idEjercicio`
  ADD PRIMARY KEY (`nombreCombo`,`idEjercicio`),
  ADD KEY `idEjercicio` (`idEjercicio`);

--
-- Indices de la tabla `Compone`
--
ALTER TABLE `Compone`
  ADD PRIMARY KEY (`idRutina`,`nombreCombo`,`idEjercicio`),
  ADD KEY `nombreCombo` (`nombreCombo`),
  ADD KEY `idEjercicio` (`idEjercicio`);

--
-- Indices de la tabla `Conforma`
--
ALTER TABLE `Conforma`
  ADD PRIMARY KEY (`nombre`,`dia`,`horaInicio`,`horaFin`),
  ADD KEY `dia` (`dia`,`horaInicio`,`horaFin`);

--
-- Indices de la tabla `Contiene`
--
ALTER TABLE `Contiene`
  ADD PRIMARY KEY (`nombreCombo`,`idEjercicio`),
  ADD KEY `idEjercicio` (`idEjercicio`);

--
-- Indices de la tabla `Cumple`
--
ALTER TABLE `Cumple`
  ADD PRIMARY KEY (`nroDocumento`,`tipoDocumento`,`idEjercicio`),
  ADD KEY `idEjercicio` (`idEjercicio`);

--
-- Indices de la tabla `Deporte`
--
ALTER TABLE `Deporte`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `Deportista`
--
ALTER TABLE `Deportista`
  ADD PRIMARY KEY (`nroDocumento`,`tipoDocumento`);

--
-- Indices de la tabla `Ejercicio`
--
ALTER TABLE `Ejercicio`
  ADD PRIMARY KEY (`idEjercicio`);

--
-- Indices de la tabla `Elige`
--
ALTER TABLE `Elige`
  ADD KEY `fechaPago` (`fechaPago`,`nombrePlan`,`idPago`);

--
-- Indices de la tabla `Entrena`
--
ALTER TABLE `Entrena`
  ADD PRIMARY KEY (`nombre`),
  ADD KEY `nroDocumento` (`nroDocumento`,`tipoDocumento`);

--
-- Indices de la tabla `Estado`
--
ALTER TABLE `Estado`
  ADD PRIMARY KEY (`id_Estado`);

--
-- Indices de la tabla `LocalGym`
--
ALTER TABLE `LocalGym`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `Obtiene`
--
ALTER TABLE `Obtiene`
  ADD PRIMARY KEY (`nroDocumento`,`tipoDocumento`,`idItem`),
  ADD KEY `idItem` (`idItem`);

--
-- Indices de la tabla `Paciente`
--
ALTER TABLE `Paciente`
  ADD PRIMARY KEY (`nroDocumento`,`tipoDocumento`);

--
-- Indices de la tabla `Pago`
--
ALTER TABLE `Pago`
  ADD PRIMARY KEY (`idPago`);

--
-- Indices de la tabla `PlanPago`
--
ALTER TABLE `PlanPago`
  ADD PRIMARY KEY (`nombrePlan`);

--
-- Indices de la tabla `Practica`
--
ALTER TABLE `Practica`
  ADD PRIMARY KEY (`nroDocumento`,`tipoDocumento`,`idRutina`),
  ADD KEY `idRutina` (`idRutina`);

--
-- Indices de la tabla `Realiza`
--
ALTER TABLE `Realiza`
  ADD PRIMARY KEY (`fechaPago`,`idPago`),
  ADD KEY `idx_realiza` (`fechaPago`,`nombrePlan`,`idPago`),
  ADD KEY `idPago` (`idPago`),
  ADD KEY `nombrePlan` (`nombrePlan`);

--
-- Indices de la tabla `Recibe`
--
ALTER TABLE `Recibe`
  ADD PRIMARY KEY (`nroDocumento`,`tipoDocumento`),
  ADD KEY `id_Estado` (`id_Estado`);

--
-- Indices de la tabla `Rutina`
--
ALTER TABLE `Rutina`
  ADD PRIMARY KEY (`idRutina`);

--
-- Indices de la tabla `SeAgenda`
--
ALTER TABLE `SeAgenda`
  ADD PRIMARY KEY (`nroDocumento`,`tipoDocumento`,`dia`,`horaInicio`,`horaFin`),
  ADD KEY `dia` (`dia`,`horaInicio`,`horaFin`);

--
-- Indices de la tabla `Tiene`
--
ALTER TABLE `Tiene`
  ADD PRIMARY KEY (`nombre`,`nombreCombo`,`idEjercicio`),
  ADD KEY `nombreCombo` (`nombreCombo`),
  ADD KEY `idEjercicio` (`idEjercicio`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`nroDocumento`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Cliente_Telefono`
--
ALTER TABLE `Cliente_Telefono`
  ADD CONSTRAINT `Cliente_Telefono_ibfk_1` FOREIGN KEY (`nroDocumento`,`tipoDocumento`) REFERENCES `Cliente` (`nroDocumento`, `tipoDocumento`);

--
-- Filtros para la tabla `ComboEjercicio_idEjercicio`
--
ALTER TABLE `ComboEjercicio_idEjercicio`
  ADD CONSTRAINT `ComboEjercicio_idEjercicio_ibfk_1` FOREIGN KEY (`nombreCombo`) REFERENCES `ComboEjercicio` (`nombreCombo`),
  ADD CONSTRAINT `ComboEjercicio_idEjercicio_ibfk_2` FOREIGN KEY (`idEjercicio`) REFERENCES `Ejercicio` (`idEjercicio`);

--
-- Filtros para la tabla `Compone`
--
ALTER TABLE `Compone`
  ADD CONSTRAINT `Compone_ibfk_1` FOREIGN KEY (`nombreCombo`) REFERENCES `ComboEjercicio` (`nombreCombo`),
  ADD CONSTRAINT `Compone_ibfk_2` FOREIGN KEY (`idEjercicio`) REFERENCES `Ejercicio` (`idEjercicio`),
  ADD CONSTRAINT `Compone_ibfk_3` FOREIGN KEY (`idRutina`) REFERENCES `Rutina` (`idRutina`);

--
-- Filtros para la tabla `Conforma`
--
ALTER TABLE `Conforma`
  ADD CONSTRAINT `Conforma_ibfk_1` FOREIGN KEY (`dia`,`horaInicio`,`horaFin`) REFERENCES `Agenda` (`dia`, `horaInicio`, `horaFin`),
  ADD CONSTRAINT `Conforma_ibfk_2` FOREIGN KEY (`nombre`) REFERENCES `LocalGym` (`nombre`);

--
-- Filtros para la tabla `Contiene`
--
ALTER TABLE `Contiene`
  ADD CONSTRAINT `Contiene_ibfk_1` FOREIGN KEY (`nombreCombo`) REFERENCES `ComboEjercicio` (`nombreCombo`),
  ADD CONSTRAINT `Contiene_ibfk_2` FOREIGN KEY (`idEjercicio`) REFERENCES `Ejercicio` (`idEjercicio`);

--
-- Filtros para la tabla `Cumple`
--
ALTER TABLE `Cumple`
  ADD CONSTRAINT `Cumple_ibfk_1` FOREIGN KEY (`nroDocumento`,`tipoDocumento`) REFERENCES `Cliente` (`nroDocumento`, `tipoDocumento`),
  ADD CONSTRAINT `Cumple_ibfk_2` FOREIGN KEY (`idEjercicio`) REFERENCES `Ejercicio` (`idEjercicio`);

--
-- Filtros para la tabla `Deportista`
--
ALTER TABLE `Deportista`
  ADD CONSTRAINT `Deportista_ibfk_1` FOREIGN KEY (`nroDocumento`,`tipoDocumento`) REFERENCES `Cliente` (`nroDocumento`, `tipoDocumento`);

--
-- Filtros para la tabla `Elige`
--
ALTER TABLE `Elige`
  ADD CONSTRAINT `Elige_ibfk_1` FOREIGN KEY (`fechaPago`,`nombrePlan`,`idPago`) REFERENCES `Realiza` (`fechaPago`, `nombrePlan`, `idPago`);

--
-- Filtros para la tabla `Entrena`
--
ALTER TABLE `Entrena`
  ADD CONSTRAINT `Entrena_ibfk_1` FOREIGN KEY (`nroDocumento`,`tipoDocumento`) REFERENCES `Cliente` (`nroDocumento`, `tipoDocumento`),
  ADD CONSTRAINT `Entrena_ibfk_2` FOREIGN KEY (`nombre`) REFERENCES `Deporte` (`nombre`);

--
-- Filtros para la tabla `Obtiene`
--
ALTER TABLE `Obtiene`
  ADD CONSTRAINT `Obtiene_ibfk_1` FOREIGN KEY (`nroDocumento`,`tipoDocumento`) REFERENCES `Cliente` (`nroDocumento`, `tipoDocumento`),
  ADD CONSTRAINT `Obtiene_ibfk_2` FOREIGN KEY (`idItem`) REFERENCES `Calificacion` (`idItem`);

--
-- Filtros para la tabla `Paciente`
--
ALTER TABLE `Paciente`
  ADD CONSTRAINT `Paciente_ibfk_1` FOREIGN KEY (`nroDocumento`,`tipoDocumento`) REFERENCES `Cliente` (`nroDocumento`, `tipoDocumento`);

--
-- Filtros para la tabla `Practica`
--
ALTER TABLE `Practica`
  ADD CONSTRAINT `Practica_ibfk_1` FOREIGN KEY (`nroDocumento`,`tipoDocumento`) REFERENCES `Cliente` (`nroDocumento`, `tipoDocumento`),
  ADD CONSTRAINT `Practica_ibfk_2` FOREIGN KEY (`idRutina`) REFERENCES `Rutina` (`idRutina`);

--
-- Filtros para la tabla `Realiza`
--
ALTER TABLE `Realiza`
  ADD CONSTRAINT `Realiza_ibfk_1` FOREIGN KEY (`idPago`) REFERENCES `Pago` (`idPago`),
  ADD CONSTRAINT `Realiza_ibfk_2` FOREIGN KEY (`nombrePlan`) REFERENCES `PlanPago` (`nombrePlan`);

--
-- Filtros para la tabla `Recibe`
--
ALTER TABLE `Recibe`
  ADD CONSTRAINT `Recibe_ibfk_1` FOREIGN KEY (`nroDocumento`,`tipoDocumento`) REFERENCES `Cliente` (`nroDocumento`, `tipoDocumento`),
  ADD CONSTRAINT `Recibe_ibfk_2` FOREIGN KEY (`id_Estado`) REFERENCES `Estado` (`id_Estado`);

--
-- Filtros para la tabla `SeAgenda`
--
ALTER TABLE `SeAgenda`
  ADD CONSTRAINT `SeAgenda_ibfk_1` FOREIGN KEY (`nroDocumento`,`tipoDocumento`) REFERENCES `Cliente` (`nroDocumento`, `tipoDocumento`),
  ADD CONSTRAINT `SeAgenda_ibfk_2` FOREIGN KEY (`dia`,`horaInicio`,`horaFin`) REFERENCES `Agenda` (`dia`, `horaInicio`, `horaFin`);

--
-- Filtros para la tabla `Tiene`
--
ALTER TABLE `Tiene`
  ADD CONSTRAINT `Tiene_ibfk_1` FOREIGN KEY (`nombre`) REFERENCES `Deporte` (`nombre`),
  ADD CONSTRAINT `Tiene_ibfk_2` FOREIGN KEY (`nombreCombo`) REFERENCES `ComboEjercicio` (`nombreCombo`),
  ADD CONSTRAINT `Tiene_ibfk_3` FOREIGN KEY (`idEjercicio`) REFERENCES `Ejercicio` (`idEjercicio`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
