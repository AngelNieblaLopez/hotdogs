/* https://www.sqlshack.com/learn-sql-naming-conventions/ */
CREATE DATABASE CINE_MOVIL;
USE CINE_MOVIL;
CREATE TABLE user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    auth_id INT NOT NULL,
    name VARCHAR(124) NOT NULL,
    last_name VARCHAR(64) NOT NULL,
    second_last_name VARCHAR(64) NOT NULL,
    role_id INT NOT NULL,
    email VARCHAR(100) NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
);

CREATE TABLE auth (
    id INT PRIMARY KEY AUTO_INCREMENT,
    password VARCHAR(128) NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
);

CREATE TABLE role (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(64) NOT NULL,
    is_worker BIT NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
);

/* CREATE TABLE page (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(64) NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
); */

/* CREATE TABLE module (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(64) NOT NULL,
    page_id INT NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
); */

/* CREATE TABLE role_module (
    id INT PRIMARY KEY AUTO_INCREMENT,
    role_id INT NOT NULL,
    module_id INT NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
); */

CREATE TABLE movie (
    id INT PRIMARY KEY AUTO_INCREMENT,
    image_url VARCHAR(500) NOT NULL,
    name VARCHAR(64),
    description varchar(3024),
    category_id INT NOT NULL,
    movie_clasification_id INT NOT NULL,
    duration INT NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
);

CREATE TABLE room (
    id INT PRIMARY KEY AUTO_INCREMENT,
    type_room_id INT NOT NULL,
    cinema_id INT NOT NULL,
    name VARCHAR(64),
    available bit NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
);

CREATE TABLE type_room (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(64),
    price DECIMAL(10,3),

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
);

CREATE TABLE seat_of_room (
    id INT PRIMARY KEY AUTO_INCREMENT,
    room_id INT NOT NULL,
    name VARCHAR(64) NOT NULL,
    available bit NOT NULL,
    position_of_seat_id INT NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
);

CREATE TABLE position_of_seat (
    id INT PRIMARY KEY AUTO_INCREMENT,
    column_of_seat_id INT NOT NULL,
    row_of_seat_id INT NOT NULL,

    
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
);

CREATE TABLE column_of_seat (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL UNIQUE,
    
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
);

CREATE TABLE row_of_seat (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL UNIQUE,
    
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
);

CREATE TABLE cinema (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name varchar(255),
    location_id INT NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
);

CREATE TABLE location (
    id INT PRIMARY KEY AUTO_INCREMENT,
    description varchar(1024) NOT NULL,
    lat VARCHAR(128) NOT NULL,
    longi VARCHAR(128) NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
);

CREATE TABLE `function` (
    id INT PRIMARY KEY AUTO_INCREMENT,
    room_id INT NOT NULL,
    start_date TIMESTAMP NOT NULL,
    function_status_id INT NOT NULL ,
    movie_id INT NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
);

 CREATE TABLE function_status (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name varchar(255),
    
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
);

CREATE TABLE seat_of_function (
    id INT PRIMARY KEY AUTO_INCREMENT,
    seat_of_room_id INT NOT NULL,
    price DECIMAL(10,3),
    function_id INT NOT NULL,
    
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
);


CREATE TABLE sale (
    id INT PRIMARY KEY AUTO_INCREMENT,
    client_id INT NOT NULL,
    worker_id INT NOT NULL,
    payment_info_id INT NOT NULL,
    

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
);

CREATE TABLE sale_detail (
    id INT PRIMARY KEY AUTO_INCREMENT,
    sale_id INT NOT NULL,
    seat_of_function_id INT NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
);

CREATE TABLE worker (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    type_of_worker_id INT NOT NULL,
    
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
);

CREATE TABLE client (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
);

CREATE TABLE type_of_worker (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
);



CREATE TABLE payment_info (
    id INT PRIMARY KEY AUTO_INCREMENT,
    total DECIMAL(12,3) NOT NULL,
    taxes DECIMAL (12,3) NOT NULL,
    subtotal DECIMAL (12,3) NOT NULL,
    payment_status_id INT NOT NULL,
    payment_card_id INT NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
);

CREATE TABLE payment_card (
    id INT PRIMARY KEY AUTO_INCREMENT,
    owner VARCHAR(256) NOT NULL,
    card_number VARCHAR(256) NOT NULL,
    cvv VARCHAR(5) NOT NULL,
    expiration_date varchar(5) NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
);


CREATE TABLE payment_status (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
);


CREATE TABLE config (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    
    enviroment_server_id INT NOT NULL,
    default_customer_role_id INT NOT NULL,
    default_function_status_id INT NOT NULL,
    app_worker_id INT NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
);

CREATE TABLE enviroment_server (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
);

CREATE TABLE movie_clasification (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    min_age int NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1
);


CREATE TABLE category (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    description varchar(255) NOT NULL,
    
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status bit NOT NULL DEFAULT 1

);
/* --------------------------------------------------------------------------------------------- */
 
-- ALTER TABLE user ADD 

-- USER
ALTER TABLE user  ADD  CONSTRAINT user_auth FOREIGN KEY(auth_id)
REFERENCES auth (id);


ALTER TABLE user  ADD  CONSTRAINT user_role FOREIGN KEY(role_id)
REFERENCES role (id);

-- Role_Module

/* ALTER TABLE module  ADD  CONSTRAINT module_page FOREIGN KEY(page_id)
REFERENCES page (id); */

/* ALTER TABLE role_module  ADD  CONSTRAINT role_module_role FOREIGN KEY(role_id)
REFERENCES role (id); */

/* ALTER TABLE role_module  ADD  CONSTRAINT role_module_module FOREIGN KEY(module_id)
REFERENCES module (id); */

-- Cinema
ALTER TABLE cinema  ADD  CONSTRAINT cinema_location FOREIGN KEY(location_id)
REFERENCES location (id);

-- Room

ALTER TABLE room  ADD  CONSTRAINT room_type_room FOREIGN KEY(type_room_id)
REFERENCES type_room (id);

ALTER TABLE room  ADD  CONSTRAINT room_cinema FOREIGN KEY(cinema_id)
REFERENCES cinema (id);


-- Seat of room

ALTER TABLE seat_of_room ADD CONSTRAINT seat_of_room_room FOREIGN KEY(room_id)
REFERENCES room (id);

ALTER TABLE seat_of_room ADD CONSTRAINT position_of_room_room FOREIGN KEY(position_of_seat_id)
REFERENCES position_of_seat (id);

ALTER TABLE position_of_seat ADD CONSTRAINT position_of_seat_column_of_seat FOREIGN KEY(column_of_seat_id)
REFERENCES column_of_seat (id);

ALTER TABLE position_of_seat ADD CONSTRAINT position_of_seat_row_of_seat FOREIGN KEY(row_of_seat_id)
REFERENCES row_of_seat (id);

-- Function

ALTER TABLE `function` ADD CONSTRAINT function_room FOREIGN KEY(room_id)
REFERENCES room (id);

ALTER TABLE `function` ADD CONSTRAINT function_function_status FOREIGN KEY(function_status_id)
REFERENCES function_status (id);

ALTER TABLE seat_of_function ADD CONSTRAINT seat_of_function_seat_of_room FOREIGN KEY(seat_of_room_id)
REFERENCES seat_of_room (id);

ALTER TABLE seat_of_function ADD CONSTRAINT seat_of_function_function FOREIGN KEY(function_id)
REFERENCES `function` (id);

ALTER TABLE `function` ADD CONSTRAINT function_movie FOREIGN KEY(movie_id)
REFERENCES movie (id);

ALTER TABLE `movie` ADD CONSTRAINT movie_category FOREIGN KEY(category_id)
REFERENCES category (id);

ALTER TABLE `movie` ADD CONSTRAINT movie_movie_clasification FOREIGN KEY(movie_clasification_id)
REFERENCES movie_clasification (id);

-- sale

ALTER TABLE sale ADD CONSTRAINT sale_client FOREIGN KEY(client_id)
REFERENCES client (id);

ALTER TABLE sale ADD CONSTRAINT sale_worker FOREIGN KEY(worker_id)
REFERENCES worker (id);

ALTER TABLE sale ADD CONSTRAINT sele_payment_info FOREIGN KEY(payment_info_id)
REFERENCES payment_info (id);

ALTER TABLE sale_detail ADD CONSTRAINT sale_detail_sale FOREIGN KEY(sale_id)
REFERENCES sale (id);

ALTER TABLE sale_detail ADD CONSTRAINT sale_detail_seat_of_function FOREIGN KEY(seat_of_function_id)
REFERENCES seat_of_function (id);

-- worker
ALTER TABLE worker ADD CONSTRAINT worker_user FOREIGN KEY(user_id)
REFERENCES user (id);

ALTER TABLE worker ADD CONSTRAINT worker_type_of_worker FOREIGN KEY(type_of_worker_id)
REFERENCES type_of_worker (id);

-- client
ALTER TABLE client ADD CONSTRAINT client_user FOREIGN KEY(user_id)
REFERENCES user (id);


-- Payment info
ALTER TABLE payment_info ADD CONSTRAINT payment_info_payment_status FOREIGN KEY(payment_status_id)
REFERENCES payment_status (id);

ALTER TABLE payment_info ADD CONSTRAINT payment_payment_card FOREIGN KEY(payment_card_id)
REFERENCES payment_card (id);

-- config

ALTER TABLE config ADD CONSTRAINT config_enviroment_server FOREIGN KEY(enviroment_server_id)
REFERENCES enviroment_server (id);

ALTER TABLE config ADD CONSTRAINT config_role FOREIGN KEY(default_customer_role_id)
REFERENCES `role` (id);

ALTER TABLE config ADD CONSTRAINT config_worker FOREIGN KEY(app_worker_id)
REFERENCES worker (id);

ALTER TABLE config ADD CONSTRAINT config_function_status FOREIGN KEY(default_function_status_id)
REFERENCES function_status (id);