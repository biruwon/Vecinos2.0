                                                                     
                                                                     
                                                                     
                                             

Instalación de la aplicación Vecinos 2.0


*Requisitos previos*

  Para la correcta instalación de la aplicación, se recomienda usar el sistema operativo Linux.
  Se requiere también en el sistema php, apache2, mysql y el uso de Git.
  Por otra parte, se hace uso uso de algunas extensiones php, las cuales se pueden instalar 
  mediante el comando pecl: openssl, apc, intl, pdo_mysql y OAuth.

  Ej: pecl install apc
  


1. Crea un directorio en tu servidor web para guardar el código de la aplicación: 

  mkdir /proyectos/Vecinos2.0

2. Descarga la aplicación clonando con Git su repositorio oficial. 
   Si no se tiene Git instalado hay un apartado explicando su funcionamiento en la documentación:

  git://github.com/biruwon/Vecinos2.0.git

3. Accede al directorio de la aplicación:

  cd Vecinos2.0 

4. Descarga los vendors 

  php bin/vendors install 

5. Configura bien tu servidor web para que se pueda acceder a la aplicación desde el directorio Vecinos2.0 
   en el que se ha instalado:

  5.1. Si el proyecto real se alojara en vecinos.com, el dominio local podría ser vecinos.local. 
  Configura el dominio ficticio vecinos.local añadiendo la siguiente línea en el archivo:

  127.0.0.1 vecinos.local 

  5.2. A continuación, configura en tu servidor web un host virtual asociado a este dominio ficticio para poder 
  ejecutar el proyecto en local. Añade en el archivo de configuración de Apache lo siguiente: 
  
  <VirtualHost *:80> 
  DocumentRoot "/proyectos/Vecinos2.0/web" 
  DirectoryIndex app.php 
  ServerName vecinos.local 
  <Directory "/proyectos/Vecinos2.0/web"> 
  AllowOverride All 
  Allow from All 
  </Directory> 
  </VirtualHost> 

  5.3. Guarda los cambios, reinicia el servidor web y accede a la URL:

  http://vecinos.local/app_dev.php 

Ejecuta los siguientes comandos desde dentro del directorio de la aplicación: 

1. Crea una nueva base de datos para la aplicación y configura sus datos de acceso (usuario, contraseña, host) 
   en el archivo de configuración app/config/parameters.ini. Puedes crear la base de datos manualmente o con 
   el comando: 

  php app/console doctrine:database:create

2. Crea el esquema de la base de datos:

  php app/console doctrine:schema:create
 
3. Carga los datos de prueba:
  
  php app/console doctrine:fixtures:load
 
4. Genera los web assets con Assetic:

  php app/console assetic:dump --env=prod --no-debug. 

  Si se produce un error al ejecutar este comando, debes activar la cache APC en tu servidor web.

5. Asegúrate de que los directorios web/*, app/cache/* y app/logs/* tienen permisos de escritura:

  chmod -R 777 web/ app/cache/ app/logs/

Una vez hecho esto, tenemos la aplicación lista con unos usuarios cargados de prueba.
Para acceder como administrador:

  email: usuario0@localhost.com
  password: usuario0

Para acceder como usuario:

  email: usuarioN@localhost.com
  password: usuarioN

  Donde N puede ser un número comprendido entre 1 y 20