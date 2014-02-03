CREATE TABLE task
(
    task_id     INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    description VARCHAR(200) NOT NULL UNIQUE,
    begin_date  INTEGER NOT NULL,
    end_date    INTEGER NOT NULL,
    state_id    INTEGER NOT NULL,
    FOREIGN KEY (state_id) REFERENCES task_state (state_id)
);

CREATE TABLE task_state
(
	state_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
	label    VARCHAR(20) NOT NULL UNIQUE
);