use crunchydb;

-- Creamos un usuario del restaurante.
INSERT INTO usuarios (nombre, apellidos, contrasena, rol, email) 
VALUES ('Sancho', 'Panza', '1234', 'admin', 'sancho@crunchy.com'),
        ('Alonso', 'Quijano', '1234', 'cocinero', 'quijote@quijote.com'),
        ('Dulcinea', 'del Toboso', '1234', 'camarero', 'dulcinea@crunchy.com'),
        ('Pepe', 'De la Torre', '1234', 'camarero', 'pepe@crunchy.com'),
        ('Beatriz', 'Fernandez', '1234', 'camarero', 'bea@crunchy.com'),
        ('Rocinante', 'Exposito', '1234', 'admin', 'rocinante@crunchy.com');



INSERT INTO stock(id_producto, nombre_producto, precio, cantidad)
VALUES 
(1, 'Lechuga', '0.50', '20'),
(2, 'Pollo', '6', '9.5'),
(3, 'Tortita', '1', '100'),
(4, 'Tomate', '5', '20');






--
-- Volcado de datos para la tabla `platos`
--

INSERT INTO `platos` (`id_plato`, `nombre`, `ingredientes`, `categoria`, `subcategoria`, `precio`, `estado`) VALUES
(43, 'enchiladas de pollo rojas', 'Tres flautas de maíz rellenas de pollo bañadas en ricas salsas cubiertas de queso', 'entrante', 'enchiladas', '14.90', 'activado'),
(44, 'enchiladas de pollo verdes', 'Tres flautas de maíz con pollo bañadas en rica salsa y cubiertas de queso', 'entrante', 'enchiladas', '14.90', 'desactivado'),
(47, 'enchiladas de pollo de mole', 'Tres flautas de maíz rellenas de pollo bañadas en rica salsa y cubiertas de queso', 'entrante', 'enchiladas', '14.90', 'activado'),
(48, 'nachos', 'Totopos de maíz, totopos refritos, delicioso queso fundido y pico de gallo', 'entrante', 'nachos', '7.90', 'activado'),
(49, 'fajitas de pollo', 'Tiras de pollo adobadas con verduras a la plancha', 'principal', 'fajitas', '11.90', 'activado'),
(50, 'tacos al pastor', 'Carne de cerdo adobada en trompo. Adobada con chile, especias, cilantro y piña', 'principal', 'tacos', '12.50', 'activado'),
(51, 'tarta de limón', 'Deliciosa tarta de limón a base de galleta, con merengue', 'postre', 'tartas', '6.90', 'activado'),
(52, 'sorbete de limón y tequila', 'Acaba con un refrescante y alegre sorbete', 'postre', 'sorbetes', '6.90', 'activado'),
(53, 'margarita frozen', 'Tequila, triple seco, limón fresco. Jarra de 1L', 'bebida', 'margaritas', '23.95', 'activado'),
(54, 'café con leche', '', 'bebida', 'cafes', '2.95', 'activado');


--
-- Volcado de datos para la tabla `restar`
--

INSERT INTO `restar` (`id_plato`, `id_producto`, `cantidad`) VALUES
(43, 1, '0.20'),
(43, 2, '0.50'),
(43, 3, '3.00'),
(44, 1, '0.20'),
(44, 2, '0.50'),
(44, 3, '3.00'),
(47, 1, '0.20'),
(47, 2, '0.50'),
(47, 3, '3.00'),
(48, 1, '0.13'),
(48, 2, '0.10'),
(49, 1, '0.20'),
(49, 2, '0.30'),
(49, 3, '5.00'),
(50, 1, '0.40'),
(50, 2, '0.40'),
(50, 3, '6.00'),
(51, 1, '3.00'),
(51, 2, '2.00'),
(51, 3, '4.00'),
(52, 1, '1.00'),
(53, 3, '1.00'),
(54, 1, '3.00');