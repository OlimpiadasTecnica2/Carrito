# OLIMPÍADA NACIONAL DE ETP 2025 

## E.E.S.T N°2
## Tecnicatura: Programacion
### Integrantes
- Salvador Avalos (Jefe)
- Gabriel Solotorevsky (Analista)
- Denis Aguero (Diseñadora)
- Paola irigoitia (Programadora)
- Merlini Nicolas (Programador)

### Introduccion:
Nuestro cliente es una compañía de comercialización de paquetes turísticos nacionales e internacionales para pasajeros individuales, familias y grupos de pasajeros, sus productos son:
- Estadías
- Pasajes aéreos
- Alquiler de auto
- Paquetes con todo el servicio

### Alcances:
El programa tendrá el siguiente alcance:
- Recopilación de productos, con precios, nombres e imágenes y elección de cantidad variable para el siguiente alcance.
- Calculo de subtotales y totales con los productos elegidos.
- Compra con tarjeta de débito, crédito, transferencia.
- Posibilidad de acreditar un consumidor final diferente al comprador.
- Factura enviado por correo electrónico al comprador y al sector de la empresa responsable
- Facturas guardadas y accesibles por usuarios
- Facturas (Pedidos) cancelables, con la posibilidad de modificación y confirmación
- Capacidad de recordar el login del usuario y sus datos
- Registro, Login y Logout
- Cuenta de administrador con acceso a Alta, Baja y consulta de productos.
- Cuenta de administrador con acceso a ABMC de facturas de todos los usuarios.
#### El programa NO realizara lo siguiente:
- Automatización de revisiones de facturas
- Manejo de los datos específicos de las estadías.
- Manejo de reclamos, devoluciones, etc.
- Manejo de finanzas.

### Compilacion
##### Debug:
#### Dependencias:
- SSMTP / MSTP
- PHP
#### Lanzamiento:
```
php -S 127.0.0.1:8000
```

##### Release:
#### Dependencias:
- MSTP
- Docker
#### Lanzamiento:
```
docker build -t server . && docker run -p 80:8080 server
```

