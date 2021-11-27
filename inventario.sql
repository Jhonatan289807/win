DROP DATABASE inventario;
CREATE DATABASE inventario;
USE inventario;
CREATE TABLE IF NOT EXISTS tbl_user
(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
user VARCHAR(20) NOT NULL,
user_cod VARCHAR(20) NOT NULL,
user_pass VARCHAR(300) NOT NULL,
user_phone INT NOT NULL,
type_user INT NOT NULL 
);
CREATE TABLE IF NOT EXISTS tbl_prod
(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
prod VARCHAR(50) NOT NULL,
cant INT NOT NULL
);
CREATE TABLE IF NOT EXISTS tbl_ont_mesh
(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
tipo_prod_fk INT NOT NULL,
serie01 VARCHAR(100) NOT NULL,
serie02 VARCHAR(100) NOT NULL,
modelo VARCHAR(100) NOT NULL,
id_estado_fk INT,
FOREIGN KEY (tipo_prod_fk) REFERENCES tbl_prod(id)
);
CREATE TABLE IF NOT EXISTS tbl_estado
(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
tipo_estado VARCHAR(20)
);
CREATE TABLE IF NOT EXISTS tbl_pedido
(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_user_fk INT NOT NULL,
fecha DATE NOT NULL,
hora TIME NOT NULL,
id_estado_fk INT NOT NULL,
FOREIGN KEY (id_user_fk) REFERENCES tbl_user(id),
FOREIGN KEY (id_estado_fk) REFERENCES tbl_estado(id)
);
CREATE TABLE IF NOT EXISTS tbl_ped_detall
(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_ped_fk INT NOT NULL,
tipo_prod_fk INT NOT NULL,
cantidad INT NOT NULL,
FOREIGN KEY (id_ped_fk) REFERENCES tbl_pedido(id),
FOREIGN KEY (tipo_prod_fk) REFERENCES tbl_prod(id)
);
CREATE TABLE tbl_entrega_ontmesh(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_det_fk INT NOT NULL,
id_ont_mesh_fk INT NOT NULL,
fecha_entrega DATE,
id_estado_fk INT,
fecha_liquido DATE,
FOREIGN KEY (id_det_fk) REFERENCES tbl_ped_detall(id)
);
CREATE TABLE tbl_entrega_otros(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_det_fk INT NOT NULL,
fecha_entrega DATE,
FOREIGN KEY (id_det_fk) REFERENCES tbl_ped_detall(id)
);
CREATE TABLE tbl_equip_disp(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_prod_fk INT NOT NULL,
id_user_fk INT NOT NULL,
cant_disp INT NOT NULL,
FOREIGN KEY (id_prod_fk) REFERENCES tbl_prod(id),
FOREIGN KEY (id_user_fk) REFERENCES tbl_user(id)
);
CREATE TABLE cod_user(
cod INT NOT NULL PRIMARY KEY
);
CREATE TABLE tbl_liquidacion_otros(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
fecha_liquid DATETIME,
id_disp_fk INT NOT NULL,
cant_liquid INT NOT NULL,
cant_rest INT NOT NULL,
FOREIGN KEY (id_disp_fk) REFERENCES tbl_equip_disp(id)
);
INSERT INTO cod_user(cod) VALUES (2);
INSERT INTO tbl_user (user,user_cod,user_pass,user_phone,type_user) VALUES ('Administrador','U0001','$2y$10$JqCPr7TGC.l5UpgDrqC/8uS52woEDULxX2iugQetlETnseeajgNwe',9999,1);
INSERT INTO tbl_estado (tipo_estado) VALUES("Pendiente");
INSERT INTO tbl_estado (tipo_estado) VALUES("Entregado");
INSERT INTO tbl_estado (tipo_estado) VALUES("Disponible");
INSERT INTO tbl_estado (tipo_estado) VALUES("No disponible");
INSERT INTO tbl_estado (tipo_estado) VALUES("En proceso");
INSERT INTO tbl_estado (tipo_estado) VALUES("Liquidado");
INSERT INTO tbl_prod(prod,cant) VALUES ('ONT',100);
INSERT INTO tbl_prod(prod,cant) VALUES ('MESH',100);
INSERT INTO tbl_prod(prod,cant) VALUES ('FIBRA',100);
INSERT INTO tbl_prod(prod,cant) VALUES ('ROSETA',100);
INSERT INTO tbl_prod(prod,cant) VALUES ('PATCHCORD',100);
INSERT INTO tbl_prod(prod,cant) VALUES ('CONECT OPT',100);
INSERT INTO tbl_prod(prod,cant) VALUES ('TEMPLADOR',100);
INSERT INTO tbl_prod(prod,cant) VALUES ('GRAPAS',100);
INSERT INTO tbl_prod(prod,cant) VALUES ('CLLO AMARRE',100);
INSERT INTO tbl_prod(prod,cant) VALUES ('1/2 TRAMO',100);
INSERT INTO tbl_prod(prod,cant) VALUES ('CLEVIS',100);
INSERT INTO tbl_prod(prod,cant) VALUES ('AISLADOR',100);
INSERT INTO tbl_prod(prod,cant) VALUES ('CINTA BMT',100);
INSERT INTO tbl_prod(prod,cant) VALUES ('EVILLA',100);
INSERT INTO tbl_prod(prod,cant) VALUES ('CINTA 2 CONT',100);
INSERT INTO tbl_prod(prod,cant) VALUES ('TARUGO',100);
INSERT INTO tbl_prod(prod,cant) VALUES ('TORNILLO',100);
INSERT INTO tbl_prod(prod,cant) VALUES ('CINTA ASL',100);
INSERT INTO tbl_prod(prod,cant) VALUES ('ARGOLLA',100);
USE inventario;
