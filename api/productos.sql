CREATE TABLE IF NOT EXISTS usuarios (id INTEGER PRIMARY KEY, titular TEXT, email TEXT, contraseña TEXT, numero_tarjeta INTEGER, fecha_vencimiento INTEGER, cvv INTEGER, direccion TEXT);
CREATE TABLE IF NOT EXISTS facturas (id INTEGER PRIMARY KEY, id_usuario INTEGER, fecha DATETIME DEFAULT CURRENT_TIMESTAMP, estado TEXT);
CREATE TABLE IF NOT EXISTS ventas (id_factura INTEGER, id_producto INTEGER, cantidad INTEGER);
CREATE TABLE IF NOT EXISTS productos (id INTEGER PRIMARY KEY, nombre TEXT, descripcion TEXT, imagen TEXT, precio NUMBER);
CREATE TABLE IF NOT EXISTS carrito (id_usuario INTEGER, id_producto INTEGER, cantidad INTEGER);

INSERT INTO productos(id,nombre,descripcion,imagen,precio) VALUES (1,'Estadia','Pasión por el arte, la historia y la buena vida. Recorré Roma, Venecia y Florencia entre ruinas antiguas, callecitas encantadoras y sabores inolvidables. 🍝 Incluye: alojamiento céntrico, tours culturales, clases de cocina italiana y traslados.','/pages/assets/img/inglaterra.mp4',1300);
INSERT INTO productos(id,nombre,descripcion,imagen,precio) VALUES (2,'Pasajes Aereos','','/pages/assets/img/Italy.mp4',1500);
INSERT INTO productos(id,nombre,descripcion,imagen,precio) VALUES (3,'Alquiler de auto','','/pages/assets/img/noruega.mp4',1600);
INSERT INTO productos(id,nombre,descripcion,imagen,precio) VALUES (4,'Todo incluido','','/pages/assets/img/inglaterra.mp4',2000);
