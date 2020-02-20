-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.8-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para warehouse_new
CREATE DATABASE IF NOT EXISTS `warehouse_new` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `warehouse_new`;

-- Volcando estructura para tabla warehouse_new.association
CREATE TABLE IF NOT EXISTS `association` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shelf_id` int(11) DEFAULT NULL,
  `box_id` int(11) DEFAULT NULL,
  `rack_pos` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shelf_id_rack_pos` (`shelf_id`,`rack_pos`),
  UNIQUE KEY `box_id` (`box_id`),
  CONSTRAINT `FK_association_box` FOREIGN KEY (`box_id`) REFERENCES `box` (`id`),
  CONSTRAINT `FK_association_shelf` FOREIGN KEY (`shelf_id`) REFERENCES `shelf` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla warehouse_new.association: ~13 rows (aproximadamente)
DELETE FROM `association`;
/*!40000 ALTER TABLE `association` DISABLE KEYS */;
INSERT INTO `association` (`id`, `shelf_id`, `box_id`, `rack_pos`) VALUES
	(12, 3, 14, 12),
	(13, 4, 15, 1),
	(15, 5, 17, 1),
	(16, 3, 18, 2),
	(17, 3, 19, 3),
	(18, 5, 20, 2),
	(19, 3, 21, 4),
	(20, 4, 22, 2),
	(21, 3, 23, 5),
	(22, 3, 24, 6),
	(23, 3, 25, 7),
	(24, 3, 26, 8),
	(25, 5, 27, 3);
/*!40000 ALTER TABLE `association` ENABLE KEYS */;

-- Volcando estructura para tabla warehouse_new.box
CREATE TABLE IF NOT EXISTS `box` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `material` varchar(50) DEFAULT NULL,
  `content` varchar(50) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `height` float DEFAULT NULL,
  `width` float DEFAULT NULL,
  `depth` float DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla warehouse_new.box: ~13 rows (aproximadamente)
DELETE FROM `box`;
/*!40000 ALTER TABLE `box` DISABLE KEYS */;
INSERT INTO `box` (`id`, `code`, `material`, `content`, `color`, `height`, `width`, `depth`, `date`) VALUES
	(14, 'CA013', 'Plástico', 'Ropa', '#9f9f00', 32, 10, 32, '2019-11-11 19:16:14'),
	(15, 'CA014', 'Madera', 'Kriptonita', '#80ff00', 90, 80, 100, '2019-11-11 22:24:41'),
	(17, 'CA004', 'Cartón', 'Vacía', '#808000', 15, 21, 12, '2019-11-12 11:11:00'),
	(18, 'CA006', 'Cuarzo', 'Azulejos', '#efefef', 34, 12, 32, '2019-11-12 11:13:17'),
	(19, 'CA003', 'Obsidiana', 'Dinamita', '#804040', 100, 150, 100, '2019-11-12 11:57:00'),
	(20, 'CA008', 'Acero', 'Herramientas', '#38381d', 21, 12, 34, '2019-11-12 12:02:00'),
	(21, 'CA005', 'Titanio', 'Diamantes', '#c0c0c0', 32, 32, 23, '2019-11-12 12:21:51'),
	(22, 'CA012', 'Cartón', 'Zapatos', '#420021', 12, 32, 12, '2019-11-15 10:01:00'),
	(23, 'CA020', 'Hierro', 'Espadas', '#808080', 100, 200, 100, '2019-11-15 12:16:04'),
	(24, 'CA021', 'Madera', 'Metralletas', '#008040', 50, 45, 50, '2019-11-15 12:19:03'),
	(25, 'CA007', 'Granito', 'Piedras', '#cfc8af', 32, 23, 12, '2019-11-29 10:49:43'),
	(26, 'CA032', 'Plástico', 'Tuberías', '#804000', 32, 32, 23, '2019-11-29 13:51:46'),
	(27, 'CA001', 'Cartón', 'Revistas', '#7c6650', 12, 12, 12, '2019-11-29 13:52:15');
/*!40000 ALTER TABLE `box` ENABLE KEYS */;

-- Volcando estructura para tabla warehouse_new.box_backup
CREATE TABLE IF NOT EXISTS `box_backup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `shelf_id` int(11) DEFAULT NULL,
  `rack_pos` int(5) DEFAULT NULL,
  `material` varchar(50) DEFAULT NULL,
  `content` varchar(50) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `height` float DEFAULT NULL,
  `width` float DEFAULT NULL,
  `depth` float DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `date_out` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `FK_box_backup_shelf` (`shelf_id`),
  CONSTRAINT `FK_box_backup_shelf` FOREIGN KEY (`shelf_id`) REFERENCES `shelf` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla warehouse_new.box_backup: ~4 rows (aproximadamente)
DELETE FROM `box_backup`;
/*!40000 ALTER TABLE `box_backup` DISABLE KEYS */;
INSERT INTO `box_backup` (`id`, `code`, `shelf_id`, `rack_pos`, `material`, `content`, `color`, `height`, `width`, `depth`, `date`, `date_out`) VALUES
	(3, 'CA002', 5, 2, 'Madera', 'Carbón', '#8f3434', 24, 24, 24, '2019-11-11 17:07:42', '2019-11-11 17:34:25'),
	(10, 'CA010', 5, 3, 'Bronce', 'Tuberías', '#c67822', 130, 125, 120, '2019-11-11 18:45:45', '2019-11-11 18:55:03'),
	(11, 'CA011', 5, 2, 'Madera', 'Lingotes de oro', '#ff6cb6', 20, 20, 20, '2019-11-11 18:46:39', '2019-11-11 18:57:51'),
	(13, 'CA015', 3, 1, 'Cartón', 'Granadas', '#004000', 13, 21, 12, '2019-11-12 10:23:00', '2019-11-29 13:52:06');
/*!40000 ALTER TABLE `box_backup` ENABLE KEYS */;

-- Volcando estructura para tabla warehouse_new.config_web
CREATE TABLE IF NOT EXISTS `config_web` (
  `cif` varchar(50) DEFAULT NULL,
  `business_name` varchar(50) DEFAULT NULL,
  `warehouse_code` int(5) DEFAULT NULL,
  `warehouse_name` varchar(50) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `web` varchar(50) DEFAULT NULL,
  `residence` varchar(50) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `responsable` varchar(50) DEFAULT NULL,
  UNIQUE KEY `warehouse_code` (`warehouse_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla warehouse_new.config_web: ~0 rows (aproximadamente)
DELETE FROM `config_web`;
/*!40000 ALTER TABLE `config_web` DISABLE KEYS */;
INSERT INTO `config_web` (`cif`, `business_name`, `warehouse_code`, `warehouse_name`, `phone`, `email`, `web`, `residence`, `location`, `responsable`) VALUES
	('67235123M', 'Magnífico', 61, 'El Señor de Viejo Mundo', '666616161', 'magno@live.com', 'http://mangoelgrande.world', 'Atenas', 'Macedonia', 'Alejandro Magno');
/*!40000 ALTER TABLE `config_web` ENABLE KEYS */;

-- Volcando estructura para tabla warehouse_new.corridor
CREATE TABLE IF NOT EXISTS `corridor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `letter` char(1) DEFAULT NULL,
  `total_pos` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `letter` (`letter`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla warehouse_new.corridor: ~2 rows (aproximadamente)
DELETE FROM `corridor`;
/*!40000 ALTER TABLE `corridor` DISABLE KEYS */;
INSERT INTO `corridor` (`id`, `letter`, `total_pos`) VALUES
	(1, 'A', 11),
	(2, 'B', 11);
/*!40000 ALTER TABLE `corridor` ENABLE KEYS */;

-- Volcando estructura para tabla warehouse_new.shelf
CREATE TABLE IF NOT EXISTS `shelf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `corridor_id` int(11) DEFAULT NULL,
  `corridor_pos` int(11) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `material` varchar(50) DEFAULT NULL,
  `total_rack` int(5) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `corridor_id_corridor_pos` (`corridor_id`,`corridor_pos`),
  UNIQUE KEY `code` (`code`),
  CONSTRAINT `FK_shelf_corridor` FOREIGN KEY (`corridor_id`) REFERENCES `corridor` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla warehouse_new.shelf: ~3 rows (aproximadamente)
DELETE FROM `shelf`;
/*!40000 ALTER TABLE `shelf` DISABLE KEYS */;
INSERT INTO `shelf` (`id`, `corridor_id`, `corridor_pos`, `code`, `material`, `total_rack`, `date`) VALUES
	(3, 1, 2, 'ES002', 'Acero', 20, '2019-11-11 17:06:00'),
	(4, 2, 3, 'ES003', 'Aluminio', 5, '2019-11-11 22:23:36'),
	(5, 1, 1, 'ES001', 'Madera', 8, '2019-11-11 22:29:45');
/*!40000 ALTER TABLE `shelf` ENABLE KEYS */;

-- Volcando estructura para tabla warehouse_new.shelf_backup
CREATE TABLE IF NOT EXISTS `shelf_backup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `corridor_id` int(11) DEFAULT NULL,
  `corridor_pos` int(11) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `material` varchar(50) DEFAULT NULL,
  `total_rack` int(5) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `reason_delete` varchar(255) DEFAULT NULL,
  `date_delete` datetime DEFAULT curtime(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `FK_shelf_backup_corridor` (`corridor_id`),
  CONSTRAINT `FK_shelf_backup_corridor` FOREIGN KEY (`corridor_id`) REFERENCES `corridor` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla warehouse_new.shelf_backup: ~3 rows (aproximadamente)
DELETE FROM `shelf_backup`;
/*!40000 ALTER TABLE `shelf_backup` DISABLE KEYS */;
INSERT INTO `shelf_backup` (`id`, `corridor_id`, `corridor_pos`, `code`, `material`, `total_rack`, `date`, `reason_delete`, `date_delete`) VALUES
	(4, 2, 1, 'ES008', 'Madera', 12, '2019-11-29 13:19:20', 'La humedad', '2019-11-29 13:19:34'),
	(5, 1, 3, 'ES009', 'Aluminio', 2, '2019-11-29 13:21:37', 'Se ha roto', '2019-11-29 13:21:45'),
	(6, 1, 7, 'ES005', 'Hierrro', 123, '2019-11-29 13:38:00', 'Oxidada', '2019-11-29 13:47:46');
/*!40000 ALTER TABLE `shelf_backup` ENABLE KEYS */;

-- Volcando estructura para tabla warehouse_new.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla warehouse_new.user: ~0 rows (aproximadamente)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `email`, `password`, `image`, `ip`, `create_time`) VALUES
	(7, 'admin', 'admin@warehouse.com', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'apache.jpg', NULL, '2019-11-11 11:40:00');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Volcando estructura para disparador warehouse_new.box_backup_refund
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `box_backup_refund` AFTER INSERT ON `box` FOR EACH ROW BEGIN
            
                IF (NEW.code = 'CA001') THEN

                    -- crea la ocupación
                    INSERT INTO association(id, shelf_id, box_id, rack_pos)
                    VALUES(NULL, 5, NEW.id, 3);
                
                    -- elimina el backup
                    DELETE FROM box_backup WHERE id = 2;
                    
                END IF;

            END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador warehouse_new.box_before_delete
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `box_before_delete` BEFORE DELETE ON `box` FOR EACH ROW BEGIN
	
	DECLARE aShelf_id INT(11);
	DECLARE aRack_pos INT(11);
	
	-- selecciona la estantería y la leja
	SELECT a.shelf_id, a.rack_pos
	INTO aShelf_id, aRack_pos
	FROM association a
	WHERE a.box_id = old.id;
	
	-- elimina ocupación
	DELETE FROM association WHERE box_id = old.id;
	
	-- guarda la caja eliminada en la backup
	INSERT INTO box_backup(id, code, shelf_id, 
								  rack_pos, material, content, 
								  color, height, width, depth, date
								  )
	VALUES(NULL, old.code, aShelf_id, 
			 aRack_pos, old.material, 
			 old.content, old.color, old.height, 
			 old.width, old.depth, old.date
			 );

END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador warehouse_new.shelf_before_delete
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `shelf_before_delete` BEFORE DELETE ON `shelf` FOR EACH ROW BEGIN
                
                -- if condition to add the reason only to the last backup
                IF (old.code = 'ES005') THEN

                    INSERT INTO shelf_backup(
                        id, corridor_id, corridor_pos, 
                        code, material, total_rack,
                        date, reason_delete, date_delete
                    )
                    VALUES(
                        NULL, old.corridor_id, old.corridor_pos,
                        old.code, old.material, old.total_rack,
                        old.date, 'Está rota', NOW()
                    );
                    
                END IF;

            END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
