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
    PRIMARY KEY(nroDocumento, tipoDocumento)
);

CREATE TABLE Usuario(
    nroDocumento VARCHAR(30) NOT NULL,
    rol VARCHAR(22),
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

CREATE TABLE Estado(
    id_Estado INT,
    PRIMARY KEY(id_Estado)
);

CREATE TABLE Paciente(
    nroDocumento VARCHAR(30) NOT NULL,
    tipoDocumento VARCHAR(16),
    fisioterapia VARCHAR(2) NOT NULL,
    PRIMARY KEY(nroDocumento, tipoDocumento)
);

CREATE TABLE Deporte(
    idDeporte INT,
    nombre VARCHAR (20) NOT NULL,
    PRIMARY KEY(idDeporte)
);

CREATE TABLE Calificacion(
    idItem INT,
    nombreItem VARCHAR (50),
    PRIMARY KEY (idItem)
);

CREATE TABLE Obtiene(
    nroDocumento VARCHAR(30) NOT NULL,
    tipoDocumento VARCHAR (16),
    idItem INT,
    fecha DATE,
    puntEsperado INT,
    puntObtenido INT,
    PRIMARY KEY(nroDocumento, tipoDocumento, idItem)
);

CREATE TABLE PlanPago(
    nombrePlan VARCHAR(12),
    descripcion VARCHAR(50) NOT NULL,
    tipoPlan VARCHAR(12) NOT NULL,
    PRIMARY KEY(nombrePlan)
);

CREATE TABLE Pago(
    idPago INT,
    ultimoMesAbonado VARCHAR(12) NOT NULL,
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
    idRutina INT,
    series INT NOT NULL,
    repeticiones INT NOT NULL,
    dia VARCHAR(8) NOT NULL,
    PRIMARY KEY (idRutina)
);

CREATE TABLE ComboEjercicio(
    nombreCombo INT,
    cantEjercicios INT NOT NULL,
    PRIMARY KEY (nombreCombo)
);

CREATE TABLE ComboEjercicio_idEjercicio(
    nombreCombo INT,
    idEjercicio INT,
    PRIMARY KEY (nombreCombo, idEjercicio)
);

CREATE TABLE Ejercicio(
    idEjercicio INT,
    nombre VARCHAR(20) NOT NULL,
    descripcion VARCHAR(100) NOT NULL,
    tipoEjercicio VARCHAR(20) NOT NULL,
    grupoMuscular VARCHAR(20) NOT NULL,
    PRIMARY KEY (idEjercicio)
);

CREATE TABLE Elige (
    nombrePlan VARCHAR(12),
    nroDocumento VARCHAR(30) NOT NULL,
    tipoDocumento VARCHAR (16),
    PRIMARY KEY (nombrePlan)
);

CREATE TABLE Realiza(
    fechaPago DATE,
    idPago INT,
    nombrePlan VARCHAR(12),
    PRIMARY KEY(fechaPago, idPago)
);

CREATE TABLE Entrena(
    idDeporte INT,
    nroDocumento VARCHAR(30) NOT NULL,
    tipoDocumento VARCHAR (16),
    PRIMARY KEY (idDeporte)
);

CREATE TABLE Practica(
    nroDocumento VARCHAR(30) NOT NULL,
    tipoDocumento VARCHAR (16),
    PRIMARY KEY (nroDocumento, tipoDocumento)
);

CREATE TABLE Contiene(
    nombreCombo INT,
    idEjercicio INT,
    PRIMARY KEY (nombreCombo, idEjercicio)
);

CREATE TABLE Recibe(
    nroDocumento VARCHAR (30) NOT NULL,
    tipoDocumento VARCHAR (16),
    id_Estado INT,
    fechaInicio DATE,
    fechaFin DATE,
    PRIMARY KEY (nroDocumento,tipoDocumento)
);

CREATE TABLE Tiene(
    idDeporte INT,
    nombreCombo INT,
    idEjercicio INT,
    PRIMARY KEY (idDeporte, nombreCombo, idEjercicio)
);

CREATE TABLE Cumple(
    nroDocumento VARCHAR (30) NOT NULL,
    tipoDocumento VARCHAR (16),
    idEjercicio INT,
    PRIMARY KEY (nroDocumento,tipoDocumento, idEjercicio)
);

CREATE TABLE Compone(
    idRutina INT,
    nombreCombo INT,
    idEjercicio INT,
    PRIMARY KEY (idRutina,nombreCombo, idEjercicio)
);

CREATE TABLE Agenda (
    dia VARCHAR (10),
    horaInicio TIME,
    horaFin TIME,
    agendados VARCHAR (20),
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
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento);

ALTER TABLE Deportista
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento);

ALTER TABLE Paciente
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento);

ALTER TABLE Elige
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento);

ALTER TABLE Elige
ADD FOREIGN KEY (nombrePlan) REFERENCES PlanPago(nombrePlan);

ALTER TABLE Realiza
ADD FOREIGN KEY (idPago) REFERENCES Pago(idPago);

ALTER TABLE Realiza
ADD FOREIGN KEY (nombrePlan) REFERENCES PlanPago(nombrePlan);

ALTER TABLE Entrena
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento);

ALTER TABLE Entrena
ADD FOREIGN KEY (idDeporte) REFERENCES Deporte(idDeporte);

ALTER TABLE Practica
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento);

ALTER TABLE ComboEjercicio_idEjercicio
ADD FOREIGN KEY (nombreCombo) REFERENCES ComboEjercicio(nombreCombo);


ALTER TABLE ComboEjercicio_idEjercicio
ADD FOREIGN KEY (idEjercicio) REFERENCES Ejercicio(idEjercicio);

ALTER TABLE Tiene
ADD FOREIGN KEY (idDeporte) REFERENCES Deporte(idDeporte);

ALTER TABLE Tiene
ADD FOREIGN KEY (nombreCombo) REFERENCES ComboEjercicio(nombreCombo);

ALTER TABLE Tiene
ADD FOREIGN KEY (idEjercicio) REFERENCES Ejercicio(idEjercicio);

ALTER TABLE Compone
ADD FOREIGN KEY (nombreCombo) REFERENCES ComboEjercicio(nombreCombo);

ALTER TABLE Compone
ADD FOREIGN KEY (idEjercicio) REFERENCES Ejercicio(idEjercicio);

ALTER TABLE Compone
ADD FOREIGN KEY (idRutina) REFERENCES Rutina(idRutina);

ALTER TABLE Obtiene
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento);

ALTER TABLE Obtiene
ADD FOREIGN KEY (IdItem) REFERENCES Calificacion(IdItem);

ALTER TABLE Recibe
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento);

ALTER TABLE Recibe
ADD FOREIGN KEY (id_Estado) REFERENCES Estado(id_Estado);

ALTER TABLE Cumple
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento);

ALTER TABLE Cumple
ADD FOREIGN KEY (idEjercicio) REFERENCES Ejercicio(idEjercicio);

ALTER TABLE SeAgenda
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente (nroDocumento, tipoDocumento);

ALTER TABLE SeAgenda
ADD FOREIGN KEY (dia,horaInicio,horaFin) REFERENCES Agenda(dia,horaInicio,horaFin);

ALTER TABLE Conforma
ADD FOREIGN KEY (Dia,horaInicio,horaFin) REFERENCES Agenda (Dia,horaInicio,horaFin);

ALTER TABLE Conforma
ADD FOREIGN KEY (Nombre) REFERENCES Localgym (Nombre);

ALTER TABLE Contiene
ADD FOREIGN KEY (nombreCombo) REFERENCES ComboEjercicio (nombreCombo);

ALTER TABLE Contiene
ADD FOREIGN KEY (idEjercicio) REFERENCES Ejercicio (idEjercicio);
