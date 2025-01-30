DELIMITER //
drop table if exists receta_ingrediente cascade;
drop table if exists ingrediente cascade;
drop table if exists usuario cascade;
drop table if exists receta cascade;
//

create table usuario(
    id integer,
    mail varchar(255),
    tarjeta varchar(16)
);
//
create table ingrediente(
    id integer,
    nombre varchar(100),
    calorias float
);
//
create table receta(
    id integer,
    nombre varchar(100),
    fecha_creacion date,
    id_usuario integer
);
//
create table receta_ingrediente(
    id_receta integer,
    id_ingrediente integer
)
//
alter table usuario add constraint pk_usuario primary key (id);
alter table receta add constraint pk_receta primary key (id);
alter table ingrediente add constraint pk_ingrediente primary key(id);
alter table receta_ingrediente add constraint pk_receta_usuario primary key(id_receta,id_ingrediente);
//
alter table receta add constraint fk_receta_usuario foreign key (id_usuario) references usuario(id);
alter table receta_ingrediente add constraint fk_receta_ingrediente_ingrediente foreign key(id_ingrediente) references ingrediente(id);
alter table receta_ingrediente add constraint fk_receta_ingrediente_receta foreign key(id_receta) references ingrediente(id);
//

insert into ingrediente values (1,'Pimiento',100);
INSERT INTO ingrediente VALUES (2, 'Tomate', 250);
INSERT INTO ingrediente VALUES (3, 'Queso Cheddar', 75);
INSERT INTO ingrediente VALUES (4, 'Ajo', 3);
INSERT INTO ingrediente VALUES (5, 'Pepino', 150);
INSERT INTO ingrediente VALUES (6, 'Espinaca', 50);
INSERT INTO ingrediente VALUES (7, 'Aceite de Oliva', 40);
INSERT INTO ingrediente VALUES (8, 'Batata', 200);
INSERT INTO ingrediente VALUES (9, 'Jamón', 120);
INSERT INTO ingrediente VALUES (10, 'Cebolla', 5);
//