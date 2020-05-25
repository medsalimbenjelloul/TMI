use tmi;

-- delete all data
delete from role_company;
delete from user;
delete from role;
delete from company;
delete from image;

-- admin user
INSERT into user (id_user, username, password, active, id_company, last_update, last_user, was_deleted)
VALUES(1, 'root', md5('root'), 1, 1, CURRENT_TIMESTAMP(), 1, 0);

-- roles
INSERT INTO role
(id_role, name, detail, is_only_system, last_update, last_user, was_deleted)
VALUES(1, 'Superusuario', 'Superusuario.', -1, CURRENT_TIMESTAMP(), 1, 0);

-- logo
INSERT INTO image
(id_image, name, path, type, width, height, aperture, model, `datetime`, focal_length, iso, shutter_speed, gps_longitude, gps_latitude, id_company, last_update, last_user, was_deleted)
VALUES(1,'company.png', 'c:\\xampp\\htdocs\\TMI\\System\\view\\logos\\', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, CURRENT_TIMESTAMP(), 1, 0);

-- company
INSERT INTO company
(id_company, name, detail, api_key, person_group_id, active, logo, last_update, last_user, was_deleted)
VALUES(1,'TMI - Grupo 2', 'Proyect for TMI course.', NULL, NULL, 1, 1, CURRENT_TIMESTAMP(), 1, 0);

-- role and his company
INSERT INTO role_company
(id_company, id_user, id_role, last_update, last_user, was_deleted)
VALUES(1, 1, 1, CURRENT_TIMESTAMP(), 1, 0);


-- business roles
INSERT INTO role
(id_role, name, detail, is_only_system, last_update, last_user, was_deleted)
VALUES(2, 'Administrador', 'Administrador.', 1, CURRENT_TIMESTAMP(), 1, 0);

INSERT INTO role
(id_role, name, detail, is_only_system, last_update, last_user, was_deleted)
VALUES(3, 'Exponente', 'Exponente.', 0, CURRENT_TIMESTAMP(), 1, 0);

INSERT INTO role
(id_role, name, detail, is_only_system, last_update, last_user, was_deleted)
VALUES(4, 'Asistente', 'Asistente.', 0, CURRENT_TIMESTAMP(), 1, 0);

INSERT INTO role
(id_role, name, detail, is_only_system, last_update, last_user, was_deleted)
VALUES(5, 'Controlador', 'Controlador.', 0, CURRENT_TIMESTAMP(), 1, 0);

-- assistance status
INSERT INTO assistance_status (name, detail, last_update, last_user, was_deleted)
VALUES('Pendiente', 'Pendiente.', CURRENT_TIMESTAMP(), 1, 0);

INSERT INTO assistance_status (name, detail, last_update, last_user, was_deleted)
VALUES('Asistió', 'Asistió.', CURRENT_TIMESTAMP(), 1, 0);

INSERT INTO assistance_status (name, detail, last_update, last_user, was_deleted)
VALUES('No asistió', 'No asistió.', CURRENT_TIMESTAMP(), 1, 0);

INSERT INTO assistance_status (name, detail, last_update, last_user, was_deleted)
VALUES('Permiso', 'Permiso.', CURRENT_TIMESTAMP(), 1, 0);

-- emotions
INSERT INTO emotion_type
(name, source_name, last_update, last_user, was_deleted)
VALUES('Desprecio', 'contempt', CURRENT_TIMESTAMP(), 1, 0);

INSERT INTO emotion_type
(name, source_name, last_update, last_user, was_deleted)
VALUES('Asco', 'disgust', CURRENT_TIMESTAMP(), 1, 0);

INSERT INTO emotion_type
(name, source_name, last_update, last_user, was_deleted)
VALUES('Miedo', 'fear', CURRENT_TIMESTAMP(), 1, 0);

INSERT INTO emotion_type
(name, source_name, last_update, last_user, was_deleted)
VALUES('Felicidad', 'happiness', CURRENT_TIMESTAMP(), 1, 0);

INSERT INTO emotion_type
(name, source_name, last_update, last_user, was_deleted)
VALUES('Neutral', 'neutral', CURRENT_TIMESTAMP(), 1, 0);

INSERT INTO emotion_type
(name, source_name, last_update, last_user, was_deleted)
VALUES('Tristeza', 'sadness', CURRENT_TIMESTAMP(), 1, 0);

INSERT INTO emotion_type
(name, source_name, last_update, last_user, was_deleted)
VALUES('Sorpresa', 'surprise', CURRENT_TIMESTAMP(), 1, 0);

INSERT INTO emotion_type
(name, source_name, last_update, last_user, was_deleted)
VALUES('Enfado', 'anger', CURRENT_TIMESTAMP(), 1, 0);

-- faces service

INSERT INTO service_type(name, source_name, last_update, last_user, was_deleted)
VALUES('persongroups', 'persongroups', CURRENT_TIMESTAMP(), 1, 0);

INSERT INTO service_type(name, source_name, last_update, last_user, was_deleted)
VALUES('persons', 'persons', CURRENT_TIMESTAMP(), 1, 0);

INSERT INTO service_type(name, source_name, last_update, last_user, was_deleted)
VALUES('persistedFaces', 'persistedFaces', CURRENT_TIMESTAMP(), 1, 0);

INSERT INTO service_type(name, source_name, last_update, last_user, was_deleted)
VALUES('train', 'train', CURRENT_TIMESTAMP(), 1, 0);

INSERT INTO service_type(name, source_name, last_update, last_user, was_deleted)
VALUES('detect', 'detect', CURRENT_TIMESTAMP(), 1, 0);

INSERT INTO service_type(name, source_name, last_update, last_user, was_deleted)
VALUES('identify', 'identify', CURRENT_TIMESTAMP(), 1, 0);
