CREATE DATABASE BD_CONTACTOS;

USE BD_CONTACTOS;

CREATE TABLE USUARIO
(
    USU_CVE 				INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ROL_CVE 				INT NOT NULL,
    USU_NOMBRE 				NVARCHAR(50) NOT NULL,
    USU_APEP	 			NVARCHAR(50) NOT NULL,
    USU_APEM		 		NVARCHAR(50) DEFAULT NULL,
    USU_USUARIO 			NVARCHAR(50) NOT NULL,
    USU_TELEFONO			NVARCHAR(50) NOT NULL,
	USU_FOTO				NVARCHAR(250) DEFAULT NULL,
    USU_ESTATUS				INT,
    USU_FECHA_REG 			TIMESTAMP
);

CREATE TABLE ROL (
    ROL_CVE			 	INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ROL_DESCRIPCION 	NVARCHAR(100),
    ROL_PERMISOS 		NVARCHAR(250),
    ROL_FECHA_REGI 		TIMESTAMP
);

CREATE TABLE PRODUCTO (
  PRO_ID			INT(11) 	NOT NULL PRIMARY KEY AUTO_INCREMENT,
  USU_CVE	  		INT(11) 	NOT NULL,
  PRO_NOMBRE 		VARCHAR(45) NOT NULL,
  PRO_DESCRIPCION 	VARCHAR(255) DEFAULT NULL,
  PRO_PRECIO 		INT(11) 	NOT NULL,
  PRO_CANTIDAD 		INT(11) 	NOT NULL,
  PRO_ACTIVO 		INT(4) 		NOT NULL,
  PRO_FOTO 			VARCHAR(255) DEFAULT NULL,
  PRO_FECHA_REG		TIMESTAMP NOT NULL
);

INSERT INTO ROL values(null,'Administrador','Todos',now());
INSERT INTO ROL values(null,'Supervisor','Algunos',now());
INSERT INTO ROL values(null,'Operativo','Algunos',now());

INSERT INTO USUARIO values(null,1,'Mario','Batali','Ferrusco','mbatali','7710000000','imagenes/usuarios/1.jpg',1,now());
INSERT INTO USUARIO values(null,2,'Cat','Cora','James','ccora','7710000000','imagenes/usuarios/2.jpg',1,now());

INSERT INTO PRODUCTO VALUES
(NULL,1, 'Burrito', 'Rellenos de queso cheddar y chorizo', 25, 15, 1, 'imagenes/productos/burrito.jpg',NOW()),
(NULL,2, 'Tacos', 'Pastor y Bistec', 12, 25, 1, 'imagenes/productos/taco.jpg',NOW()),
(NULL,1, 'papas', 'de chipotle y con sal', 10, 6, 1, 'imagenes/productos/papas.jpg',NOW()),
(NULL,2, 'Burriti', 'Campechano ', 18, 7, 0, 'imagenes/productos/La.png',NOW()),
(NULL,1, 'Chilaquiles', 'Muy sabrosos, ', 15, 9, 1, 'imagenes/productos/chilaquiles.jpg',NOW()),
(NULL,2, 'Refrescos', 'sabrosos', 11, 9, 1, 'imagenes/productos/refresco.jpg',NOW()),
(NULL,1, 'Chips mini', 'Frituras con chile y limon', 5, 7, 1, 'imagenes/productos/chip.jpg',NOW());

-- -----------------------------------------------------------------------
-- -----------------------------------------------------------------------
-- CONSULTAS SQL

-- Consulta del stock -> spMostrarProductos

DELIMITER //

CREATE PROCEDURE sp_MostrarProductos(IN cveProducto INT)
BEGIN
    SELECT  
        A.PRO_ID AS CLAVE, 
        A.USU_CVE AS CVE_USU, 
        A.PRO_NOMBRE AS PRODUCTO, 
        A.PRO_PRECIO AS COSTO, 
        A.PRO_FOTO AS FOTO_PRO, 
        A.PRO_DESCRIPCION AS DESCRIPCION,
        CONCAT(B.USU_NOMBRE, ' ', B.USU_APEP, ' ', COALESCE(B.USU_APEM, '')) AS USUARIO,
        B.USU_USUARIO AS ALIAS, 
        B.USU_TELEFONO AS TELEFONO, 
        B.USU_FOTO AS FOTO,
        A.PRO_CANTIDAD AS EXISTENCIAS
    FROM PRODUCTO A
    INNER JOIN USUARIO B ON A.USU_CVE = B.USU_CVE
    WHERE A.PRO_ID = cveProducto;
END //

DELIMITER ;
-- Se tiene el, parámetro -> cveProducto
SELECT  A.PRO_ID CLAVE, A.USU_CVE CVE_USU, 
    A.PRO_NOMBRE PRODUCTO,A.PRO_PRECIO COSTO, A.PRO_FOTO FOTO_PRO, 
    A.PRO_DESCRIPCION DESCRIPCION,CONCAT(B.USU_NOMBRE,' ',B.USU_APEP,' ',B.USU_APEM) USUARIO,
    B.USU_USUARIO ALIAS, B.USU_TELEFONO TELEFONO, B.USU_FOTO FOTO
    FROM PRODUCTO A, USUARIO B
    WHERE A.PRO_ID=cveProducto
    AND   A.USU_CVE=B.USU_CVE;


-- Consulta del stock -> spCartaPedidos
-- No tiene parámetros
SELECT  A.PRO_ID CLAVE, A.USU_CVE CVE_USU, 
        A.PRO_NOMBRE PRODUCTO,A.PRO_PRECIO COSTO, A.PRO_FOTO FOTO_PRO, 
        A.PRO_DESCRIPCION DESCRIPCION,CONCAT(B.USU_NOMBRE,' ',B.USU_APEP,' ',B.USU_APEM) USUARIO,
        B.USU_USUARIO ALIAS, B.USU_TELEFONO TELEFONO, B.USU_FOTO FOTO
        FROM PRODUCTO A, USUARIO B
        WHERE A.USU_CVE=B.USU_CVE;

-- ----------------------------------------------------------------------
-- Ejecutar el procedimiento almacenado para probar consulta de datos

select * from producto;

CREATE VIEW vwRptArticulos AS
SELECT 
    p.PRO_ID as clave,
    p.PRO_NOMBRE as nombre,
    p.PRO_DESCRIPCION as descripcion,
    p.PRO_CANTIDAD as existencias,
    p.PRO_PRECIO as precio,
    p.PRO_FOTO as foto,
    'Standard' as modelo,  -- Valor por defecto ya que no existe en tu tabla
    'Comida' as familia    -- Valor por defecto ya que no existe en tu tabla
FROM PRODUCTO p
WHERE p.PRO_ACTIVO = 1;