/*
Timestamps
01/01/2013	1356994800 
01/01/2014	1388530800 
01/01/2015	1420066800 
01/01/2016  1451602800 
*/

INSERT INTO user (user_id, username, email, display_name, password, state) VALUES (1, 'johndoe', 'john@doe.com', 'John Doe', 'johndoe', 1);
INSERT INTO user (user_id, username, email, display_name, password, state) VALUES (2, 'mariedoe', 'marie@doe.com', 'Marie Doe', 'mariedoe', 1);

INSERT INTO project (project_id, display_name, begin_date, end_date, user_id) VALUES (1, 'Projet terminé', 1356994800, 1388530800, 1);
INSERT INTO project (project_id, display_name, begin_date, end_date, user_id) VALUES (2, 'Projet actif 1', 1356994800, 1420066800, 1);
INSERT INTO project (project_id, display_name, begin_date, end_date, user_id) VALUES (3, 'Projet actif 2', 1388530800, 1420066800, 1);

INSERT INTO task_state (state_id, label) VALUES (1, 'Pas commencé');
INSERT INTO task_state (state_id, label) VALUES (2, 'En cours');
INSERT INTO task_state (state_id, label) VALUES (3, 'Fait');
INSERT INTO task_state (state_id, label) VALUES (4, 'En retard');

INSERT INTO task (task_id, description, begin_date, end_date, state_id, project_id) VALUES (1, 'Tache pas commencée', 1420066800, 1451602800, 1, 1);
INSERT INTO task (task_id, description, begin_date, end_date, state_id, project_id) VALUES (2, 'Tache faite', 1356994800, 1388530800, 3, 1);
INSERT INTO task (task_id, description, begin_date, end_date, state_id, project_id) VALUES (3, 'Tache en cours', 1356994800, 1420066800, 2, 1);
INSERT INTO task (task_id, description, begin_date, end_date, state_id, project_id) VALUES (4, 'Tache en retard', 1356994800, 1388530800, 4, 1);
