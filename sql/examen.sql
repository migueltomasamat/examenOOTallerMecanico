DELIMITER //
drop table if exists vehiculo cascade;
drop table if exists reparacion cascade;
//

create table vehiculo(
    matricula varchar(7),
    marca varchar(255),
    modelo varchar(255),
    nombrePropietario varchar(255),
    anyoFabricacion integer
);
//
create table reparacion(
    idReparacion integer,
    descripcion varchar(255),
    fechaEntrada date,
    costeEstimado float,
    estado varchar(255),
    matriculaVehiculo varchar(7)
);
//
alter table vehiculo add constraint pk_vehiculo primary key (matricula);
alter table reparacion add constraint pk_reparacion primary key (idReparacion);
//
alter table reparacion add constraint fk_reparacion_vehiculo foreign key (matriculaVehiculo) references vehiculo(matricula);
//

insert into vehiculo values ('1234AAA','Opel ','Corsa','Carlos Sanchez',2015);
insert into vehiculo values ('2345BBB','Ford','Focus','Ana López',2018);
insert into vehiculo values ('3456CCC','Renault','Clio','Javier Martín',2020);
insert into vehiculo values ('4567DDD','Seat','Ibiza','María García',2017);
insert into vehiculo values ('5678EEE','Volkswagen','Golf','David Rodríguez',2019);
insert into vehiculo values ('6789FFF','Peugeot','208','Laura Fernández',2021);
insert into vehiculo values ('7890GGG','Toyota','Yaris','Miguel Pérez',2016);
insert into vehiculo values ('8901HHH','Hyundai','i20','Sofía Gómez',2022);
insert into vehiculo values ('9012JJJ','Kia','Ceed','Pablo Moreno',2014);
insert into vehiculo values ('0123KKK','Nissan','Qashqai','Elena Jiménez',2023);
insert into vehiculo values ('1122LLL','Audi','A3','Daniel Ruiz',2015);
//
insert into reparacion values(1,'Cambio Aceite',STR_TO_DATE('2025-01-01','%Y-%m-%d'),98.25,'Pendiente','1234AAA');
insert into reparacion values(2,'Pastillas de Freno',STR_TO_DATE('2025-02-15','%Y-%m-%d'),150.75,'Pendiente','1234AAA');
insert into reparacion values(3,'Revisión completa',STR_TO_DATE('2025-03-10','%Y-%m-%d'),250.00,'En Progreso','1234AAA');
insert into reparacion values(4,'Cambio Neumáticos',STR_TO_DATE('2025-04-05','%Y-%m-%d'),420.50,'Finalizada','4567DDD');
insert into reparacion values(5,'Alineación de dirección',STR_TO_DATE('2025-05-20','%Y-%m-%d'),75.00,'Pendiente','5678EEE');
insert into reparacion values(6,'Cambio Correa Distribución',STR_TO_DATE('2025-06-11','%Y-%m-%d'),550.80,'En Progreso','6789FFF');
insert into reparacion values(7,'Reparación Fuga Aire Acondicionado',STR_TO_DATE('2025-07-22','%Y-%m-%d'),180.20,'Finalizada','7890GGG');
insert into reparacion values(8,'Cambio de Batería',STR_TO_DATE('2025-08-18','%Y-%m-%d'),130.00,'Pendiente','8901HHH');
insert into reparacion values(9,'Sustitución Amortiguadores',STR_TO_DATE('2025-09-01','%Y-%m-%d'),380.60,'Entregado','9012JJJ');
insert into reparacion values(10,'Reparación Sistema de Escape',STR_TO_DATE('2025-10-30','%Y-%m-%d'),210.45,'En Progreso','0123KKK');
insert into reparacion values(11,'Cambio Kit de Embrague',STR_TO_DATE('2025-11-25','%Y-%m-%d'),680.00,'Pendiente','1122LLL');
//