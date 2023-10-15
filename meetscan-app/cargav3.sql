-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `email_verified_at` DATETIME NULL,
  `password` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`perfil`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`perfil` (
  `cd_perfil` INT NOT NULL,
  `ds_perfil` TEXT(255) NOT NULL,
  `ds_leitura` TEXT(1) NOT NULL,
  `ds_escrita` TEXT(1) NOT NULL,
  `ds_exclusao` TEXT(1) NOT NULL,
  `ds_edicao` TEXT(1) NOT NULL,
  PRIMARY KEY (`cd_perfil`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`controle_acesso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`controle_acesso` (
  `id_controle_acesso` INT NOT NULL AUTO_INCREMENT,
  `ds_acao` TEXT(255) NOT NULL,
  `dt_registro` DATETIME NULL,
  `usuario_id` INT NOT NULL,
  PRIMARY KEY (`id_controle_acesso`),
  INDEX `fk_controle_acesso_users1_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_controle_acesso_users1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `mydb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`anexos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`anexos` (
  `id_anexos` INT NOT NULL AUTO_INCREMENT,
  `ds_arquivo` TEXT(300) NOT NULL,
  `ds_link` TEXT(500) NOT NULL,
  `dt_registro` DATETIME NULL,
  `usuario_id` INT NOT NULL,
  PRIMARY KEY (`id_anexos`),
  INDEX `fk_anexos_users1_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_anexos_users1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `mydb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`auditoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`auditoria` (
  `id_auditoria` INT NOT NULL AUTO_INCREMENT,
  `ds_acao` TEXT(255) NOT NULL,
  `dt_registro` DATETIME NULL,
  `usuario_id` INT NOT NULL,
  PRIMARY KEY (`id_auditoria`),
  INDEX `fk_auditoria_users1_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_auditoria_users1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `mydb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`codigo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`codigo` (
  `id_codigo` INT NOT NULL AUTO_INCREMENT,
  `ds_codigo` TEXT(255) NOT NULL,
  `dt_registro` DATETIME NULL,
  `dt_alteracao` DATETIME NULL,
  `id_usuario` INT NOT NULL,
  PRIMARY KEY (`id_codigo`),
  INDEX `fk_codigo_users1_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_codigo_users1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `mydb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`perfil_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`perfil_usuario` (
  `id_perfil_usuario` INT NOT NULL AUTO_INCREMENT,
  `id_usuario` INT NOT NULL,
  `cd_perfil` INT NOT NULL,
  PRIMARY KEY (`id_perfil_usuario`),
  INDEX `fk_perfil_usuario_users_idx` (`id_usuario` ASC),
  INDEX `fk_perfil_usuario_perfil1_idx` (`cd_perfil` ASC),
  CONSTRAINT `fk_perfil_usuario_users`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `mydb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_perfil_usuario_perfil1`
    FOREIGN KEY (`cd_perfil`)
    REFERENCES `mydb`.`perfil` (`cd_perfil`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`status` (
  `cd_status` INT NOT NULL,
  `ds_status` VARCHAR(1) NULL,
  PRIMARY KEY (`cd_status`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`status_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`status_usuario` (
  `id_status_usuario` INT NOT NULL AUTO_INCREMENT,
  `id_usuario` INT NOT NULL,
  `cd_status` INT NOT NULL,
  PRIMARY KEY (`id_status_usuario`),
  INDEX `fk_status_usuario_users1_idx` (`id_usuario` ASC),
  INDEX `fk_status_usuario_status1_idx` (`cd_status` ASC),
  CONSTRAINT `fk_status_usuario_users1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `mydb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_status_usuario_status1`
    FOREIGN KEY (`cd_status`)
    REFERENCES `mydb`.`status` (`cd_status`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

insert into meetscan.tb_perfil (cd_perfil, ds_perfil, ds_leitura, ds_escrita, ds_exclusao, ds_edicao)
values (1, 'Administrador', 'S', 'S', 'S', 'S');

insert into meetscan.tb_perfil (cd_perfil, ds_perfil, ds_leitura, ds_escrita, ds_exclusao, ds_edicao)
values (2, 'Morador', 'S', 'N', 'N', 'N');


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
