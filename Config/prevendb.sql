
DROP DATABASE IF EXISTS PREVENDB;
CREATE DATABASE PREVENDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE PREVENDB;

CREATE TABLE USUARIO
(
	`dni` CHAR(9),
	`username` VARCHAR(20) NOT NULL,
	`password` VARCHAR(128) NOT NULL,
	`rol` enum('edificio','organizacion','registrado','administrador') NOT NULL,
	`nombre` VARCHAR(30) NOT NULL,
	`apellidos` VARCHAR(60) NOT NULL,
	`email` VARCHAR(50) NOT NULL,
	`telefono` VARCHAR(9) NOT NULL,
	`foto_perfil` VARCHAR(20) NULL,

	CONSTRAINT `pk_usuario` PRIMARY KEY (`dni`),
	CONSTRAINT `uq_user_username` UNIQUE (`username`),
	CONSTRAINT `uq_user_telf` UNIQUE (`telefono`),
	CONSTRAINT `uq_user_email` UNIQUE (`email`)
);

CREATE TABLE EDIFICIO
(
	`edificio_id` INT(10) AUTO_INCREMENT,
	`dni` CHAR(9) NOT NULL,
	`nombre` VARCHAR(60) NOT NULL,
	`calle` VARCHAR(60) NOT NULL,
	`localidad` VARCHAR(40) NOT NULL,
	`provincia` VARCHAR(40) NOT NULL,
	`codigo_postal` CHAR(5) NOT NULL,
	`telefono` VARCHAR(9) NOT NULL,
	`fax` VARCHAR(9) NULL,
	`foto_edificio` VARCHAR(12) NULL,

	CONSTRAINT `pk_edificio` PRIMARY KEY (`edificio_id`),
	CONSTRAINT `fk_edificio_to_usuario` FOREIGN KEY (`dni`) REFERENCES USUARIO (`dni`)
);

CREATE TABLE PLANTA
(
	`planta_id` INT(10) AUTO_INCREMENT,
	`edificio_id` INT(10) NOT NULL,
	`nombre` VARCHAR(40) NOT NULL,
	`num_planta` TINYINT UNSIGNED NOT NULL,
	`descripcion` TEXT NOT NULL,

	CONSTRAINT `pk_planta` PRIMARY KEY (`planta_id`),
	CONSTRAINT `fk_planta_to_edificio` FOREIGN KEY (`edificio_id`) REFERENCES EDIFICIO (`edificio_id`)
);

CREATE TABLE ESPACIO
(
	`espacio_id` INT(10) AUTO_INCREMENT,
	`planta_id` INT(10) NOT NULL,
	`nombre` VARCHAR(40) NOT NULL,
	`dimensiones` VARCHAR(10) NULL,
	`descripcion` TEXT NOT NULL,
	`foto_espacio` VARCHAR(20) NULL,

	CONSTRAINT `pk_espacio` PRIMARY KEY (`espacio_id`),
	CONSTRAINT `fk_espacio_to_planta` FOREIGN KEY (`planta_id`) REFERENCES PLANTA (`planta_id`)
);

CREATE TABLE PLAN
(
	`plan_id` INT(10) AUTO_INCREMENT,
	`nombre` VARCHAR(40) NOT NULL,
	`descripcion` VARCHAR(380) NOT NULL,
	`instrucciones` TEXT NOT NULL,

	CONSTRAINT `pk_plan` PRIMARY KEY (`plan_id`) 
);

CREATE TABLE EDIFICIO_PLAN
(
	`edificio_id` INT(10) NOT NULL,
	`plan_id` INT(10) NOT NULL,
	`fecha_asignacion` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	`fecha_implementacion` TIMESTAMP NULL,
	`estado` enum('pendiente', 'implementado','prescrito') NOT NULL DEFAULT 'pendiente',

	CONSTRAINT `pk_edificio_plan` PRIMARY KEY (`edificio_id`, `plan_id`),
	CONSTRAINT `fk_edificio_plan_to_edificio` FOREIGN KEY (`edificio_id`) REFERENCES EDIFICIO (`edificio_id`),
	CONSTRAINT `fk_edificio_plan_to_plan` FOREIGN KEY (`plan_id`) REFERENCES PLAN (`plan_id`)
);

CREATE TABLE DOCUMENTO
(
	`documento_id` INT(10) AUTO_INCREMENT,
	`plan_id` INT(10) NOT NULL,
	`titulo` VARCHAR(50) NOT NULL,
	`descripcion` VARCHAR(380) NOT NULL,
	`comentario` TEXT NULL,
	`visible` BIT NOT NULL,

	CONSTRAINT `pk_documento` PRIMARY KEY (`documento_id`),
	CONSTRAINT `fk_documento_to_plan` FOREIGN KEY (`plan_id`) REFERENCES PLAN (`plan_id`)
);

CREATE TABLE PROCEDIMIENTO
(
	`procedimiento_id` INT(10) AUTO_INCREMENT,
	`plan_id` INT(10) NOT NULL,
	`titulo` VARCHAR(50) NOT NULL,
	`descripcion` VARCHAR(380) NOT NULL,
	`comentario` TEXT NULL,

	CONSTRAINT `pk_procedimiento` PRIMARY KEY (`procedimiento_id`),
	CONSTRAINT `fk_procedimiento_to_plan` FOREIGN KEY (`plan_id`) REFERENCES PLAN (`plan_id`)
);

CREATE TABLE RUTA
(
	`ruta_id` INT(10) AUTO_INCREMENT,
	`plan_id` INT(10) NOT NULL,
	`titulo` VARCHAR(50) NOT NULL,
	`descripcion` VARCHAR(380) NOT NULL,
	`comentario` TEXT NULL,

	CONSTRAINT `pk_ruta` PRIMARY KEY (`ruta_id`),
	CONSTRAINT `fk_ruta_to_plan` FOREIGN KEY (`plan_id`) REFERENCES PLAN (`plan_id`)
);

CREATE TABLE EDIFICIO_DOCUMENTO
(
	`edificio_documento_id` INT(10) AUTO_INCREMENT,
	`edificio_id` INT(10) NOT NULL,
	`documento_id` INT(10) NOT NULL,
	`estado` enum('vigente', 'vencido') NOT NULL DEFAULT 'vigente',
	`fecha_implementacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`nombre_doc` VARCHAR(20) NOT NULL,

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
	`fecha_implementacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
	`fecha_implementacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`nombre_doc` VARCHAR(20) NOT NULL,

	CONSTRAINT `pk_planta_ruta` PRIMARY KEY (`planta_ruta_id`),
	CONSTRAINT `fk_planta_ruta_to_planta` FOREIGN KEY (`planta_id`) REFERENCES PLANTA (`planta_id`),
	CONSTRAINT `fk_planta_ruta_to_ruta` FOREIGN KEY (`ruta_id`) REFERENCES RUTA (`ruta_id`)
);

CREATE TABLE SIMULACRO
(
	`simulacro_id` INT(10) AUTO_INCREMENT,
	`plan_id` INT(10) NOT NULL,
	`titulo` VARCHAR(50) NOT NULL,
	`descripcion` VARCHAR(380) NOT NULL,
	`comentario` TEXT NULL,

	CONSTRAINT `pk_simulacro` PRIMARY KEY (`simulacro_id`),
	CONSTRAINT `fk_simulacro_to_plan` FOREIGN KEY (`plan_id`) REFERENCES PLAN (`plan_id`)
);

CREATE TABLE EDIFICIO_SIMULACRO
(
	`edificio_simulacro_id` INT(10) AUTO_INCREMENT,
	`edificio_id` INT(10) NOT NULL,
	`simulacro_id` INT(10) NOT NULL,
	`estado` enum('vigente', 'vencido') NOT NULL DEFAULT 'vigente',
	`fecha_planificacion` TIMESTAMP NOT NULL,
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
	`titulo` VARCHAR(50) NOT NULL,
	`descripcion` VARCHAR(380) NOT NULL,
	`comentario` TEXT NULL,

	CONSTRAINT `pk_formacion` PRIMARY KEY (`formacion_id`),
	CONSTRAINT `fk_formacion_to_plan` FOREIGN KEY (`plan_id`) REFERENCES PLAN (`plan_id`)
);

CREATE TABLE EDIFICIO_FORMACION
(
	`edificio_formacion_id` INT(10) AUTO_INCREMENT,
	`edificio_id` INT(10) NOT NULL,
	`formacion_id` INT(10) NOT NULL,
	`estado` enum('vigente', 'vencido') NOT NULL DEFAULT 'vigente',
	`fecha_planificacion` TIMESTAMP NOT NULL,
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
	`dni` CHAR(9) NOT NULL,
	`edificio_id` INT(10) NOT NULL,
	`plan_id` INT(10) NOT NULL,
	`leido` BIT NOT NULL DEFAULT 0,
	`fecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`mensaje` VARCHAR(280) NOT NULL,

	CONSTRAINT `pk_notificacion` PRIMARY KEY (`id_notificacion`),
	CONSTRAINT `fk_notificacion_to_usuario` FOREIGN KEY (`dni`) REFERENCES USUARIO (`dni`),
	CONSTRAINT `fk_notificacion_to_edificio_plan` FOREIGN KEY (`edificio_id`, `plan_id`) REFERENCES EDIFICIO_PLAN (`edificio_id`, `plan_id`)
);



INSERT INTO USUARIO (`dni`,`username`,`password`,`rol`,`nombre`,`apellidos`,`email`,`telefono`,`foto_perfil`)
VALUES ('00000000D','sg2proot','7a25b0bc04e77a2f7453dd021168cdc2','administrador','admin','adminsurname','admin@email.es','111111111',null);


CREATE USER IF NOT EXISTS 'prevenroot'@'localhost' IDENTIFIED BY 'passsg2p';
GRANT ALL PRIVILEGES ON prevendb.* TO 'prevenroot'@'localhost';