
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
    `num_planta` TINYINT UNSIGNED NOT NULL,
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
    `fecha_asignacion` DATE NOT NULL DEFAULT CURRENT_DATE,
    `fecha_implementacion` DATE NOT NULL DEFAULT '00-00-0000',
    `estado` enum('pendiente', 'implementado','vencido') NOT NULL DEFAULT 'pendiente',

    CONSTRAINT `pk_edificio_plan` PRIMARY KEY (`edificio_id`, `plan_id`),
    CONSTRAINT `fk_edificio_plan_to_edificio` FOREIGN KEY (`edificio_id`) REFERENCES EDIFICIO (`edificio_id`),
    CONSTRAINT `fk_edificio_plan_to_plan` FOREIGN KEY (`plan_id`) REFERENCES PLAN (`plan_id`)
);

CREATE TABLE DOCUMENTO
(
    `documento_id` INT(10) AUTO_INCREMENT,
    `plan_id` INT(10) NOT NULL,
    `nombre` VARCHAR(50) NOT NULL,
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
    `nombre` VARCHAR(50) NOT NULL,
    `descripcion` TEXT NOT NULL,

    CONSTRAINT `pk_procedimiento` PRIMARY KEY (`procedimiento_id`),
    CONSTRAINT `fk_procedimiento_to_plan` FOREIGN KEY (`plan_id`) REFERENCES PLAN (`plan_id`)
);

CREATE TABLE RUTA
(
    `ruta_id` INT(10) AUTO_INCREMENT,
    `plan_id` INT(10) NOT NULL,
    `nombre` VARCHAR(50) NOT NULL,
    `descripcion` TEXT NOT NULL,

    CONSTRAINT `pk_ruta` PRIMARY KEY (`ruta_id`),
    CONSTRAINT `fk_ruta_to_plan` FOREIGN KEY (`plan_id`) REFERENCES PLAN (`plan_id`)
);

CREATE TABLE EDIFICIO_DOCUMENTO
(
    `edificio_documento_id` INT(10) AUTO_INCREMENT,
    `edificio_id` INT(10) NOT NULL,
    `documento_id` INT(10) NOT NULL,
    `estado` enum('vigente', 'vencido') NOT NULL DEFAULT 'vigente',
    `fecha_implementacion` DATE NOT NULL DEFAULT '00-00-0000',
    `nombre_doc` VARCHAR(20) NOT NULL DEFAULT 'empty',

    CONSTRAINT `pk_edificio_documento` PRIMARY KEY (`edificio_documento_id`),
    CONSTRAINT `fk_edificio_documento_to_edificio` FOREIGN KEY (`edificio_id`) REFERENCES EDIFICIO (`edificio_id`),
    CONSTRAINT `fk_edificio_documento_to_documento` FOREIGN KEY (`documento_id`) REFERENCES DOCUMENTO (`documento_id`)
);

CREATE TABLE EDIFICIO_PROCEDIMIENTO
(
    `edificio_procedimiento_id` INT(10) AUTO_INCREMENT,
    `edificio_id` INT(10) NOT NULL,
    `procedimiento_id` INT(10) NOT NULL,
    `estado` enum('vigente', 'vencido') NOT NULL DEFAULT 'vigente',
    `fecha_implementacion` DATE NOT NULL DEFAULT '00-00-0000',
    `nombre_doc` VARCHAR(20) NOT NULL,

    CONSTRAINT `pk_edificio_procedimiento` PRIMARY KEY (`edificio_procedimiento_id`),
    CONSTRAINT `fk_edificio_procedimiento_to_edificio` FOREIGN KEY (`edificio_id`) REFERENCES EDIFICIO (`edificio_id`),
    CONSTRAINT `fk_edificio_procedimiento_to_procedimiento` FOREIGN KEY (`procedimiento_id`) REFERENCES PROCEDIMIENTO (`procedimiento_id`)
);

CREATE TABLE PLANTA_RUTA
(
    `planta_ruta_id` INT(10) AUTO_INCREMENT,
    `planta_id` INT(10) NOT NULL,
    `ruta_id` INT(10) NOT NULL,
    `estado` enum('vigente', 'vencido') NOT NULL DEFAULT 'vigente',
    `fecha_implementacion` DATE NOT NULL DEFAULT '00-00-0000',
    `nombre_doc` VARCHAR(20) NOT NULL,

    CONSTRAINT `pk_planta_ruta` PRIMARY KEY (`planta_ruta_id`),
    CONSTRAINT `fk_planta_ruta_to_planta` FOREIGN KEY (`planta_id`) REFERENCES PLANTA (`planta_id`),
    CONSTRAINT `fk_planta_ruta_to_ruta` FOREIGN KEY (`ruta_id`) REFERENCES RUTA (`ruta_id`)
);

CREATE TABLE SIMULACRO
(
    `simulacro_id` INT(10) AUTO_INCREMENT,
    `plan_id` INT(10) NOT NULL,
    `nombre` VARCHAR(50) NOT NULL,
    `descripcion` TEXT NOT NULL,

    CONSTRAINT `pk_simulacro` PRIMARY KEY (`simulacro_id`),
    CONSTRAINT `fk_simulacro_to_plan` FOREIGN KEY (`plan_id`) REFERENCES PLAN (`plan_id`)
);

CREATE TABLE EDIFICIO_SIMULACRO
(
    `edificio_simulacro_id` INT(10) AUTO_INCREMENT,
    `edificio_id` INT(10) NOT NULL,
    `simulacro_id` INT(10) NOT NULL,
    `estado` enum('vigente', 'vencido') NOT NULL DEFAULT 'vigente',
    `fecha_planificacion` DATE NOT NULL DEFAULT '00-00-0000',
    `url_recurso` VARCHAR(20) NULL,
    `destinatarios` VARCHAR(100) NOT NULL,
    `resultado` TEXT NULL,

    CONSTRAINT `pk_edificio_simulacro` PRIMARY KEY (`edificio_simulacro_id`),
    CONSTRAINT `fk_edificio_simulacro_to_edificio` FOREIGN KEY (`edificio_id`) REFERENCES EDIFICIO (`edificio_id`),
    CONSTRAINT `fk_edificio_simulacro_to_simulacro` FOREIGN KEY (`simulacro_id`) REFERENCES SIMULACRO (`simulacro_id`)
);

CREATE TABLE FORMACION
(
    `formacion_id` INT(10) AUTO_INCREMENT,
    `plan_id` INT(10) NOT NULL,
    `nombre` VARCHAR(50) NOT NULL,
    `descripcion` TEXT NOT NULL,

    CONSTRAINT `pk_formacion` PRIMARY KEY (`formacion_id`),
    CONSTRAINT `fk_formacion_to_plan` FOREIGN KEY (`plan_id`) REFERENCES PLAN (`plan_id`)
);

CREATE TABLE EDIFICIO_FORMACION
(
    `edificio_formacion_id` INT(10) AUTO_INCREMENT,
    `edificio_id` INT(10) NOT NULL,
    `formacion_id` INT(10) NOT NULL,
    `estado` enum('vigente', 'vencido') NOT NULL DEFAULT 'vigente',
    `fecha_planificacion` DATE NOT NULL DEFAULT '00-00-0000',
    `nombre_doc` VARCHAR(20) NULL,
    `url_recurso` VARCHAR(20) NULL,
    `destinatarios` VARCHAR(100) NOT NULL,

    CONSTRAINT `pk_edificio_formacion` PRIMARY KEY (`edificio_formacion_id`),
    CONSTRAINT `fk_edificio_formacion_to_edificio` FOREIGN KEY (`edificio_id`) REFERENCES EDIFICIO (`edificio_id`),
    CONSTRAINT `fk_edificio_formacion_to_formacion` FOREIGN KEY (`formacion_id`) REFERENCES FORMACION (`formacion_id`)
);


CREATE TABLE NOTIFICACION
(
    `id_notificacion` INT(10) AUTO_INCREMENT,
    `username` VARCHAR(20) NOT NULL,
    `edificio_id` INT(10) NOT NULL,
    `plan_id` INT(10) NOT NULL,
    `leido` BIT NOT NULL DEFAULT 0,
    `fecha` DATE NOT NULL DEFAULT CURRENT_DATE,
    `mensaje` VARCHAR(280) NOT NULL,

    CONSTRAINT `pk_notificacion` PRIMARY KEY (`id_notificacion`),
    CONSTRAINT `fk_notificacion_to_usuario` FOREIGN KEY (`username`) REFERENCES USUARIO (`username`),
    CONSTRAINT `fk_notificacion_to_edificio_plan` FOREIGN KEY (`edificio_id`, `plan_id`) REFERENCES EDIFICIO_PLAN (`edificio_id`, `plan_id`)
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
(4,'sg2ped2','Edificio Cuatro','Calle ejemplo 4','Ourense','Ourense','36687','987678769','default.png');

INSERT INTO PLANTA (`planta_id`, `edificio_id`, `nombre`, `num_planta`, `descripcion`, `foto_planta`) VALUES
(1,1,'Planta Uno',1,'descripcion de la planta uno','default.png'),
(2,1,'Planta Dos',2,'descripcion de la planta dos','default.png'),
(3,1,'Planta Tres',3,'descripcion de la planta tres','default.png');

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
(6,'Plan con Simulacros','Descripcion Plan');


INSERT INTO DOCUMENTO (`documento_id`,`plan_id`,`nombre`,`descripcion`,`visible`) VALUES
(1,2,'Documentos del plan con documentos','Descripcion del Documento','yes'),
(2,2,'Nombre Documento','Descripcion','no');

INSERT INTO PROCEDIMIENTO (`procedimiento_id`,`plan_id`,`nombre`,`descripcion`) VALUES
(1,3,'Procedimiento del plan con procedimientos','Descripcion del Procedimiento');

INSERT INTO RUTA (`ruta_id`, `plan_id`, `nombre`, `descripcion`) VALUES
(1,1,'Rutas del Plan Uno','Descripcion de la definicion de la ruta'),
(2,4,'Rutas del plan con rutas','Descripcion Rutas');

INSERT INTO FORMACION (`formacion_id`,`plan_id`,`nombre`,`descripcion`) VALUES
(1,5,'Formaciones del plan con formaciones','Descripción de la formación');

INSERT INTO SIMULACRO (`simulacro_id`,`plan_id`,`nombre`,`descripcion`) VALUES
(1,6,'Simulacros del plan con simulacros','Descripcion del simulacro');

INSERT INTO PLANTA_RUTA (`planta_ruta_id`, `planta_id`, `ruta_id`, `estado`, `fecha_implementacion`, `nombre_doc`) VALUES
(1,2,1,'vigente','15-05-2021','nombre_doc');

INSERT INTO EDIFICIO_PLAN (`edificio_id`, `plan_id`, `fecha_asignacion`, `estado`) VALUES
(2,1, '25-12-2020', 'pendiente');

INSERT INTO EDIFICIO_DOCUMENTO (`edificio_documento_id`, `edificio_id`, `documento_id`, `estado`, `nombre_doc`) VALUES
(1,2,1,'vigente','doc.pdf');


CREATE USER IF NOT EXISTS 'prevenroot'@'localhost' IDENTIFIED BY 'passsg2p';
GRANT ALL PRIVILEGES ON prevendb_test.* TO 'prevenroot'@'localhost';