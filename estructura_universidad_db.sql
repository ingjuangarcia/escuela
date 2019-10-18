-- MySQL Script generated by MySQL Workbench
-- 10/18/19 07:54:42
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
SHOW WARNINGS;
-- -----------------------------------------------------
-- Schema escuela
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `escuela` ;

-- -----------------------------------------------------
-- Schema escuela
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `escuela` DEFAULT CHARACTER SET latin1 ;
SHOW WARNINGS;
USE `escuela` ;

-- -----------------------------------------------------
-- Table `escuela`.`carrera`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `escuela`.`carrera` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `escuela`.`carrera` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `nombre` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = latin1;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `escuela`.`materia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `escuela`.`materia` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `escuela`.`materia` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `nombre` VARCHAR(45) NOT NULL COMMENT '',
  `credito` INT(11) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = latin1;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `escuela`.`carrera_materia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `escuela`.`carrera_materia` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `escuela`.`carrera_materia` (
  `carrera_id` INT(11) NOT NULL COMMENT '',
  `materia_id` INT(11) NOT NULL COMMENT '')
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

SHOW WARNINGS;
CREATE INDEX `kfcarr_idx` ON `escuela`.`carrera_materia` (`carrera_id` ASC)  COMMENT '';

SHOW WARNINGS;
CREATE INDEX `fkmat_idx` ON `escuela`.`carrera_materia` (`materia_id` ASC)  COMMENT '';

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `escuela`.`estudiante`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `escuela`.`estudiante` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `escuela`.`estudiante` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `nombre` VARCHAR(100) NOT NULL COMMENT '',
  `matricula` VARCHAR(45) NOT NULL COMMENT '',
  `edad` INT(11) NOT NULL COMMENT '',
  `carrera_id` INT(11) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = latin1;

SHOW WARNINGS;
CREATE UNIQUE INDEX `matricula_UNIQUE` ON `escuela`.`estudiante` (`matricula` ASC)  COMMENT '';

SHOW WARNINGS;
CREATE INDEX `fkcarrera_idx` ON `escuela`.`estudiante` (`carrera_id` ASC)  COMMENT '';

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `escuela`.`semestre`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `escuela`.`semestre` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `escuela`.`semestre` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `semestre` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `escuela`.`semestre_estu_mat`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `escuela`.`semestre_estu_mat` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `escuela`.`semestre_estu_mat` (
  `semestre_id` INT(11) NOT NULL COMMENT '',
  `estudiante_id` INT(11) NOT NULL COMMENT '',
  `materia_id` INT(11) NOT NULL COMMENT '')
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

SHOW WARNINGS;
CREATE INDEX `kfsem_idx` ON `escuela`.`semestre_estu_mat` (`semestre_id` ASC)  COMMENT '';

SHOW WARNINGS;
CREATE INDEX `kfest_idx` ON `escuela`.`semestre_estu_mat` (`estudiante_id` ASC)  COMMENT '';

SHOW WARNINGS;
CREATE INDEX `kfmat_idx` ON `escuela`.`semestre_estu_mat` (`materia_id` ASC)  COMMENT '';

SHOW WARNINGS;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;