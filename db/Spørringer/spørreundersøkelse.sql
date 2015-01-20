SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP TABLE IF EXISTS PreSporreundersokelse;
DROP TABLE IF EXISTS Personas;

-- -----------------------------------------------------
-- Table personas
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS Personas (
  id INT(5) NULL DEFAULT NULL AUTO_INCREMENT ,
  fornavn VARCHAR(45) NOT NULL ,
  etternavn VARCHAR(45) NOT NULL ,
  alder INT(3) NOT NULL ,
  epost VARCHAR(65) NOT NULL ,
  kjonn CHAR(1) NOT NULL COMMENT 'Kjonnsbestemelse M/K.' ,
  UNIQUE INDEX (id ASC) ,
  PRIMARY KEY (id) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table PreSporreundersokelse
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS PreSporreundersokelse (
  id INT(5) NOT NULL AUTO_INCREMENT ,
  SP01 CHAR(8) NOT NULL COMMENT 'Hva onsker du å selge/selger du mest av på nettet?' ,
  SP02 CHAR(8) NOT NULL COMMENT 'Hva onsker du å kjope på nett?' ,
  SP03 CHAR(1) NOT NULL COMMENT 'Hvor ofte bruker du finn.no?' ,
  SP04 CHAR(1) NOT NULL COMMENT 'Hvor ofte er du på bytte/kjope/salgs-grupper på facebook?' ,
  SP05 VARCHAR(200) NOT NULL COMMENT 'Hvilken nettbutikk bruker du mest?' ,
  SP06 CHAR(1) NOT NULL COMMENT 'Hvor viktig er det for deg å kunne gi bort ting på finn.no?' ,
  SP07 CHAR(1) NOT NULL COMMENT 'Hvor viktig er deg ville det vært å bytte ting for deg på finn.no?' ,
  SP08 CHAR(1) NOT NULL COMMENT 'Hvor viktig er det for deg å kunne auksjonere bort ting på finn.no?' ,
  SP09 CHAR(1) NOT NULL COMMENT 'Hvor viktig er det for deg hvis annonsen din ble postet på FB?' ,
  SP10 CHAR(1) NOT NULL COMMENT 'Hvor mye ville du stolt på en privatperson med opptil flere positive tilbakemeldinger?' ,
  SP11 VARCHAR(200) NOT NULL COMMENT 'Hva irriterer deg ved finn.no?' ,
  SP12 VARCHAR(200) NOT NULL COMMENT 'Hva liker du ved finn.no?' ,
  UNIQUE INDEX (id ASC) ,
  PRIMARY KEY (id) 
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
