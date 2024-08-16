USE FidatBD;
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
ALTER TABLE
    Obtiene
ADD
    FOREIGN KEY (puntMaxima) REFERENCES Calificacion(puntMaxima);
    
ALTER TABLE
    Obtiene
ADD
    FOREIGN KEY (nroDocumento, tipoDocumento) REFERENCES Cliente(nroDocumento, tipoDocumento);
