use crunchydb;

-- Creamos un usuario del restaurante.
INSERT INTO usuarios (nombre, apellidos, contrasena, rol, email) 
VALUES ('Sancho', 'Panza', '1234', 'admin', 'sancho@crunchy.com');
INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellidos`, `contrasena`, `rol`, `email`) 
VALUES ('2', 'Alonso', 'Quijano', '1234', 'cocinero', 'quijote@quijote.com');
INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellidos`, `contrasena`, `rol`, `email`) 
VALUES ('3', 'Dulcinea', 'del Toboso', '1234', 'camarero', 'dulcinea@crunchy.com');
-- Creamos varios clientes para probar la gestión de las reservas
INSERT INTO reservas (id_reserva, id_usuario, mesa, nombre, apellidos, fecha_hora_reserva, telefono, 
correo, num_personas, fecha_hora_llegada, estado, observaciones)
VALUES (NULL, 2, 3, 'Luis', 'Ballesteros', '2023-12-07 21:30:00', '673782981', 
'luis1753@gmail.com', 4, NULL, NULL, NULL); 
INSERT INTO reservas (id_reserva, id_usuario, mesa, nombre, apellidos, fecha_hora_reserva, telefono, 
correo, num_personas, fecha_hora_llegada, estado, observaciones)
VALUES (NULL, 3, 4, 'Ana', 'Ruiz', '2023-12-07 22:00:00', '652738287', 
'ana99@gmail.com', 2, NULL, NULL, NULL);
-- Creamos stock
INSERT INTO stock (nombre_producto, precio, cantidad)
VALUES 
('Lechuga', '0.50', '20'),
('Pollo', '6', '9.5'),
('Tortita', '1', '100');
