use tmi;

-- delete all data
delete from role_company;
delete from user;
delete from role;
delete from company;
delete from image;

-- admin user
INSERT into user (id_user, username, password, active, id_company, last_update, last_user, was_deleted)
VALUES(1, 'root', md5('root'), 1, NULL, CURRENT_TIMESTAMP(), 1, 0);

-- roles
INSERT INTO role
(id_role, name, detail, is_only_system, last_update, last_user, was_deleted)
VALUES(1, 'Root', 'Root role.', -1, CURRENT_TIMESTAMP(), 1, 0);

-- logo
INSERT INTO image
(id_image, name, path, type, width, height, aperture, model, `datetime`, focal_length, iso, shutter_speed, gps_longitude, gps_latitude, id_company, last_update, last_user, was_deleted)
VALUES(1,'company.png', 'c:\\xampp\\htdocs\\TMI\\System\\view\\logos\\company.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, CURRENT_TIMESTAMP(), 1, 0);

-- company
INSERT INTO company
(id_company, name, detail, api_key, person_group_id, active, logo, last_update, last_user, was_deleted)
VALUES(1,'TMI', 'Proyect for TMI course.', NULL, NULL, 1, 1, CURRENT_TIMESTAMP(), 1, 0);

-- role and his company
INSERT INTO role_company
(id_company, id_user, id_role, last_update, last_user, was_deleted)
VALUES(1, 1, 1, CURRENT_TIMESTAMP(), 1, 0);


-- business roles
INSERT INTO role
(id_role, name, detail, is_only_system, last_update, last_user, was_deleted)
VALUES(2, 'Administrator', 'Administrator role.', 1, CURRENT_TIMESTAMP(), 1, 0);

INSERT INTO role
(id_role, name, detail, is_only_system, last_update, last_user, was_deleted)
VALUES(3, 'Exponent', 'Exponent role.', 0, CURRENT_TIMESTAMP(), 1, 0);

INSERT INTO role
(id_role, name, detail, is_only_system, last_update, last_user, was_deleted)
VALUES(4, 'Assistant', 'Assistant role.', 0, CURRENT_TIMESTAMP(), 1, 0);

INSERT INTO role
(id_role, name, detail, is_only_system, last_update, last_user, was_deleted)
VALUES(5, 'Controller', 'Controller role.', 0, CURRENT_TIMESTAMP(), 1, 0);
