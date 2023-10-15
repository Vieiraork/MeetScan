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
-- Table `meetscan`.`tb_parametro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meetscan`.`tb_parametro` (
  `cd_parametro` INT NOT NULL,
  `vl_parametro` VARCHAR(250) NOT NULL,
  `ds_descricao` VARCHAR(250) NOT NULL,
  `dt_registro` DATETIME NULL,
  PRIMARY KEY (`cd_parametro`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `meetscan`.`tb_perfil`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meetscan`.`tb_perfil` (
  `cd_perfil` INT NOT NULL,
  `ds_perfil` VARCHAR(250) NOT NULL,
  `ds_leitura` VARCHAR(1) NOT NULL,
  `ds_escrita` VARCHAR(1) NOT NULL,
  `ds_exclusao` VARCHAR(1) NOT NULL,
  `ds_edicao` VARCHAR(1) NOT NULL,
  PRIMARY KEY (`cd_perfil`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `meetscan`.`tb_usuario_perfil` (
  `id_usuario_perfil` INT AUTO_INCREMENT,
  `id_perfil` INT NOT NULL,
  `id_usuario` INT NOT NULL,
  PRIMARY KEY (`id_usuario_perfil`),
)


-- -----------------------------------------------------
-- Table `meetscan`.`tb_usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meetscan`.`tb_usuarios` (
  `id_usuarios` INT NOT NULL AUTO_INCREMENT,
  `no_usuario` VARCHAR(250) NOT NULL,
  `ds_email` VARCHAR(250) NOT NULL,
  `ds_senha` VARCHAR(250) NOT NULL,
  `st_status` VARCHAR(1) NOT NULL,
  `ds_token` VARCHAR(250) NULL,
  `dt_registro` DATETIME NULL,
  `dt_alteracao` DATETIME NULL,
  `cd_perfil` INT NOT NULL,
  PRIMARY KEY (`id_usuarios`),
  INDEX `fk_tb_usuarios_tb_perfil_idx` (`cd_perfil` ASC),
  CONSTRAINT `fk_tb_usuarios_tb_perfil`
    FOREIGN KEY (`cd_perfil`)
    REFERENCES `meetscan`.`tb_perfil` (`cd_perfil`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `meetscan`.`tb_controle_acessos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meetscan`.`tb_controle_acessos` (
  `id_controle_acesso` INT NOT NULL AUTO_INCREMENT,
  `ds_acao` VARCHAR(250) NOT NULL,
  `dt_registro` DATETIME NULL,
  `id_usuario` INT NOT NULL,
  PRIMARY KEY (`id_controle_acesso`),
  INDEX `fk_tb_controle_acessos_tb_usuarios1_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_tb_controle_acessos_tb_usuarios1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `meetscan`.`tb_usuarios` (`id_usuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `meetscan`.`tb_anexos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meetscan`.`tb_anexos` (
  `id_anexo` INT NOT NULL AUTO_INCREMENT,
  `ds_arquivo` VARCHAR(250) NULL,
  `ds_link` TEXT(500) NOT NULL,
  `dt_registro` DATETIME NULL,
  `id_usuario` INT NOT NULL,
  PRIMARY KEY (`id_anexo`),
  INDEX `fk_tb_anexos_tb_usuarios1_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_tb_anexos_tb_usuarios1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `meetscan`.`tb_usuarios` (`id_usuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `meetscan`.`tb_auditoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meetscan`.`tb_auditoria` (
  `id_auditoria` INT NOT NULL AUTO_INCREMENT,
  `ds_acao` VARCHAR(250) NOT NULL,
  `dt_registro` DATETIME NULL,
  `id_usuario` INT NOT NULL,
  PRIMARY KEY (`id_auditoria`),
  INDEX `fk_tb_auditoria_tb_usuarios1_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_tb_auditoria_tb_usuarios1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `meetscan`.`tb_usuarios` (`id_usuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `meetscan`.`tb_codigo_acesso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `meetscan`.`tb_codigo_acesso` (
  `id_codigo_acesso` INT NOT NULL,
  `ds_codigo_acesso` VARCHAR(250) NOT NULL,
  `dt_registro` DATETIME NULL,
  `dt_alteracao` DATETIME NULL,
  `id_usuario` INT NOT NULL,
  PRIMARY KEY (`id_codigo_acesso`),
  INDEX `fk_tb_codigo_acesso_tb_usuarios1_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_tb_codigo_acesso_tb_usuarios1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `meetscan`.`tb_usuarios` (`id_usuarios`)
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
