USE FidatBD;
CREATE TABLE Calificacion(
    id INT AUTO_INCREMENT PRIMARY KEY,
    puntMaxima int,
    fuerzaMusc int,
    resMusc int,
    resAnaerobica int,
    resilicencia int,
    flexibilidad int,
    cumpAgenda int,
    resMonotonia int
);
CREATE TABLE Obtiene(
    nroDocumento varchar(30) NOT NULL,
    tipoDocumento VARCHAR (16),
    id int,
    fecha DATE,
    puntEsperado int,
    puntObtenido int,
    PRIMARY KEY(nroDocumento, tipoDocumento, id)
);
ALTER TABLE
    Obtiene
ADD
    FOREIGN KEY (id) REFERENCES Calificacion(id);
    
ALTER TABLE
    Obtiene
ADD
    FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento) ON DELETE CASCADE;

CREATE INDEX idx_calificacion_id ON Calificacion(id);