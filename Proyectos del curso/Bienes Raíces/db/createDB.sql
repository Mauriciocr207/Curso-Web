-- SE CREAN LAS TABLAS ER CON MYSQL WORKBENCH
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema bienesRaices_CRUD
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bienesRaices_CRUD
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bienesRaices_CRUD` DEFAULT CHARACTER SET utf8 ;
USE `bienesRaices_CRUD` ;

-- -----------------------------------------------------
-- Table `bienesRaices_CRUD`.`vendedores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bienesRaices_CRUD`.`vendedores` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `apellido` VARCHAR(45) NULL,
  `telefono` VARCHAR(10) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bienesRaices_CRUD`.`propiedades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bienesRaices_CRUD`.`propiedades` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NULL,
  `precio` DECIMAL(10,2) NULL,
  `imagen` VARCHAR(200) NULL,
  `descripcion` LONGTEXT NULL,
  `habitaciones` INT(1) NULL,
  `wc` INT(11) NULL,
  `estacionamiento` INT(1) NULL,
  `creado` DATE NULL,
  `vendedor_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_propiedades_vendedor_idx` (`vendedor_id` ASC) VISIBLE,
  CONSTRAINT `fk_propiedades_vendedores`
    FOREIGN KEY (`vendedor_id`)
    REFERENCES `bienesRaices_CRUD`.`vendedores` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `bienesRaices_CRUD`.`vendedores`
-- -----------------------------------------------------
START TRANSACTION;
USE `bienesRaices_CRUD`;
INSERT INTO `bienesRaices_CRUD`.`vendedores` (`id`, `nombre`, `apellido`, `telefono`) VALUES (1, 'Juan', 'de la Torre', '1234567890');
INSERT INTO `bienesRaices_CRUD`.`vendedores` (`id`, `nombre`, `apellido`, `telefono`) VALUES (DEFAULT, 'Karen', 'Perez', '1234567890');

COMMIT;

