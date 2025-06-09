docker build -t php_server .
docker run -p 80:8080 -v ./:/var/www/html php_server