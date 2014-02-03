CREATE TABLE user
(
    user_id       INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    username      VARCHAR(255) DEFAULT NULL UNIQUE,
    email         VARCHAR(255) DEFAULT NULL UNIQUE,
    display_name  VARCHAR(50) DEFAULT NULL,
    password      VARCHAR(128) NOT NULL,
    state         SMALLINT,
    role          VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS `user_role` (
  `role_id` VARCHAR(255) NOT NULL,
  `is_default` TINYINT(1) NOT NULL,
  `parent` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
);

CREATE TABLE IF NOT EXISTS `user_role_linker` (
  `user_id` INTEGER NOT NULL,
  `role_id` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`)
);

