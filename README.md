
# Sistema de Inventario - ECOTEC

## 1. Descripción del proyecto

Sistema web de gestión de inventario desarrollado como parte de la Actividad Integradora 3 de Diseño Web de la Universidad ECOTEC.

Permite registrar productos y consultar la información almacenada en una base de datos MySQL/MariaDB.

## 2. Tecnologías utilizadas

- PHP: procesamiento de datos.
- MySQL/MariaDB: base de datos.
- HTML5: estructura de las páginas.
- CSS3: diseño visual y responsivo.
- PDO: conexión segura con MySQL.
- Git y GitHub: control de versiones.
- XAMPP: servidor local.

## 3. Funcionalidades

- Registro de productos.
- Validación de formularios.
- Almacenamiento en MySQL.
- Visualización de productos en una tabla.
- Prevención de inyección SQL mediante sentencias preparadas.
- Protección contra XSS mediante htmlspecialchars().

## 4. Archivos del proyecto

- conexion.php: conexión PDO con la base de datos.
- index.php: página inicial.
- registro.php: formulario para registrar productos.
- listar.php: consulta y visualización de productos.
- db_sistema_web.sql: estructura de la base de datos.
- .gitignore: exclusión de archivos innecesarios.

## 5. Instalación local

1. Instalar XAMPP.
2. Iniciar Apache y MySQL desde XAMPP.
3. Descargar este repositorio desde GitHub.
4. Colocar los archivos del proyecto en:
   C:\xampp\htdocs\AI3_DisenoWeb
5. Abrir http://localhost/phpmyadmin
6. Crear la base de datos db_sistema_web.
7. Importar el archivo db_sistema_web.sql.
8. Verificar la configuración de conexion.php.

En una instalación local típica de XAMPP se utiliza el usuario root sin contraseña. Si la instalación utiliza otras credenciales, deben configurarse mediante variables de entorno.

## 6. Ejecutar el sistema

Página principal:
http://localhost/AI3_DisenoWeb/index.php

Registrar productos:
http://localhost/AI3_DisenoWeb/registro.php

Consultar productos:
http://localhost/AI3_DisenoWeb/listar.php

## 7. Seguridad implementada

El sistema utiliza PDO y consultas preparadas mediante prepare() y execute() para reducir el riesgo de inyección SQL.

También utiliza htmlspecialchars() para codificar datos antes de mostrarlos en HTML, reduciendo el riesgo de ataques XSS.

La conexión utiliza try-catch para controlar errores sin mostrar detalles técnicos sensibles al usuario.

## 8. Control de versiones

El desarrollo se documenta mediante commits en GitHub, permitiendo revisar los cambios realizados en la base de datos, la conexión, los formularios y las vistas.

## 9. Información académica

Universidad: ECOTEC

Carrera: Sistemas Inteligentes

Asignatura: Diseño Web

Estudiante: Melany Arcos

Proyecto: Actividad Integradora 3

## 10. Repositorio público

https://github.com/innovaai01-coder/AI3_DisenoWeb_MelanyArcos
