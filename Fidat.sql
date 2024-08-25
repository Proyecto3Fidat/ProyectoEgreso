USE FidatBD;

CREATE TABLE Cliente(
    nroDocumento VARCHAR (30) NOT NULL,
    tipoDocumento VARCHAR (16) NOT NULL,
    altura DOUBLE,
    peso INT,
    calle VARCHAR(100),
    numero INT,
    esquina VARCHAR(100),
    email VARCHAR(40),
    patologias VARCHAR(25),
    fechaNacimiento DATE,
    nombre VARCHAR(30),
    apellido VARCHAR(30),
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
    deporte VARCHAR(15) NOT NULL,
    posicion VARCHAR(15) NOT NULL,
    estado VARCHAR (15) NOT NULL,
    PRIMARY KEY(nroDocumento, tipoDocumento)
);

CREATE TABLE Estado(
    id_Estado INT,
    fechaInicio DATE,
    fechaFin DATE,
    PRIMARY KEY(id_Estado)
);

CREATE TABLE Paciente(
    nroDocumento VARCHAR(30) NOT NULL,
    tipoDocumento VARCHAR(16),
    fisioterapia VARCHAR(2) NOT NULL,
    estado VARCHAR (15) NOT NULL,
    PRIMARY KEY(nroDocumento, tipoDocumento)
);

CREATE TABLE Deporte(
    idDeporte INT,
    nombre VARCHAR (20) NOT NULL,
    PRIMARY KEY(idDeporte)
);

CREATE TABLE Calificacion(
    id INT AUTO_INCREMENT PRIMARY KEY,
    puntMaxima INT,
    fuerzaMusc INT,
    resMusc INT,
    resAnaerobica INT,
    resilicencia INT,
    flexibilidad INT,
    cumpAgenda INT,
    resMonotonia INT
);

CREATE TABLE Obtiene(
    nroDocumento VARCHAR(30) NOT NULL,
    tipoDocumento VARCHAR (16),
    id INT,
    fecha DATE,
    puntEsperado INT,
    puntObtenido INT,
    PRIMARY KEY(nroDocumento, tipoDocumento, id)
);

CREATE TABLE PlanPago(
    nombre VARCHAR(12),
    descripcion VARCHAR(50) NOT NULL,
    tipoPlan VARCHAR(12) NOT NULL,
    PRIMARY KEY(nombre)
);

CREATE TABLE Pago(
    idPago INT,
    ultimoMesAbonado VARCHAR(12) NOT NULL,
    PRIMARY KEY(idPago)
);

CREATE TABLE LocalGym(
    nombre VARCHAR(20),
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
    id_Ejercicio INT,
    nombre VARCHAR(20) NOT NULL,
    descripcion VARCHAR(100) NOT NULL,
    tipoEjercicio VARCHAR(20) NOT NULL,
    grupoMuscular VARCHAR(20) NOT NULL,
    PRIMARY KEY (id_Ejercicio)
);

CREATE TABLE Elige (
    nombre VARCHAR(12),
    nroDocumento VARCHAR(30) NOT NULL,
    tipoDocumento VARCHAR (16),
    PRIMARY KEY (nombre)
);

CREATE TABLE Realiza(
    fechaPago DATE,
    idPago INT,
    nombre VARCHAR(12),
    PRIMARY KEY(fechaPago, idPago)
);

CREATE TABLE Arma(
    nroDocumento VARCHAR(30) NOT NULL,
    tipoDocumento VARCHAR (16),
    fecha DATE,
    PRIMARY KEY(nroDocumento, tipoDocumento)
);

CREATE TABLE Selecciona(
    nroDocumento VARCHAR(30) NOT NULL,
    tipoDocumento VARCHAR (16),
    nombre VARCHAR(20),
    PRIMARY KEY(nroDocumento, tipoDocumento)
);

CREATE TABLE Conserva(
    nroDocumento VARCHAR(30) NOT NULL,
    tipoDocumento VARCHAR (16),
    id_Estado INT,
    PRIMARY KEY(nroDocumento, tipoDocumento, id_Estado)
);

CREATE TABLE Posee(
    nroDocumento VARCHAR(30) NOT NULL,
    tipoDocumento VARCHAR (16),
    id_Estado INT,
    PRIMARY KEY(nroDocumento, tipoDocumento, id_Estado)
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
    idRutina INT,
    PRIMARY KEY (nroDocumento, tipoDocumento, idRutina)
);

CREATE TABLE Contiene(
    nombreCombo INT,
    id_Ejercicio INT,
    PRIMARY KEY (nombreCombo, id_Ejercicio)
);

CREATE TABLE Tiene(
    idDeporte INT,
    nombreCombo INT,
    id_Ejercicio INT,
    PRIMARY KEY (idDeporte, nombreCombo, id_Ejercicio)
);

CREATE TABLE Compone(
    nombreCombo INT,
    id_Ejercicio INT,
    PRIMARY KEY (nombreCombo, id_Ejercicio)
);

/* Claves Foráneas con ON DELETE CASCADE */
ALTER TABLE
    Cliente_Telefono
ADD
    FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento) ON DELETE CASCADE;

ALTER TABLE
    Obtiene
ADD
    FOREIGN KEY (id) REFERENCES Calificacion(id) ON DELETE CASCADE;

ALTER TABLE
    Obtiene
ADD
    FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento) ON DELETE CASCADE;

ALTER TABLE
    Paciente
ADD
    FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento) ON DELETE CASCADE;

ALTER TABLE
    Elige
ADD
    FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento) ON DELETE CASCADE;

ALTER TABLE
    Elige
ADD
    FOREIGN KEY (nombre) REFERENCES PlanPago(nombre) ON DELETE CASCADE;

ALTER TABLE
    Realiza
ADD
    FOREIGN KEY (idPago) REFERENCES Pago(idPago) ON DELETE CASCADE;

ALTER TABLE
    Realiza
ADD
    FOREIGN KEY (nombre) REFERENCES PlanPago(nombre) ON DELETE CASCADE;

ALTER TABLE
    Selecciona
ADD
    FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento) ON DELETE CASCADE;

ALTER TABLE
    Selecciona
ADD
    FOREIGN KEY (nombre) REFERENCES LocalGym(nombre) ON DELETE CASCADE;

ALTER TABLE
    Conserva
ADD
    FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Deportista(nroDocumento, tipoDocumento) ON DELETE CASCADE;

ALTER TABLE
    Conserva
ADD
    FOREIGN KEY (id_Estado) REFERENCES Estado(id_Estado) ON DELETE CASCADE;

ALTER TABLE
    Posee
ADD
    FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Deportista(nroDocumento, tipoDocumento) ON DELETE CASCADE;

ALTER TABLE
    Posee
ADD
    FOREIGN KEY (id_Estado) REFERENCES Estado(id_Estado) ON DELETE CASCADE;

ALTER TABLE
    Entrena
ADD
    FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento) ON DELETE CASCADE;

ALTER TABLE
    Entrena
ADD
    FOREIGN KEY (idDeporte) REFERENCES Deporte(idDeporte) ON DELETE CASCADE;

ALTER TABLE
    Practica
ADD
    FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento) ON DELETE CASCADE;

ALTER TABLE
    Practica
ADD
    FOREIGN KEY (idRutina) REFERENCES Rutina(idRutina) ON DELETE CASCADE;

ALTER TABLE
    Contiene
ADD
    FOREIGN KEY (nombreCombo) REFERENCES ComboEjercicio(nombreCombo) ON DELETE CASCADE;

ALTER TABLE
    Contiene
ADD
    FOREIGN KEY (id_Ejercicio) REFERENCES Ejercicio(id_Ejercicio) ON DELETE CASCADE;

ALTER TABLE
    Tiene
ADD
    FOREIGN KEY (idDeporte) REFERENCES Deporte(idDeporte) ON DELETE CASCADE;

ALTER TABLE
    Tiene
ADD
    FOREIGN KEY (nombreCombo) REFERENCES ComboEjercicio(nombreCombo) ON DELETE CASCADE;

ALTER TABLE
    Tiene
ADD
    FOREIGN KEY (id_Ejercicio) REFERENCES Ejercicio(id_Ejercicio) ON DELETE CASCADE;

ALTER TABLE
    Compone
ADD
    FOREIGN KEY (nombreCombo) REFERENCES ComboEjercicio(nombreCombo) ON DELETE CASCADE;

ALTER TABLE
    Compone
ADD
    FOREIGN KEY (id_Ejercicio) REFERENCES Ejercicio(id_Ejercicio) ON DELETE CASCADE;

CREATE INDEX idx_calificacion_id ON Calificacion(id);
