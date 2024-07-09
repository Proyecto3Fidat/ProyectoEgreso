USE FidatBD;


CREATE TABLE Cliente(
	nroDocumento int,
	tipoDocumento VARCHAR(12),
	altura double NOT NULL,
	peso int NOT NULL,
	calle VARCHAR(25) NOT NULL,
	numero int NOT NULL,
	esquina VARCHAR(50) NOT NULL,
	email VARCHAR(18) NOT NULL,
	patologias VARCHAR(25) NOT NULL,
	fechaNacimiento DATE NOT NULL,
	nombre VARCHAR(12) NOT NULL,
	apellido VARCHAR(12) NOT NULL,
	PRIMARY KEY(nroDocumento,tipoDocumento)
);

CREATE TABLE Usuario(
    nroDocumento int NOT NULL,
    rol int,
    passwd VARCHAR(22) NOT NULL,
    PRIMARY KEY(nroDocumento,rol)
);

CREATE TABLE Cliente_Telefono(
    nroDocumento int,
	tipoDocumento VARCHAR(12) ,
	telefono int,
    PRIMARY KEY(nroDocumento,tipoDocumento, telefono)
);

CREATE TABLE Deportista(
    nroDocumento int,
	tipoDocumento VARCHAR(12) ,
	deporte VARCHAR(15) NOT NULL,
	posicion VARCHAR(15) NOT NULL,
	estado VARCHAR (15) NOT NULL,
	PRIMARY KEY(nroDocumento,tipoDocumento)
);

CREATE TABLE Estado(
    id_Estado int,
    fechaInicio DATE,
    fechaFin DATE,
    PRIMARY KEY(id_Estado)
);

CREATE TABLE Paciente(
    nroDocumento int,
	tipoDocumento VARCHAR(12),
    fisioterapia VARCHAR(2) NOT NULL,
    estado VARCHAR (15) NOT NULL,
    PRIMARY KEY(nroDocumento,tipoDocumento)
);

CREATE TABLE Deporte(
    idDeporte int,
    nombre VARCHAR (20) NOT NULL,
    PRIMARY KEY(idDeporte)
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
    calle varchar(25) NOT NULL,
    nroPuerta VARCHAR(4) NOT NULL,
    esquina VARCHAR(25) NOT NULL,
    PRIMARY KEY (nombre)
);

CREATE TABLE Rutina(
    idRutina int,
    series int NOT NULL,
    repeticiones int NOT NULL,
    dia VARCHAR(8) NOT NULL,
    PRIMARY KEY (idRutina)
);

CREATE TABLE ComboEjercicio(
    nombreCombo int,
    cantEjercicios int NOT NULL,
    PRIMARY KEY (nombreCombo)
);

CREATE TABLE ComboEjercicio_idEjercicio(
    nombreCombo int,
    idEjercicio int,
    PRIMARY KEY (nombreCombo,idEjercicio)
);

CREATE TABLE Ejercicio(
    id_Ejercicio int,
    nombre VARCHAR(20) NOT NULL,
    descripcion VARCHAR(100) NOT NULL,
    tipoEjercicio VARCHAR(20) NOT NULL,
    grupoMuscular VARCHAR(20) NOT NULL,
    PRIMARY KEY (id_Ejercicio)
);

CREATE TABLE Elige (
    nombre VARCHAR(12),
    nroDocumento int,
    tipoDocumento VARCHAR(12),
    PRIMARY KEY (nombre)
);

CREATE TABLE Realiza(
	fechaPago DATE,
	idPago int,
	nombre VARCHAR(12),
	PRIMARY KEY(fechaPago,idPago)
);

CREATE TABLE Arma(
	nroDocumento int,
    tipoDocumento VARCHAR(12),
	fecha DATE,
	PRIMARY KEY(nroDocumento,tipoDocumento)
);

CREATE TABLE Selecciona(
	nroDocumento int,
    tipoDocumento VARCHAR(12),
	nombre VARCHAR(20),
	PRIMARY KEY(nroDocumento,tipoDocumento)
);

CREATE TABLE Conserva(
	nroDocumento int,
    tipoDocumento VARCHAR(12), 
    id_Estado int,
	PRIMARY KEY(nroDocumento,tipoDocumento, id_Estado)
);

CREATE TABLE Posee(
	nroDocumento int,
    tipoDocumento VARCHAR(12),
	id_Estado int,
	PRIMARY KEY(nroDocumento,tipoDocumento, id_Estado)
);

CREATE TABLE Entrena(
    idDeporte int,
    nroDocumento int,
    tipoDocumento VARCHAR(12),
    PRIMARY KEY (idDeporte)
);

CREATE TABLE Practica(
    nroDocumento int,
    tipoDocumento VARCHAR(12),
    idRutina int,
    PRIMARY KEY (nroDocumento,tipoDocumento,idRutina)
);

CREATE TABLE Contiene(
    nombreCombo int,
    id_Ejercicio int,
    PRIMARY KEY (nombreCombo,id_Ejercicio)
);

CREATE TABLE Tiene(
    idDeporte int,
    nombreCombo int,
    id_Ejercicio int,
    PRIMARY KEY (IdDeporte,nombreCombo,id_Ejercicio)
);

CREATE TABLE Compone(
    nombreCombo int,
    id_Ejercicio int,
    PRIMARY KEY (nombreCombo,id_Ejercicio)
);

/*Claves Foráneas*/

ALTER TABLE Cliente_Telefono
ADD FOREIGN KEY (nroDocumento,tipoDocumento) REFERENCES Cliente(nroDocumento,tipoDocumento);

ALTER TABLE Deportista
ADD FOREIGN KEY (nroDocumento,tipoDocumento) REFERENCES Cliente(nroDocumento,tipoDocumento);

ALTER TABLE Paciente
ADD FOREIGN KEY (nroDocumento,tipoDocumento) REFERENCES Cliente(nroDocumento,tipoDocumento);

ALTER TABLE Elige
ADD FOREIGN KEY (nroDocumento,tipoDocumento) REFERENCES Cliente(nroDocumento,tipoDocumento);

ALTER TABLE Elige
ADD FOREIGN KEY (nombre) REFERENCES Planpago(nombre);

ALTER TABLE Realiza
ADD FOREIGN KEY (idPago) REFERENCES Pago(idPago);

ALTER TABLE Realiza
ADD FOREIGN KEY (nombre) REFERENCES Planpago(nombre);

ALTER TABLE Selecciona
ADD FOREIGN KEY (nroDocumento,tipoDocumento) REFERENCES Cliente(nroDocumento,tipoDocumento);

ALTER TABLE Selecciona
ADD FOREIGN KEY (nombre) REFERENCES LocalGym(nombre);

ALTER TABLE Conserva
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Deportista (nroDocumento, tipoDocumento);

ALTER TABLE Conserva
ADD FOREIGN KEY (id_Estado) REFERENCES Estado (id_Estado);

ALTER TABLE Posee
ADD FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Deportista (nroDocumento, tipoDocumento);

ALTER TABLE Posee
ADD FOREIGN KEY (id_Estado) REFERENCES Estado (id_Estado);

ALTER TABLE Entrena
ADD FOREIGN KEY (nroDocumento,tipoDocumento) REFERENCES Cliente(nroDocumento,tipoDocumento);

ALTER TABLE Entrena
ADD FOREIGN KEY (idDeporte) REFERENCES Deporte(idDeporte);

ALTER TABLE Practica
ADD FOREIGN KEY (nroDocumento,tipoDocumento) REFERENCES Cliente(nroDocumento,tipoDocumento);

ALTER TABLE Practica
ADD FOREIGN KEY (idRutina) REFERENCES Rutina(idRutina);

ALTER TABLE Contiene
ADD FOREIGN KEY (nombreCombo) REFERENCES ComboEjercicio(nombreCombo);

ALTER TABLE Contiene
ADD FOREIGN KEY (id_Ejercicio) REFERENCES Ejercicio(id_Ejercicio);

ALTER TABLE Tiene
ADD FOREIGN KEY (idDeporte) REFERENCES Deporte (idDeporte);

ALTER TABLE Tiene
ADD FOREIGN KEY (nombreCombo) REFERENCES ComboEjercicio (nombreCombo);

ALTER TABLE Tiene
ADD FOREIGN KEY (id_Ejercicio) REFERENCES Ejercicio (id_Ejercicio);

ALTER TABLE Compone
ADD FOREIGN KEY (nombreCombo) REFERENCES ComboEjercicio(nombreCombo);

ALTER TABLE Compone
ADD FOREIGN KEY (id_Ejercicio) REFERENCES Ejercicio(id_Ejercicio);



