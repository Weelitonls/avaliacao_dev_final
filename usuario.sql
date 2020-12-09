CREATE TABLE `usuario` (
	`codigo` INT(11) NOT NULL AUTO_INCREMENT,
	`login` VARCHAR(20) NOT NULL COLLATE 'latin1_swedish_ci',
	`senha` VARCHAR(20) NOT NULL COLLATE 'latin1_swedish_ci',
	`nome` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	PRIMARY KEY (`codigo`) USING BTREE
)
COLLATE='latin1_swedish_ci'
ENGINE=MyISAM
AUTO_INCREMENT=2
;
