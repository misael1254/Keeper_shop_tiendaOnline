/*
 Navicat Premium Data Transfer

 Source Server         : Mariadb
 Source Server Type    : MariaDB
 Source Server Version : 100136
 Source Host           : localhost:3306
 Source Schema         : tienda

 Target Server Type    : MariaDB
 Target Server Version : 100136
 File Encoding         : 65001

 Date: 22/05/2019 21:54:17
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for adquirir_productos
-- ----------------------------
DROP TABLE IF EXISTS `adquirir_productos`;
CREATE TABLE `adquirir_productos`  (
  `modelo` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `folio_compra` varchar(9) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  INDEX `modelo`(`modelo`) USING BTREE,
  INDEX `folio_compra`(`folio_compra`) USING BTREE,
  CONSTRAINT `adquirir_productos_ibfk_1` FOREIGN KEY (`modelo`) REFERENCES `producto` (`modelo`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `adquirir_productos_ibfk_2` FOREIGN KEY (`folio_compra`) REFERENCES `compra` (`folio_compra`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of adquirir_productos
-- ----------------------------
INSERT INTO `adquirir_productos` VALUES ('NIKE GK VAPOR GRIP_9', '1', 5, 5000);
INSERT INTO `adquirir_productos` VALUES ('NIKE GK MERCURIAL TOUCH_9', '1', 5, 8000);
INSERT INTO `adquirir_productos` VALUES ('UNO PREMIER NG_9', '1', 12, 6000);
INSERT INTO `adquirir_productos` VALUES ('KRAKEN_9', '2', 10, 8140);
INSERT INTO `adquirir_productos` VALUES ('ASIMETRIK ETNIK_9_AM', '2', 10, 8000);
INSERT INTO `adquirir_productos` VALUES ('EGOTIKO QUANTUM_9_GL', '2', 10, 9400);
INSERT INTO `adquirir_productos` VALUES ('PREMIER NRG NEO_9_B-R', '2', 5, 2000);
INSERT INTO `adquirir_productos` VALUES ('EGOTIKO CUP COLOMBIA_9_B', '2', 10, 9000);
INSERT INTO `adquirir_productos` VALUES ('Elite Sport Black Real_9', '3', 13, 10400);
INSERT INTO `adquirir_productos` VALUES ('Elite Sport Aqua_9', '3', 10, 7990);
INSERT INTO `adquirir_productos` VALUES ('Elite Sport Camaleon_9', '3', 12, 9360);
INSERT INTO `adquirir_productos` VALUES ('Elite Sport Club_9', '3', 10, 6990);
INSERT INTO `adquirir_productos` VALUES ('Elite Sport Infinite_9', '4', 6, 6000);
INSERT INTO `adquirir_productos` VALUES ('Uhlsport Aerored Soft_9', '4', 3, 7200);
INSERT INTO `adquirir_productos` VALUES ('NIKE GK VAPOR GRIP_9', '5', 1, 755);
INSERT INTO `adquirir_productos` VALUES ('Rinat_Alpha_Uno_9', '7', 10, 6080);
INSERT INTO `adquirir_productos` VALUES ('Rinat_Fenix_Morado9', '7', 1, 919);
INSERT INTO `adquirir_productos` VALUES ('Rinat_Fenix_Morado9', '8', 6, 5514);
INSERT INTO `adquirir_productos` VALUES ('Adidas_Predator_Hy_9', '9', 3, 10350);
INSERT INTO `adquirir_productos` VALUES ('Adidas_Predator_Pro_10', '9', 3, 7500);

-- ----------------------------
-- Table structure for cliente
-- ----------------------------
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente`  (
  `id_cliente` varchar(4) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_cliente` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `ap_paterno` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `ap_materno` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `cp` varchar(5) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `calle` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `poblacion_colonia` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_usu` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `id_estado` varchar(2) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `id_municipio` varchar(5) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_cliente`) USING BTREE,
  INDEX `nombre_usu`(`nombre_usu`) USING BTREE,
  INDEX `id_estado`(`id_estado`) USING BTREE,
  INDEX `id_municipio`(`id_municipio`) USING BTREE,
  CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`nombre_usu`) REFERENCES `usuario` (`nombre_usu`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `cliente_ibfk_3` FOREIGN KEY (`id_municipio`) REFERENCES `municipio` (`id_municipio`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of cliente
-- ----------------------------
INSERT INTO `cliente` VALUES ('1', 'MISAEL', 'URZUA', 'RAMOS', '14407', 'AV INDEPENDENCIA', 'EJIDO VIEJO', 'misael', '1', '1');
INSERT INTO `cliente` VALUES ('2', 'LARRY', 'URZUA', 'RAMOS', '14406', 'AV INDEPENDENCIA', 'EJIDO VIEJO', 'larry', '1', '1');
INSERT INTO `cliente` VALUES ('3', 'XIMENA YAMILETH', 'GARCIA', 'GODINEZ', '14407', 'REFORMA', 'EJIDO VIEJO', 'XIMENA_97', '1', '1');

-- ----------------------------
-- Table structure for color
-- ----------------------------
DROP TABLE IF EXISTS `color`;
CREATE TABLE `color`  (
  `id_color` varchar(3) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `color` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_color`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of color
-- ----------------------------
INSERT INTO `color` VALUES ('1', 'AZUL');
INSERT INTO `color` VALUES ('10', 'NEGRO');
INSERT INTO `color` VALUES ('11', 'MULTICOLOR');
INSERT INTO `color` VALUES ('12', 'AMARILLO');
INSERT INTO `color` VALUES ('13', 'MORADO');
INSERT INTO `color` VALUES ('2', 'ROJO');
INSERT INTO `color` VALUES ('3', 'BLANCO/NARANJA');
INSERT INTO `color` VALUES ('4', 'GRIS');
INSERT INTO `color` VALUES ('5', 'AZUL/AMARILLO');
INSERT INTO `color` VALUES ('6', 'AMARILLO/MORADO');
INSERT INTO `color` VALUES ('7', 'DORADO');
INSERT INTO `color` VALUES ('8', 'BLANCO/ROJO');
INSERT INTO `color` VALUES ('9', 'BLANCO');

-- ----------------------------
-- Table structure for compra
-- ----------------------------
DROP TABLE IF EXISTS `compra`;
CREATE TABLE `compra`  (
  `folio_compra` varchar(9) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_compra` date NOT NULL,
  `tipo_pago` varchar(18) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`folio_compra`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of compra
-- ----------------------------
INSERT INTO `compra` VALUES ('1', '2019-04-20', 'TARGETA_CREDITO', 19000);
INSERT INTO `compra` VALUES ('2', '2019-04-21', 'TARGETA_CREDITO', 27540);
INSERT INTO `compra` VALUES ('3', '2019-05-07', 'TARGETA_CREDITO', 27750);
INSERT INTO `compra` VALUES ('4', '2019-05-07', 'TARGETA_CREDITO', 6000);
INSERT INTO `compra` VALUES ('5', '2019-05-10', 'TARGETA_CREDITO', 755);
INSERT INTO `compra` VALUES ('6', '2019-05-12', 'TARJETA_CREDITO', 3000);
INSERT INTO `compra` VALUES ('7', '2019-05-15', 'TARJETA_CREDITO', 6999);
INSERT INTO `compra` VALUES ('8', '2019-05-15', 'TARJETA_CREDITO', 5514);
INSERT INTO `compra` VALUES ('9', '2019-05-15', 'TARJETA_CREDITO', 17850);

-- ----------------------------
-- Table structure for email
-- ----------------------------
DROP TABLE IF EXISTS `email`;
CREATE TABLE `email`  (
  `correo` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `id_cliente` varchar(4) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  INDEX `id_cliente`(`id_cliente`) USING BTREE,
  CONSTRAINT `email_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of email
-- ----------------------------
INSERT INTO `email` VALUES ('ximena@hotmail.com', '3');
INSERT INTO `email` VALUES ('ximena1@hotmail.com', '3');
INSERT INTO `email` VALUES ('escom_97@hotmail.com', '1');
INSERT INTO `email` VALUES ('escom_96@hotmail.com', '1');
INSERT INTO `email` VALUES ('Larryedsel@hotmail.com', '2');
INSERT INTO `email` VALUES ('@', '2');

-- ----------------------------
-- Table structure for email_proveedor
-- ----------------------------
DROP TABLE IF EXISTS `email_proveedor`;
CREATE TABLE `email_proveedor`  (
  `correo` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `rfc` varchar(13) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  INDEX `rfc`(`rfc`) USING BTREE,
  CONSTRAINT `email_proveedor_ibfk_1` FOREIGN KEY (`rfc`) REFERENCES `proveedor` (`rfc`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of email_proveedor
-- ----------------------------
INSERT INTO `email_proveedor` VALUES ('larry@prueba.com', 'HGRRMS970314U');

-- ----------------------------
-- Table structure for es_color
-- ----------------------------
DROP TABLE IF EXISTS `es_color`;
CREATE TABLE `es_color`  (
  `id_color` varchar(3) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `modelo` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `existencia` int(11) NOT NULL,
  `src` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  INDEX `id_color`(`id_color`) USING BTREE,
  INDEX `modelo`(`modelo`) USING BTREE,
  CONSTRAINT `es_color_ibfk_1` FOREIGN KEY (`id_color`) REFERENCES `color` (`id_color`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `es_color_ibfk_2` FOREIGN KEY (`modelo`) REFERENCES `producto` (`modelo`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of es_color
-- ----------------------------
INSERT INTO `es_color` VALUES ('3', 'NIKE GK VAPOR GRIP_9', 6, 'modulos/source/NIKE/NIKE GK VAPOR GRIP 3434.png');
INSERT INTO `es_color` VALUES ('4', 'NIKE GK MERCURIAL TOUCH_9', 8, 'modulos/source/NIKE/NIKE GK MERCURIAL TOUCH ELITE GREY754.png');
INSERT INTO `es_color` VALUES ('3', 'UNO PREMIER NG_9', 11, 'modulos/source/RINAT/UNO PREMIER NG B NAR494.png');
INSERT INTO `es_color` VALUES ('5', 'KRAKEN_9', 13, 'modulos/source/RINAT/KRAKEN NRG NEO AZUL-AMARILLO NEON365.png');
INSERT INTO `es_color` VALUES ('6', 'ASIMETRIK ETNIK_9_AM', 10, 'modulos/source/RINAT/ASIMETRIK ETNIK AMARILLO NEON-MORADO123.png');
INSERT INTO `es_color` VALUES ('7', 'EGOTIKO QUANTUM_9_GL', 10, 'modulos/source/RINAT/GOTIKO QUANTUM GOLD172.png');
INSERT INTO `es_color` VALUES ('8', 'PREMIER NRG NEO_9_B-R', 5, 'modulos/source/RINAT/PREMIER NRG NEO BLANCO-ROJO689.png');
INSERT INTO `es_color` VALUES ('9', 'EGOTIKO CUP COLOMBIA_9_B', 10, 'modulos/source/RINAT/EGOTIKO CUP COLOMBIA BLANCO111.png');
INSERT INTO `es_color` VALUES ('10', 'Elite Sport Black Real_9', 12, 'modulos/source/ELITE/Elite Sport Black Real P-NEGRA401.png');
INSERT INTO `es_color` VALUES ('9', 'Elite Sport Aqua_9', 9, 'modulos/source/ELITE/Elite Sport Aqua H-BLANCO485.png');
INSERT INTO `es_color` VALUES ('11', 'Elite Sport Camaleon_9', 9, 'modulos/source/ELITE/Elite Sport Camaleon98.png');
INSERT INTO `es_color` VALUES ('11', 'Elite Sport Club_9', 7, 'modulos/source/ELITE/Elite Sport Club 201776.png');
INSERT INTO `es_color` VALUES ('12', 'Elite Sport Infinite_9', 5, 'modulos/source/ELITE/Elite Sport Infinite171.png');
INSERT INTO `es_color` VALUES ('1', 'Uhlsport Aerored Soft_9', 2, 'modulos/source/UHLSPORT/Uhlsport Aerored Soft HN Grey-Fluo Red726.png');
INSERT INTO `es_color` VALUES ('9', 'Rinat_Alpha_Uno_9', 10, 'modulos/source/RINAT/Uno Alpha White33.png');
INSERT INTO `es_color` VALUES ('13', 'Rinat_Fenix_Morado9', 7, 'modulos/source/RINAT/Fenix Quantum Pro197.png');
INSERT INTO `es_color` VALUES ('11', 'Adidas_Predator_Hy_9', 3, 'modulos/source/ADIDAS/ADIDAS PREDATOR PRO HYBRID487.png');
INSERT INTO `es_color` VALUES ('2', 'Adidas_Predator_Pro_10', 3, 'modulos/source/ADIDAS/Adidas Predator Pro791.png');

-- ----------------------------
-- Table structure for estado
-- ----------------------------
DROP TABLE IF EXISTS `estado`;
CREATE TABLE `estado`  (
  `id_estado` varchar(2) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_estado` varchar(16) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_estado`) USING BTREE,
  INDEX `id_estado`(`id_estado`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of estado
-- ----------------------------
INSERT INTO `estado` VALUES ('1', 'GUERRERO');
INSERT INTO `estado` VALUES ('2', 'VERACRUZ');

-- ----------------------------
-- Table structure for gama
-- ----------------------------
DROP TABLE IF EXISTS `gama`;
CREATE TABLE `gama`  (
  `id_gama` varchar(1) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `gama` varchar(11) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_gama`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of gama
-- ----------------------------
INSERT INTO `gama` VALUES ('1', 'PROFESIONAL');
INSERT INTO `gama` VALUES ('2', 'SEMIPROFECI');
INSERT INTO `gama` VALUES ('3', 'ALPHA');

-- ----------------------------
-- Table structure for latex
-- ----------------------------
DROP TABLE IF EXISTS `latex`;
CREATE TABLE `latex`  (
  `id_latex` varchar(2) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `latex` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_latex`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of latex
-- ----------------------------
INSERT INTO `latex` VALUES ('1', 'OMEGA GRIP');
INSERT INTO `latex` VALUES ('2', 'OMEGA XTREAM');
INSERT INTO `latex` VALUES ('3', 'DUOGRIP');
INSERT INTO `latex` VALUES ('4', 'ELITE CONTACT');
INSERT INTO `latex` VALUES ('5', 'CONTACT EXTREME GRIP');
INSERT INTO `latex` VALUES ('6', 'CONTACT G');
INSERT INTO `latex` VALUES ('7', 'SOFT');

-- ----------------------------
-- Table structure for marca
-- ----------------------------
DROP TABLE IF EXISTS `marca`;
CREATE TABLE `marca`  (
  `id_marca` varchar(2) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `marca` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_marca`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of marca
-- ----------------------------
INSERT INTO `marca` VALUES ('1', 'NIKE');
INSERT INTO `marca` VALUES ('2', 'RINAT');
INSERT INTO `marca` VALUES ('3', 'ADIDAS');
INSERT INTO `marca` VALUES ('4', 'ELITE');
INSERT INTO `marca` VALUES ('5', 'UHLSPORT');

-- ----------------------------
-- Table structure for municipio
-- ----------------------------
DROP TABLE IF EXISTS `municipio`;
CREATE TABLE `municipio`  (
  `id_municipio` varchar(5) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `municipio_delegacion` varchar(38) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `id_estado` varchar(2) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_municipio`) USING BTREE,
  INDEX `id_estado`(`id_estado`) USING BTREE,
  CONSTRAINT `municipio_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of municipio
-- ----------------------------
INSERT INTO `municipio` VALUES ('1', 'Acapulco de Juarez', '1');
INSERT INTO `municipio` VALUES ('10', 'Atlixtac', '1');
INSERT INTO `municipio` VALUES ('11', 'Atoyac de Alvarez', '1');
INSERT INTO `municipio` VALUES ('12', 'Ayutla de los Libres', '1');
INSERT INTO `municipio` VALUES ('13', 'Azoyu', '1');
INSERT INTO `municipio` VALUES ('14', 'Benito Juarez', '1');
INSERT INTO `municipio` VALUES ('15', 'Buenavista de Cuellar', '1');
INSERT INTO `municipio` VALUES ('16', 'Coahuayutla de Jose Maria Izazaga', '1');
INSERT INTO `municipio` VALUES ('17', 'Cocula', '1');
INSERT INTO `municipio` VALUES ('18', 'Copala', '1');
INSERT INTO `municipio` VALUES ('19', 'Copalillo', '1');
INSERT INTO `municipio` VALUES ('2', 'Ahuacuotzingo', '1');
INSERT INTO `municipio` VALUES ('20', 'Copanatoyac', '1');
INSERT INTO `municipio` VALUES ('21', 'Coyuca de Benitez', '1');
INSERT INTO `municipio` VALUES ('22', 'Coyuca de Catalan', '1');
INSERT INTO `municipio` VALUES ('23', 'Cuajinicuilapa', '1');
INSERT INTO `municipio` VALUES ('24', 'Cualac', '1');
INSERT INTO `municipio` VALUES ('25', 'Cuautepec', '1');
INSERT INTO `municipio` VALUES ('26', 'Cuetzala del Progreso', '1');
INSERT INTO `municipio` VALUES ('27', 'Cutzamala de Pinzon', '1');
INSERT INTO `municipio` VALUES ('28', 'Chilapa de Alvarez', '1');
INSERT INTO `municipio` VALUES ('29', 'Chilpancingo de los Bravo', '1');
INSERT INTO `municipio` VALUES ('3', 'Ajuchitlan del Progreso', '1');
INSERT INTO `municipio` VALUES ('30', 'Florencio Villarreal', '1');
INSERT INTO `municipio` VALUES ('31', 'General Canuto A. Neri', '1');
INSERT INTO `municipio` VALUES ('32', 'General Heliodoro Castillo', '1');
INSERT INTO `municipio` VALUES ('33', 'Huamuxtitlan', '1');
INSERT INTO `municipio` VALUES ('34', 'Huitzuco de los Figueroa', '1');
INSERT INTO `municipio` VALUES ('35', 'Iguala de la Independencia', '1');
INSERT INTO `municipio` VALUES ('36', 'Igualapa', '1');
INSERT INTO `municipio` VALUES ('37', 'Ixcateopan de Cuauhtemoc', '1');
INSERT INTO `municipio` VALUES ('38', 'Zihuatanejo de Azueta', '1');
INSERT INTO `municipio` VALUES ('39', 'Juan R. Escudero', '1');
INSERT INTO `municipio` VALUES ('4', 'Alcozauca de Guerrero', '1');
INSERT INTO `municipio` VALUES ('40', 'Leonardo Bravo', '1');
INSERT INTO `municipio` VALUES ('41', 'Malinaltepec', '1');
INSERT INTO `municipio` VALUES ('42', 'Martir de Cuilapan', '1');
INSERT INTO `municipio` VALUES ('43', 'Metlatonoc', '1');
INSERT INTO `municipio` VALUES ('44', 'Mochitlan', '1');
INSERT INTO `municipio` VALUES ('45', 'Olinala', '1');
INSERT INTO `municipio` VALUES ('46', 'Ometepec', '1');
INSERT INTO `municipio` VALUES ('47', 'Pedro Ascencio Alquisiras', '1');
INSERT INTO `municipio` VALUES ('48', 'Petatlan', '1');
INSERT INTO `municipio` VALUES ('49', 'Pilcaya', '1');
INSERT INTO `municipio` VALUES ('5', 'Alpoyeca', '1');
INSERT INTO `municipio` VALUES ('50', 'Pungarabato', '1');
INSERT INTO `municipio` VALUES ('51', 'Quechultenango', '1');
INSERT INTO `municipio` VALUES ('52', 'San Luis Acatlan', '1');
INSERT INTO `municipio` VALUES ('53', 'San Marcos', '1');
INSERT INTO `municipio` VALUES ('54', 'San Miguel Totolapan', '1');
INSERT INTO `municipio` VALUES ('55', 'Taxco de Alarcon', '1');
INSERT INTO `municipio` VALUES ('56', 'Tecoanapa', '1');
INSERT INTO `municipio` VALUES ('57', 'Tecpan de Galeana', '1');
INSERT INTO `municipio` VALUES ('58', 'Teloloapan', '1');
INSERT INTO `municipio` VALUES ('59', 'Tepecoacuilco de Trujano', '1');
INSERT INTO `municipio` VALUES ('6', 'Apaxtla', '1');
INSERT INTO `municipio` VALUES ('60', 'Tetipac', '1');
INSERT INTO `municipio` VALUES ('61', 'Tixtla de Guerrero', '1');
INSERT INTO `municipio` VALUES ('62', 'Tlacoachistlahuaca', '1');
INSERT INTO `municipio` VALUES ('63', 'Tlacoapa', '1');
INSERT INTO `municipio` VALUES ('64', 'Tlalchapa', '1');
INSERT INTO `municipio` VALUES ('65', 'Tlalixtaquilla de Maldonado', '1');
INSERT INTO `municipio` VALUES ('66', 'Tlapa de Comonfort', '1');
INSERT INTO `municipio` VALUES ('67', 'Tlapehuala', '1');
INSERT INTO `municipio` VALUES ('68', 'La Union de Isidoro Montes de Oca', '1');
INSERT INTO `municipio` VALUES ('69', 'Xalpatlahuac', '1');
INSERT INTO `municipio` VALUES ('7', 'Arcelia', '1');
INSERT INTO `municipio` VALUES ('70', 'Xochihuehuetlan', '1');
INSERT INTO `municipio` VALUES ('71', 'Xochistlahuaca', '1');
INSERT INTO `municipio` VALUES ('72', 'Zapotitlan Tablas', '1');
INSERT INTO `municipio` VALUES ('73', 'Zirandaro', '1');
INSERT INTO `municipio` VALUES ('74', 'Zitlala', '1');
INSERT INTO `municipio` VALUES ('75', 'Eduardo Neri', '1');
INSERT INTO `municipio` VALUES ('76', 'Acatepec', '1');
INSERT INTO `municipio` VALUES ('77', 'Marquelia', '1');
INSERT INTO `municipio` VALUES ('78', 'Cochoapa el Grande', '1');
INSERT INTO `municipio` VALUES ('79', 'Jose Joaquin de Herrera', '1');
INSERT INTO `municipio` VALUES ('8', 'Atenango del Rio', '1');
INSERT INTO `municipio` VALUES ('80', 'Juchitan', '1');
INSERT INTO `municipio` VALUES ('81', 'Iliatenco', '1');
INSERT INTO `municipio` VALUES ('9', 'Atlamajalcingo del Monte', '1');

-- ----------------------------
-- Table structure for producto
-- ----------------------------
DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto`  (
  `modelo` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `existencia` int(11) NOT NULL,
  `nombre_producto` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `precio` int(11) NOT NULL,
  `id_marca` varchar(2) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `id_talla` varchar(2) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `id_gama` varchar(1) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `id_latex` varchar(2) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`modelo`) USING BTREE,
  INDEX `id_marca`(`id_marca`) USING BTREE,
  INDEX `id_talla`(`id_talla`) USING BTREE,
  INDEX `id_gama`(`id_gama`) USING BTREE,
  INDEX `id_latex`(`id_latex`) USING BTREE,
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`id_talla`) REFERENCES `talla` (`id_talla`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`id_latex`) REFERENCES `latex` (`id_latex`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `producto_ibfk_4` FOREIGN KEY (`id_gama`) REFERENCES `gama` (`id_gama`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of producto
-- ----------------------------
INSERT INTO `producto` VALUES ('Adidas_Predator_Hy_9', 3, 'ADIDAS PREDATOR PRO HYBRID', 3450, '3', '1', '1', '1');
INSERT INTO `producto` VALUES ('Adidas_Predator_Pro_10', 3, 'Adidas Predator Pro', 2500, '3', '2', '1', '1');
INSERT INTO `producto` VALUES ('ASIMETRIK ETNIK_9_AM', 10, 'ASIMETRIK ETNIK AMARILLO NEON-MORADO', 801, '2', '1', '3', '3');
INSERT INTO `producto` VALUES ('EGOTIKO CUP COLOMBIA_9_B', 10, 'EGOTIKO CUP COLOMBIA BLANCO', 901, '2', '1', '3', '3');
INSERT INTO `producto` VALUES ('EGOTIKO QUANTUM_9_GL', 10, 'GOTIKO QUANTUM GOLD', 940, '2', '1', '3', '3');
INSERT INTO `producto` VALUES ('Elite Sport Aqua_9', 9, 'Elite Sport Aqua H-BLANCO', 799, '4', '1', '1', '4');
INSERT INTO `producto` VALUES ('Elite Sport Black Real_9', 12, 'Elite Sport Black Real P-NEGRA', 800, '4', '1', '1', '5');
INSERT INTO `producto` VALUES ('Elite Sport Camaleon_9', 9, 'Elite Sport Camaleon', 780, '4', '1', '1', '5');
INSERT INTO `producto` VALUES ('Elite Sport Club_9', 7, 'Elite Sport Club 2017', 699, '4', '1', '1', '5');
INSERT INTO `producto` VALUES ('Elite Sport Infinite_9', 5, 'Elite Sport Infinite', 1000, '4', '1', '1', '6');
INSERT INTO `producto` VALUES ('KRAKEN_9', 13, 'KRAKEN NRG NEO AZUL-AMARILLO NEON', 800, '2', '1', '3', '3');
INSERT INTO `producto` VALUES ('NIKE GK MERCURIAL TOUCH_9', 8, 'NIKE GK MERCURIAL TOUCH ELITE GREY', 1600, '1', '3', '1', '3');
INSERT INTO `producto` VALUES ('NIKE GK VAPOR GRIP_9', 6, 'NIKE GK VAPOR GRIP 3', 1000, '1', '1', '3', '1');
INSERT INTO `producto` VALUES ('PREMIER NRG NEO_9_B-R', 5, 'PREMIER NRG NEO BLANCO-ROJO', 400, '2', '1', '1', '1');
INSERT INTO `producto` VALUES ('Rinat_Alpha_Uno_9', 10, 'Uno Alpha White', 608, '2', '1', '3', '1');
INSERT INTO `producto` VALUES ('Rinat_Fenix_Morado9', 7, 'Fenix Quantum Pro', 919, '2', '1', '1', '1');
INSERT INTO `producto` VALUES ('Uhlsport Aerored Soft_9', 2, 'Uhlsport Aerored Soft HN Grey-Fluo Red', 2400, '5', '1', '1', '1');
INSERT INTO `producto` VALUES ('UNO PREMIER NG_9', 11, 'UNO PREMIER NG B NAR', 500, '2', '1', '3', '3');

-- ----------------------------
-- Table structure for producto_vendido
-- ----------------------------
DROP TABLE IF EXISTS `producto_vendido`;
CREATE TABLE `producto_vendido`  (
  `folio_venta` varchar(9) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `modelo` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  INDEX `modelo`(`modelo`) USING BTREE,
  INDEX `folio_venta`(`folio_venta`) USING BTREE,
  CONSTRAINT `producto_vendido_ibfk_1` FOREIGN KEY (`modelo`) REFERENCES `producto` (`modelo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `producto_vendido_ibfk_2` FOREIGN KEY (`folio_venta`) REFERENCES `venta` (`folio_venta`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of producto_vendido
-- ----------------------------
INSERT INTO `producto_vendido` VALUES ('1', 'Elite Sport Infinite_9', 6, 6000);
INSERT INTO `producto_vendido` VALUES ('2', 'Elite Sport Infinite_9', 1, 1000);
INSERT INTO `producto_vendido` VALUES ('2', 'Elite Sport Camaleon_9', 1, 780);
INSERT INTO `producto_vendido` VALUES ('2', 'Elite Sport Black Real_9', 1, 800);
INSERT INTO `producto_vendido` VALUES ('3', 'Uhlsport Aerored Soft_9', 1, 2400);
INSERT INTO `producto_vendido` VALUES ('4', 'Elite Sport Camaleon_9', 2, 1560);
INSERT INTO `producto_vendido` VALUES ('4', 'Elite Sport Aqua_9', 1, 799);
INSERT INTO `producto_vendido` VALUES ('4', 'Elite Sport Club_9', 3, 2097);

-- ----------------------------
-- Table structure for provee
-- ----------------------------
DROP TABLE IF EXISTS `provee`;
CREATE TABLE `provee`  (
  `rfc` varchar(13) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `folio_compra` varchar(9) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  INDEX `rfc`(`rfc`) USING BTREE,
  INDEX `folio_compra`(`folio_compra`) USING BTREE,
  CONSTRAINT `provee_ibfk_1` FOREIGN KEY (`rfc`) REFERENCES `proveedor` (`rfc`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `provee_ibfk_2` FOREIGN KEY (`folio_compra`) REFERENCES `compra` (`folio_compra`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of provee
-- ----------------------------
INSERT INTO `provee` VALUES ('UURM970314HGR', '1');
INSERT INTO `provee` VALUES ('UURM970314HGR', '2');
INSERT INTO `provee` VALUES ('UURM970314HGR', '3');
INSERT INTO `provee` VALUES ('UURM970314HGR', '4');
INSERT INTO `provee` VALUES ('HGRRMS970314U', '5');
INSERT INTO `provee` VALUES ('HGRRMS970314U', '6');
INSERT INTO `provee` VALUES ('HGRRMS970314U', '7');
INSERT INTO `provee` VALUES ('UURM970314HGR', '8');
INSERT INTO `provee` VALUES ('HGRRMS970314U', '9');

-- ----------------------------
-- Table structure for proveedor
-- ----------------------------
DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE `proveedor`  (
  `rfc` varchar(13) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_proveedor` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `cp` varchar(5) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `calle` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `poblacion_colonia` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `id_estado` varchar(2) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `id_municipio` varchar(5) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`rfc`) USING BTREE,
  INDEX `rfc`(`rfc`) USING BTREE,
  INDEX `proveedor_ibfk_1`(`id_estado`) USING BTREE,
  INDEX `id_municipio`(`id_municipio`) USING BTREE,
  CONSTRAINT `proveedor_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `proveedor_ibfk_2` FOREIGN KEY (`id_municipio`) REFERENCES `municipio` (`id_municipio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of proveedor
-- ----------------------------
INSERT INTO `proveedor` VALUES ('HGRRMS970314U', 'LARRYEDSEL S.A. DE C.V', '14407', 'AV INDEPENDENCIA', 'EJIDO VIEJO', '1', '1');
INSERT INTO `proveedor` VALUES ('UURM970314HGR', 'MISAEL S.A. DE C.V', '14407', 'AV INDEPENDENCIA ', 'EJIDO VIEJO', '1', '1');

-- ----------------------------
-- Table structure for talla
-- ----------------------------
DROP TABLE IF EXISTS `talla`;
CREATE TABLE `talla`  (
  `id_talla` varchar(1) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `talla` varchar(2) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_talla`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of talla
-- ----------------------------
INSERT INTO `talla` VALUES ('1', '9');
INSERT INTO `talla` VALUES ('2', '10');
INSERT INTO `talla` VALUES ('3', '11');

-- ----------------------------
-- Table structure for telefono
-- ----------------------------
DROP TABLE IF EXISTS `telefono`;
CREATE TABLE `telefono`  (
  `num_telefono` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `id_cliente` varchar(4) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  INDEX `id_cliente`(`id_cliente`) USING BTREE,
  CONSTRAINT `telefono_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of telefono
-- ----------------------------
INSERT INTO `telefono` VALUES ('7446881067', '3');
INSERT INTO `telefono` VALUES ('7446881067', '1');
INSERT INTO `telefono` VALUES ('7445872793', '1');

-- ----------------------------
-- Table structure for telefono_proveedor
-- ----------------------------
DROP TABLE IF EXISTS `telefono_proveedor`;
CREATE TABLE `telefono_proveedor`  (
  `num_telefono` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `rfc` varchar(13) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`num_telefono`) USING BTREE,
  INDEX `rfc`(`rfc`) USING BTREE,
  CONSTRAINT `telefono_proveedor_ibfk_1` FOREIGN KEY (`rfc`) REFERENCES `proveedor` (`rfc`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of telefono_proveedor
-- ----------------------------
INSERT INTO `telefono_proveedor` VALUES ('7446881067', 'HGRRMS970314U');

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario`  (
  `nombre_usu` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `tipo_usu` int(1) NOT NULL,
  PRIMARY KEY (`nombre_usu`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES ('larry', '1111', 2);
INSERT INTO `usuario` VALUES ('misael', '1111', 1);
INSERT INTO `usuario` VALUES ('XIMENA_97', '1111', 2);

-- ----------------------------
-- Table structure for venta
-- ----------------------------
DROP TABLE IF EXISTS `venta`;
CREATE TABLE `venta`  (
  `folio_venta` varchar(9) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_venta` date NOT NULL,
  `total` int(11) NOT NULL,
  `id_cliente` varchar(4) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`folio_venta`) USING BTREE,
  INDEX `id_cliente`(`id_cliente`) USING BTREE,
  CONSTRAINT `id_cliente_fk` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish2_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of venta
-- ----------------------------
INSERT INTO `venta` VALUES ('1', '2019-05-08', 6000, '1');
INSERT INTO `venta` VALUES ('2', '2019-05-15', 2580, '1');
INSERT INTO `venta` VALUES ('3', '2019-05-16', 2400, '1');
INSERT INTO `venta` VALUES ('4', '2019-05-16', 4456, '2');

SET FOREIGN_KEY_CHECKS = 1;
