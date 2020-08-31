-----------------------------------------------
-- Table `u620166704_jazz_grill_100`.`Adm`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u620166704_jazz_grill_100`.`Adm` (
  `id_adm` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `picture` MEDIUMTEXT NULL,
  `obs` VARCHAR(60) NULL,
  `active` TINYINT NOT NULL,
  `token_login_web` VARCHAR(90) NULL,
  `created_at` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id_adm`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u620166704_jazz_grill_100`.`Category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u620166704_jazz_grill_100`.`Category` (
  `id_category` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(60) NOT NULL,
  `active` TINYINT NOT NULL,
  `created_at` TIMESTAMP NULL,
  PRIMARY KEY (`id_category`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u620166704_jazz_grill_100`.`Product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u620166704_jazz_grill_100`.`Product` (
  `id_product` INT NOT NULL AUTO_INCREMENT,
  `fk_id_category` INT NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  `picture` MEDIUMTEXT NOT NULL,
  `star` INT NOT NULL,
  `price_new` FLOAT NOT NULL,
  `price_old` FLOAT NULL,
  `active` TINYINT NOT NULL COMMENT 'Lanche ativo no cardapio',
  `created_at` TIMESTAMP NULL,
  PRIMARY KEY (`id_product`),
  CONSTRAINT `fk_Product_Category1`
    FOREIGN KEY (`fk_id_category`)
    REFERENCES `u620166704_jazz_grill_100`.`Category` (`id_category`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u620166704_jazz_grill_100`.`Customer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u620166704_jazz_grill_100`.`Customer` (
  `id_customer` INT NOT NULL AUTO_INCREMENT,
  `phone_number_1` VARCHAR(16) NOT NULL,
  `phone_number_2` VARCHAR(16) NOT NULL,
  `name` VARCHAR(60) NOT NULL,
  `cpf` VARCHAR(14) NULL,
  `obs` VARCHAR(255) NULL,
  `picture` MEDIUMTEXT NULL,
  `active` TINYINT NOT NULL,
  `created_at` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id_customer`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u620166704_jazz_grill_100`.`Address`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u620166704_jazz_grill_100`.`Address` (
  `id_address` INT NOT NULL AUTO_INCREMENT,
  `fk_id_customer` INT NOT NULL,
  `local` VARCHAR(60) NULL,
  `cep` VARCHAR(10) NULL,
  `rua` VARCHAR(255) NOT NULL,
  `numero_complemento` VARCHAR(60) NOT NULL,
  `bairro` VARCHAR(60) NOT NULL,
  `cidade` VARCHAR(60) NOT NULL,
  `estado` VARCHAR(2) NOT NULL,
  `referencia` VARCHAR(60) NULL,
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


-- -----------------------------------------------------
-- Table `u620166704_jazz_grill_100`.`Order`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u620166704_jazz_grill_100`.`Order` (
  `id_order` INT NOT NULL AUTO_INCREMENT,
  `fk_id_adm` INT NOT NULL,
  `fk_id_customer` INT NOT NULL,
  `fk_id_address` INT NOT NULL,
  `obs` VARCHAR(255) NULL,
  `active` TINYINT NOT NULL,
  `created_at` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id_order`),
  CONSTRAINT `fk_Order_Adm1`
    FOREIGN KEY (`fk_id_adm`)
    REFERENCES `u620166704_jazz_grill_100`.`Adm` (`id_adm`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Order_Customer1`
    FOREIGN KEY (`fk_id_customer`)
    REFERENCES `u620166704_jazz_grill_100`.`Customer` (`id_customer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Order_Address1`
    FOREIGN KEY (`fk_id_address`)
    REFERENCES `u620166704_jazz_grill_100`.`Address` (`id_address`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u620166704_jazz_grill_100`.`ProductOrder`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u620166704_jazz_grill_100`.`ProductOrder` (
  `id_product_order` INT NOT NULL AUTO_INCREMENT,
  `fk_id_order` INT NOT NULL,
  `fk_id_product` INT NOT NULL,
  `price` FLOAT NOT NULL,
  PRIMARY KEY (`id_product_order`),
  CONSTRAINT `fk_ItemOrder_Order1`
    FOREIGN KEY (`fk_id_order`)
    REFERENCES `u620166704_jazz_grill_100`.`Order` (`id_order`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ItemOrder_Product1`
    FOREIGN KEY (`fk_id_product`)
    REFERENCES `u620166704_jazz_grill_100`.`Product` (`id_product`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u620166704_jazz_grill_100`.`Item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u620166704_jazz_grill_100`.`Item` (
  `id_item` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(60) NOT NULL,
  `description` VARCHAR(45) NOT NULL,
  `cost` FLOAT NOT NULL,
  `un` VARCHAR(43) NOT NULL,
  `picture` MEDIUMTEXT NULL,
  `active` TINYINT NOT NULL,
  `created_at` TIMESTAMP NULL,
  PRIMARY KEY (`id_item`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u620166704_jazz_grill_100`.`ItemProduct`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u620166704_jazz_grill_100`.`ItemProduct` (
  `id_item_product` INT NOT NULL AUTO_INCREMENT,
  `fk_id_product` INT NOT NULL,
  `fk_id_item` INT NOT NULL,
  PRIMARY KEY (`id_item_product`),
  CONSTRAINT `fk_ProductComposition_Product1`
    FOREIGN KEY (`fk_id_product`)
    REFERENCES `u620166704_jazz_grill_100`.`Product` (`id_product`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ProductComposition_ItemProduct1`
    FOREIGN KEY (`fk_id_item`)
    REFERENCES `u620166704_jazz_grill_100`.`Item` (`id_item`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
