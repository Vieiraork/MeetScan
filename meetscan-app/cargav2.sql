-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema meetscan
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema meetscan
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `meetscan` DEFAULT CHARACTER SET utf8 ;
USE `meetscan` ;

-- -----------------------------------------------------
-- Table `meetscan`.`tb_perfil`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meetscan`.`tb_perfil` (
  `cd_perfil` INT NOT NULL,
  `ds_perfil` VARCHAR(70) NULL,
  PRIMARY KEY (`cd_perfil`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `meetscan`.`tb_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meetscan`.`tb_usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `no_usuario` VARCHAR(200) NOT NULL,
  `ds_email` VARCHAR(200) NOT NULL,
  `ds_senha` VARCHAR(200) NOT NULL,
  `st_status` VARCHAR(1) NOT NULL,
  `ds_token` VARCHAR(200) NULL,
  `dt_inclusao` DATETIME NULL,
  `dt_alteracao` DATETIME NULL,
  `cd_perfil` INT NOT NULL,
  PRIMARY KEY (`id_usuario`),
  INDEX `fk_tb_usuario_tb_perfil1_idx` (`cd_perfil` ASC) VISIBLE,
  CONSTRAINT `fk_tb_usuario_tb_perfil1`
    FOREIGN KEY (`cd_perfil`)
    REFERENCES `meetscan`.`tb_perfil` (`cd_perfil`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `meetscan`.`tb_tipo_acao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meetscan`.`tb_tipo_acao` (
  `cd_tipo_acao` INT NOT NULL,
  `ds_tipo_acao` VARCHAR(60) NULL,
  PRIMARY KEY (`cd_tipo_acao`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `meetscan`.`tb_controle_acesso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meetscan`.`tb_controle_acesso` (
  `id_controle_acesso` INT NOT NULL AUTO_INCREMENT,
  `dt_inclusao` DATETIME NULL,
  `id_usuario` INT NOT NULL,
  `cd_tipo_acao` INT NOT NULL,
  PRIMARY KEY (`id_controle_acesso`),
  INDEX `fk_tb_controle_acesso_tb_usuario1_idx` (`id_usuario` ASC) VISIBLE,
  INDEX `fk_tb_controle_acesso_tb_tipo_acao1_idx` (`cd_tipo_acao` ASC) VISIBLE,
  CONSTRAINT `fk_tb_controle_acesso_tb_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `meetscan`.`tb_usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_controle_acesso_tb_tipo_acao1`
    FOREIGN KEY (`cd_tipo_acao`)
    REFERENCES `meetscan`.`tb_tipo_acao` (`cd_tipo_acao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `meetscan`.`tb_auditoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meetscan`.`tb_auditoria` (
  `id_auditoria` INT NOT NULL AUTO_INCREMENT,
  `dt_inclusao` DATETIME NOT NULL,
  `id_usuario` INT NOT NULL,
  `cd_tipo_acao` INT NOT NULL,
  PRIMARY KEY (`id_auditoria`),
  INDEX `fk_tb_auditoria_tb_usuario1_idx` (`id_usuario` ASC) VISIBLE,
  INDEX `fk_tb_auditoria_tb_tipo_acao1_idx` (`cd_tipo_acao` ASC) VISIBLE,
  CONSTRAINT `fk_tb_auditoria_tb_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `meetscan`.`tb_usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_auditoria_tb_tipo_acao1`
    FOREIGN KEY (`cd_tipo_acao`)
    REFERENCES `meetscan`.`tb_tipo_acao` (`cd_tipo_acao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `meetscan`.`tb_codigo_acesso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meetscan`.`tb_codigo_acesso` (
  `id_codigo_acesso` INT NOT NULL AUTO_INCREMENT,
  `ds_codigo_acesso` VARCHAR(200) NULL,
  `dt_inclusao` DATETIME NULL,
  `dt_alteracao` DATETIME NULL,
  `id_usuario` INT NOT NULL,
  PRIMARY KEY (`id_codigo_acesso`),
  INDEX `fk_tb_codigo_acesso_tb_usuario1_idx` (`id_usuario` ASC) VISIBLE,
  CONSTRAINT `fk_tb_codigo_acesso_tb_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `meetscan`.`tb_usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `meetscan`.`tb_anexo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meetscan`.`tb_anexo` (
  `id_anexo` INT NOT NULL AUTO_INCREMENT,
  `ds_arquivo` VARCHAR(200) NOT NULL,
  `ds_link` VARCHAR(250) NOT NULL,
  `no_arquivo` VARCHAR(100) NOT NULL,
  `ds_caminho` TEXT(500) NULL,
  `dt_inclusao` DATETIME NULL,
  `id_usuario` INT NOT NULL,
  PRIMARY KEY (`id_anexo`),
  INDEX `fk_tb_anexo_tb_usuario1_idx` (`id_usuario` ASC) VISIBLE,
  CONSTRAINT `fk_tb_anexo_tb_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `meetscan`.`tb_usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `meetscan`.`tb_parametro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meetscan`.`tb_parametro` (
  `cd_parametro` INT NOT NULL,
  `vl_parametro` TEXT(500) NOT NULL,
  `ds_parametro` VARCHAR(100) NOT NULL,
  `dt_registro` DATETIME NULL,
  PRIMARY KEY (`cd_parametro`),
  UNIQUE INDEX `cd_parametro_UNIQUE` (`cd_parametro` ASC) VISIBLE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
