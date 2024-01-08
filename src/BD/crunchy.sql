-- 1.- Creamos la Base de Datos
create database if not exists crunchydb DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
-- Seleccionamos la base de datos "crunchydb"
use crunchydb;
drop table if exists restar;
drop table if exists stock;
drop table if exists detalle_pedido;
drop table if exists platos;
drop table if exists pedidos;
drop table if exists reservas;
drop table if exists usuarios;
-- 2.- Creamos las tablas
-- 2.1.1.- Tabla usuarios
create table if not exists usuarios(
    id_usuario int auto_increment primary key,
    nombre varchar(100) not null,
    apellidos varchar(100),
    contrasena varchar(8) not null,
    rol enum("admin", "cocinero", "camarero"),
    email varchar (50) not null unique
)
ENGINE InnoDB;
-- 2.1.2.- Tabla mesas
-- create table if not exists mesas(
--    id_mesa int auto_increment primary key,
--     -- poner el resto de las columnas
--     comensales int default 2
-- )
-- ENGINE InnoDB; 

-- Tabla reservas
create table if not exists reservas(
    id_reserva int auto_increment primary key,
    id_usuario int,
    foreign key(id_usuario) references usuarios(id_usuario) on update cascade on delete set null,
    mesa int,
    nombre varchar(255),
    apellidos varchar(255),
    fecha_hora_reserva datetime,
    telefono varchar(20),
    correo varchar(255),
    personas int
)
ENGINE InnoDB;

-- Tabla pedidos
create table if not exists pedidos(
    id_pedido int auto_increment primary key,
    mesa int,
    estado_pedido enum("Pendiente", "Confirmado", "Completado"),
    fecha_hora_pedido datetime,
    id_reserva int not null,
    foreign key (id_reserva) references reservas(id_reserva) on delete cascade
)
ENGINE InnoDB;

-- 2.1.4 .- Tabla platos
create table if not exists platos(
    id_plato int auto_increment primary key,
    nombre varchar(30),
    ingredientes text,
    categoria varchar(30),
    subcategoria varchar(30),
    precio decimal(5,2),
    estado enum('activado','desactivado')
)
ENGINE InnoDB;

-- Tabla detalle_pedido
create table if not exists detalle_pedido(
    id_pedido int,
    foreign key (id_pedido) references pedidos(id_pedido) on update cascade on delete cascade,
    id_plato int,
    foreign key (id_plato) references platos(id_plato) on update cascade on delete set null,
    constraint unique (id_plato, id_pedido),
    unidades int
    )
ENGINE InnoDB;

-- 2.1.6 .- Tabla stock
create table if not exists stock(
    id_producto int auto_increment primary key,
    nombre_producto text unique not null,
    precio decimal (5,2) not null,
    cantidad decimal (5,2) not null,
    constraint `cantidad siempre mayor que cero` check (cantidad>=0.0),
    constraint `precio siempre mayor que cero` check (precio>=0.0)
    )
ENGINE InnoDB;
-- 2.1.7 .- Tabla restar
create table if not exists restar(
    id_plato int,
    foreign key (id_plato) references platos (id_plato) on update cascade on delete set null,
    id_producto int,
    foreign key (id_producto) references stock (id_producto) on update cascade on delete set null,
    cantidad decimal (5,2)
    )
ENGINE InnoDB;

-- 3.- Creamos un usuario  
create user if not exists crunchy@'localhost' identified by "1234";
-- 4.- Le damos permiso en la base de datos "crunchy"
grant all on crunchydb.* to crunchy@'localhost';
