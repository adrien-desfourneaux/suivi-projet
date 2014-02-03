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

CREATE TABLE project
(
    project_id   INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    display_name VARCHAR(50) NOT NULL UNIQUE,
    begin_date   INTEGER NOT NULL,
    end_date     INTEGER NOT NULL,
    user_id      INTEGER NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user (user_id)
);

CREATE TABLE task_state
(
    state_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    label    VARCHAR(20) NOT NULL UNIQUE
);

CREATE TABLE task
(
    task_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    description VARCHAR(200) NOT NULL UNIQUE,
    begin_date INTEGER NOT NULL,
    end_date INTEGER NOT NULL,
    state_id INTEGER NOT NULL,
    project_id INTEGER NOT NULL,
    FOREIGN KEY (state_id) REFERENCES task_state (state_id),
    FOREIGN KEY (project_id) REFERENCES project (project_id)
);