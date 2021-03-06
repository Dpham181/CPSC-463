DROP DATABASE IF EXISTS STORE_SITE;
CREATE DATABASE IF NOT EXISTS STORE_SITE;

-- hosting database admin
DROP USER IF EXISTS 'dbhost'@'localhost';
CREATE USER IF NOT EXISTS 'dbhost'@'localhost' IDENTIFIED BY 'danh123';

-- 2 roles user for security

DROP USER IF EXISTS 'regular'@'localhost';
CREATE USER IF NOT EXISTS 'regular'@'localhost' IDENTIFIED BY 'regular123';


DROP USER IF EXISTS 'admin'@'localhost';
CREATE USER IF NOT EXISTS 'admin'@'localhost' IDENTIFIED BY 'admin123';



-- FOR USING THIS DB
USE STORE_SITE;


CREATE TABLE USERS_ACCCOUNT
(
  ACC_NUM INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  HASH_PASS VARCHAR(225) COLLATE utf8_unicode_ci NOT NULL,
  EMAIL VARCHAR(100) COLLATE utf8_unicode_ci NOT NULL,
  DATE_CREATED timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  ACC_TYPE ENUM('R','A') DEFAULT 'R'
);
SET time_zone='+00:00';


CREATE TABLE CUSTOMER
(
  CUSTOMER_ID INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  R_ID INT(10) UNSIGNED NOT NULL,
  CARD_STATUS VARCHAR(10),

  CONSTRAINT FOREIGN KEY (R_ID) REFERENCES USERS_ACCCOUNT(ACC_NUM)
);

CREATE TABLE PROFILE
(
  PROFILE_ID INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  AUSER_ID INT(10) UNSIGNED NOT NULL,
  FIRST_NAME VARCHAR(100),
  LAST_NAME VARCHAR(150),
  COUNTRY VARCHAR(250),
  ZIPCODE VARCHAR(100),
  CITY VARCHAR(100),
  STREET VARCHAR(100),
  STATE CHAR(10),

  CONSTRAINT FOREIGN KEY (AUSER_ID) REFERENCES USERS_ACCCOUNT(ACC_NUM),
  CHECK (ZIPCODE  REGEXP '(?!0{5})(?!9{5})\\d{5}(-(?!0{4})(?!9{4})\\d{4})?'),
  INDEX (LAST_NAME ),
  UNIQUE (FIRST_NAME , LAST_NAME )
);

CREATE TABLE PAYMENT_INFO
(
INFO_ID INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
UINFO_ID INT(10) UNSIGNED NOT NULL,
CREDIT_NUM INT(16) UNSIGNED NOT NULL,
EXP_DATE VARCHAR(10),

CONSTRAINT FOREIGN KEY (UINFO_ID) REFERENCES CUSTOMER(CUSTOMER_ID)
);

CREATE TABLE ORDERING
(
  ORDER_ID INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  CORDER_ID INT(10) UNSIGNED NOT NULL,
  PAYMENT_STATUS CHAR(4),
  DATE_ORDER timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT FOREIGN KEY (CORDER_ID) REFERENCES CUSTOMER(CUSTOMER_ID)
);

CREATE TABLE ITEMS
(
  ITEM_NUM INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  OITEM_NUM INT(10) UNSIGNED NOT NULL DEFAULT 0,
  TITLE VARCHAR(100) DEFAULT 'NOT ASIGNED',

  CONSTRAINT FOREIGN KEY (OITEM_NUM) REFERENCES ORDERING(ORDER_ID)
);
CREATE TABLE SUB_ITEMS
(
  SI_NUM INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ISI_NUM INT(10) UNSIGNED NOT NULL,
  BRAND VARCHAR(100),
  PRICE INT(10) UNSIGNED DEFAULT 0,
  NAME VARCHAR(10),
  STATUS VARCHAR(100),
  QUANTITY INT(10) UNSIGNED DEFAULT 0,

  CONSTRAINT FOREIGN KEY (ISI_NUM) REFERENCES ITEMS(ITEM_NUM)

);
CREATE TABLE INVOICE
(
  INVOICE_ID INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ITEMS_ID INT(10) UNSIGNED NOT NULL,
  OR_ID INT (10) UNSIGNED NOT NULL,
  QUANTITY INT(250) UNSIGNED DEFAULT 0,
  PRICE INT (10) UNSIGNED DEFAULT 0,
  CUS_INFO VARCHAR(250),
  TOTAL INT(10) UNSIGNED DEFAULT 0,

  CONSTRAINT FOREIGN KEY (ITEMS_ID) REFERENCES SUB_ITEMS(SI_NUM),
  CONSTRAINT FOREIGN KEY (OR_ID) REFERENCES ORDERING(ORDER_ID),

  SHARING BIT DEFAULT 0
);

GRANT SELECT, INSERT, DELETE, UPDATE ON STORE_SITE.* TO 'dbhost'@'localhost';
GRANT SELECT, INSERT, DELETE, UPDATE ON STORE_SITE.* TO 'admin'@'localhost';

GRANT SELECT ON STORE_SITE.* TO 'regular'@'localhost';
GRANT UPDATE ON STORE_SITE.PROFILE TO 'regular'@'localhost';
GRANT INSERT ON STORE_SITE.ITEMS TO 'regular'@'localhost';
GRANT INSERT ON STORE_SITE.SUB_ITEMS TO 'regular'@'localhost';



INSERT INTO USERS_ACCCOUNT VALUES
(1,'$2y$10$E.FxChiouNOFkP8hVaNvA.hdNK5gGwmgXRZ5dY3oFYeercG9J7yVi', 'danhpham312@gmail.com',CURRENT_TIMESTAMP, 'A'),
(2,'$2y$10$E.FxChiouNOFkP8hVaNvA.hdNK5gGwmgXRZ5dY3oFYeercG9J7yVi','anthonyle63@csu.fullerton.edu',CURRENT_TIMESTAMP,'R'),
(3,'$2y$10$E.FxChiouNOFkP8hVaNvA.hdNK5gGwmgXRZ5dY3oFYeercG9J7yVi','hecmed@csu.fullerton.edu',CURRENT_TIMESTAMP,'A'),
(4,'$2y$10$E.FxChiouNOFkP8hVaNvA.hdNK5gGwmgXRZ5dY3oFYeercG9J7yVi' ,'allensarmiento@csu.fulleton.edu',CURRENT_TIMESTAMP,'R'),
(5,'$2y$10$E.FxChiouNOFkP8hVaNvA.hdNK5gGwmgXRZ5dY3oFYeercG9J7yVi' ,'test@snax.io',CURRENT_TIMESTAMP,'R');


-- CUSTOMER
-- ORDERING
-- ITEMS
-- SUB_ITEMS
INSERT INTO CUSTOMER VALUES
(1, 3, 'MasterCard'),
(2, 4, 'MasterCard'),
(3, 5, 'MasterCard');

-- ORDER_ID
-- CORDER_ID - user id --- CUSTOMER_ID
-- payment status
-- date purchased

INSERT INTO ORDERING VALUES
(1, 1,'Sure', CURRENT_TIMESTAMP),
(2, 2, 'pass', CURRENT_TIMESTAMP),
(3, 3, 'pass', CURRENT_TIMESTAMP);


INSERT INTO ITEMS VALUES
(1, 1,'CoffeeHut'),
(2, 1,'MojoJojo');


-- SI_NUM (increase by 1)
-- ISI_NUM (product company id)
-- BRAND (name of product)
-- PRICE (price of product)
-- NAME (??? redundant?)
-- STATUS (Available/NotAvailable)
-- QUANTITY (0-10)
INSERT INTO SUB_ITEMS VALUES
(1,1, 'Toffee Coffee', 10, '...', 'available', 100),
(2,1, 'Hazlenut Haze', 11, '...', 'available', 100),
(3,1, 'Coconut Coco', 12, '...', 'available', 100),
(4,1, 'Caramel Cafe', 7, '...', 'available', 100),
(5,1, 'Honey Cup', 8, '...', 'available', 100),
(6,1, 'Pumpkin Latte', 12, '...', 'available', 100),
(7,2, 'Brazilian Coffee', 6, '...', 'available', 100);

-- invoice id
-- subitems id --- SI_NUM the unique subitem number
-- order id ---- CUSTOMER_ID
-- QUANTITY
-- price
-- customer INFO_ID lets make this a hash! or current date is probably smarter and easier
-- total

INSERT INTO INVOICE VALUES
-- "(incrementing unique number, the unique sub items that was purchased, customer id that is created when they register, quantity purchased)"
(1, 2, 2, 3, 11, 'name and some cust', 107, TRUE),
(2, 3, 2, 1, 12, 'more info about the purchase', 107, FALSE),
(3, 4, 1, 3, 13, 'more info', 107, FALSE);

-- "(incrementing unique number, the unique sub item that was purchased, customer id that is created when they register, the qty purchased,
-- the price of the singular item, misc. info, total purchase amount)"

-- select * from invoice where invoice.order_id = 2; (the 2 comes from the $session id in php)
-- select SI_NUM, BRAND, PRICE, QUANTITY from sub_items;

-- The process so far, When a person registers
-- update the user in USERS_ACCCOUNT
-- update user to Customer
-- update user to ORDERING
-- after purchase update INVOICE with values
