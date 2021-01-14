-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema greta
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema greta
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `greta` DEFAULT CHARACTER SET utf8mb4 ;
USE `greta` ;

-- -----------------------------------------------------
-- Table `greta`.`enseignants`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `greta`.`enseignants` (
  `code_ens` SMALLINT NOT NULL AUTO_INCREMENT,
  `nom_ens` VARCHAR(45) NOT NULL,
  `grade_ens` TINYINT NULL DEFAULT 0,
  `embauche_ens` DATE NULL,
  PRIMARY KEY (`code_ens`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `greta`.`matieres`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `greta`.`matieres` (
  `code_mat` SMALLINT NOT NULL AUTO_INCREMENT,
  `nom_mat` VARCHAR(45) NOT NULL,
  `coeff_mat` TINYINT NULL,
  `enseignants_code_ens` SMALLINT NOT NULL,
  PRIMARY KEY (`code_mat`),
  INDEX `fk_matieres_enseignants_idx` (`enseignants_code_ens` ASC) VISIBLE,
  CONSTRAINT `fk_matieres_enseignants`
    FOREIGN KEY (`enseignants_code_ens`)
    REFERENCES `greta`.`enseignants` (`code_ens`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `greta`.`etudiants`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `greta`.`etudiants` (
  `code_etu` SMALLINT NOT NULL,
  `nom_etu` VARCHAR(45) NOT NULL,
  `ddn_etu` DATE NOT NULL,
  `sexe_etu` CHAR(1) NOT NULL,
  PRIMARY KEY (`code_etu`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `greta`.`ETUDIE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `greta`.`ETUDIE` (
  `etudiants_code_etu` SMALLINT NOT NULL,
  `matieres_code_mat` SMALLINT NOT NULL,
  PRIMARY KEY (`etudiants_code_etu`, `matieres_code_mat`),
  INDEX `fk_etudiants_has_matieres_matieres1_idx` (`matieres_code_mat` ASC) VISIBLE,
  INDEX `fk_etudiants_has_matieres_etudiants1_idx` (`etudiants_code_etu` ASC) VISIBLE,
  CONSTRAINT `fk_etudiants_has_matieres_etudiants1`
    FOREIGN KEY (`etudiants_code_etu`)
    REFERENCES `greta`.`etudiants` (`code_etu`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_etudiants_has_matieres_matieres1`
    FOREIGN KEY (`matieres_code_mat`)
    REFERENCES `greta`.`matieres` (`code_mat`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
