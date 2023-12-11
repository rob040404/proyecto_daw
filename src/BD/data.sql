use crunchydb;

-- Creamos un usuario del restaurante.
INSERT INTO usuarios (nombre, apellidos, contrasena, rol, email) 
VALUES ('Sancho', 'Panza', '1234', 'admin', 'sancho@crunchy.com'),
        ('Alonso', 'Quijano', '1234', 'cocinero', 'quijote@quijote.com'),
        ('Dulcinea', 'del Toboso', '1234', 'camarero', 'dulcinea@crunchy.com'),
        ('Pepe', 'De la Torre', '1234', 'camarero', 'pepe@crunchy.com'),
        ('Beatriz', 'Fernandez', '1234', 'camarero', 'bea@crunchy.com'),
        ('Rocinante', 'Exposito', '1234', 'admin', 'rocinante@crunchy.com');

-- Creamos varios clientes para probar la gestión de las reservas
INSERT INTO reservas (id_usuario, mesa, nombre, apellidos, fecha_hora_reserva, telefono, correo, personas, estado)
VALUES (3, 3, 'Luis', 'Ballesteros', '2023-12-07 21:30:00', '673782981', 'luis1753@gmail.com', 4, 'Aceptada'); 
INSERT INTO reservas (id_usuario, mesa, nombre, apellidos, fecha_hora_reserva, telefono, correo, personas, estado)
VALUES (4, 4, 'Ana', 'Ruiz', '2023-12-07 22:00:00', '652738287', 'ana99@gmail.com', 2, 'Aceptada');
-- Creamos stock
INSERT INTO stock (nombre_producto, precio, cantidad)
VALUES 
('Lechuga', '0.50', '20'),
('Pollo', '6', '9.5'),
('Tortita', '1', '100');