DELIMITER //
drop table if exists telefono cascade;
drop table if exists user cascade;


/*Creacion de tablas*/

create table user(
                     uuid VARCHAR(36),
                     username VARCHAR(100) NOT NULL,
                     password VARCHAR(255) NOT NULL,
                     dni VARCHAR(9) NOT NULL,
                     correoelectronico VARCHAR(255) NOT NULL,
                     fechanac DATE,
                     nombre VARCHAR(100) NOT NULL,
                     apellidos VARCHAR(255) NOT NULL,
                     direccion VARCHAR(255),
                     califacion DECIMAL(5,2),
                     tarjetapago VARCHAR(16),
                     datosadicionales JSON,
                     tipo ENUM('admin','user','superuser','god','guest') NOT NULL
);
//

create table telefono(
                         id BIGINT AUTO_INCREMENT PRIMARY KEY,
                         prefijo VARCHAR(5),
                         numero VARCHAR(9),
                         uuid_usuario VARCHAR(36)
);
//
/*Creación de claves primarias*/
alter table user add constraint pk_user primary key (uuid);
alter table user add constraint uk_user unique (dni);
//
/*alter table telefono add constraint pk_telefono primary key (id);*/

/*Creación de claves ajenas*/

alter table telefono add constraint fk_telefono_user
    foreign key (uuid_usuario) references user(uuid);
//