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
INSERT INTO reservas(id_reserva, id_usuario, mesa, nombre, estado)
VALUES
(1, 1, 1, 'Ana', 'Aceptada'),
(2, 1, 2, 'Bob', 'Aceptada');
INSERT INTO reservas (id_usuario, mesa, nombre, apellidos, fecha_hora_reserva, telefono, correo, personas, estado)
VALUES (3, 3, 'Luis', 'Ballesteros', '2023-12-07 21:30:00', '673782981', 'luis1753@gmail.com', 4, 'Aceptada'); 
INSERT INTO reservas (id_usuario, mesa, nombre, apellidos, fecha_hora_reserva, telefono, correo, personas, estado)
VALUES (4, 4, 'Ana', 'Ruiz', '2023-12-07 22:00:00', '652738287', 'ana99@gmail.com', 2, 'Aceptada');

INSERT INTO stock(id_producto, nombre_producto, precio, cantidad)
VALUES 
(1, 'Lechuga', '0.50', '20'),
(2, 'Pollo', '6', '9.5'),
(3, 'Tortita', '1', '100'),
(4, 'Tomate', '5', '20');

INSERT INTO platos(id_plato, nombre, precio)
VALUES
(1, 'Ensalada de pollo', 4.00),
(2, 'Tortita de pollo', 5.50),
(3, 'Ensalada clasica', 4.50);

INSERT INTO restar(id_plato, id_producto, cantidad)
VALUES
(1, 1, 1),
(1, 2, 0.5),
(2, 2, 0.5),
(2, 3, 1),
(3, 1, 1),
(3, 4, 1);


INSERT INTO pedir(id_reserva, id_plato, unidades)
VALUES
(1, 1, 2),
(1, 2, 1),
(2, 3, 2),
(2, 2, 2);



INSERT INTO `platos` (`nombre`, `ingredientes`, `categoria`, `subcategoria`, `precio`, `estado`) VALUES
('tacos al pastor', 'Carne a la brasa, cilantro, lima, tortita de maiz', 'principal', 'tacos', '8.90', 'activado'),
('nachos con guacamole', 'Nachos de maíz, con guacamole, salsa agria, pico de gallo, jalapeños', 'entrante', 'nachos', '12.80', 'activado'),
('nachos con queso', 'Nachos con queso fundido, frijoles, ternera', 'entrante', 'nachos', '11.80', 'activado'),
('tacos cochinita pibil', 'Tacos con cochinita pibil y un poco de cebolla roja (4uds.)', 'principal', 'tacos', '12.40', 'activado'),
('ensalada de pollo', 'Pollo, tiras de maiz, lechuga, col lombarda, manzana y cebolla agridulce', 'principal', 'ensalada', '10.90', 'activado'),
('sorbete de limón y tequila', 'Delicioso sorbete con limón y tequila', 'postre', NULL, '6.60', 'activado'),
('corona', NULL, 'bebida', 'alcoholicas', '3.95', 'activado'),
('coca-cola', NULL, 'bebida', 'refresco', '3.60', 'activado');

