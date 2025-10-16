# Mi web de contactos - Samuel Aded
Aplicación de agenda de contactos con Symfony
### Instalación de las carpetas `/var` y `/vendor` (*composer*)
Para instalar composer hay que ejecutar este comando:
```
composer install
```
### Comandos necesarios para la gestión y la creación de entidades y controladores, además de formularios y más.
1. Crear entidad
```
php bin/console make:entity
```
2. Migrar cambios en la base de datos
```
php bin/console make:migration
```
3.
```
php bin/console doctrine:make:migration
```
O también:
```
php bin/console d:m:m
```
4. Crear el proyecto
```
composer create-project symfony/skeleton:"6.4.*" symphony-contactos
```
5. Crear el primer controlador
```
php bin/console make:controller PageController
```
6. Levantar el servidor
Para levantar el servidor debemos ir a la carpeta `/public` 
```
php -S localhost:8080
```
O también:
```
php -S 127.0.0.1:8080
```
7.