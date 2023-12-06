use crunchydb;
DELETE FROM usuarios;
-- Creamos un usuario del restaurante.
INSERT INTO usuarios (nombre, apellidos, contrasena, rol, email) 
VALUES ('Sancho', 'Panza', '1234', 'admin', 'sancho@crunchy.com'),
    ('Alonso', 'Quijano', '1234', 'cocinero', 'quijote@quijote.com'),
    ('Dulcinea', 'del Toboso', '1234', 'camarero', 'dulcinea@crunchy.com'),
    ('Rocinante', 'Exposito', '1234', 'admin', 'rocinante@crunchy.com');
DELETE FROM stock;
INSERT INTO stock (nombre_producto, precio, cantidad)
VALUES 
('Lechuga', '0.50', '20'),
('Pollo', '6', '9.5'),
('Tortita', '1', '100');
