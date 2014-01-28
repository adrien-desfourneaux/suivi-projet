CREATE TABLE user
(
    user_id       INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    username      VARCHAR(255) DEFAULT NULL UNIQUE,
    email         VARCHAR(255) DEFAULT NULL UNIQUE,
    display_name  VARCHAR(50) DEFAULT NULL,
    password      VARCHAR(128) NOT NULL,
    state         SMALLINT
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
