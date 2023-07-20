-- create database
DROP SCHEMA IF EXISTS productodesayuno;
CREATE SCHEMA productodesayuno;
USE productodesayuno;



-- create roles
DROP TABLE IF EXISTS pd_role;
CREATE TABLE pd_role
(
    id   INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    CONSTRAINT role__name_uindex UNIQUE (name)
);
-- insert default roles
INSERT INTO pd_role (name) VALUES ('admin');
INSERT INTO pd_role (name) VALUES ('super-admin');




-- create user table
DROP TABLE IF EXISTS pd_user;
CREATE TABLE pd_user
(
    id    INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    name  VARCHAR(255) NOT NULL,
    pass  VARCHAR(255) NOT NULL,
    role  INT          NOT NULL,
    CONSTRAINT user__role__id_fk FOREIGN KEY (role) REFERENCES pd_role (id)
);
-- insert default users
INSERT INTO pd_user (email, name, pass, role) VALUES ('valeria@almacen.com', 'Valeria', 'change me', 1); -- admin
INSERT INTO pd_user (email, name, pass, role) VALUES ('simone.celia@simonecelia.it', 'Simone Celia', 'change me', 2); -- super-admin




-- create super_category table
# DROP TABLE IF EXISTS pd_super_category;
# CREATE TABLE pd_super_category
# (
#     id   INT AUTO_INCREMENT PRIMARY KEY,
#     name VARCHAR(255) NOT NULL
# );
# -- insert default super category
# INSERT INTO pd_super_category (name) VALUES ('sin super categoría');




-- create category table
DROP TABLE IF EXISTS pd_category;
CREATE TABLE pd_category
(
    id   INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
#     super_category INT NOT NULL,
#     CONSTRAINT category__super_category__id_fk FOREIGN KEY (super_category) REFERENCES pd_super_category (id)
);
-- insert default categories
INSERT INTO pd_category (name) VALUES ('desayuno');



-- create table period
DROP TABLE IF EXISTS pd_period;
CREATE TABLE pd_period
(
    id     INT AUTO_INCREMENT PRIMARY KEY,
    start  TIMESTAMP        NULL,
    end    TIMESTAMP        NULL,
    actual BIT DEFAULT b'1' NOT NULL
);
-- insert default value
INSERT INTO pd_period (start, end, actual) VALUES ('2023-07-17 21:43:56', NULL, TRUE);




-- supplir
DROP TABLE IF EXISTS pd_supplier;
CREATE TABLE pd_supplier
(
    id   INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);
-- defaults
INSERT INTO pd_supplier (id, name) VALUES (1, 'sin proveedor');




-- table product
DROP TABLE IF EXISTS pd_product;
CREATE TABLE pd_product
(
    id       INT AUTO_INCREMENT PRIMARY KEY,
    name     VARCHAR(255)  NOT NULL,
    category INT           NOT NULL,
    supplier INT           NOT NULL,
    unit     VARCHAR(255)  NULL,
    deposit0 DECIMAL(9, 2) NULL,
    deposit1 DECIMAL(9, 2) NULL,
    outflow0 DECIMAL(9, 2) NULL,
    outflow1 DECIMAL(9, 2) NULL,
    `left`   DECIMAL(9, 2) NULL,
    `period` INT NULL,
    note     VARCHAR(255)  NULL,
    CONSTRAINT product_category_id_fk
        FOREIGN KEY (category) REFERENCES pd_category (id),
    constraint product_period_id_fk
        FOREIGN KEY (period) REFERENCES pd_period (id)
            ON DELETE CASCADE,
    CONSTRAINT product_supplier_id_fk
        FOREIGN KEY (supplier) REFERENCES pd_supplier (id)
);
-- defaults
INSERT INTO pd_product (name, category, supplier, period) VALUES ('york', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('edam', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('pavo', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('manchego', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('bacon', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('yogurt', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('granola', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('humus', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('lacon', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('ens kentuky', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('champinones', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('atun', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('marmelada', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('mozzarella', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('fruta', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('aguacate', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('mato', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('rabanito', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('marmelada tomate', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('tomate huntar', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('queso vegano', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('bolitas mozzarella', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('pesto', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('jamon iberico', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('jamon serrano', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('queso semi', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('queso ovejo', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('salchichon', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('chorizo', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('brie', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('lomo iberico', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('pastrami', 1, 1, 1);
INSERT INTO pd_product (name, category, supplier, period) VALUES ('fuet', 1, 1, 1);




-- table operation
DROP TABLE IF EXISTS pd_operation;
CREATE TABLE pd_operation
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    user_       INT                                   NOT NULL,
    timestamp   TIMESTAMP DEFAULT current_timestamp() NOT NULL ON UPDATE current_timestamp(),
    product     INT                                   NULL,
    description VARCHAR(255)                          NULL,
    CONSTRAINT operation_product_id_fk
        FOREIGN KEY (product) REFERENCES pd_product (id)
            ON DELETE SET NULL,
    CONSTRAINT operation_user__id_fk
        FOREIGN KEY (user_) REFERENCES pd_user (id)
);


