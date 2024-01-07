use crunchydb;

-- Creamos un usuario del restaurante.
INSERT INTO usuarios (nombre, apellidos, contrasena, rol, email) 
VALUES ('Sancho', 'Panza', '1234', 'admin', 'sancho@crunchy.com'),
        ('Alonso', 'Quijano', '1234', 'cocinero', 'quijote@quijote.com'),
        ('Dulcinea', 'del Toboso', '1234', 'camarero', 'dulcinea@crunchy.com'),
        ('Pepe', 'De la Torre', '1234', 'camarero', 'pepe@crunchy.com'),
        ('Beatriz', 'Fernandez', '1234', 'camarero', 'bea@crunchy.com'),
        ('Rocinante', 'Exposito', '1234', 'admin', 'rocinante@crunchy.com');




INSERT INTO reservas(id_reserva, id_usuario, mesa, nombre)
VALUES
(1, 1, 1, 'Ana'),
(2, 1, 2, 'Bob');

INSERT INTO pedidos(id_pedido, id_reserva, mesa, estado_pedido, fecha_hora_pedido)
VALUES
(1, 1, 1, 'Pendiente', CURRENT_TIMESTAMP),
(2, 2, 2, 'Pendiente', CURRENT_TIMESTAMP);


-- ¡¡PARA LA CARTA !!

-- 1. BORRAR TABLAS 'PLATOS', 'STOCK', Y SI SE PUEDE 'RESTAR'. AUNQUE HABIENDO BORRADO LAS ANTERIORES ESA NO DEBE DAR PROBLEMA

-- 2. INSERTAR INGREDIENTES EN TABLA 'STOCK'

-- 3. INSERTAR PLATOS EN TABLA 'PLATOS'

-- 4. INSERTAR VALORES EN TABLA 'RESTAR'

-- INSERCIÓN EN 'STOCK'
INSERT INTO `stock` (`id_producto`, `nombre_producto`, `precio`, `cantidad`) VALUES
(1, 'Lechuga', '0.50', '20.00'),
(2, 'Pollo', '6.00', '9.50'),
(3, 'Tortita', '1.00', '100.00'),
(4, 'Tomate', '5.00', '20.00'),
(5, 'pimiento', '0.40', '50.00'),
(6, 'cebolla', '0.50', '50.00'),
(7, 'tortita de maíz', '0.10', '50.00'),
(8, 'queso', '3.00', '50.00'),
(9, 'aguacate', '1.50', '50.00'),
(10, 'jalapeños', '1.00', '50.00'),
(11, 'totopos', '1.00', '50.00'),
(12, 'atún', '18.00', '10.00'),
(13, 'mahonesa', '2.00', '10.00'),
(14, 'frijoles', '2.00', '40.00'),
(15, 'pibil', '10.00', '20.00'),
(16, 'chipotle', '3.00', '15.00'),
(17, 'carnitas ', '10.00', '15.00'),
(18, 'jamón york', '2.50', '10.00'),
(19, 'champiñon', '4.00', '20.00'),
(20, 'crema agria', '1.20', '15.00'),
(21, 'res', '20.00', '20.00'),
(22, 'chorizo', '3.00', '30.00'),
(23, 'pastor', '12.00', '30.00'),
(24, 'lombarda', '0.50', '20.00'),
(25, 'mariachi', '4.00', '20.00'),
(26, 'maíz', '1.00', '30.00'),
(27, 'batata', '1.00', '30.00'),
(28, 'lima', '0.50', '40.00'),
(29, 'arroz', '0.60', '20.00'),
(30, 'garbanzos', '0.50', '25.00'),
(31, 'zanahoria', '0.35', '40.00'),
(32, 'coca-cola', '0.65', '60.00'),
(33, 'fanta limón', '0.60', '60.00'),
(34, 'coca-cola zero', '0.65', '60.00'),
(35, 'coca-cola ligth', '0.60', '60.00'),
(36, 'fanta nranja', '0.60', '60.00'),
(37, 'café', '0.40', '60.00'),
(38, 'descafeinado', '0.35', '40.00'),
(39, 'aquarius limón', '0.60', '60.00'),
(40, 'aquarius naranja', '0.60', '60.00'),
(41, 'nestea', '0.60', '40.00'),
(42, 'agua mineral', '0.30', '40.00'),
(43, 'corona', '1.00', '50.00'),
(44, 'pacífico', '1.00', '60.00'),
(45, 'negra modelo', '1.20', '60.00'),
(46, 'salitos', '0.50', '60.00'),
(47, 'zumo de piña', '0.60', '50.00'),
(48, 'zumo de melocotón', '0.60', '50.00'),
(49, 'zumo de mango', '0.60', '60.00'),
(50, 'vino rueda', '4.00', '50.00'),
(51, 'rioja', '4.50', '50.00'),
(52, 'vino ribera', '4.50', '40.00'),
(53, 'casera', '0.60', '60.00'),
(54, 'ginebra bombay', '15.00', '20.00'),
(55, 'ginebra beefeater', '15.00', '20.00'),
(56, 'tanqueray', '14.00', '20.00'),
(57, 'ron brugal', '16.00', '30.00'),
(58, 'ron havana ', '17.00', '30.00'),
(59, 'whisky ballantines', '14.00', '20.00'),
(60, 'whisky johnnie walker', '18.00', '30.00'),
(61, 'jack deniels', '20.00', '30.00'),
(62, 'fresa', '2.00', '20.00'),
(63, 'mezcal 400', '40.00', '30.00'),
(64, 'mezcal sa baltasar', '40.00', '30.00'),
(65, 'mezcal santa ana', '40.00', '30.00'),
(66, 'chocolate', '5.00', '20.00'),
(67, 'galleta', '1.00', '50.00'),
(68, 'helado vainilla', '2.00', '20.00'),
(69, 'helado chocolate', '2.50', '20.00'),
(70, 'helado limón', '2.00', '20.00'),
(71, 'helado fresa', '2.00', '20.00'),
(72, 'tequila dobel', '60.00', '20.00'),
(73, 'tequila cristalino', '60.00', '20.00'),
(74, 'tequila herradura', '60.00', '20.00'),
(75, 'tequila jose cuervo', '50.00', '20.00');


-- INSERCIÓN EN 'PLATOS'
INSERT INTO `platos` (`id_plato`, `nombre`, `ingredientes`, `categoria`, `subcategoria`, `precio`, `estado`) VALUES
(43, 'enchiladas de pollo rojas', 'Tres flautas de maíz rellenas de pollo bañadas en ricas salsas cubiertas de queso', 'entrante', 'enchiladas', '14.90', 'activado'),
(44, 'enchiladas de pollo verdes', 'Tres flautas de maíz con pollo bañadas en rica salsa y cubiertas de queso', 'entrante', 'enchiladas', '14.90', 'activado'),
(47, 'enchiladas de pollo de mole', 'Tres flautas de maíz rellenas de pollo bañadas en rica salsa y cubiertas de queso', 'entrante', 'enchiladas', '14.90', 'activado'),
(48, 'nachos', 'Totopos de maíz, totopos refritos, delicioso queso fundido y pico de gallo', 'entrante', 'nachos', '7.90', 'activado'),
(49, 'fajitas de pollo', 'Tiras de pollo adobadas con verduras a la plancha', 'principal', 'fajitas', '11.90', 'activado'),
(50, 'tacos al pastor', 'Carne de cerdo adobada en trompo. Adobada con chile, especias, cilantro y piña', 'principal', 'tacos', '12.50', 'activado'),
(51, 'tarta de limón', 'Deliciosa tarta de limón a base de galleta, con merengue', 'postre', 'tartas', '6.90', 'activado'),
(52, 'sorbete de limón y tequila', 'Acaba con un refrescante y alegre sorbete', 'postre', 'sorbetes', '6.90', 'activado'),
(53, 'margarita frozen', 'Tequila, triple seco, limón fresco. Jarra de 1L', 'bebida', 'margaritas', '23.95', 'activado'),
(54, 'café con leche', '', 'bebida', 'cafes', '2.95', 'activado'),
(60, 'fanta naranja', '', 'bebida', 'refrescos', '3.00', 'activado'),
(66, 'cosa random', 'Es una cosa random para probar', 'entrante', 'otro', '12.00', 'activado'),
(67, 'sopa', 'Sopa para probar', 'principal', 'cuchara', '9.00', 'activado'),
(68, 'otro principal', 'Otro principal para probar', 'principal', 'otro', '10.00', 'activado'),
(69, 'crepa de cajeta', '¡¡La estrella de la casa!! Deliciosa crepe de arina de arroz, bañada en chocolate caliente y helado de vainilla', 'postre', 'otro', '6.90', 'activado'),
(70, 'otro plato de prueba', 'Prueba de otro plato', 'otro', NULL, '10.00', 'activado'),
(71, 'guacamole', 'Aguacate machacado con cebolla, cilantro y jalapeños. Con totopos.', 'entrante', 'otro', '11.90', 'activado'),
(72, 'atún endiablado', 'Atún, chile chipotle, mahonesa, lechuguita y totpos', 'entrante', 'otro', '10.50', 'activado'),
(73, 'nachos con guacamoles', 'Totopos de maíz, frijoles refritos, delicioso queso fundido, pico de gallo y guacamoles', 'entrante', 'nachos', '11.90', 'activado'),
(74, 'pollo chipotle', 'Se acompaña de pico de gallo y 6 tortitas de trigo', 'entrante', 'quesos', '14.70', 'activado'),
(75, 'pibil', 'Cerdo horneado. Se acompaña de pico de gallo y 6 tortitas de maíz', 'entrante', 'quesos', '14.70', 'activado'),
(76, 'carnitas', 'Cerdo guisado. Se acompaña de pico de gallo y 6 tortitas de maíz', 'entrante', 'quesos', '14.70', 'activado'),
(77, 'jamón york', 'Se acompaña de pico de gallo y 6 tortitas de maíz', 'entrante', 'quesos', '14.70', 'activado'),
(78, 'champiñon', 'Mixta: jamón york y champiñon. Se acompaña de pico de gallo y 6 tortitas de maíz', 'entrante', 'quesos', '13.90', 'activado'),
(79, 'solo queso', 'Sólo queso, para que nada te distraiga del sabor auténtico. Se acompaña de pico de gallo y 6 tortitas de maíz', 'entrante', 'quesos', '12.90', 'activado'),
(80, 'flautas de pollo', 'Dos tortitas de maíz rellenas de pollo, con salsa verde, crema agria y frijoles', 'entrante', 'flautas', '7.60', 'activado'),
(81, 'fajitas de arrachera', 'Tiras de pollo adobadas con verduritas a la plancha', 'principal', 'fajitas', '11.90', 'activado'),
(82, 'fajitas mixtas', 'Tiras de res y de pollo con verduritas a la plancha', 'principal', 'fajitas', '11.90', 'activado'),
(83, 'fejitas de verdura', 'Verduritas a la plancha en tiras listas para hacer tacos', 'principal', 'fajitas', '9.90', 'activado'),
(84, 'huitlacoche', 'Hongo de maíz', 'principal', 'quesadillas', '5.90', 'activado'),
(85, 'chorizo', 'Deliciosa quesadilla con chorizo picante', 'principal', 'quesadillas', '5.40', 'activado'),
(86, 'pollo a la plancha', 'Deliciosa quesadilla con pollo a la plancha', 'principal', 'quesadillas', '4.90', 'activado'),
(87, 'mixta', 'Mixta: jamón york y champiñon', 'principal', 'quesadillas', '5.40', 'activado'),
(88, 'pastor', 'Cerdo adobado asado', 'principal', 'gringas', '7.90', 'activado'),
(89, 'cochinita pibil', 'Cerdo horneado', 'principal', 'gringas', '6.50', 'activado'),
(90, 'gringa de carnitas', 'Cerdo guisado', 'principal', 'gringas', '6.50', 'activado'),
(91, 'ensalada de pollo', 'Pollo, tiras de maíz, lechuga, col lombarda, manzana y cebolla agridulce', 'principal', 'ensaladas', '10.90', 'activado'),
(92, 'ensalada de camole y nopales', 'Batata, maíz dulce, cactus, tomate y cilantro. Aliñada con nuestra vinagreta de mango', 'principal', 'ensaladas', '10.90', 'activado'),
(93, 'ensalada de aguacate y elote', 'Aguacate, maíz dulce, lechuga y tomate. Aliñada con lima, aceite y sésamo', 'principal', 'ensaladas', '10.90', 'activado'),
(94, 'sopa azteca', 'Caldo de pollo, tortilla de maíz, pollo, queso, aguacate, chile, pasta y chipotle', 'principal', 'cuchara', '11.90', 'activado'),
(95, 'caldo tlalpeño', 'Sopa de pollo, arroz, garbanzos, aguacate, lima, zanahoria y chipotle', 'principal', 'cuchara', '11.90', 'activado'),
(96, 'fanta limón', '', 'bebida', 'refrescos', '3.60', 'activado'),
(97, 'coca-cola', '', 'bebida', 'refrescos', '3.60', 'activado'),
(98, 'coca-cola zero', '', 'bebida', 'refrescos', '3.60', 'activado'),
(99, 'coca-cola ligth', '', 'bebida', 'refrescos', '3.60', 'activado'),
(100, 'aquatius de limón', '', 'bebida', 'refrescos', '3.20', 'activado'),
(101, 'aquarius de naranja', '', 'bebida', 'refrescos', '3.20', 'activado'),
(102, 'nestea', '', 'bebida', 'refrescos', '3.45', 'activado'),
(103, 'agua mineral', '', 'bebida', 'otro', '2.50', 'activado'),
(104, 'corona', '', 'bebida', 'cervezas', '3.95', 'activado'),
(105, 'pacífico', '', 'bebida', 'cervezas', '3.95', 'activado'),
(106, 'negra modelo', '', 'bebida', 'cervezas', '3.95', 'activado'),
(107, 'salitos', '', 'bebida', 'cervezas', '3.95', 'activado'),
(108, 'zumo de piña', '', 'bebida', 'zumos', '2.95', 'activado'),
(109, 'zumo de melocotón', '', 'bebida', 'zumos', '2.95', 'activado'),
(110, 'rueda', 'Copa de vino blanco Rueda', 'bebida', 'vinos', '3.50', 'activado'),
(111, 'rioja', 'Copa de vino tinto Rioja', 'bebida', 'vinos', '4.00', 'activado'),
(112, 'ribera', 'Copa de vino Ribera del Duero', 'bebida', 'vinos', '4.50', 'activado'),
(113, 'sangría', 'Típica bebida mexicana con vino tinto, limón y frutas tropicales', 'bebida', 'vinos', '3.55', 'activado'),
(114, 'limonada', '', 'bebida', 'limonadas', '3.50', 'activado'),
(115, 'bombay saphire', '', 'bebida', 'ginebra', '9.90', 'activado'),
(116, 'beefeater', '', 'bebida', 'ginebra', '8.50', 'activado'),
(117, 'tanqueray', '', 'bebida', 'ginebra', '8.50', 'activado'),
(118, 'brugal', '', 'bebida', 'ron', '9.50', 'activado'),
(119, 'ron havana 7', '', 'bebida', 'ron', '10.50', 'activado'),
(120, 'ballantine\'s', '', 'bebida', 'whisky', '9.00', 'activado'),
(121, 'johnnie walker', '', 'bebida', 'whisky', '9.00', 'activado'),
(122, 'jack daniel\'s', '', 'bebida', 'whisky', '10.50', 'activado'),
(123, 'margarita de fresa', 'Cambia de sabor con nuestra margarita de fresa (jarra de 1L.)', 'bebida', 'margaritas', '25.95', 'activado'),
(124, 'daiquiri', 'Ron y fresa', 'bebida', 'cocteles', '98.90', 'activado'),
(125, 'mojito', 'Ron, hierbabuena, lima y azúcar', 'bebida', 'cocteles', '8.90', 'activado'),
(126, 'caipirinha', 'Casaca, lima, y azucar moreno', 'bebida', 'cocteles', '8.90', 'activado'),
(127, '400 conejos', '', 'bebida', 'mezcales', '7.00', 'activado'),
(128, 'alipus san baltazar', '', 'bebida', 'mezcales', '7.00', 'activado'),
(129, 'alipus santa ana', '', 'bebida', 'mezcales', '7.00', 'activado'),
(130, 'cortado', '', 'bebida', 'cafes', '1.95', 'activado'),
(131, 'americano', '', 'bebida', 'cafes', '2.50', 'activado'),
(132, 'capuchino', '', 'bebida', 'cafes', '2.95', 'activado'),
(133, 'pastel de kahlúa', 'Con licor de café', 'postre', 'tartas', '6.60', 'activado'),
(134, 'helado de vainilla', 'Dos bolas de delicioso helado con sabor a vainilla', 'postre', 'helados', '4.50', 'activado'),
(135, 'helado de limón', 'Dos bolas de delicioso helado de limón', 'postre', 'helados', '4.50', 'activado'),
(136, 'helado de chocolate', 'Dos bolas de delicioso helado de chocolate', 'postre', 'helados', '4.50', 'activado'),
(137, 'helado de fresa', 'Dos bolas de delicioso helado de fresa', 'postre', 'helados', '4.50', 'activado'),
(138, 'tarta de queso', 'Cremosa delicia de queso', 'postre', 'tartas', '6.90', 'activado'),
(139, 'sorbete de mango y tequila', 'Delicioso sorbete con sabor a mango para terminar la velada', 'postre', 'sorbetes', '6.60', 'activado'),
(140, 'maestro dobel', '', 'bebida', 'tequilas', '9.00', 'activado'),
(141, '1800 cristalino', '', 'bebida', 'tequilas', '9.00', 'activado'),
(142, 'herradura añejo', '', 'bebida', 'tequilas', '9.00', 'activado'),
(143, 'josé cuervo reposado', '', 'bebida', 'tequilas', '8.00', 'activado'),
(144, 'sorbete de limón', 'Delicioso postre para acabar con alegría', 'postre', 'sorbetes', '6.60', 'activado'),
(145, 'sorbete de mango', 'Delicioso sorbete con sabor a mango para terminar', 'postre', 'sorbetes', '5.60', 'activado');

-- INSERCIÓN EN 'RESTAR'
INSERT INTO `restar` (`id_plato`, `id_producto`, `cantidad`) VALUES
(50, 1, '0.40'),
(50, 2, '0.40'),
(50, 3, '6.00'),
(53, 3, '1.00'),
(43, 5, '2.00'),
(43, 2, '0.50'),
(43, 8, '0.33'),
(43, 4, '1.00'),
(43, 7, '3.00'),
(44, 1, '0.20'),
(44, 2, '0.50'),
(44, 8, '0.33'),
(44, 7, '3.00'),
(47, 1, '0.20'),
(47, 2, '0.50'),
(47, 8, '0.33'),
(47, 4, '1.00'),
(47, 7, '3.00'),
(71, 9, '2.00'),
(71, 6, '0.25'),
(71, 10, '0.10'),
(71, 1, '0.20'),
(71, 11, '0.50'),
(72, 12, '0.25'),
(72, 10, '0.50'),
(72, 1, '0.20'),
(72, 13, '0.10'),
(72, 11, '0.50'),
(73, 9, '1.00'),
(73, 6, '0.20'),
(73, 14, '0.50'),
(73, 10, '0.20'),
(73, 1, '0.10'),
(73, 8, '0.33'),
(73, 4, '1.00'),
(73, 11, '1.00'),
(48, 6, '0.25'),
(48, 14, '0.50'),
(48, 8, '0.50'),
(48, 4, '1.00'),
(48, 11, '1.00'),
(74, 6, '0.20'),
(74, 8, '0.50'),
(74, 4, '1.00'),
(74, 3, '6.00'),
(75, 6, '0.20'),
(75, 15, '0.50'),
(75, 8, '0.50'),
(75, 3, '6.00'),
(76, 17, '1.00'),
(76, 6, '0.20'),
(76, 8, '0.50'),
(76, 4, '1.00'),
(76, 3, '6.00'),
(77, 6, '0.20'),
(77, 18, '0.50'),
(77, 8, '0.50'),
(77, 4, '1.00'),
(77, 3, '6.00'),
(78, 6, '0.20'),
(78, 19, '0.50'),
(78, 18, '0.50'),
(78, 8, '0.50'),
(78, 4, '1.00'),
(79, 6, '0.20'),
(79, 8, '0.75'),
(79, 4, '1.00'),
(79, 7, '6.00'),
(80, 20, '0.40'),
(80, 14, '0.25'),
(80, 2, '0.25'),
(80, 7, '2.00'),
(49, 1, '0.20'),
(49, 5, '2.00'),
(49, 2, '0.30'),
(49, 4, '1.00'),
(49, 3, '4.00'),
(81, 6, '0.25'),
(81, 1, '0.25'),
(81, 5, '1.00'),
(81, 4, '1.00'),
(81, 3, '4.00'),
(82, 6, '0.20'),
(82, 1, '0.25'),
(82, 5, '1.00'),
(82, 2, '0.50'),
(82, 21, '0.50'),
(82, 4, '1.00'),
(82, 3, '4.00'),
(83, 6, '0.50'),
(83, 1, '0.40'),
(83, 5, '2.00'),
(83, 4, '2.00'),
(83, 3, '4.00'),
(84, 8, '0.50'),
(84, 3, '1.00'),
(85, 22, '0.50'),
(85, 8, '0.40'),
(85, 3, '1.00'),
(86, 2, '0.25'),
(86, 8, '0.40'),
(86, 3, '1.00'),
(87, 19, '0.40'),
(87, 18, '0.25'),
(87, 8, '0.50'),
(88, 14, '0.30'),
(88, 23, '0.40'),
(88, 8, '0.40'),
(88, 3, '1.00'),
(89, 16, '0.15'),
(89, 14, '0.30'),
(89, 15, '0.25'),
(89, 3, '1.00'),
(90, 17, '0.25'),
(90, 14, '0.20'),
(90, 8, '0.40'),
(90, 3, '1.00'),
(91, 6, '0.25'),
(91, 1, '0.40'),
(91, 24, '0.40'),
(91, 2, '0.50'),
(92, 27, '1.00'),
(92, 26, '0.33'),
(92, 4, '1.00'),
(93, 9, '1.00'),
(93, 1, '0.50'),
(93, 28, '1.00'),
(93, 26, '0.33'),
(93, 4, '2.00'),
(94, 9, '1.00'),
(94, 16, '0.20'),
(94, 8, '0.50'),
(94, 7, '2.00'),
(95, 9, '1.00'),
(95, 29, '0.20'),
(95, 16, '0.25'),
(95, 30, '0.25'),
(95, 28, '1.00'),
(60, 36, '1.00'),
(60, 2, '1.00'),
(96, 33, '1.00'),
(97, 32, '1.00'),
(98, 34, '1.00'),
(99, 35, '1.00'),
(100, 39, '1.00'),
(101, 40, '1.00'),
(102, 41, '1.00'),
(103, 42, '1.00'),
(104, 43, '1.00'),
(105, 44, '1.00'),
(106, 45, '1.00'),
(107, 46, '1.00'),
(108, 47, '1.00'),
(109, 48, '1.00'),
(110, 50, '0.20'),
(112, 52, '0.20'),
(113, 53, '0.20'),
(113, 51, '0.15'),
(111, 51, '0.20'),
(114, 53, '0.20'),
(114, 28, '3.00'),
(115, 54, '0.20'),
(116, 55, '0.20'),
(117, 56, '0.20'),
(118, 57, '0.20'),
(119, 58, '0.20'),
(120, 59, '0.20'),
(121, 60, '0.20'),
(122, 61, '10.90'),
(123, 62, '0.50'),
(124, 53, '0.20'),
(124, 62, '0.25'),
(124, 58, '0.15'),
(125, 28, '2.00'),
(125, 58, '0.20'),
(126, 28, '2.00'),
(126, 58, '0.20'),
(127, 63, '0.20'),
(128, 64, '0.20'),
(129, 65, '0.20'),
(130, 37, '1.00'),
(132, 37, '1.00'),
(69, 66, '0.50'),
(69, 68, '1.00'),
(133, 37, '1.00'),
(134, 68, '4.50'),
(135, 70, '1.00'),
(136, 66, '1.00'),
(137, 71, '1.00'),
(138, 67, '0.20'),
(138, 8, '1.00'),
(139, 28, '2.00'),
(140, 72, '0.10'),
(141, 73, '0.10'),
(142, 74, '0.10'),
(143, 75, '0.10'),
(144, 28, '2.00'),
(145, 28, '2.00'),
(131, 37, '1.00');