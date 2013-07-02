SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `restaurante` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `restaurante` ;

-- -----------------------------------------------------
-- Table `restaurante`.`FUNCIONARIO`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `restaurante`.`FUNCIONARIO` (
  `id_funcionario` INT NOT NULL AUTO_INCREMENT ,
  `nome_funcionario` VARCHAR(60) NULL ,
  `data_admissao` DATETIME NULL ,
  `senha` VARCHAR(100) NULL ,
  `usuario` VARCHAR(100) NULL ,
  `permissao` INT NULL ,
  PRIMARY KEY (`id_funcionario`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `restaurante`.`MESA`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `restaurante`.`MESA` (
  `id_mesa` INT NOT NULL AUTO_INCREMENT ,
  `nro_mesa` INT NOT NULL ,
  PRIMARY KEY (`id_mesa`) ,
  UNIQUE INDEX `nro_mesa_UNIQUE` (`nro_mesa` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `restaurante`.`CONTA`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `restaurante`.`CONTA` (
  `id_conta` INT NOT NULL AUTO_INCREMENT ,
  `status_conta` CHAR(1) NULL ,
  `data_entrada` DATETIME NULL ,
  `data_saida` DATETIME NULL ,
  `FUNCIONARIO_id_funcionario` INT NOT NULL ,
  `MESA_id_mesa` INT NOT NULL ,
  `vlr_total` FLOAT NULL ,
  `tipo_pagamento` VARCHAR(2) NOT NULL DEFAULT NULL ,
  PRIMARY KEY (`id_conta`) ,
  INDEX `fk_CONTA_FUNCIONARIO1_idx` (`FUNCIONARIO_id_funcionario` ASC) ,
  INDEX `fk_CONTA_MESA1_idx` (`MESA_id_mesa` ASC) ,
  CONSTRAINT `fk_CONTA_FUNCIONARIO1`
    FOREIGN KEY (`FUNCIONARIO_id_funcionario` )
    REFERENCES `restaurante`.`FUNCIONARIO` (`id_funcionario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CONTA_MESA1`
    FOREIGN KEY (`MESA_id_mesa` )
    REFERENCES `restaurante`.`MESA` (`id_mesa` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `restaurante`.`ITEM`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `restaurante`.`ITEM` (
  `id_item` INT NOT NULL AUTO_INCREMENT ,
  `nome_item` VARCHAR(45) NULL ,
  `vlr_unitario` FLOAT NULL ,
  PRIMARY KEY (`id_item`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `restaurante`.`PEDIDO`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `restaurante`.`PEDIDO` (
  `id_pedido` INT NOT NULL AUTO_INCREMENT ,
  `data_pedido` DATETIME NOT NULL ,
  `status_pedido` CHAR(1) NOT NULL ,
  `CONTA_id_conta` INT NOT NULL ,
  `entrega_pedido` DATETIME NULL ,
  `qtd` INT NOT NULL ,
  `ITEM_id_item` INT NOT NULL ,
  `descricao_pedido` VARCHAR(100) NULL ,
  PRIMARY KEY (`id_pedido`, `ITEM_id_item`) ,
  INDEX `fk_PEDIDO_CONTA1_idx` (`CONTA_id_conta` ASC) ,
  INDEX `fk_PEDIDO_ITEM1_idx` (`ITEM_id_item` ASC) ,
  CONSTRAINT `fk_PEDIDO_CONTA1`
    FOREIGN KEY (`CONTA_id_conta` )
    REFERENCES `restaurante`.`CONTA` (`id_conta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PEDIDO_ITEM1`
    FOREIGN KEY (`ITEM_id_item` )
    REFERENCES `restaurante`.`ITEM` (`id_item` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
