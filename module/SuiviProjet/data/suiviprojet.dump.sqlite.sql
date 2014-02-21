UPDATE project SET user_id = 1 WHERE project_id = 1;
UPDATE project SET user_id = 1 WHERE project_id = 2;
UPDATE project SET user_id = 1 WHERE project_id = 3;
UPDATE project SET user_id = 1 WHERE project_id = 4;
UPDATE project SET user_id = 1 WHERE project_id = 5;
UPDATE project SET user_id = 1 WHERE project_id = 6;
UPDATE project SET user_id = 3 WHERE project_id = 7;

UPDATE task SET project_id = 3 WHERE task_id = 1;
UPDATE task SET project_id = 3 WHERE task_id = 2;
UPDATE task SET project_id = 3 WHERE task_id = 3;
UPDATE task SET project_id = 3 WHERE task_id = 4;
UPDATE task SET project_id = 3 WHERE task_id = 5;
UPDATE task SET project_id = 4 WHERE task_id = 6; /* Projet actif 2, Tâche faite */
UPDATE task SET project_id = 3 WHERE task_id = 7;
