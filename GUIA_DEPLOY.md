# Deploy infinityfree

> composer install --optimize-autoloader --no-dev 
- si no tenemos la carpeta node_modules usamos:
 npm install
- ahora solo resta:
>   npm run production


- subir todos los archivos vía ftp con filezilla a una carpeta llamada laravel dentro de la carpeta
> htdocs
- y en la raiz de esta carpeta subir la carpeta public (se genero con el npm run)

> ahora ir al archivo index y cambiar todos los /../ por /laravel/

- cambiar estos valores en el env del servidor:
DB_HOST=sql212.infinityfree.com
DB_PORT=3306
DB_DATABASE=if0_34545861_hostal_star
DB_USERNAME=if0_34545861
DB_PASSWORD=p4YHLMWbHUiQOBI 

- como no se puede hacer un migrate se exporta la base de datos ya con las migraciones
>   nos vamos a phpmyadmin, en la base de datos, la exportamos, 
>   ahora vamos a la base de datos del servidor y la importaoms

## Cuando ejecutamos en local 
>   npm run development

## No funciona el comando migrate desde route
- entramos a sql directo y agregamos la sentencia en crudo

> ALTER TABLE rents ADD COLUMN pay_type varchar(20) null AFTER money_deposit

- tmb podemos agrearle un dato por default, para evitar llenar mas
> ALTER TABLE rents ADD COLUMN pay_type varchar(20) null default 'semanas' AFTER money_deposit