SET GLOBAL sql_mode = 'NO_ENGINE_SUBSTITUTION';
SET SESSION sql_mode = 'NO_ENGINE_SUBSTITUTION';

DROP DATABASE IF EXISTS prevendb_test;
CREATE DATABASE prevendb_test DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE prevendb_test;

CREATE TABLE USUARIO
(
    `username` VARCHAR(20),
    `dni` CHAR(9) NOT NULL,
    `password` VARCHAR(128) NOT NULL,
    `rol` enum('edificio','organizacion','registrado','administrador') NOT NULL,
    `nombre` VARCHAR(30) NOT NULL,
    `apellidos` VARCHAR(60) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `telefono` VARCHAR(9) NOT NULL,
    `foto_perfil` VARCHAR(40) NOT NULL,

    CONSTRAINT `pk_usuario` PRIMARY KEY (`username`),
    CONSTRAINT `uq_user_dni` UNIQUE (`dni`),
    CONSTRAINT `uq_user_telf` UNIQUE (`telefono`),
    CONSTRAINT `uq_user_email` UNIQUE (`email`)
);

CREATE TABLE EDIFICIO
(
    `edificio_id` INT(10) AUTO_INCREMENT,
    `username` VARCHAR(20) NOT NULL,
    `nombre` VARCHAR(60) NOT NULL,
    `calle` VARCHAR(60) NOT NULL,
    `ciudad` VARCHAR(40) NOT NULL,
    `provincia` VARCHAR(40) NOT NULL,
    `codigo_postal` CHAR(5) NOT NULL,
    `telefono` VARCHAR(9) NOT NULL,
    `foto_edificio` VARCHAR(40) NOT NULL,

    CONSTRAINT `pk_edificio` PRIMARY KEY (`edificio_id`),
    CONSTRAINT `fk_edificio_to_usuario` FOREIGN KEY (`username`) REFERENCES USUARIO (`username`)
);

CREATE TABLE PLANTA
(
    `planta_id` INT(10) AUTO_INCREMENT,
    `edificio_id` INT(10) NOT NULL,
    `nombre` VARCHAR(40) NOT NULL,
    `num_planta` TINYINT NOT NULL,
    `descripcion` TEXT NOT NULL,
    `foto_planta` VARCHAR(40) NOT NULL,

    CONSTRAINT `pk_planta` PRIMARY KEY (`planta_id`),
    CONSTRAINT `uq_edificio_num_planta` UNIQUE (`edificio_id`,`num_planta`),
    CONSTRAINT `fk_planta_to_edificio` FOREIGN KEY (`edificio_id`) REFERENCES EDIFICIO (`edificio_id`)
);

CREATE TABLE ESPACIO
(
    `espacio_id` INT(10) AUTO_INCREMENT,
    `planta_id` INT(10) NOT NULL,
    `nombre` VARCHAR(40) NOT NULL,
    `descripcion` TEXT NOT NULL,
    `foto_espacio` VARCHAR(40) NOT NULL,

    CONSTRAINT `pk_espacio` PRIMARY KEY (`espacio_id`),
    CONSTRAINT `uq_planta_nombre_espacio` UNIQUE (`planta_id`,`nombre`),
    CONSTRAINT `fk_espacio_to_planta` FOREIGN KEY (`planta_id`) REFERENCES PLANTA (`planta_id`)
);

CREATE TABLE PLAN
(
    `plan_id` INT(10) AUTO_INCREMENT,
    `nombre` VARCHAR(60) NOT NULL,
    `descripcion` TEXT NOT NULL,

    CONSTRAINT `pk_plan` PRIMARY KEY (`plan_id`),
    CONSTRAINT `uq_plan_nombre` UNIQUE (`nombre`)
);

CREATE TABLE EDIFICIO_PLAN
(
    `edificio_id` INT(10) NOT NULL,
    `plan_id` INT(10) NOT NULL,
    `fecha_asignacion` DATE NOT NULL,
    `fecha_cumplimentacion` DATE NOT NULL DEFAULT '00-00-0000',
    `fecha_vencimiento` DATE NOT NULL DEFAULT '00-00-0000',
    `estado` enum('pendiente', 'cumplimentado','vencido') NOT NULL DEFAULT 'pendiente',

    CONSTRAINT `pk_edificio_plan` PRIMARY KEY (`edificio_id`, `plan_id`),
    CONSTRAINT `fk_edificio_plan_to_edificio` FOREIGN KEY (`edificio_id`) REFERENCES EDIFICIO (`edificio_id`),
    CONSTRAINT `fk_edificio_plan_to_plan` FOREIGN KEY (`plan_id`) REFERENCES PLAN (`plan_id`)
);

CREATE TABLE DOCUMENTO
(
    `documento_id` INT(10) AUTO_INCREMENT,
    `plan_id` INT(10) NOT NULL,
    `nombre` VARCHAR(60) NOT NULL,
    `descripcion` TEXT NOT NULL,
    `visible` enum('yes','no') NOT NULL,

    CONSTRAINT `pk_documento` PRIMARY KEY (`documento_id`),
    CONSTRAINT `uq_documento_plan` UNIQUE (`plan_id`,`nombre`),
    CONSTRAINT `fk_documento_to_plan` FOREIGN KEY (`plan_id`) REFERENCES PLAN (`plan_id`)
);

CREATE TABLE PROCEDIMIENTO
(
    `procedimiento_id` INT(10) AUTO_INCREMENT,
    `plan_id` INT(10) NOT NULL,
    `nombre` VARCHAR(60) NOT NULL,
    `descripcion` TEXT NOT NULL,

    CONSTRAINT `pk_procedimiento` PRIMARY KEY (`procedimiento_id`),
    CONSTRAINT `uq_documento_plan` UNIQUE (`plan_id`,`nombre`),
    CONSTRAINT `fk_procedimiento_to_plan` FOREIGN KEY (`plan_id`) REFERENCES PLAN (`plan_id`)
);

CREATE TABLE RUTA
(
    `ruta_id` INT(10) AUTO_INCREMENT,
    `plan_id` INT(10) NOT NULL,
    `nombre` VARCHAR(60) NOT NULL,
    `descripcion` TEXT NOT NULL,

    CONSTRAINT `pk_ruta` PRIMARY KEY (`ruta_id`),
    CONSTRAINT `uq_ruta_plan` UNIQUE (`plan_id`,`nombre`),
    CONSTRAINT `fk_ruta_to_plan` FOREIGN KEY (`plan_id`) REFERENCES PLAN (`plan_id`)
);

CREATE TABLE EDIFICIO_DOCUMENTO
(
    `cumplimentacion_id` INT(10) AUTO_INCREMENT,
    `edificio_id` INT(10) NOT NULL,
    `documento_id` INT(10) NOT NULL,
    `estado` enum('pendiente','cumplimentado','vencido') NOT NULL DEFAULT 'pendiente',
    `fecha_cumplimentacion` DATE NOT NULL DEFAULT '00-00-0000',
    `fecha_vencimiento` DATE NOT NULL DEFAULT '00-00-0000',
    `nombre_doc` VARCHAR(50) NOT NULL,

    CONSTRAINT `pk_edificio_documento` PRIMARY KEY (`cumplimentacion_id`),
    CONSTRAINT `fk_edificio_documento_to_edificio` FOREIGN KEY (`edificio_id`) REFERENCES EDIFICIO (`edificio_id`),
    CONSTRAINT `fk_edificio_documento_to_documento` FOREIGN KEY (`documento_id`) REFERENCES DOCUMENTO (`documento_id`)
);

CREATE TABLE EDIFICIO_PROCEDIMIENTO
(
    `cumplimentacion_id` INT(10) AUTO_INCREMENT,
    `edificio_id` INT(10) NOT NULL,
    `procedimiento_id` INT(10) NOT NULL,
    `estado` enum('pendiente','cumplimentado','vencido') NOT NULL DEFAULT 'pendiente',
    `fecha_cumplimentacion` DATE NOT NULL DEFAULT '00-00-0000',
    `fecha_vencimiento` DATE NOT NULL DEFAULT '00-00-0000',
    `nombre_doc` VARCHAR(50) NOT NULL,

    CONSTRAINT `pk_edificio_procedimiento` PRIMARY KEY (`cumplimentacion_id`),
    CONSTRAINT `fk_edificio_procedimiento_to_edificio` FOREIGN KEY (`edificio_id`) REFERENCES EDIFICIO (`edificio_id`),
    CONSTRAINT `fk_edificio_procedimiento_to_procedimiento` FOREIGN KEY (`procedimiento_id`) REFERENCES PROCEDIMIENTO (`procedimiento_id`)
);

CREATE TABLE PLANTA_RUTA
(
    `cumplimentacion_id` INT(10) AUTO_INCREMENT,
    `planta_id` INT(10) NOT NULL,
    `ruta_id` INT(10) NOT NULL,
    `estado` enum('pendiente','cumplimentado','vencido') NOT NULL DEFAULT 'pendiente',
    `fecha_cumplimentacion` DATE NOT NULL DEFAULT '00-00-0000',
    `fecha_vencimiento` DATE NOT NULL DEFAULT '00-00-0000',
    `nombre_doc` VARCHAR(50) NOT NULL,

    CONSTRAINT `pk_planta_ruta` PRIMARY KEY (`cumplimentacion_id`),
    CONSTRAINT `fk_planta_ruta_to_planta` FOREIGN KEY (`planta_id`) REFERENCES PLANTA (`planta_id`),
    CONSTRAINT `fk_planta_ruta_to_ruta` FOREIGN KEY (`ruta_id`) REFERENCES RUTA (`ruta_id`)
);

CREATE TABLE SIMULACRO
(
    `simulacro_id` INT(10) AUTO_INCREMENT,
    `plan_id` INT(10) NOT NULL,
    `nombre` VARCHAR(60) NOT NULL,
    `descripcion` TEXT NOT NULL,

    CONSTRAINT `pk_simulacro` PRIMARY KEY (`simulacro_id`),
    CONSTRAINT `uq_simulacro_plan` UNIQUE (`plan_id`,`nombre`),
    CONSTRAINT `fk_simulacro_to_plan` FOREIGN KEY (`plan_id`) REFERENCES PLAN (`plan_id`)
);

CREATE TABLE EDIFICIO_SIMULACRO
(
    `cumplimentacion_id` INT(10) AUTO_INCREMENT,
    `edificio_id` INT(10) NOT NULL,
    `simulacro_id` INT(10) NOT NULL,
    `estado` enum('pendiente','cumplimentado','vencido') NOT NULL DEFAULT 'pendiente',
    `fecha_planificacion` DATE NOT NULL DEFAULT '00-00-0000',
    `fecha_vencimiento` DATE NOT NULL DEFAULT '00-00-0000',
    `fecha_cumplimentacion` DATE NOT NULL DEFAULT '00-00-0000',
    `url_recurso` VARCHAR(200) NULL,
    `destinatarios` VARCHAR(200) NOT NULL,

    CONSTRAINT `pk_edificio_simulacro` PRIMARY KEY (`cumplimentacion_id`),
    CONSTRAINT `fk_edificio_simulacro_to_edificio` FOREIGN KEY (`edificio_id`) REFERENCES EDIFICIO (`edificio_id`),
    CONSTRAINT `fk_edificio_simulacro_to_simulacro` FOREIGN KEY (`simulacro_id`) REFERENCES SIMULACRO (`simulacro_id`)
);

CREATE TABLE FORMACION
(
    `formacion_id` INT(10) AUTO_INCREMENT,
    `plan_id` INT(10) NOT NULL,
    `nombre` VARCHAR(60) NOT NULL,
    `descripcion` TEXT NOT NULL,

    CONSTRAINT `pk_formacion` PRIMARY KEY (`formacion_id`),
    CONSTRAINT `uq_formacion_plan` UNIQUE (`plan_id`,`nombre`),
    CONSTRAINT `fk_formacion_to_plan` FOREIGN KEY (`plan_id`) REFERENCES PLAN (`plan_id`)
);

CREATE TABLE EDIFICIO_FORMACION
(
    `cumplimentacion_id` INT(10) AUTO_INCREMENT,
    `edificio_id` INT(10) NOT NULL,
    `formacion_id` INT(10) NOT NULL,
    `estado` enum('pendiente','cumplimentado','vencido') NOT NULL DEFAULT 'pendiente',
    `fecha_planificacion` DATE NOT NULL DEFAULT '00-00-0000',
    `fecha_vencimiento` DATE NOT NULL DEFAULT '00-00-0000',
    `fecha_cumplimentacion` DATE NOT NULL DEFAULT '00-00-0000',
    `url_recurso` VARCHAR(200) NULL,
    `destinatarios` VARCHAR(200) NOT NULL,

    CONSTRAINT `pk_edificio_formacion` PRIMARY KEY (`cumplimentacion_id`),
    CONSTRAINT `fk_edificio_formacion_to_edificio` FOREIGN KEY (`edificio_id`) REFERENCES EDIFICIO (`edificio_id`),
    CONSTRAINT `fk_edificio_formacion_to_formacion` FOREIGN KEY (`formacion_id`) REFERENCES FORMACION (`formacion_id`)
);


CREATE TABLE NOTIFICACION
(
    `id_notificacion` INT(10) AUTO_INCREMENT,
    `username` VARCHAR(20) NOT NULL,
    `edificio_id` INT(10) NOT NULL,
    `plan_id` INT(10) NOT NULL,
    `leido` enum('yes','no') DEFAULT 'no',
    `fecha` DATE NOT NULL,
    `mensaje` VARCHAR(280) NOT NULL,

    CONSTRAINT `pk_notificacion` PRIMARY KEY (`id_notificacion`),
    CONSTRAINT `fk_notificacion_to_usuario` FOREIGN KEY (`username`) REFERENCES USUARIO (`username`),
    CONSTRAINT `fk_notificacion_to_edificio_plan` FOREIGN KEY (`edificio_id`, `plan_id`) REFERENCES EDIFICIO_PLAN (`edificio_id`, `plan_id`) ON DELETE CASCADE
);



INSERT INTO USUARIO (`username`, `dni`, `password`,`rol`,`nombre`,`apellidos`,`email`,`telefono`,`foto_perfil`) VALUES
('sg2padmin','14197701P','7a25b0bc04e77a2f7453dd021168cdc2','administrador','admin','adminsurname','admin@email.es','666666666','default.png'),
('sg2porg','84001360R','7a25b0bc04e77a2f7453dd021168cdc2','organizacion','rorganizacion','rorganizacion','rorg@email.es','666666667','default.png'),
('sg2ped','67453966A','7a25b0bc04e77a2f7453dd021168cdc2','edificio','redificio','redificio','red@email.es','666666668','default.png'),
('sg2ped2','53147657Q','7a25b0bc04e77a2f7453dd021168cdc2','edificio','redificioo','redificioo','red2@email.es','666666669','default.png'),
('sg2prg','20271577K','7a25b0bc04e77a2f7453dd021168cdc2','registrado','registrado','registrado','rg@email.es','666666665','default.png');

INSERT INTO EDIFICIO (`edificio_id`, `username`, `nombre`, `calle`, `ciudad`, `provincia`, `codigo_postal`, `telefono`, `foto_edificio`) VALUES
(1,'sg2ped','Edificio Uno','Calle ejemplo 1','Ourense','Ourense','36687','987678765','default.png'),
(2,'sg2ped2','Edificio Dos','Calle ejemplo 2','Ourense','Ourense','36687','987678766','default.png'),
(3,'sg2ped','Edificio Tres','Calle ejemplo 3','Ourense','Ourense','36687','987678768','default.png'),
(4,'sg2ped2','Edificio Cuatro','Calle ejemplo 4','Ourense','Ourense','36687','987678769','default.png'),
(5,'sg2ped2','Edificio con Planta','Calle ejemplo 4','Ourense','Ourense','36687','997678769','default.png'),
(6,'sg2ped2','Edificio Cumplimentaciones Documento','Calle ejemplo 4','Ourense','Ourense','36687','997678700','default.png'),
(7,'sg2ped','Edificio con Asignaciones','Calle ejemplo 4','Ourense','Ourense','36687','997678701','default.png');

INSERT INTO PLANTA (`planta_id`, `edificio_id`, `nombre`, `num_planta`, `descripcion`, `foto_planta`) VALUES
(1,1,'Planta Uno',1,'descripcion de la planta uno','default.png'),
(2,1,'Planta Dos',2,'descripcion de la planta dos','default.png'),
(3,1,'Planta Tres',3,'descripcion de la planta tres','default.png'),
(4,5,'Planta Tres',3,'descripcion de la planta tres','default.png'),
(5,7,'Planta del Edificio con asignaciones',1,'descripcion','default.png');

INSERT INTO ESPACIO (`espacio_id`, `planta_id`, `nombre`, `descripcion`, `foto_espacio`) VALUES
(1,1,'Espacio Uno','Descripcion del espacio uno','default.png'),
(2,1,'Espacio Dos','Descripcion del espacio dos','default.png'),
(3,1,'Espacio Tres','Descripcion del espacio tres','default.png');

INSERT INTO PLAN (`plan_id`, `nombre`, `descripcion`) VALUES
(1,'Plan Uno','Descripcion Plan Uno'),
(2,'Plan con Documentos','Descripcion Plan'),
(3,'Plan con Procedimientos','Descripcion Plan'),
(4,'Plan con Rutas','Descripcion Plan'),
(5,'Plan con Formaciones','Descripcion Plan'),
(6,'Plan con Simulacros','Descripcion Plan'),
(7,'Plan Completo','Descripcion Plan'),
(8,'Plan sin Documentos','Descripcion Plan'),
(9,'Plan Vencido','Descripcion Plan'),
(10,'Plan con cumplimentaciones', 'descripcion'),
(11,'Plan Asignado', 'descripcion');


INSERT INTO DOCUMENTO (`documento_id`,`plan_id`,`nombre`,`descripcion`,`visible`) VALUES
(1,2,'Documentos del plan con documentos','Descripcion del Documento','yes'),
(2,2,'Nombre Documento','Descripcion','no'),
(3,7,'Documento del Plan Completo','Descripcion','si'),
(4,9,'Documento del Plan Vencido','Descripcion','si'),
(5,1,'Otro Documento','Descripcion','si'),
(6,10,'Documento con Cumplimentaciones','Descripcion','si'),
(7,10,'Documento no Visible','Descripcion','no'),
(8,11,'Documento del Plan Asignado','Descripcion','si'),
(9,10,'Documento Vencido','Descripcion','si');

INSERT INTO PROCEDIMIENTO (`procedimiento_id`,`plan_id`,`nombre`,`descripcion`) VALUES
(1,3,'Procedimiento del plan con procedimientos','Descripcion del Procedimiento'),
(2,3,'Nombre Procedimiento','Descripcion del Procedimiento'),
(3,7,'Procedimiento del Plan Completo','Descripcion del Procedimiento'),
(4,11,'Procedimiento del Plan Asignado','Descripcion del Procedimiento'),
(5,10,'Procedimiento del Plan con cumplimentaciones','Descripcion del Procedimiento'),
(6,9,'Procedimiento del Plan vencido','Descripcion del Procedimiento'),
(7,10,'Procedimiento Vencido','Descripcion del Procedimiento');

INSERT INTO RUTA (`ruta_id`, `plan_id`, `nombre`, `descripcion`) VALUES
(1,1,'Rutas del Plan Uno','Descripcion de la definicion de la ruta'),
(2,4,'Rutas del plan con rutas','Descripcion Rutas'),
(3,1,'Otra Ruta del Plan Uno','Descripcion de la definicion de la ruta'),
(4,7,'Ruta del Plan Completo','Descripcion de la Ruta'),
(5,9,'Ruta del Plan Vencido','Descripcion de la Ruta'),
(6,11,'Ruta del Plan Vencido','Descripcion de la Ruta');

INSERT INTO FORMACION (`formacion_id`,`plan_id`,`nombre`,`descripcion`) VALUES
(1,5,'Formaciones del plan con formaciones','Descripción de la formación'),
(2,5,'Otra Formación del plan con formaciones','Descripción de la formación'),
(3,7,'Formación del Plan Completo','Descripción de la formación'),
(4,1,'Formación del Plan Uno','Descripción de la formación'),
(5,9,'Formación con asignación vencida','Descripción de la formación'),
(6,1,'Formación Vencida','Descripción de la formación');

INSERT INTO SIMULACRO (`simulacro_id`,`plan_id`,`nombre`,`descripcion`) VALUES
(1,6,'Simulacros del plan con simulacros','Descripcion del simulacro'),
(2,6,'Otro Simulacro','Descripcion del simulacro'),
(3,7,'Simulacro del Plan Completo','Descripcion del simulacro'),
(4,1,'Simulacro del Plan Uno','Descripcion del simulacro'),
(5,9,'Simulacro con asignación vencida','Descripcion del simulacro');

INSERT INTO PLANTA_RUTA (`cumplimentacion_id`, `planta_id`, `ruta_id`, `estado`, `fecha_cumplimentacion`, `nombre_doc`) VALUES
(1,2,1,'pendiente','15-05-2021','document_default'),
(2,4,1,'pendiente','15-05-2021','document_default'),
(3,4,1,'vencido','15-05-2021','document_default'),
(4,5,6,'vencido','15-05-2021','document_default');

INSERT INTO EDIFICIO_PLAN (`edificio_id`, `plan_id`, `fecha_asignacion`, `estado`) VALUES
(2,1, '25-12-2020', 'pendiente'),
(6,10, '25-12-2020', 'pendiente'),
(7,11, '25-12-2020', 'pendiente'),
(5,1, '25-12-2020', 'pendiente'),
(1,9,'25-12-1992','vencido'),
(2,9,'25-12-1992','vencido'),
(3,9,'25-12-1992','vencido'),
(4,9,'25-12-1992','vencido'),
(5,9,'25-12-1992','vencido'),
(6,9,'25-12-1992','vencido'),
(7,9,'25-12-1992','vencido');


INSERT INTO EDIFICIO_DOCUMENTO (`cumplimentacion_id`, `edificio_id`, `documento_id`, `estado`, `nombre_doc`) VALUES
(1,2,1,'pendiente','doc.pdf'),
(2,6,6,'pendiente','doc.pdf'),
(3,2,1,'vencido','document_default'),
(4,7,8,'vencido','document_default'),
(5,6,9,'vencido','document_default');

INSERT INTO EDIFICIO_PROCEDIMIENTO (`cumplimentacion_id`, `edificio_id`, `procedimiento_id`, `estado`, `nombre_doc`) VALUES
(1,3,1,'pendiente','doc.pdf'),
(2,6,7,'vencido','document_default'),
(3,6,5,'pendiente','document_default'),
(4,7,4,'vencido','document_default');

INSERT INTO EDIFICIO_FORMACION (`cumplimentacion_id`,`edificio_id`,`formacion_id`,`estado`,`url_recurso`,`destinatarios`) VALUES
(1,4,2,'pendiente','recurso','destinatarios'),
(2,2,1,'pendiente','recurso','destinatarios'),
(3,2,1,'vencido','recurso','destinatarios'),
(4,2,1,'vencido','recurso','destinatarios'),
(5,2,4,'pendiente','recurso','destinatarios');

INSERT INTO EDIFICIO_SIMULACRO (`cumplimentacion_id`,`edificio_id`,`simulacro_id`,`estado`,`url_recurso`,`destinatarios`) VALUES
(1,4,1,'pendiente','url/recurso','Todos'),
(2,2,4,'pendiente','url/recurso','Todos'),
(3,2,4,'vencido','url/recurso','Todos');

INSERT INTO NOTIFICACION (`id_notificacion`, `username`,`edificio_id`, `plan_id`, `mensaje`) VALUES
(1,'sg2prg','2','1','mensaje');


CREATE USER IF NOT EXISTS 'prevenroot'@'localhost' IDENTIFIED BY 'passsg2p';
GRANT ALL PRIVILEGES ON prevendb_test.* TO 'prevenroot'@'localhost';