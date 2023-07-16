-- create database
DROP SCHEMA IF EXISTS productodesayuno;
CREATE SCHEMA productodesayuno;
USE productodesayuno;



-- create roles
DROP TABLE IF EXISTS lcga_role;
CREATE TABLE lcga_role
(
    id   INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    CONSTRAINT role__name_uindex UNIQUE (name)
);
-- insert default roles
INSERT INTO lcga_role (name) VALUES ('admin');
INSERT INTO lcga_role (name) VALUES ('super-admin');




-- create user table
DROP TABLE IF EXISTS lcga_user;
CREATE TABLE lcga_user
(
    id    INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    name  VARCHAR(255) NOT NULL,
    pass  VARCHAR(255) NOT NULL,
    role  INT          NOT NULL,
    CONSTRAINT user__role__id_fk FOREIGN KEY (role) REFERENCES lcga_role (id)
);
-- insert default users
INSERT INTO lcga_user (email, name, pass, role) VALUES ('andres@almacen.com', 'Andres', 'change me', 1); -- admin
INSERT INTO lcga_user (email, name, pass, role) VALUES ('simone.celia@simonecelia.it', 'Simone Celia', 'change me', 2); -- super-admin




-- create super_category table
# DROP TABLE IF EXISTS lcga_super_category;
# CREATE TABLE lcga_super_category
# (
#     id   INT AUTO_INCREMENT PRIMARY KEY,
#     name VARCHAR(255) NOT NULL
# );
# -- insert default super category
# INSERT INTO lcga_super_category (name) VALUES ('sin super categoría');




-- create category table
DROP TABLE IF EXISTS lcga_category;
CREATE TABLE lcga_category
(
    id   INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
#     super_category INT NOT NULL,
#     CONSTRAINT category__super_category__id_fk FOREIGN KEY (super_category) REFERENCES lcga_super_category (id)
);
-- insert default categories
INSERT INTO lcga_category (name) VALUES ('vinos');
INSERT INTO lcga_category (name) VALUES ('whisky');
INSERT INTO lcga_category (name) VALUES ('aguas de la vida');
INSERT INTO lcga_category (name) VALUES ('ron');
INSERT INTO lcga_category (name) VALUES ('gin');
INSERT INTO lcga_category (name) VALUES ('vodka');
INSERT INTO lcga_category (name) VALUES ('tequila');
INSERT INTO lcga_category (name) VALUES ('refrescos');
INSERT INTO lcga_category (name) VALUES ('brandy y cognac');
INSERT INTO lcga_category (name) VALUES ('licores');



-- create table period
DROP TABLE IF EXISTS lcga_period;
CREATE TABLE lcga_period
(
    id     INT AUTO_INCREMENT PRIMARY KEY,
    start  TIMESTAMP        NULL,
    end    TIMESTAMP        NULL,
    actual BIT DEFAULT b'1' NOT NULL
);
-- insert default value
INSERT INTO lcga_period (start, end, actual) VALUES ('2022-01-13 21:43:56', NULL, TRUE);




-- supplir
DROP TABLE IF EXISTS lcga_supplier;
CREATE TABLE lcga_supplier
(
    id   INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);
-- defaults
INSERT INTO lcga_supplier (id, name) VALUES (1, 'sin proveedor');




-- table product
DROP TABLE IF EXISTS lcga_product;
CREATE TABLE lcga_product
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
        FOREIGN KEY (category) REFERENCES lcga_category (id),
    constraint product_period_id_fk
        FOREIGN KEY (period) REFERENCES lcga_period (id)
            ON DELETE CASCADE,
    CONSTRAINT product_supplier_id_fk
        FOREIGN KEY (supplier) REFERENCES lcga_supplier (id)
);
-- defaults
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('anna de codorniu blanc de blancs', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('anna de codorniu rosé', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('anna ice edition', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('juvé camps reserva familia bn', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('ars collecta blanc de noirs', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('gran juvé camps brut', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('jaume de codorniu gran reserva', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('pere ventura vintage', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('recaredo terrers brut nature', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('waltraud', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('jean leon viña gigi', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('anec mut', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('xino xano', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('ermita d''espiells', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('natureo', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('moustillant de gramona', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('gramona gessami', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('can bas la romana', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('rebels de batea', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('reforjat', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('tina 20', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('castell raimat', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('ànima de raimat', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('viñas de anna', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('la duda', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('godeval cepas vellas', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('legaris', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('la charla', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('josè pariente', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('belondrade y lurton', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('añares terra nova', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('martin códax', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('mar de frades', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('leiras', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('martin códax arousa', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('viña pomal selecció cent.', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('viña ardanza reserva', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('ramon bilbao ed. limitada', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('muga crianza', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('muga prado enea', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('montecillo edición limitada', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('marqués de vargas reserva', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('pago de los capellanes crianza', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('legaris roble', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('aalto', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('pago de carraovejas crianza', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('alion', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('vega sicilia valbueno 5° año', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('flor de pingus', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('tino pesquera crianza', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('psi', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('mauro', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('purgatori', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('raimat', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('jean leon 3055', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('jean leon la scala gran reserva', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('el pispa', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('octubre', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('somiadors', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('intramurs', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('merum priorati desti', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('pazo san mauro', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('fefiñanes', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('pascal jolivet attitude', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('fiocco di vite', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('domaine nathalie', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('miraval', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('whispering ángel', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('bouchard beaune du cháteau premier cru.', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('moustillant de gramona' , 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('augustus rose', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('chivite las fincas rose', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('viñas de anna rosat', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('moët chandon brut imperial', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('moët chandon rose imperial', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('moët ice', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('ruinart blanc de blancs', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('bollinger special cuvée', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('laurent perrier cuvée rosé', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('piper heidsieck', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('veuve clicquot brut', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('dom perignon', 1, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('dewars''s white label', 2, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('dewars''s 8 años caribbean smooth', 2, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('dewars''s 12 años', 2, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('dewars''s 15 años', 2, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('ballantines''s', 2, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('the famous grouse', 2, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('johnnie walker etiqueta negra', 2, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('chivas 12', 2, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('cardhu', 2, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('highland park 12', 2, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('glenrothers', 2, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('macallan 12', 2, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('four roses', 2, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('jack daniel''s', 2, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('licor de hierbas el afilador', 3, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('licor sin alcohol', 3, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('limoncello villa massa', 3, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('licor de manzana o melocotón', 3, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('grappa nonino', 3, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('orujo blanco', 3, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('crema de orujo', 3, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('marc de cava', 3, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('marc de champagne', 3, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('calvados', 3, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('licor de crema catalana', 3, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('frangelico', 3, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('patxaran', 3, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('jagermeister', 3, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('bacardí carta blanca', 4, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('bacardí 8 años', 4, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('santa teresa gran reserva', 4, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('santa teresa 1796', 4, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('brugal', 4, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('barceló añejo', 4, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('brugal extra viejo', 4, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('habana club 7 años', 4, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('barceló imperial', 4, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('zacapa 23 años', 4, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('bombay dry', 5, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('bombay bramble', 5, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('bombay citron pressé', 5, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('bombay sapphire', 5, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('puerto de indias', 5, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('bulldog', 5, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('london n 1', 5, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('london n 3', 5, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('sipsmith', 5, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('martin miller''s', 5, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('masters', 5, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('finest tangerines gold', 5, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('roku', 5, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('nordes', 5, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('hendrick''s', 5, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('gin gold', 5, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('gin mare', 5, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('oxley', 5, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('g''vine florasion', 5, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('brockmans', 5, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('monkey 47', 5, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('erisoff', 6, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('stolichnaya', 6, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('absolut', 6, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('grey goose', 6, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('roberto cavalli', 6, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('patrón silver', 7, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('patrón reposado', 7, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('carlos III', 9, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('magno', 9, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('torres V', 9, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('torres X', 9, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('mascaro', 9, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('carlos I', 9, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('duque de alba', 9, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('lepanto', 9, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('cardenal mendoza', 9, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('larios 1866', 9, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('saint vivant armagnac', 9, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('calvados', 9, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('malibu', 10, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('amaretto disaronno', 10, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('tía maría', 10, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('cointreau', 10, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('anís del mono', 10, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('marie brizard', 10, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('baileys', 10, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('drambuie', 10, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('grand marnier rojo', 10, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('bonet', 10, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('calisay', 10, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('ponche caballero', 10, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('crema de cassis', 10, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('chartruesse amarillo', 10, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('chartruesse verde', 10, 1, 1);
INSERT INTO lcga_product (name, category, supplier, period) VALUES ('licor 43', 10, 1, 1);




-- table operation
DROP TABLE IF EXISTS lcga_operation;
CREATE TABLE lcga_operation
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    user_       INT                                   NOT NULL,
    timestamp   TIMESTAMP DEFAULT current_timestamp() NOT NULL ON UPDATE current_timestamp(),
    product     INT                                   NULL,
    description VARCHAR(255)                          NULL,
    CONSTRAINT operation_product_id_fk
        FOREIGN KEY (product) REFERENCES lcga_product (id)
            ON DELETE SET NULL,
    CONSTRAINT operation_user__id_fk
        FOREIGN KEY (user_) REFERENCES lcga_user (id)
);


