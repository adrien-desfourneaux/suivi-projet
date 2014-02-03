DROP TABLE project;
CREATE TABLE project
(
    project_id   INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    display_name VARCHAR(50) NOT NULL UNIQUE,
    begin_date   INTEGER NOT NULL,
    end_date     INTEGER NOT NULL,
    user_id      INTEGER,
    FOREIGN KEY (user_id) REFERENCES user (user_id)
);

DROP TABLE task;
CREATE TABLE task
(
    task_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    description VARCHAR(200) NOT NULL UNIQUE,
    begin_date INTEGER NOT NULL,
    end_date INTEGER NOT NULL,
    state_id INTEGER NOT NULL,
    project_id INTEGER,
    FOREIGN KEY (state_id) REFERENCES task_state (state_id),
    FOREIGN KEY (project_id) REFERENCES project (project_id)
);