USE FidatBD;

CREATE TABLE Cliente(
    nroDocumento VARCHAR (30) NOT NULL,
    tipoDocumento VARCHAR (16) NOT NULL,
    nombre VARCHAR(30),
    apellido VARCHAR(30),
    altura DOUBLE,
    peso INT,
    calle VARCHAR(100),
    numero INT,
    esquina VARCHAR(100),
    email VARCHAR(40),
    patologias VARCHAR(25),
    fechaNacimiento DATE,
    activo BOOLEAN,
    PRIMARY KEY(nroDocumento, tipoDocumento)
);

CREATE TABLE Usuario(
    nroDocumento VARCHAR(30) NOT NULL,
    rol VARCHAR(35),
    passwd VARCHAR(255) NOT NULL,
    token VARCHAR(255) NOT NULL,
    PRIMARY KEY(nroDocumento)
);

CREATE TABLE Cliente_Telefono(
    nroDocumento VARCHAR(30) NOT NULL,
    tipoDocumento VARCHAR (16),
    telefono VARCHAR(25),
    PRIMARY KEY(nroDocumento, tipoDocumento, telefono)
);

CREATE TABLE Deportista(
    nroDocumento VARCHAR(30) NOT NULL,
    tipoDocumento VARCHAR (16),
    posicion VARCHAR(15) NOT NULL,
    PRIMARY KEY(nroDocumento, tipoDocumento)
);

CREATE TABLE Club(
    idClub INT AUTO_INCREMENT,
    nombreClub VARCHAR (20),
    PRIMARY KEY(idClub)
);


CREATE TABLE Estado(
    idEstado INT AUTO_INCREMENT,
    PRIMARY KEY(idEstado)
);

CREATE TABLE Paciente(
    nroDocumento VARCHAR(30) NOT NULL,
    tipoDocumento VARCHAR(16),
    fisioterapia VARCHAR(2) NOT NULL,
    PRIMARY KEY(nroDocumento, tipoDocumento)
);

CREATE TABLE Deporte(
    nombre VARCHAR (20),
    PRIMARY KEY(nombre)
);

CREATE TABLE Calificacion(
    id INT AUTO_INCREMENT,
    puntMaxima INT,
    fuerzaMusc INT,
    resMusc INT,
    resAnaerobica INT,
    resilicencia INT,
    flexibilidad INT,
    cumpAgenda INT,
    resMonotonia INT,
    PRIMARY KEY (id)
);

CREATE TABLE Obtiene(
    nroDocumento VARCHAR(30) NOT NULL,
    tipoDocumento VARCHAR (16),
    id INT AUTO_INCREMENT,
    fecha DATE,
    puntEsperado INT,
    puntObtenido INT,
    PRIMARY KEY(nroDocumento, tipoDocumento, id)
);

CREATE TABLE PlanPago(
    nombrePlan VARCHAR(12),
    descripcion VARCHAR(50) NOT NULL,
    tipoPlan VARCHAR(12) NOT NULL,
    PRIMARY KEY(nombrePlan)
);

CREATE TABLE Pago(
    idPago INT AUTO_INCREMENT,
    fechaVencimiento DATE,
    PRIMARY KEY(idPago)
);

CREATE TABLE LocalGym(
    nombre VARCHAR(20),
    capXturno INT,
    calle VARCHAR(25) NOT NULL,
    nroPuerta VARCHAR(4) NOT NULL,
    esquina VARCHAR(25) NOT NULL,
    PRIMARY KEY (nombre)
);

CREATE TABLE Rutina(
    idRutina INT AUTO_INCREMENT,
    series INT NOT NULL,
    repeticiones INT NOT NULL,
    dia VARCHAR(8) NOT NULL,
    PRIMARY KEY (idRutina)
);

CREATE TABLE ComboEjercicio(
    nombreCombo VARCHAR (20),
    PRIMARY KEY (nombreCombo)
);

CREATE TABLE Ejercicio(
    idEjercicio INT AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(20) NOT NULL,
    descripcion VARCHAR(100) NOT NULL,
    tipoEjercicio VARCHAR(20) NOT NULL,
    grupoMuscular VARCHAR(20) NOT NULL,
    PRIMARY KEY (idEjercicio)
);

CREATE TABLE Elige (
    fechaPago DATE,
    idPago INT AUTO_INCREMENT,
    nombrePlan VARCHAR(12),
    nroDocumento VARCHAR(30) NOT NULL,
    tipoDocumento VARCHAR(16)
);

CREATE TABLE Realiza(
    fechaPago DATE,
    idPago INT,
    nombrePlan VARCHAR(12),
    PRIMARY KEY(fechaPago, idPago)
);

CREATE TABLE Entrena(
    nombre VARCHAR(20),
    nroDocumento VARCHAR(30) NOT NULL,
    tipoDocumento VARCHAR (16),
    PRIMARY KEY (nombre)
);

CREATE TABLE Relacionado(
    idClub INT,
    nombre VARCHAR(20),
    nroDocumento VARCHAR(30) NOT NULL,
    tipoDocumento VARCHAR(16),
    PRIMARY KEY (idClub, nombre, nroDocumento, tipoDocumento)
);

CREATE TABLE Practica(
    nroDocumento VARCHAR(30),
    tipoDocumento VARCHAR (16),
    idRutina int,
    PRIMARY KEY (nroDocumento, tipoDocumento, idRutina)
);

CREATE TABLE Contiene(
    nombreCombo VARCHAR (20),
    idEjercicio INT,
    PRIMARY KEY (nombreCombo, idEjercicio)
);

CREATE TABLE Recibe(
    nroDocumento VARCHAR (30) NOT NULL,
    tipoDocumento VARCHAR (16),
    idEstado INT,
    fechaInicio DATE,
    fechaFin DATE,
    PRIMARY KEY (nroDocumento,tipoDocumento)
);

CREATE TABLE Tiene(
    nombre VARCHAR(20),
    nombreCombo VARCHAR (20),
    idEjercicio INT,
    PRIMARY KEY (nombre, nombreCombo, idEjercicio)
);

CREATE TABLE Cumple(
    nroDocumento VARCHAR (30) NOT NULL,
    tipoDocumento VARCHAR (16),
    idEjercicio INT,
    PRIMARY KEY (nroDocumento,tipoDocumento, idEjercicio)
);

CREATE TABLE Compone(
    idRutina INT,
    nombreCombo VARCHAR (20),
    idEjercicio INT,
    PRIMARY KEY (idRutina,nombreCombo, idEjercicio)
);

CREATE TABLE Agenda (
    dia VARCHAR (10),
    horaInicio TIME,
    horaFin TIME,
    agendados VARCHAR (30),
    PRIMARY KEY (dia,horaInicio,horaFin)
);

CREATE TABLE SeAgenda (
    nroDocumento VARCHAR (30) NOT NULL,
    tipoDocumento VARCHAR (16),
    dia VARCHAR (10),
    horaInicio TIME,
    horaFin TIME,
    fecha DATE,
    asistencia varchar (5),
    PRIMARY KEY (nroDocumento, tipoDocumento, dia,horaInicio, horaFin)
);

CREATE TABLE Conforma(
    nombre VARCHAR(20),
    dia VARCHAR (10),
    horaInicio TIME,
    horaFin TIME,
    PRIMARY KEY (nombre, dia, horaInicio, horaFin)
);

/* Claves Foráneas con ON DELETE CASCADE */
ALTER TABLE Cliente_Telefono
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento) ON DELETE CASCADE;

ALTER TABLE Deportista
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento) ON DELETE CASCADE;

ALTER TABLE Paciente
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento) ON DELETE CASCADE;

CREATE INDEX idx_realiza ON Realiza(fechaPago, nombrePlan, idPago);

ALTER TABLE Elige
ADD FOREIGN KEY (nroDocumento,tipoDocumento) REFERENCES Cliente(nroDocumento,tipoDocumento) ON DELETE CASCADE;

ALTER TABLE Elige
ADD FOREIGN KEY (fechaPago, nombrePlan, idPago) REFERENCES Realiza(fechaPago, nombrePlan, idPago) ON DELETE CASCADE;

ALTER TABLE Realiza
ADD FOREIGN KEY (idPago) REFERENCES Pago(idPago) ON DELETE CASCADE;

ALTER TABLE Realiza
ADD FOREIGN KEY (nombrePlan) REFERENCES PlanPago(nombrePlan) ON DELETE CASCADE;

ALTER TABLE Entrena
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento) ON DELETE CASCADE;

ALTER TABLE Entrena
ADD FOREIGN KEY (nombre) REFERENCES Deporte(nombre) ON DELETE CASCADE;

ALTER TABLE Practica
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento) ON DELETE CASCADE;

ALTER TABLE Practica
ADD FOREIGN KEY (idRutina) REFERENCES Rutina(idRutina) ON DELETE CASCADE;

ALTER TABLE Tiene
ADD FOREIGN KEY (nombre) REFERENCES Deporte(nombre) ON DELETE CASCADE;

ALTER TABLE Tiene
ADD FOREIGN KEY (nombreCombo) REFERENCES ComboEjercicio(nombreCombo) ON DELETE CASCADE;

ALTER TABLE Tiene
ADD FOREIGN KEY (idEjercicio) REFERENCES Ejercicio(idEjercicio) ON DELETE CASCADE;

ALTER TABLE Compone
ADD FOREIGN KEY (nombreCombo) REFERENCES ComboEjercicio(nombreCombo) ON DELETE CASCADE;

ALTER TABLE Compone
ADD FOREIGN KEY (idEjercicio) REFERENCES Ejercicio(idEjercicio) ON DELETE CASCADE;

ALTER TABLE Compone
ADD FOREIGN KEY (idRutina) REFERENCES Rutina(idRutina) ON DELETE CASCADE;

ALTER TABLE Obtiene
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento) ON DELETE CASCADE;

ALTER TABLE Obtiene
ADD FOREIGN KEY (Id) REFERENCES Calificacion(Id) ON DELETE CASCADE;

ALTER TABLE Recibe
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento) ON DELETE CASCADE;

ALTER TABLE Recibe
ADD FOREIGN KEY (idEstado) REFERENCES Estado(idEstado) ON DELETE CASCADE;

ALTER TABLE Cumple
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento) ON DELETE CASCADE;

ALTER TABLE Cumple
ADD FOREIGN KEY (idEjercicio) REFERENCES Ejercicio(idEjercicio) ON DELETE CASCADE;

ALTER TABLE SeAgenda
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente (nroDocumento, tipoDocumento) ON DELETE CASCADE;

ALTER TABLE SeAgenda
ADD FOREIGN KEY (dia,horaInicio,horaFin) REFERENCES Agenda(dia,horaInicio,horaFin) ON DELETE CASCADE;

ALTER TABLE Conforma
ADD FOREIGN KEY (dia, horaInicio, horaFin) REFERENCES Agenda(dia, horaInicio, horaFin) ON DELETE CASCADE;

ALTER TABLE Conforma
ADD FOREIGN KEY (Nombre) REFERENCES LocalGym (Nombre) ON DELETE CASCADE;

ALTER TABLE Contiene
ADD FOREIGN KEY (nombreCombo) REFERENCES ComboEjercicio (nombreCombo) ON DELETE CASCADE;

ALTER TABLE Contiene
ADD FOREIGN KEY (idEjercicio) REFERENCES Ejercicio (idEjercicio) ON DELETE CASCADE;

ALTER TABLE Relacionado
ADD FOREIGN KEY (idClub) REFERENCES Club(idClub) ON DELETE CASCADE;

ALTER TABLE Relacionado
ADD FOREIGN KEY (nombre) REFERENCES Deporte(nombre) ON DELETE CASCADE;

ALTER TABLE Relacionado
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento) ON DELETE CASCADE;
