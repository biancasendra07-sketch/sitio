# Puesta en marcha

El sitio requiere PHP 8.1 o posterior, MySQL/MariaDB y la extensión PDO para MySQL.

1. Copiá la carpeta del sitio al directorio web de XAMPP, por ejemplo `htdocs/sitio`.
2. Iniciá Apache y MySQL desde XAMPP.
3. Importá `basededatos.sql` en phpMyAdmin. Si ya tenés la base cargada, agregá el índice único de correo con:

   ```sql
   USE crepusculo;
   ALTER TABLE usuarios MODIFY email VARCHAR(255) NOT NULL;
   ALTER TABLE usuarios ADD UNIQUE KEY usuarios_email_unique (email);
   ```

4. Si MySQL no usa `127.0.0.1`, base `crepusculo`, usuario `root` y contraseña vacía, configurá las variables `DB_HOST`, `DB_NAME`, `DB_USER` y `DB_PASSWORD` en el entorno de PHP.
5. Abrí `http://localhost/sitio/`, creá una cuenta y luego iniciá sesión.

Las páginas internas requieren una sesión. El buscador de personajes usa la tabla `personajes`; las imágenes se asignan a partir de los archivos de `imagenes/`.
