/* https://www.sqlshack.com/learn-sql-naming-conventions/ */
CREATE DATABASE hot_dogs;

USE hot_dogs;

CREATE TABLE product (
    id int primary key AUTO_INCREMENT,
    key varchar NOT NULL,
    price decimal(5, 2) NOT NULL,
    status bit NOT NULL
);

CREATE TABLE user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR NOT NULL,
    last_name VARCHAR NOT NULL,
    second_last_name VARCHAR NOT NULL,
    password VARCHAR NOT NULL,
    email VARCHAR NOT NULL,
    status bit NOT NULL
);

CREATE TABLE seller (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    status bit NOT NULL
);

CREATE TABLE customer (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    status bit NOT NULL
);

CREATE TABLE payment_info (
    id INT PRIMARY KEY AUTO_INCREMENT,
    proprietary VARCHAR NOT NULL,
    number VARCHAR NOT NULL,
    cvv VARCHAR NOT NULL,
    expiration varchar NOT NULL,
    status bit NOT NULL
);

CREATE TABLE order (
    id INT PRIMARY KEY AUTO_INCREMENT,
    client_id INT NOT NULL,
    seller_id INT NOT NULL,
    payment_info_id INT NOT NULL,
    total decimal(5, 2) NOT NULL,
    subtotal decimal(5, 2) NOT NULL,
    taxes decimal(5, 2) NOT NULL,
    status bit
);

CREATE TABLE order_item (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    status bit
);

CREATE TABLE config (
    id INT PRIMARY KEY AUTO_INCREMENT,
    app_seller_id INT NOT NULL,
);

ALTER TABLE
    seller
ADD
    CONSTRAINT seller_user FOREIGN KEY(user_id) REFERENCES user (id);

ALTER TABLE
    customer
ADD
    CONSTRAINT customer_user FOREIGN KEY(user_id) REFERENCES user (id);

ALTER TABLE
    order
ADD
    CONSTRAINT order_client FOREIGN KEY(client_id) REFERENCES client (id);

ALTER TABLE
    order
ADD
    CONSTRAINT order_seller FOREIGN KEY(seller_id) REFERENCES seller (id);

ALTER TABLE
    order
ADD
    CONSTRAINT order_payment_info FOREIGN KEY(payment_info_id) REFERENCES payment_info (id);

ALTER TABLE
    order_item
ADD
    CONSTRAINT order_item_order FOREIGN KEY(order_id) REFERENCES order (id);

ALTER TABLE
    config
ADD
    CONSTRAINT config_seller FOREIGN KEY(app_seller_id) REFERENCES seller (id);


