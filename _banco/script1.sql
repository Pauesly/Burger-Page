
-- -----------------------------------------------------
-- Table `u620166704_jazz_grill_100`.`Adm`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u620166704_jazz_grill_100`.`Adm` (
  `id_adm` INT NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `picture` MEDIUMTEXT NULL,
  PRIMARY KEY (`id_adm`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u620166704_jazz_grill_100`.`Burger`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u620166704_jazz_grill_100`.`Burger` (
  `id_burger` INT NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  `picture` MEDIUMTEXT NOT NULL,
  `stars` INT NOT NULL,
  `price_new` FLOAT NOT NULL,
  `price_old` FLOAT NULL,
  `active` TINYINT NOT NULL COMMENT 'Lanche ativo no cardapio',
  PRIMARY KEY (`id_burger`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u620166704_jazz_grill_100`.`Customer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u620166704_jazz_grill_100`.`Customer` (
  `id_customer` INT NOT NULL,
  `phone_number_1` VARCHAR(15) NOT NULL,
  `phone_number_2` VARCHAR(15) NOT NULL,
  `name` VARCHAR(60) NOT NULL,
  `obs` VARCHAR(255) NULL,
  `picture` MEDIUMTEXT NULL,
  `cpf` VARCHAR(14) NULL,
  `active` TINYINT NOT NULL,
  PRIMARY KEY (`id_customer`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u620166704_jazz_grill_100`.`Address`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u620166704_jazz_grill_100`.`Address` (
  `id_address` INT NOT NULL,
  `fk_id_customer` INT NOT NULL,
  `local` VARCHAR(60) NULL,
  `rua` VARCHAR(255) NOT NULL,
  `numero` VARCHAR(60) NOT NULL,
  `bairro` VARCHAR(60) NOT NULL,
  `cidade` VARCHAR(60) NOT NULL,
  `estado` VARCHAR(2) NOT NULL,
  `referencia` VARCHAR(60) NOT NULL,
  `latitude` VARCHAR(13) NULL,
  `longitude` VARCHAR(13) NULL,
  `obs` VARCHAR(60) NULL,
  `active` TINYINT NOT NULL,
  PRIMARY KEY (`id_address`),
  CONSTRAINT `fk_Address_Customer`
    FOREIGN KEY (`fk_id_customer`)
    REFERENCES `u620166704_jazz_grill_100`.`Customer` (`id_customer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
