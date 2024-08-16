USE FidatBD;

CREATE TABLE Cliente(
    nroDocumento varchar (30) NOT NULL,
    tipoDocumento VARCHAR (16) NOT NULL,
    altura double,
    peso int,
    calle VARCHAR(100),
    numero int,
    esquina VARCHAR(100),
    email VARCHAR(40),
    patologias VARCHAR(25),
    fechaNacimiento DATE,
    nombre VARCHAR(30),
    apellido VARCHAR(30),
    PRIMARY KEY(nroDocumento, tipoDocumento)
);

CREATE TABLE Usuario(
    nroDocumento varchar(30) NOT NULL,
    rol varchar(22),
    passwd VARCHAR(255) NOT NULL,
    token VARCHAR(255) NOT NULL,
    PRIMARY KEY(nroDocumento)
);

CREATE TABLE Cliente_Telefono(
    nroDocumento varchar(30) NOT NULL,
    tipoDocumento VARCHAR (16),
    telefono int,
    PRIMARY KEY(nroDocumento, tipoDocumento, telefono)
);

CREATE TABLE Deportista(
    nroDocumento varchar(30) NOT NULL,
    tipoDocumento VARCHAR (16),
    deporte VARCHAR(15) NOT NULL,
    posicion VARCHAR(15) NOT NULL,
    estado VARCHAR (15) NOT NULL,
    PRIMARY KEY(nroDocumento, tipoDocumento)
);

CREATE TABLE Estado(
    id_Estado int,
    fechaInicio DATE,
    fechaFin DATE,
    PRIMARY KEY(id_Estado)
);

CREATE TABLE Paciente(
    nroDocumento varchar(30) NOT NULL,
    tipoDocumento VARCHAR(16),
    fisioterapia VARCHAR(2) NOT NULL,
    estado VARCHAR (15) NOT NULL,
    PRIMARY KEY(nroDocumento, tipoDocumento)
);

CREATE TABLE Deporte(
    idDeporte int,
    nombre VARCHAR (20) NOT NULL,
    PRIMARY KEY(idDeporte)
);
CREATE TABLE Calificacion(
    puntMaxima int,
    fuerzaMusc int,
    resMusc int,
    resAnaerobica int,
    resilicencia int,
    flexibilidad int,
    cumpAgenda int,
    resMonotonia int,
    PRIMARY KEY(puntMaxima)
);
CREATE TABLE Obtiene(
    nroDocumento varchar(30) NOT NULL,
    tipoDocumento VARCHAR (16),
    puntMaxima int,
    fecha DATE,
    puntEsperado int,
    puntObtenido int,
    PRIMARY KEY(nroDocumento, tipoDocumento, puntMaxima)
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
    PRIMARY KEY (nombreCombo, idEjercicio)
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
    nroDocumento varchar(30) NOT NULL,
    tipoDocumento VARCHAR (16),
    PRIMARY KEY (nombre)
);

CREATE TABLE Realiza(
    fechaPago DATE,
    idPago int,
    nombre VARCHAR(12),
    PRIMARY KEY(fechaPago, idPago)
);

CREATE TABLE Arma(
    nroDocumento varchar(30) NOT NULL,
    tipoDocumento VARCHAR (16),
    fecha DATE,
    PRIMARY KEY(nroDocumento, tipoDocumento)
);

CREATE TABLE Selecciona(
    nroDocumento varchar(30) NOT NULL,
    tipoDocumento VARCHAR (16),
    nombre VARCHAR(20),
    PRIMARY KEY(nroDocumento, tipoDocumento)
);

CREATE TABLE Conserva(
    nroDocumento varchar(30) NOT NULL,
    tipoDocumento VARCHAR (16),
    id_Estado int,
    PRIMARY KEY(nroDocumento, tipoDocumento, id_Estado)
);

CREATE TABLE Posee(
    nroDocumento varchar(30) NOT NULL,
    tipoDocumento VARCHAR (16),
    id_Estado int,
    PRIMARY KEY(nroDocumento, tipoDocumento, id_Estado)
);

CREATE TABLE Entrena(
    idDeporte int,
    nroDocumento varchar(30) NOT NULL,
    tipoDocumento VARCHAR (16),
    PRIMARY KEY (idDeporte)
);

CREATE TABLE Practica(
    nroDocumento varchar(30) NOT NULL,
    tipoDocumento VARCHAR (16),
    idRutina int,
    PRIMARY KEY (nroDocumento, tipoDocumento, idRutina)
);

CREATE TABLE Contiene(
    nombreCombo int,
    id_Ejercicio int,
    PRIMARY KEY (nombreCombo, id_Ejercicio)
);

CREATE TABLE Tiene(
    idDeporte int,
    nombreCombo int,
    id_Ejercicio int,
    PRIMARY KEY (IdDeporte, nombreCombo, id_Ejercicio)
);

CREATE TABLE Compone(
    nombreCombo int,
    id_Ejercicio int,
    PRIMARY KEY (nombreCombo, id_Ejercicio)
);

/*Claves Foráneas*/
ALTER TABLE
    Cliente_Telefono
ADD
    FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento);

ALTER TABLE
    Obtiene
ADD
    FOREIGN KEY (puntMaxima) REFERENCES Calificacion(puntMaxima);
    
ALTER TABLE
    Obtiene
ADD
    FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento);

ALTER TABLE
    Paciente
ADD
    FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento);

ALTER TABLE
    Elige
ADD
    FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento);

ALTER TABLE
    Elige
ADD
    FOREIGN KEY (nombre) REFERENCES Planpago(nombre);

ALTER TABLE
    Realiza
ADD
    FOREIGN KEY (idPago) REFERENCES Pago(idPago);

ALTER TABLE
    Realiza
ADD
    FOREIGN KEY (nombre) REFERENCES Planpago(nombre);

ALTER TABLE
    Selecciona
ADD
    FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento);

ALTER TABLE
    Selecciona
ADD
    FOREIGN KEY (nombre) REFERENCES LocalGym(nombre);

ALTER TABLE
    Conserva
ADD
    FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Deportista (nroDocumento, tipoDocumento);

ALTER TABLE
    Conserva
ADD
    FOREIGN KEY (id_Estado) REFERENCES Estado (id_Estado);

ALTER TABLE
    Posee
ADD
    FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Deportista (nroDocumento, tipoDocumento);

ALTER TABLE
    Posee
ADD
    FOREIGN KEY (id_Estado) REFERENCES Estado (id_Estado);

ALTER TABLE
    Entrena
ADD
    FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento);

ALTER TABLE
    Entrena
ADD
    FOREIGN KEY (idDeporte) REFERENCES Deporte(idDeporte);

ALTER TABLE
    Practica
ADD
    FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento);

ALTER TABLE
    Practica
ADD
    FOREIGN KEY (idRutina) REFERENCES Rutina(idRutina);

ALTER TABLE
    Contiene
ADD
    FOREIGN KEY (nombreCombo) REFERENCES ComboEjercicio(nombreCombo);

ALTER TABLE
    Contiene
ADD
    FOREIGN KEY (id_Ejercicio) REFERENCES Ejercicio(id_Ejercicio);

ALTER TABLE
    Tiene
ADD
    FOREIGN KEY (idDeporte) REFERENCES Deporte (idDeporte);

ALTER TABLE
    Tiene
ADD
    FOREIGN KEY (nombreCombo) REFERENCES ComboEjercicio (nombreCombo);

ALTER TABLE
    Tiene
ADD
    FOREIGN KEY (id_Ejercicio) REFERENCES Ejercicio (id_Ejercicio);

ALTER TABLE
    Compone
ADD
    FOREIGN KEY (nombreCombo) REFERENCES ComboEjercicio(nombreCombo);

ALTER TABLE
    Compone
ADD
    FOREIGN KEY (id_Ejercicio) REFERENCES Ejercicio(id_Ejercicio);