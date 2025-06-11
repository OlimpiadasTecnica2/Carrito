CREATE TABLE IF NOT EXISTS usuarios (id INTEGER PRIMARY KEY, titular TEXT, email TEXT, contraseña TEXT, numero_tarjeta INTEGER, fecha_vencimiento INTEGER, cvv INTEGER, direccion TEXT);
CREATE TABLE IF NOT EXISTS productos (id INTEGER PRIMARY KEY, nombre TEXT, descripcion TEXT, imagen TEXT, precio NUMBER);
CREATE TABLE IF NOT EXISTS carrito (id_usuario INTEGER, id_producto INTEGER, cantidad INTEGER);

INSERT INTO productos(nombre,descripcion,imagen,precio) VALUES ('Estadia','Estadia nacional o internacional','/public/img/estadia.png',1300);
INSERT INTO productos(nombre,descripcion,imagen,precio) VALUES ('Pasajes Aereos','Estadia nacional o internacional','/public/img/estadia.png',1500);
INSERT INTO productos(nombre,descripcion,imagen,precio) VALUES ('Alquiler de auto','Estadia nacional o internacional','/public/img/estadia.png',1600);
INSERT INTO productos(nombre,descripcion,imagen,precio) VALUES ('Todo incluido','Estadia nacional o internacional','/public/img/estadia.png',2000);
