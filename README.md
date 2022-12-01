# Pizza-php development

### Configuration ###

- NodeJS https://nodejs.org/en/
- Composer https://getcomposer.org/

1. Clone the project

2. Go to the folder application using cd command on your cmd or terminal

3. Run ```composer install --ignore-platform-reqs```

4. Open your config/config.php file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.

5. Import pizza.sql

### Recommended development hosting ###

1. Go to your xampp extra folder. Ex.: D:\xampp\apache\conf\extra
2. Open httpd-vhosts.conf
3. Add: ```<VirtualHost *:80> ServerName pizza.test DocumentRoot "path to project" <Directory "path to project">
   DirectoryIndex index.php
   AllowOverride All
   Order allow,deny
   Allow from all
   </Directory>
   </VirtualHost>```
4. Open C:\Windows\System32\drivers\etc
5. Add ```127.0.0.1 pizza.test```
6. Restart xampp and go to http://pizza.test in a browser

### Login ###

Login URL: /login

##### Default credentials
##### `email: admin@admin.com`
##### `password: admin`


