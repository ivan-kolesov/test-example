# Installation guide

## Requirements
- PHP 5.5.16 or higher
- MySQL 5.5 or higher
- http servers are: Apache with `mod_rewrite` module enabled or Nginx

## Configuring database

- Create a MySQL database from `database-dump.sql` file 
- Make copy of `app/config/database-example.php` file to `app/config/database.php`
- Set `dsn`, `username`, `password` parameters in `app/config/database.php` according the created database

## Configuring folders

- Set permission 0775 to `public/uploads` directory

## Configuring web server

- Set `public` directory as document root

- On Apache:
    - create `.htaccess` file into `public` directory with following rules:  
        Options +FollowSymLinks  
        RewriteEngine On  
       
        RewriteCond %{REQUEST_FILENAME} !-d  
        RewriteCond %{REQUEST_FILENAME} !-f  
        RewriteRule ^ index.php [L]  

- On Nginx:
    - add following directives to your config:  
        location / {  
            try_files $uri $uri/ /index.php?$query_string;  
        }