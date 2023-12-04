use crunchydb;

-- Creamos un usuario del restaurante.
INSERT INTO usuarios (nombre, apellidos, contrasena, rol, email) 
VALUES ('Sancho', 'Panza', '1234', 'admin', 'sancho@crunchy.com');
INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellidos`, `contrasena`, `rol`, `email`) 
VALUES ('2', 'Alonso', 'Quijano', '1234', 'cocinero', 'quijote@quijote.com');
INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellidos`, `contrasena`, `rol`, `email`) 
VALUES ('3', 'Dulcinea', 'del Toboso', '1234', 'camarero', 'dulcinea@crunchy.com');

INSERT INTO stock (nombre_producto, precio, cantidad)
VALUES 
('Lechuga', '0.50', '20'),
('Pollo', '6', '9.5'),
('Tortita', '1', '100');
