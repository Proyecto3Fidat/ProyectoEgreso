DROP DATABASE IF EXISTS FidatBD;
CREATE DATABASE FidatBD;
USE FidatBD;

CREATE TABLE Cliente(
    nroDocumento varchar(30),
    tipoDocumento VARCHAR(12),
    nombre VARCHAR(12) NOT NULL,
    apellido VARCHAR(12) NOT NULL,
    altura double NOT NULL,
    peso int NOT NULL,
    calle VARCHAR(25) NOT NULL,
    numero int NOT NULL,
    esquina VARCHAR(50) NOT NULL,
    email VARCHAR(18) NOT NULL,
    patologias VARCHAR(25) NOT NULL,
    fechaNacimiento DATE NOT NULL,
    PRIMARY KEY(nroDocumento, tipoDocumento)
);

CREATE TABLE Usuario(
    nroDocumento varchar(30) NOT NULL,
    rol int,
    passwd VARCHAR(22) NOT NULL,
    PRIMARY KEY(nroDocumento, rol)
);

CREATE TABLE Cliente_Telefono(
    nroDocumento varchar(30),
    tipoDocumento VARCHAR(12),
    telefono int,
    PRIMARY KEY(nroDocumento, tipoDocumento, telefono)
);

CREATE TABLE Deportista(
    nroDocumento varchar(30) NOT NULL,
    tipoDocumento VARCHAR(12),
    deporte VARCHAR(15) NOT NULL,
    posicion VARCHAR(15) NOT NULL,
    PRIMARY KEY(nroDocumento, tipoDocumento)
);

CREATE TABLE Estado(
    iDEstado int,
    PRIMARY KEY(iDEstado)
);

CREATE TABLE Calificacion(
    puntMaxima int,
    fuerzaMusc int NOT NULL,
    resMusc int NOT NULL,
    resAnaerobica int NOT NULL,
    resiliencia int NOT NULL,
    flexibilidad int NOT NULL,
    cumpAgenda int NOT NULL,
    resMonotonia int NOT NULL,
    PRIMARY KEY(puntMaxima)
);

CREATE TABLE Paciente(
    nroDocumento varchar(30),
    tipoDocumento VARCHAR(12),
    fisioterapia VARCHAR(2) NOT NULL,
    PRIMARY KEY(nroDocumento, tipoDocumento)
);

CREATE TABLE Deporte(
    nombre VARCHAR(12),
    PRIMARY KEY(nombre)
);

CREATE TABLE PlanPago(
    nombre VARCHAR(12),
    descripcion VARCHAR(50) NOT NULL,
    tipoPlan VARCHAR(12) NOT NULL,
    PRIMARY KEY(nombre)
);

CREATE TABLE Pago(
    idPago int,
    ultimoMesAbonado VARCHAR(12) NOT NULL,
    PRIMARY KEY(idPago)
);

CREATE TABLE LocalGym(
    nombre VARCHAR(20),
    calle VARCHAR(25) NOT NULL,
    nroPuerta VARCHAR(4) NOT NULL,
    esquina VARCHAR(25) NOT NULL,
    PRIMARY KEY(nombre)
);

CREATE TABLE Rutina(
    idRutina int,
    series int NOT NULL,
    repeticiones int NOT NULL,
    dia VARCHAR(8) NOT NULL,
    PRIMARY KEY(idRutina)
);

CREATE TABLE ComboEjercicio(
    nombreCombo varchar(20),
    cantEjercicios int NOT NULL,
    PRIMARY KEY(nombreCombo)
);

CREATE TABLE ComboEjercicio_idEjercicio(
    nombreCombo varchar(20),
    idEjercicio int,
    PRIMARY KEY(nombreCombo, idEjercicio)
);

CREATE TABLE Ejercicio(
    idEjercicio int,
    nombre VARCHAR(20) NOT NULL,
    descripcion VARCHAR(100) NOT NULL,
    tipoEjercicio VARCHAR(20) NOT NULL,
    grupoMuscular VARCHAR(20) NOT NULL,
    PRIMARY KEY(idEjercicio)
);

CREATE TABLE Elige (
    nombre VARCHAR(12),
    nroDocumento varchar(30),
    tipoDocumento VARCHAR(12),
    PRIMARY KEY (nombre, nroDocumento, tipoDocumento)
);

CREATE TABLE Agenda (
    nroDocumento varchar(30),
    tipoDocumento VARCHAR(12),
    nombre VARCHAR(12),
    horaInicio int,
    horaFin int,
    fecha DATE,
    capXturno int,
    dias VARCHAR(12),
    PRIMARY KEY(nroDocumento, tipoDocumento, nombre)
);

CREATE TABLE Obtiene (
    nroDocumento varchar(30),
    tipoDocumento VARCHAR(12),
    puntMaxima int,
    fecha DATE,
    puntEsperado int,
    puntObtenido int,
    PRIMARY KEY(nroDocumento, tipoDocumento, puntMaxima)
);

CREATE TABLE Recibe(
    nroDocumento varchar(30),
    tipoDocumento VARCHAR(12),
    iDEstado int,
    fechaInicio DATE,
    fechaFin DATE,
    PRIMARY KEY(nroDocumento, tipoDocumento, iDEstado)
);

CREATE TABLE Realiza(
    fechaPago DATE,
    idPago int,
    nombre VARCHAR(12),
    PRIMARY KEY(fechaPago, idPago, nombre)
);

CREATE TABLE Cumple(
    nroDocumento varchar(30),
    tipoDocumento VARCHAR(12),
    idEjercicio int,
    PRIMARY KEY(nroDocumento, tipoDocumento, idEjercicio)
);

CREATE TABLE Entrena(
    nombre varchar(12),
    nroDocumento varchar(30),
    tipoDocumento VARCHAR(12),
    PRIMARY KEY(nombre, nroDocumento, tipoDocumento)
);

CREATE TABLE Practica(
    nroDocumento varchar(30),
    tipoDocumento VARCHAR(12),
    idRutina int,
    PRIMARY KEY(nroDocumento, tipoDocumento, idRutina)
);

CREATE TABLE Tiene(
    nombre varchar(12),
    nombreCombo varchar(20),
    idEjercicio int,
    PRIMARY KEY(nombre, nombreCombo, idEjercicio)
);

CREATE TABLE Compone(
    nombreCombo varchar(20),
    idEjercicio int,
    PRIMARY KEY(nombreCombo, idEjercicio)
);

/* Claves Foráneas */

ALTER TABLE Cliente_Telefono
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento);

ALTER TABLE Deportista
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento);

ALTER TABLE Paciente
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento);

ALTER TABLE Elige
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento);

ALTER TABLE Elige
ADD FOREIGN KEY (nombre) REFERENCES PlanPago(nombre);

ALTER TABLE Realiza
ADD FOREIGN KEY (idPago) REFERENCES Pago(idPago);

ALTER TABLE Realiza
ADD FOREIGN KEY (nombre) REFERENCES PlanPago(nombre);

ALTER TABLE Entrena
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento);

ALTER TABLE Entrena
ADD FOREIGN KEY (nombre) REFERENCES Deporte(nombre);

ALTER TABLE Practica
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento);

ALTER TABLE Practica
ADD FOREIGN KEY (idRutina) REFERENCES Rutina(idRutina);

ALTER TABLE ComboEjercicio_idEjercicio
ADD FOREIGN KEY (nombreCombo) REFERENCES ComboEjercicio(nombreCombo);

ALTER TABLE ComboEjercicio_idEjercicio
ADD FOREIGN KEY (idEjercicio) REFERENCES Ejercicio(idEjercicio);

ALTER TABLE Tiene
ADD FOREIGN KEY (nombre) REFERENCES Deporte(nombre);

ALTER TABLE Tiene
ADD FOREIGN KEY (nombreCombo) REFERENCES ComboEjercicio(nombreCombo);

ALTER TABLE Tiene
ADD FOREIGN KEY (idEjercicio) REFERENCES Ejercicio(idEjercicio);

ALTER TABLE Compone
ADD FOREIGN KEY (nombreCombo) REFERENCES ComboEjercicio(nombreCombo);

ALTER TABLE Compone
ADD FOREIGN KEY (idEjercicio) REFERENCES Ejercicio(idEjercicio);

ALTER TABLE Obtiene
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento);

ALTER TABLE Obtiene
ADD FOREIGN KEY (puntMaxima) REFERENCES Calificacion(puntMaxima);

ALTER TABLE Recibe
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento);

ALTER TABLE Recibe
ADD FOREIGN KEY (iDEstado) REFERENCES Estado(iDEstado);

ALTER TABLE Cumple
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento);

ALTER TABLE Cumple
ADD FOREIGN KEY (idEjercicio) REFERENCES Ejercicio(idEjercicio);