--
-- ER/Studio Data Architect 10.0 SQL Code Generation
-- Project :      db_model.DM1
--
-- Date Created : Sunday, May 17, 2020 19:22:26
-- Target DBMS : MySQL 5.x
--

-- 
-- TABLE: assistance 
--

CREATE TABLE assistance(
    id_event                       INT              NOT NULL,
    id_session                     INT              NOT NULL,
    id_company                     INT              NOT NULL,
    id_user                        INT              NOT NULL,
    id_role                        INT              NOT NULL,
    detail                         VARCHAR(256),
    group_photo_1                  INT,
    group_photo_2                  INT,
    group_photo_3                  INT,
    emotion_1                      INT,
    emotion_2                      INT,
    emotion_3                      INT,
    previus_assistance_status_1    INT,
    previus_assistance_status_2    INT,
    previus_assistance_status_3    INT,
    final_assistance_status        INT,
    last_update                    DATETIME,
    last_user                      INT,
    was_deleted                    DECIMAL(1, 0)    NOT NULL,
    PRIMARY KEY (id_event, id_session, id_company, id_user, id_role)
)ENGINE=INNODB
;



-- 
-- TABLE: assistance_status 
--

CREATE TABLE assistance_status(
    id_assistance_status    INT              AUTO_INCREMENT,
    name                    VARCHAR(64)      NOT NULL,
    detail                  VARCHAR(256),
    last_update             DATETIME,
    last_user               INT,
    was_deleted             DECIMAL(1, 0)    NOT NULL,
    PRIMARY KEY (id_assistance_status)
)ENGINE=INNODB
;



-- 
-- TABLE: company 
--

CREATE TABLE company(
    id_company         INT              AUTO_INCREMENT,
    name               VARCHAR(64)      NOT NULL,
    detail             VARCHAR(256),
    api_key            VARCHAR(256),
    person_group_id    VARCHAR(256),
    active             DECIMAL(1, 0)    NOT NULL,
    logo               INT,
    last_update        DATETIME,
    last_user          INT,
    was_deleted        DECIMAL(1, 0)    NOT NULL,
    PRIMARY KEY (id_company)
)ENGINE=INNODB
;



-- 
-- TABLE: emotion_type 
--

CREATE TABLE emotion_type(
    id_emotion_type    INT              AUTO_INCREMENT,
    name               VARCHAR(64)      NOT NULL,
    source_name        VARCHAR(64)      NOT NULL,
    last_update        DATETIME,
    last_user          INT,
    was_deleted        DECIMAL(1, 0)    NOT NULL,
    PRIMARY KEY (id_emotion_type)
)ENGINE=INNODB
;



-- 
-- TABLE: event 
--

CREATE TABLE event(
    id_event       INT              AUTO_INCREMENT,
    name           VARCHAR(64)      NOT NULL,
    detail         VARCHAR(256),
    id_company     INT              NOT NULL,
    last_update    DATETIME,
    last_user      INT,
    was_deleted    DECIMAL(1, 0)    NOT NULL,
    PRIMARY KEY (id_event)
)ENGINE=INNODB
;



-- 
-- TABLE: event_enrolled 
--

CREATE TABLE event_enrolled(
    id_event       INT              NOT NULL,
    id_company     INT              NOT NULL,
    id_user        INT              NOT NULL,
    id_role        INT              NOT NULL,
    last_update    DATETIME,
    last_user      INT,
    was_deleted    DECIMAL(1, 0)    NOT NULL,
    PRIMARY KEY (id_event, id_company, id_user, id_role)
)ENGINE=INNODB
;



-- 
-- TABLE: faces_service 
--

CREATE TABLE faces_service(
    id_faces_service       INT              AUTO_INCREMENT,
    json_response          TEXT,
    id_service_type        INT              NOT NULL,
    id_person              INT,
    id_image               INT,
    id_take_group_photo    INT,
    id_company             INT              NOT NULL,
    last_update            DATETIME,
    last_user              INT,
    was_deleted            DECIMAL(1, 0)    NOT NULL,
    PRIMARY KEY (id_faces_service)
)ENGINE=INNODB
;



-- 
-- TABLE: image 
--

CREATE TABLE image(
    id_image         INT              AUTO_INCREMENT,
    name             VARCHAR(64)      NOT NULL,
    path             VARCHAR(256),
    type             VARCHAR(32),
    width            FLOAT(8, 0),
    height           FLOAT(8, 0),
    aperture         VARCHAR(64),
    model            VARCHAR(64),
    datetime         VARCHAR(64),
    focal_length     VARCHAR(64),
    iso              VARCHAR(64),
    shutter_speed    VARCHAR(64),
    gps_longitude    VARCHAR(64),
    gps_latitude     VARCHAR(64),
    id_company       INT,
    last_update      DATETIME,
    last_user        INT,
    was_deleted      DECIMAL(1, 0)    NOT NULL,
    PRIMARY KEY (id_image)
)ENGINE=INNODB
;



-- 
-- TABLE: person 
--

CREATE TABLE person(
    id_person         INT              AUTO_INCREMENT,
    id_user           INT              NOT NULL,
    names             VARCHAR(64)      NOT NULL,
    first_surname     VARCHAR(64)      NOT NULL,
    second_surname    VARCHAR(64),
    birthday          DATE,
    email             VARCHAR(64)      NOT NULL,
    phone             VARCHAR(32),
    person_id         VARCHAR(256),
    photo_1           INT              NOT NULL,
    photo_2           INT              NOT NULL,
    photo_3           INT              NOT NULL,
    id_company        INT,
    last_update       DATETIME,
    last_user         INT,
    was_deleted       DECIMAL(1, 0)    NOT NULL,
    PRIMARY KEY (id_person)
)ENGINE=INNODB
;



-- 
-- TABLE: role 
--

CREATE TABLE role(
    id_role           INT              AUTO_INCREMENT,
    name              VARCHAR(64)      NOT NULL,
    detail            VARCHAR(256),
    is_only_system    DECIMAL(1, 0),
    last_update       DATETIME,
    last_user         INT,
    was_deleted       DECIMAL(1, 0)    NOT NULL,
    PRIMARY KEY (id_role)
)ENGINE=INNODB
;



-- 
-- TABLE: role_company 
--

CREATE TABLE role_company(
    id_company     INT              NOT NULL,
    id_user        INT              NOT NULL,
    id_role        INT              NOT NULL,
    last_update    DATETIME,
    last_user      INT,
    was_deleted    DECIMAL(1, 0)    NOT NULL,
    PRIMARY KEY (id_company, id_user, id_role)
)ENGINE=INNODB
;



-- 
-- TABLE: service_type 
--

CREATE TABLE service_type(
    id_service_type    INT              AUTO_INCREMENT,
    name               VARCHAR(64)      NOT NULL,
    source_name        VARCHAR(64)      NOT NULL,
    last_update        DATETIME,
    last_user          INT,
    was_deleted        DECIMAL(1, 0)    NOT NULL,
    PRIMARY KEY (id_service_type)
)ENGINE=INNODB
;



-- 
-- TABLE: session 
--

CREATE TABLE session(
    id_session       INT              AUTO_INCREMENT,
    name             VARCHAR(64)      NOT NULL,
    detail           VARCHAR(256),
    when_datetime    DATETIME         NOT NULL,
    id_event         INT,
    id_company       INT              NOT NULL,
    last_update      DATETIME         NOT NULL,
    last_user        INT              NOT NULL,
    was_deleted      DECIMAL(1, 0)    NOT NULL,
    PRIMARY KEY (id_session)
)ENGINE=INNODB
;



-- 
-- TABLE: take_group_photo 
--

CREATE TABLE take_group_photo(
    id_take_group_photo              INT              AUTO_INCREMENT,
    observations                     VARCHAR(256),
    faceids_emotions                 TEXT,
    faceids_personids_confidences    TEXT             NOT NULL,
    id_image                         INT,
    id_session                       INT              NOT NULL,
    id_company                       INT              NOT NULL,
    last_update                      DATETIME,
    last_user                        INT,
    was_deleted                      DECIMAL(1, 0)    NOT NULL,
    PRIMARY KEY (id_take_group_photo)
)ENGINE=INNODB
;



-- 
-- TABLE: user 
--

CREATE TABLE user(
    id_user        INT              AUTO_INCREMENT,
    username       VARCHAR(256)     NOT NULL,
    password       VARCHAR(256)     NOT NULL,
    active         DECIMAL(1, 0)    NOT NULL,
    id_company     INT,
    last_update    DATETIME,
    last_user      INT,
    was_deleted    DECIMAL(1, 0)    NOT NULL,
    PRIMARY KEY (id_user)
)ENGINE=INNODB
;



-- 
-- TABLE: assistance 
--

ALTER TABLE assistance ADD CONSTRAINT Refevent_enrolled32 
    FOREIGN KEY (id_event, id_company, id_user, id_role)
    REFERENCES event_enrolled(id_event, id_company, id_user, id_role)
;

ALTER TABLE assistance ADD CONSTRAINT Refsession33 
    FOREIGN KEY (id_session)
    REFERENCES session(id_session)
;

ALTER TABLE assistance ADD CONSTRAINT Refassistance_status35 
    FOREIGN KEY (final_assistance_status)
    REFERENCES assistance_status(id_assistance_status)
;

ALTER TABLE assistance ADD CONSTRAINT Refemotion_type59 
    FOREIGN KEY (emotion_3)
    REFERENCES emotion_type(id_emotion_type)
;

ALTER TABLE assistance ADD CONSTRAINT Refemotion_type60 
    FOREIGN KEY (emotion_1)
    REFERENCES emotion_type(id_emotion_type)
;

ALTER TABLE assistance ADD CONSTRAINT Refemotion_type61 
    FOREIGN KEY (emotion_2)
    REFERENCES emotion_type(id_emotion_type)
;

ALTER TABLE assistance ADD CONSTRAINT Reftake_group_photo62 
    FOREIGN KEY (group_photo_3)
    REFERENCES take_group_photo(id_take_group_photo)
;

ALTER TABLE assistance ADD CONSTRAINT Reftake_group_photo63 
    FOREIGN KEY (group_photo_1)
    REFERENCES take_group_photo(id_take_group_photo)
;

ALTER TABLE assistance ADD CONSTRAINT Reftake_group_photo64 
    FOREIGN KEY (group_photo_2)
    REFERENCES take_group_photo(id_take_group_photo)
;

ALTER TABLE assistance ADD CONSTRAINT Refassistance_status65 
    FOREIGN KEY (previus_assistance_status_1)
    REFERENCES assistance_status(id_assistance_status)
;

ALTER TABLE assistance ADD CONSTRAINT Refassistance_status66 
    FOREIGN KEY (previus_assistance_status_2)
    REFERENCES assistance_status(id_assistance_status)
;

ALTER TABLE assistance ADD CONSTRAINT Refassistance_status67 
    FOREIGN KEY (previus_assistance_status_3)
    REFERENCES assistance_status(id_assistance_status)
;


-- 
-- TABLE: company 
--

ALTER TABLE company ADD CONSTRAINT Refimage52 
    FOREIGN KEY (logo)
    REFERENCES image(id_image)
;


-- 
-- TABLE: event_enrolled 
--

ALTER TABLE event_enrolled ADD CONSTRAINT Refevent30 
    FOREIGN KEY (id_event)
    REFERENCES event(id_event)
;

ALTER TABLE event_enrolled ADD CONSTRAINT Refrole_company51 
    FOREIGN KEY (id_company, id_user, id_role)
    REFERENCES role_company(id_company, id_user, id_role)
;


-- 
-- TABLE: faces_service 
--

ALTER TABLE faces_service ADD CONSTRAINT Reftake_group_photo43 
    FOREIGN KEY (id_take_group_photo)
    REFERENCES take_group_photo(id_take_group_photo)
;

ALTER TABLE faces_service ADD CONSTRAINT Refservice_type68 
    FOREIGN KEY (id_service_type)
    REFERENCES service_type(id_service_type)
;

ALTER TABLE faces_service ADD CONSTRAINT Refperson70 
    FOREIGN KEY (id_person)
    REFERENCES person(id_person)
;

ALTER TABLE faces_service ADD CONSTRAINT Refimage71 
    FOREIGN KEY (id_image)
    REFERENCES image(id_image)
;


-- 
-- TABLE: person 
--

ALTER TABLE person ADD CONSTRAINT Refimage53 
    FOREIGN KEY (photo_1)
    REFERENCES image(id_image)
;

ALTER TABLE person ADD CONSTRAINT Refimage54 
    FOREIGN KEY (photo_2)
    REFERENCES image(id_image)
;

ALTER TABLE person ADD CONSTRAINT Refimage55 
    FOREIGN KEY (photo_3)
    REFERENCES image(id_image)
;

ALTER TABLE person ADD CONSTRAINT Refuser48 
    FOREIGN KEY (id_user)
    REFERENCES user(id_user)
;


-- 
-- TABLE: role_company 
--

ALTER TABLE role_company ADD CONSTRAINT Refrole23 
    FOREIGN KEY (id_role)
    REFERENCES role(id_role)
;

ALTER TABLE role_company ADD CONSTRAINT Refcompany24 
    FOREIGN KEY (id_company)
    REFERENCES company(id_company)
;

ALTER TABLE role_company ADD CONSTRAINT Refuser50 
    FOREIGN KEY (id_user)
    REFERENCES user(id_user)
;


-- 
-- TABLE: session 
--

ALTER TABLE session ADD CONSTRAINT Refevent20 
    FOREIGN KEY (id_event)
    REFERENCES event(id_event)
;


-- 
-- TABLE: take_group_photo 
--

ALTER TABLE take_group_photo ADD CONSTRAINT Refimage36 
    FOREIGN KEY (id_image)
    REFERENCES image(id_image)
;

ALTER TABLE take_group_photo ADD CONSTRAINT Refsession37 
    FOREIGN KEY (id_session)
    REFERENCES session(id_session)
;


