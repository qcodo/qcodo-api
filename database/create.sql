/* SQLEditor (MySQL)*/

DROP TABLE IF EXISTS `parameter`;

DROP TABLE IF EXISTS `operation`;

DROP TABLE IF EXISTS `qcodo_constant`;

DROP TABLE IF EXISTS `class_property`;

DROP TABLE IF EXISTS `class_variable`;

DROP TABLE IF EXISTS `variable`;

DROP TABLE IF EXISTS `qcodo_class`;

DROP TABLE IF EXISTS `qcodo_interface`;

DROP TABLE IF EXISTS `file`;

DROP TABLE IF EXISTS `directory_token`;

DROP TABLE IF EXISTS `variable_type`;

DROP TABLE IF EXISTS `class_group`;

DROP TABLE IF EXISTS `variable_group`;

DROP TABLE IF EXISTS `protection_type`;


CREATE TABLE `directory_token`
(
`id` INTEGER unsigned  NOT NULL AUTO_INCREMENT,
`token` VARCHAR(255) NOT NULL UNIQUE,
`path` VARCHAR(255) NOT NULL UNIQUE,
`core_flag` BOOLEAN,
`relative_flag` BOOLEAN,
PRIMARY KEY (`id`)
) ENGINE=InnoDB;



CREATE TABLE `variable_type`
(
`id` INTEGER unsigned  NOT NULL AUTO_INCREMENT,
`name` VARCHAR(50) NOT NULL UNIQUE,
PRIMARY KEY (`id`)
) ENGINE=InnoDB;



CREATE TABLE `class_group`
(
`id` INTEGER unsigned  NOT NULL AUTO_INCREMENT,
`name` VARCHAR(50),
`order_number` INTEGER,
PRIMARY KEY (`id`)
) ENGINE=InnoDB;



CREATE TABLE `file`
(
`id` INTEGER unsigned  NOT NULL AUTO_INCREMENT,
`directory_id` INTEGER unsigned  NOT NULL,
`path` VARCHAR(255) NOT NULL,
`deprecated_major_version` INTEGER,
`deprecated_minor_version` INTEGER,
`deprecated_build` INTEGER,
PRIMARY KEY (`id`)
) ENGINE=InnoDB;



CREATE TABLE `variable_group`
(
`id` INTEGER unsigned  NOT NULL AUTO_INCREMENT,
`name` VARCHAR(50),
`order_number` INTEGER,
PRIMARY KEY (`id`)
) ENGINE=InnoDB;



CREATE TABLE `protection_type`
(
`id` INTEGER unsigned  NOT NULL AUTO_INCREMENT,
`name` VARCHAR(50) NOT NULL UNIQUE,
PRIMARY KEY (`id`)
) ENGINE=InnoDB;



CREATE TABLE `qcodo_interface`
(
`id` INTEGER unsigned  NOT NULL AUTO_INCREMENT,
`parent_qcodo_interface_id` INTEGER unsigned,
`class_group_id` INTEGER unsigned,
`name` VARCHAR(100) NOT NULL UNIQUE,
`first_version` VARCHAR(40),
`last_version` VARCHAR(40),
`short_description` TEXT,
`extended_description` TEXT,
`file_id` INTEGER unsigned,
PRIMARY KEY (`id`)
) ENGINE=InnoDB;



CREATE TABLE `qcodo_class`
(
`id` INTEGER unsigned  NOT NULL AUTO_INCREMENT,
`parent_qcodo_class_id` INTEGER unsigned,
`interface_id` INTEGER unsigned,
`class_group_id` INTEGER unsigned,
`name` VARCHAR(100) NOT NULL UNIQUE,
`abstract_flag` BOOLEAN,
`enumeration_flag` BOOLEAN,
`first_version` VARCHAR(40),
`last_version` VARCHAR(40),
`short_description` TEXT,
`extended_description` TEXT,
`file_id` INTEGER unsigned,
PRIMARY KEY (`id`)
) ENGINE=InnoDB;



CREATE TABLE `variable`
(
`id` INTEGER unsigned  NOT NULL AUTO_INCREMENT,
`name` VARCHAR(100),
`variable_type_id` INTEGER unsigned  NOT NULL,
`object_type_id` INTEGER unsigned,
`array_flag` BOOLEAN,
`default_value` VARCHAR(200),
`first_version` VARCHAR(40),
`last_version` VARCHAR(40),
`short_description` TEXT,
`extended_description` TEXT,
PRIMARY KEY (`id`)
) ENGINE=InnoDB;



CREATE TABLE `operation`
(
`id` INTEGER unsigned  NOT NULL AUTO_INCREMENT,
`qcodo_class_id` INTEGER unsigned,
`qcodo_interface_id` INTEGER unsigned,
`name` VARCHAR(100),
`protection_type_id` INTEGER unsigned,
`static_flag` BOOLEAN,
`abstract_flag` BOOLEAN,
`final_flag` BOOLEAN,
`return_variable_id` INTEGER unsigned,
`additional_variable_id` INTEGER unsigned,
`first_version` VARCHAR(40),
`last_version` VARCHAR(40),
`short_description` TEXT,
`extended_description` TEXT,
`file_id` INTEGER unsigned,
PRIMARY KEY (`id`)
) ENGINE=InnoDB;



CREATE TABLE `qcodo_constant`
(
`id` INTEGER unsigned  NOT NULL AUTO_INCREMENT,
`qcodo_class_id` INTEGER unsigned,
`variable_id` INTEGER unsigned  NOT NULL UNIQUE,
`file_id` INTEGER unsigned,
PRIMARY KEY (`id`)
) ENGINE=InnoDB;



CREATE TABLE `class_variable`
(
`id` INTEGER unsigned  NOT NULL AUTO_INCREMENT,
`qcodo_class_id` INTEGER unsigned  NOT NULL,
`variable_group_id` INTEGER unsigned,
`protection_type_id` INTEGER unsigned  NOT NULL,
`variable_id` INTEGER unsigned  NOT NULL UNIQUE,
`read_only_flag` BOOLEAN,
`static_flag` BOOLEAN,
PRIMARY KEY (`id`)
) ENGINE=InnoDB;



CREATE TABLE `class_property`
(
`id` INTEGER unsigned  NOT NULL AUTO_INCREMENT,
`qcodo_class_id` INTEGER unsigned  NOT NULL,
`variable_group_id` INTEGER unsigned,
`variable_id` INTEGER unsigned  NOT NULL UNIQUE,
`class_variable_id` INTEGER unsigned,
`read_only_flag` BOOLEAN,
`write_only_flag` BOOLEAN,
PRIMARY KEY (`id`)
) ENGINE=InnoDB;



CREATE TABLE `parameter`
(
`id` INTEGER unsigned  NOT NULL AUTO_INCREMENT,
`operation_id` INTEGER unsigned  NOT NULL,
`order_number` INTEGER,
`variable_id` INTEGER unsigned  NOT NULL UNIQUE,
`reference_flag` BOOLEAN,
PRIMARY KEY (`id`)
) ENGINE=InnoDB;


CREATE INDEX `file_directory_id_idx`  ON `file`(`directory_id`);
ALTER TABLE `file` ADD FOREIGN KEY directory_id_idxfk(`directory_id`) REFERENCES `directory_token`(`id`);
CREATE UNIQUE INDEX `file_idx` ON `file` (`directory_id`,`path`);
CREATE INDEX `qcodo_interface_parent_qcodo_interface_id_idx`  ON `qcodo_interface`(`parent_qcodo_interface_id`);
ALTER TABLE `qcodo_interface` ADD FOREIGN KEY parent_qcodo_interface_id_idxfk(`parent_qcodo_interface_id`) REFERENCES `qcodo_interface`(`id`);
CREATE INDEX `qcodo_interface_class_group_id_idx`  ON `qcodo_interface`(`class_group_id`);
ALTER TABLE `qcodo_interface` ADD FOREIGN KEY class_group_id_idxfk(`class_group_id`) REFERENCES `class_group`(`id`);
CREATE INDEX `qcodo_interface_file_id_idx`  ON `qcodo_interface`(`file_id`);
ALTER TABLE `qcodo_interface` ADD FOREIGN KEY file_id_idxfk(`file_id`) REFERENCES `file`(`id`);
CREATE INDEX `qcodo_class_parent_qcodo_class_id_idx`  ON `qcodo_class`(`parent_qcodo_class_id`);
ALTER TABLE `qcodo_class` ADD FOREIGN KEY parent_qcodo_class_id_idxfk(`parent_qcodo_class_id`) REFERENCES `qcodo_class`(`id`);
CREATE INDEX `qcodo_class_interface_id_idx`  ON `qcodo_class`(`interface_id`);
ALTER TABLE `qcodo_class` ADD FOREIGN KEY interface_id_idxfk(`interface_id`) REFERENCES `qcodo_interface`(`id`);
CREATE INDEX `qcodo_class_class_group_id_idx`  ON `qcodo_class`(`class_group_id`);
ALTER TABLE `qcodo_class` ADD FOREIGN KEY class_group_id_idxfk(`class_group_id`) REFERENCES `class_group`(`id`);
CREATE INDEX `qcodo_class_file_id_idx`  ON `qcodo_class`(`file_id`);
ALTER TABLE `qcodo_class` ADD FOREIGN KEY file_id_idxfk(`file_id`) REFERENCES `file`(`id`);
CREATE INDEX `variable_type_id_idx`  ON `variable`(`variable_type_id`);
ALTER TABLE `variable` ADD FOREIGN KEY variable_type_id_idxfk(`variable_type_id`) REFERENCES `variable_type`(`id`);
CREATE INDEX `variable_object_type_id_idx`  ON `variable`(`object_type_id`);
ALTER TABLE `variable` ADD FOREIGN KEY object_type_id_idxfk(`object_type_id`) REFERENCES `qcodo_class`(`id`);
CREATE INDEX `operation_qcodo_class_id_idx`  ON `operation`(`qcodo_class_id`);
ALTER TABLE `operation` ADD FOREIGN KEY qcodo_class_id_idxfk(`qcodo_class_id`) REFERENCES `qcodo_class`(`id`);
CREATE INDEX `operation_qcodo_interface_id_idx`  ON `operation`(`qcodo_interface_id`);
ALTER TABLE `operation` ADD FOREIGN KEY qcodo_interface_id_idxfk(`qcodo_interface_id`) REFERENCES `qcodo_interface`(`id`);
CREATE INDEX `operation_protection_type_id_idx`  ON `operation`(`protection_type_id`);
ALTER TABLE `operation` ADD FOREIGN KEY protection_type_id_idxfk(`protection_type_id`) REFERENCES `protection_type`(`id`);
CREATE INDEX `operation_return_variable_id_idx`  ON `operation`(`return_variable_id`);
ALTER TABLE `operation` ADD FOREIGN KEY return_variable_id_idxfk(`return_variable_id`) REFERENCES `variable`(`id`);
CREATE INDEX `operation_additional_variable_id_idx`  ON `operation`(`additional_variable_id`);
ALTER TABLE `operation` ADD FOREIGN KEY additional_variable_id_idxfk(`additional_variable_id`) REFERENCES `variable`(`id`);
CREATE INDEX `operation_file_id_idx`  ON `operation`(`file_id`);
ALTER TABLE `operation` ADD FOREIGN KEY file_id_idxfk(`file_id`) REFERENCES `file`(`id`);
CREATE UNIQUE INDEX `operation_idx` ON `operation` (`qcodo_class_id`,`qcodo_interface_id`,`name`);
CREATE INDEX `qcodo_constant_qcodo_class_id_idx`  ON `qcodo_constant`(`qcodo_class_id`);
ALTER TABLE `qcodo_constant` ADD FOREIGN KEY qcodo_class_id_idxfk(`qcodo_class_id`) REFERENCES `qcodo_class`(`id`);
CREATE INDEX `qcodo_constant_variable_id_idx`  ON `qcodo_constant`(`variable_id`);
ALTER TABLE `qcodo_constant` ADD FOREIGN KEY variable_id_idxfk(`variable_id`) REFERENCES `variable`(`id`);
CREATE INDEX `qcodo_constant_file_id_idx`  ON `qcodo_constant`(`file_id`);
ALTER TABLE `qcodo_constant` ADD FOREIGN KEY file_id_idxfk(`file_id`) REFERENCES `file`(`id`);
CREATE INDEX `class_variable_qcodo_class_id_idx`  ON `class_variable`(`qcodo_class_id`);
ALTER TABLE `class_variable` ADD FOREIGN KEY qcodo_class_id_idxfk(`qcodo_class_id`) REFERENCES `qcodo_class`(`id`);
CREATE INDEX `class_variable_variable_group_id_idx`  ON `class_variable`(`variable_group_id`);
ALTER TABLE `class_variable` ADD FOREIGN KEY variable_group_id_idxfk(`variable_group_id`) REFERENCES `variable_group`(`id`);
CREATE INDEX `class_variable_protection_type_id_idx`  ON `class_variable`(`protection_type_id`);
ALTER TABLE `class_variable` ADD FOREIGN KEY protection_type_id_idxfk(`protection_type_id`) REFERENCES `protection_type`(`id`);
CREATE INDEX `class_variable_variable_id_idx`  ON `class_variable`(`variable_id`);
ALTER TABLE `class_variable` ADD FOREIGN KEY variable_id_idxfk(`variable_id`) REFERENCES `variable`(`id`);
CREATE INDEX `class_variable_idx` ON `class_variable` (`qcodo_class_id`,`variable_group_id`);
CREATE INDEX `class_property_qcodo_class_id_idx`  ON `class_property`(`qcodo_class_id`);
ALTER TABLE `class_property` ADD FOREIGN KEY qcodo_class_id_idxfk(`qcodo_class_id`) REFERENCES `qcodo_class`(`id`);
CREATE INDEX `class_property_variable_group_id_idx`  ON `class_property`(`variable_group_id`);
ALTER TABLE `class_property` ADD FOREIGN KEY variable_group_id_idxfk(`variable_group_id`) REFERENCES `variable_group`(`id`);
CREATE INDEX `class_property_variable_id_idx`  ON `class_property`(`variable_id`);
ALTER TABLE `class_property` ADD FOREIGN KEY variable_id_idxfk(`variable_id`) REFERENCES `variable`(`id`);
CREATE INDEX `class_property_class_variable_id_idx`  ON `class_property`(`class_variable_id`);
ALTER TABLE `class_property` ADD FOREIGN KEY class_variable_id_idxfk(`class_variable_id`) REFERENCES `class_variable`(`id`);
CREATE INDEX `class_property_idx` ON `class_property` (`qcodo_class_id`,`variable_group_id`);
CREATE INDEX `parameter_operation_id_idx`  ON `parameter`(`operation_id`);
ALTER TABLE `parameter` ADD FOREIGN KEY operation_id_idxfk(`operation_id`) REFERENCES `operation`(`id`);
CREATE INDEX `parameter_variable_id_idx`  ON `parameter`(`variable_id`);
ALTER TABLE `parameter` ADD FOREIGN KEY variable_id_idxfk(`variable_id`) REFERENCES `variable`(`id`);
