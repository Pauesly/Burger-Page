----------------------------------------
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
  `picture_thumb` MEDIUMTEXT NOT NULL,
  `picture_large` MEDIUMTEXT NOT NULL,
  `star` INT NOT NULL,
  `price_new` DECIMAL(10,2) NOT NULL,
  `price_old` DECIMAL(10,2) NULL,
  `active` TINYINT NOT NULL COMMENT 'Lanche ativo no cardapio',
  `created_at` TIMESTAMP NOT NULL,
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
  `email` VARCHAR(60) NULL,
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
  `rua` VARCHAR(255) NULL,
  `numero_complemento` VARCHAR(60) NULL,
  `bairro` VARCHAR(60) NULL,
  `cidade` VARCHAR(60) NULL,
  `estado` VARCHAR(2) NULL,
  `referencia` VARCHAR(60) NULL,
  `latitude` VARCHAR(13) NULL,
  `longitude` VARCHAR(13) NULL,
  `obs` VARCHAR(60) NULL,
  `active` TINYINT NULL,
  PRIMARY KEY (`id_address`),
  CONSTRAINT `fk_Address_Customer`
    FOREIGN KEY (`fk_id_customer`)
    REFERENCES `u620166704_jazz_grill_100`.`Customer` (`id_customer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u620166704_jazz_grill_100`.`PaymentTerm`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u620166704_jazz_grill_100`.`PaymentTerm` (
  `id_payment_term` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(60) NOT NULL,
  `active` TINYINT NOT NULL,
  PRIMARY KEY (`id_payment_term`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u620166704_jazz_grill_100`.`Status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u620166704_jazz_grill_100`.`Status` (
  `id_status` INT NOT NULL AUTO_INCREMENT,
  `status` VARCHAR(60) NOT NULL,
  `sequence` INT NOT NULL,
  `active` TINYINT NOT NULL,
  PRIMARY KEY (`id_status`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u620166704_jazz_grill_100`.`Orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u620166704_jazz_grill_100`.`Orders` (
  `id_order` INT NOT NULL AUTO_INCREMENT,
  `fk_id_adm` INT NOT NULL,
  `fk_id_customer` INT NOT NULL,
  `fk_id_address` INT NOT NULL,
  `fk_id_payment_term` INT NULL,
  `fk_id_status` INT NOT NULL,
  `obs` VARCHAR(255) NULL,
  `payment_status` TINYINT NOT NULL,
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
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Order_PaymentTerm1`
    FOREIGN KEY (`fk_id_payment_term`)
    REFERENCES `u620166704_jazz_grill_100`.`PaymentTerm` (`id_payment_term`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Orders_Status1`
    FOREIGN KEY (`fk_id_status`)
    REFERENCES `u620166704_jazz_grill_100`.`Status` (`id_status`)
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
  `qtd` INT NOT NULL,
  `price_unit` DECIMAL(10,2) NOT NULL,
  `price_total` DECIMAL(10,2) NOT NULL,
  `obs` VARCHAR(256) NOT NULL,
  PRIMARY KEY (`id_product_order`),
  CONSTRAINT `fk_ItemOrder_Order1`
    FOREIGN KEY (`fk_id_order`)
    REFERENCES `u620166704_jazz_grill_100`.`Orders` (`id_order`)
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
  `description` VARCHAR(255) NOT NULL,
  `un` VARCHAR(43) NOT NULL,
  `cost` DECIMAL(10,2) NOT NULL,
  `picture` MEDIUMTEXT NULL,
  `active` TINYINT NOT NULL,
  `created_at` TIMESTAMP NOT NULL,
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


-- -----------------------------------------------------
-- Table `u620166704_jazz_grill_100`.`OrderStatus`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u620166704_jazz_grill_100`.`OrderStatus` (
  `id_order_status` INT NOT NULL AUTO_INCREMENT,
  `fk_id_adm` INT NOT NULL,
  `fk_id_order` INT NOT NULL,
  `fk_id_status` INT NOT NULL,
  `created_at` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id_order_status`),
  CONSTRAINT `fk_OrderStatus_Order1`
    FOREIGN KEY (`fk_id_order`)
    REFERENCES `u620166704_jazz_grill_100`.`Orders` (`id_order`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_OrderStatus_Status1`
    FOREIGN KEY (`fk_id_status`)
    REFERENCES `u620166704_jazz_grill_100`.`Status` (`id_status`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_OrderStatus_Adm1`
    FOREIGN KEY (`fk_id_adm`)
    REFERENCES `u620166704_jazz_grill_100`.`Adm` (`id_adm`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `u620166704_jazz_grill_100`.`Testimony`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u620166704_jazz_grill_100`.`Testimony` (
  `id_testimony` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) NOT NULL,
  `testimony` VARCHAR(160) NOT NULL,
  `status` VARCHAR(20) NOT NULL,
  `thumb` MEDIUMTEXT NULL,
  `active` TINYINT NOT NULL,
  `created_at` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id_testimony`))
ENGINE = InnoDB;

