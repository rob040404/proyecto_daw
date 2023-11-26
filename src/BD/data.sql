use crunchydb;

-- Creamos un usuario del restaurante.
INSERT INTO usuarios (nombre, apellidos, contrasena, rol, email) 
VALUES ('Sancho', 'Panza', '1234', 'admin', 'sancho@crunchy.com');

INSERT INTO stock (nombre_producto, precio, cantidad)
VALUES 
('Lechuga', '0.50', '20'),
('Pollo', '6', '9.5'),
('Tortita', '1', '100');
