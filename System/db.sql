CREATE DATABASE tmi;
use tmi;
-- 
-- TABLE: assistance 
--

CREATE TABLE assistance(
    id_event                INT              NOT NULL,
    id_session              INT              NOT NULL,
    id_company              INT              NOT NULL,
    id_user                 INT              NOT NULL,
    id_role                 INT              NOT NULL,
    detail                  VARCHAR(256),
    id_assistance_status    INT,
    last_update             DATETIME,
    last_user               INT,
    was_deleted             DECIMAL(1, 0),
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
    was_deleted             DECIMAL(1, 0),
    PRIMARY KEY (id_assistance_status)
)ENGINE=INNODB
;



-- 
-- TABLE: company 
--

CREATE TABLE company(
    id_company     INT              AUTO_INCREMENT,
    name           VARCHAR(64)      NOT NULL,
    detail         VARCHAR(256),
    api_key        VARCHAR(256),
    logo           INT,
    last_update    DATETIME         NOT NULL,
    last_user      INT              NOT NULL,
    was_deleted    DECIMAL(1, 0),
    PRIMARY KEY (id_company)
)ENGINE=INNODB
;



-- 
-- TABLE: detect_image 
--

CREATE TABLE detect_image(
    id_detect_image        INT              AUTO_INCREMENT,
    json                   TEXT,
    id_personal_photo      INT,
    id_take_group_photo    INT,
    id_session             INT,
    id_company             INT,
    last_update            DATETIME,
    last_user              INT,
    was_deleted            DECIMAL(1, 0),
    PRIMARY KEY (id_detect_image)
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
    was_deleted    DECIMAL(1, 0),
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
    was_deleted    DECIMAL(1, 0),
    PRIMARY KEY (id_event, id_company, id_user, id_role)
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
    id_company       INT              NOT NULL,
    last_update      DATETIME,
    last_user        INT,
    was_deleted      DECIMAL(1, 0),
    PRIMARY KEY (id_image)
)ENGINE=INNODB
;



-- 
-- TABLE: person 
--

CREATE TABLE person(
    id_person         INT              AUTO_INCREMENT,
    id_user           INT              NOT NULL,
    username          VARCHAR(64)      NOT NULL,
    password          VARCHAR(256)     NOT NULL,
    names             VARCHAR(64)      NOT NULL,
    first_surname     VARCHAR(64)      NOT NULL,
    second_surname    VARCHAR(64),
    birthday          DATE,
    email             VARCHAR(64)      NOT NULL,
    phone             VARCHAR(32),
    id_company        INT              NOT NULL,
    last_update       DATETIME,
    last_user         INT,
    was_deleted       DECIMAL(1, 0),
    PRIMARY KEY (id_person)
)ENGINE=INNODB
;



-- 
-- TABLE: personal_photo 
--

CREATE TABLE personal_photo(
    id_personal_photo    INT              AUTO_INCREMENT,
    id_person            INT,
    id_image             INT,
    id_company           INT              NOT NULL,
    last_update          DATETIME,
    last_user            INT,
    was_deleted          DECIMAL(1, 0),
    PRIMARY KEY (id_personal_photo)
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
    last_update       DATETIME         NOT NULL,
    last_user         INT              NOT NULL,
    was_deleted       DECIMAL(1, 0),
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
    last_update    DATETIME         NOT NULL,
    last_user      INT              NOT NULL,
    was_deleted    DECIMAL(1, 0),
    PRIMARY KEY (id_company, id_user, id_role)
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
    was_deleted      DECIMAL(1, 0),
    PRIMARY KEY (id_session)
)ENGINE=INNODB
;



-- 
-- TABLE: take_group_photo 
--

CREATE TABLE take_group_photo(
    id_take_group_photo    INT              AUTO_INCREMENT,
    id_image               INT,
    id_session             INT              NOT NULL,
    id_company             INT              NOT NULL,
    last_update            DATETIME,
    last_user              INT,
    was_deleted            DECIMAL(1, 0),
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
    last_update    DATETIME,
    last_user      INT,
    was_deleted    DECIMAL(1, 0),
    PRIMARY KEY (id_user)
)ENGINE=INNODB
;



-- 
-- TABLE: verify_image 
--

CREATE TABLE verify_image(
    id_verify_image           INT              AUTO_INCREMENT,
    json                      TEXT,
    id_detect_image_group     INT,
    id_detect_image_person    INT,
    id_company                INT,
    last_update               DATETIME,
    last_user                 INT,
    was_deleted               DECIMAL(1, 0),
    PRIMARY KEY (id_verify_image)
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
    FOREIGN KEY (id_assistance_status)
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
-- TABLE: detect_image 
--

ALTER TABLE detect_image ADD CONSTRAINT Refpersonal_photo42 
    FOREIGN KEY (id_personal_photo)
    REFERENCES personal_photo(id_personal_photo)
;

ALTER TABLE detect_image ADD CONSTRAINT Reftake_group_photo43 
    FOREIGN KEY (id_take_group_photo)
    REFERENCES take_group_photo(id_take_group_photo)
;

ALTER TABLE detect_image ADD CONSTRAINT Refsession44 
    FOREIGN KEY (id_session)
    REFERENCES session(id_session)
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
-- TABLE: person 
--

ALTER TABLE person ADD CONSTRAINT Refuser48 
    FOREIGN KEY (id_user)
    REFERENCES user(id_user)
;


-- 
-- TABLE: personal_photo 
--

ALTER TABLE personal_photo ADD CONSTRAINT Refperson17 
    FOREIGN KEY (id_person)
    REFERENCES person(id_person)
;

ALTER TABLE personal_photo ADD CONSTRAINT Refimage18 
    FOREIGN KEY (id_image)
    REFERENCES image(id_image)
;


-- 
-- TABLE: role_company 
--

ALTER TABLE role_company ADD CONSTRAINT Refuser50 
    FOREIGN KEY (id_user)
    REFERENCES user(id_user)
;

ALTER TABLE role_company ADD CONSTRAINT Refrole23 
    FOREIGN KEY (id_role)
    REFERENCES role(id_role)
;

ALTER TABLE role_company ADD CONSTRAINT Refcompany24 
    FOREIGN KEY (id_company)
    REFERENCES company(id_company)
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


-- 
-- TABLE: verify_image 
--

ALTER TABLE verify_image ADD CONSTRAINT Refdetect_image45 
    FOREIGN KEY (id_detect_image_group)
    REFERENCES detect_image(id_detect_image)
;

ALTER TABLE verify_image ADD CONSTRAINT Refdetect_image46 
    FOREIGN KEY (id_detect_image_person)
    REFERENCES detect_image(id_detect_image)
;


