-- Inserción de datos en la tabla Cliente
INSERT INTO Cliente (nroDocumento, tipoDocumento, rol, passwd, altura, peso, calle, numero, esquina, email, patologias, puntuacion, fechaNacimiento, nombre, apellido) 
VALUES
(1, 'DNI', 'Cliente', 'pass123', 175, 70, 'Calle A', 123, 'Esquina 1', 'email1@example.com', 'Ninguna', 5, '1990-01-01', 'Juan', 'Perez'),
(2, 'DNI', 'Cliente', 'pass456', 180, 80, 'Calle B', 456, 'Esquina 2', 'email2@example.com', 'Asma', 8, '1985-02-02', 'Ana', 'Gomez'),
(3, 'DNI', 'Cliente', 'pass789', 165, 65, 'Calle C', 789, 'Esquina 3', 'email3@example.com', 'Diabetes', 6, '1992-03-03', 'Luis', 'Martinez'),
(4, 'DNI', 'Cliente', 'pass101', 170, 75, 'Calle D', 101, 'Esquina 4', 'email4@example.com', 'Ninguna', 7, '1988-04-04', 'Maria', 'Lopez'),
(5, 'DNI', 'Cliente', 'pass202', 160, 60, 'Calle E', 202, 'Esquina 5', 'email5@example.com', 'Hipertensión', 9, '1995-05-05', 'Carlos', 'Fernandez');

-- Inserción de datos en la tabla Cliente_Telefono
INSERT INTO Cliente_Telefono (nroDocumento, tipoDocumento, rol, telefono) 
VALUES
(1, 'DNI', 'Cliente', 123456789),
(2, 'DNI', 'Cliente', 987654321),
(3, 'DNI', 'Cliente', 123123123),
(4, 'DNI', 'Cliente', 321321321),
(5, 'DNI', 'Cliente', 456456456);

-- Inserción de datos en la tabla Deportista
INSERT INTO Deportista (nroDocumento, tipoDocumento, rol, deporte, posicion, estado) 
VALUES
(1, 'DNI', 'Cliente', 'Futbol', 'Delantero', 'Activo'),
(2, 'DNI', 'Cliente', 'Baloncesto', 'Base', 'Activo'),
(3, 'DNI', 'Cliente', 'Tenis', 'Jugador', 'Inactivo'),
(4, 'DNI', 'Cliente', 'Natacion', 'Nadador', 'Activo'),
(5, 'DNI', 'Cliente', 'Atletismo', 'Corredor', 'Inactivo');

-- Inserción de datos en la tabla Estado
INSERT INTO Estado (id_Estado, fechaInicio, fechaFin) 
VALUES
(1, '2023-01-01', '2023-01-31'),
(2, '2023-02-01', '2023-02-28'),
(3, '2023-03-01', '2023-03-31'),
(4, '2023-04-01', '2023-04-30'),
(5, '2023-05-01', '2023-05-31');

-- Inserción de datos en la tabla Paciente
INSERT INTO Paciente (nroDocumento, tipoDocumento, rol, fisioterapia, estado) 
VALUES
(1, 'DNI', 'Cliente', 'SI', 'Activo'),
(2, 'DNI', 'Cliente', 'NO', 'Inactivo'),
(3, 'DNI', 'Cliente', 'SI', 'Activo'),
(4, 'DNI', 'Cliente', 'NO', 'Inactivo'),
(5, 'DNI', 'Cliente', 'SI', 'Activo');

-- Inserción de datos en la tabla Deporte
INSERT INTO Deporte (idDeporte, nombre) 
VALUES
(1, 'Futbol'),
(2, 'Baloncesto'),
(3, 'Tenis'),
(4, 'Natacion'),
(5, 'Atletismo');

-- Inserción de datos en la tabla PlanPago
INSERT INTO PlanPago (nombre, descripcion, tipoPlan) 
VALUES
('Basico', 'Plan basico', 'Mensual'),
('Avanzado', 'Plan avanzado', 'Mensual'),
('Premium', 'Plan premium', 'Anual'),
('Pro', 'Plan profesional', 'Anual'),
('VIP', 'Plan VIP', 'Mensual');

-- Inserción de datos en la tabla Pago
INSERT INTO Pago (idPago, ultimoMesAbonado) 
VALUES
(1, 'Enero'),
(2, 'Febrero'),
(3, 'Marzo'),
(4, 'Abril'),
(5, 'Mayo');

-- Inserción de datos en la tabla LocalGym
INSERT INTO LocalGym (nombre, calle, nroPuerta, esquina) 
VALUES
('Gym A', 'Calle F', '101', 'Esquina 6'),
('Gym B', 'Calle G', '202', 'Esquina 7'),
('Gym C', 'Calle H', '303', 'Esquina 8'),
('Gym D', 'Calle I', '404', 'Esquina 9'),
('Gym E', 'Calle J', '505', 'Esquina 10');

-- Inserción de datos en la tabla Rutina
INSERT INTO Rutina (idRutina, series, repeticiones, dia) 
VALUES
(1, 3, 10, 'Lunes'),
(2, 4, 12, 'Martes'),
(3, 5, 15, 'Miercoles'),
(4, 3, 10, 'Jueves'),
(5, 4, 12, 'Viernes');

-- Inserción de datos en la tabla ComboEjercicio
INSERT INTO ComboEjercicio (nombreCombo, cantEjercicios) 
VALUES
(1, 5),
(2, 6),
(3, 4),
(4, 7),
(5, 8);

-- Inserción de datos en la tabla ComboEjercicio_idEjercicio
INSERT INTO ComboEjercicio_idEjercicio (nombreCombo, idEjercicio) 
VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(3, 5);

-- Inserción de datos en la tabla Ejercicio
INSERT INTO Ejercicio (id_Ejercicio, nombre, descripcion, tipoEjercicio, grupoMuscular) 
VALUES
(1, 'Ejercicio A', 'Descripcion A', 'Cardio', 'Piernas'),
(2, 'Ejercicio B', 'Descripcion B', 'Fuerza', 'Brazos'),
(3, 'Ejercicio C', 'Descripcion C', 'Resistencia', 'Espalda'),
(4, 'Ejercicio D', 'Descripcion D', 'Flexibilidad', 'Core'),
(5, 'Ejercicio E', 'Descripcion E', 'Potencia', 'Pecho');

-- Inserción de datos en la tabla Elige
INSERT INTO Elige (nombre, nroDocumento, tipoDocumento, rol) 
VALUES
('Basico', 1, 'DNI', 'Cliente'),
('Avanzado', 2, 'DNI', 'Cliente'),
('Premium', 3, 'DNI', 'Cliente'),
('Pro', 4, 'DNI', 'Cliente'),
('VIP', 5, 'DNI', 'Cliente');

-- Inserción de datos en la tabla Realiza
INSERT INTO Realiza (fechaPago, idPago, nombre) 
VALUES
('2023-01-10', 1, 'Basico'),
('2023-02-10', 2, 'Avanzado'),
('2023-03-10', 3, 'Premium'),
('2023-04-10', 4, 'Pro'),
('2023-05-10', 5, 'VIP');

-- Inserción de datos en la tabla Arma
INSERT INTO Arma (nroDocumento, tipoDocumento, rol, fecha) 
VALUES
(1, 'DNI', 'Cliente', '2023-01-15'),
(2, 'DNI', 'Cliente', '2023-02-15'),
(3, 'DNI', 'Cliente', '2023-03-15'),
(4, 'DNI', 'Cliente', '2023-04-15'),
(5, 'DNI', 'Cliente', '2023-05-15');

-- Inserción de datos en la tabla Selecciona
INSERT INTO Selecciona (nroDocumento, tipoDocumento, rol, nombre) 
VALUES
(1, 'DNI', 'Cliente', 'Gym A'),
(2, 'DNI', 'Cliente', 'Gym B'),
(3, 'DNI', 'Cliente', 'Gym C'),
(4, 'DNI', 'Cliente', 'Gym D'),
(5, 'DNI', 'Cliente', 'Gym E');

-- Inserción de datos en la tabla Conserva
INSERT INTO Conserva (nroDocumento, tipoDocumento, rol, id_Estado) 
VALUES
(1, 'DNI', 'Cliente', 1),
(2, 'DNI', 'Cliente', 2),
(3, 'DNI', 'Cliente', 3),
(4, 'DNI', 'Cliente', 4),
(5, 'DNI', 'Cliente', 5);

-- Inserción de datos en la tabla Posee
INSERT INTO Posee (nroDocumento, tipoDocumento, rol, id_Estado) 
VALUES
(1, 'DNI', 'Cliente', 1),
(2, 'DNI', 'Cliente', 2),
(3, 'DNI', 'Cliente', 3),
(4, 'DNI', 'Cliente', 4),
(5, 'DNI', 'Cliente', 5);

-- Inserción de datos en la tabla Entrena
INSERT INTO Entrena (idDeporte, nroDocumento, tipoDocumento, rol) 
VALUES
(1, 1, 'DNI', 'Cliente'),
(2, 2, 'DNI', 'Cliente'),
(3, 3, 'DNI', 'Cliente'),
(4, 4, 'DNI', 'Cliente'),
(5, 5, 'DNI', 'Cliente');

-- Inserción de datos en la tabla Practica
INSERT INTO Practica (nroDocumento, tipoDocumento, rol, idRutina) 
VALUES
(1, 'DNI', 'Cliente', 1),
(2, 'DNI', 'Cliente', 2),
(3, 'DNI', 'Cliente', 3),
(4, 'DNI', 'Cliente', 4),
(5, 'DNI', 'Cliente', 5);

-- Inserción de datos en la tabla Contiene
INSERT INTO Contiene (nombreCombo, id_Ejercicio) 
VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- Inserción de datos en la tabla Tiene
INSERT INTO Tiene (idDeporte, nombreCombo, id_Ejercicio) 
VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5);

-- Inserción de datos en la tabla Compone
INSERT INTO Compone (nombreCombo, id_Ejercicio) 
VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);
