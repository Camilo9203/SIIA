# SIIA (Sistema Integrado de Información de Acreditación) - Unidad Administrativa de Organizaciones Solidarias

El SIIA es el sistema de acreditacion de Organizaciones Solidarias para que entidades/organizaciones como cooperativas en el “tramite” de solicitud de la Acreditación, la aplicación SIIA se creó desde cero para no solamente dar la parte del trámite sino poder obtener más información, como la de las organizaciones históricas, el informe de actividades, el módulo de docentes, reportes entre otros.

## Empezando

Estas instrucciones le permitirán obtener una copia del proyecto en funcionamiento en su máquina local para fines de desarrollo y prueba. Consulte la implementación para obtener notas sobre cómo implementar el proyecto en un sistema en vivo.

### Prerequisitos

Qué cosas necesitas para instalar el software y cómo instalarlas:

Actulizar Sistema Operativo

```
# apt-get update
# apt-get dist-upgrade ó upgrade
```

Apache - Ubuntu >= 16.04 LTS

```
# apt-get install apache2
```

MySQL 
```
# apt-get install mysql-server
```

PHP >= 7.0 - Ubuntu >= 16.04 LTS

```
Ejemplo versiones = php7.x-dev

# apt-get install php7.0 
# apt-get install php-mysql php-curl php-gd php-pear php-imagick php-imap php-mcrypt php-memcache php-pspell php-recode php-snmp php-tidy php-xmlrpc php-xsl php-dev -y
# apt-get install php libapache2-mod-php
# php --version
```

Activar modulos - Ubuntu >= 16.04 LTS

```
# a2enmod headers
# a2enmod expires
# a2enmod rewrite
# a2enmod ssl > Si es necesario para dominios con SSL.
```

Si es necesario instalar Git

```
# apt-get install git
```

### Instalando

Una serie de ejemplos paso a paso que indican que debe ejecutar un entorno de desarrollo - Ubuntu >= 16.04 LTS

Activar MultiViews en Apache

```
# nano /etc/apache2/sites-available/000-default.conf 

<Directory /var/www/html/>
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Order allow,deny
        allow from all
</Directory>

Guardar y salir.

# service apache2 restart
```

Cambiando el nombre del directorio a SIIA

```
# cd /var/www/html/
# mv sia_org_solidarias siia
```

Cambiando de branch en git para pruebas

```
# cd /var/www/html/siia
# git branch dev
```

## Corriendo el proyecto - Dev

CodeIgniter requiere hacer (si existe omitir el paso)

```
# cd /var/www/html/siia/
# nano index.php
	Editar la linea 56.
		define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'production');
	a
		define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'testing');

	Guardar y salir.
```

Ejecutar bash para los folder de uploads


```
# cd /var/www/html/siia/
# sh FOLDERS_SIIA.sh
```

Crear base de datos limpia en MySQL

```
# mysql -u root -p
> create database siia;
> exit;
# mysql siia < /var/www/html/siia/siiaRecursos/siia_clean.sql
# mysql -u root -p
> use siia;
> ALTER TABLE administradores AUTO_INCREMENT = 99999999;
> exit;
```

Cambiar el archivo de configuracion de CodeIgniter
```
# cd /var/www/html/siia/application/config
# nano config.php

	$config['base_url'] = 'http://10.5.5.5/siia/';

	$config['cookie_domain'] = '10.5.5.5';

	Guardar y salir.
```

Abrimos el explorador y entramos a la ip del servidor al proyecto por ejemplo: http://10.5.5.5/siia/home

### Analice las pruebas de extremo a extremo

Agregar administradores

```
http://10.5.5.5/siia/super/?
```

Verificar el ingreso de administradores

```
http://10.5.5.5/siia/admin
```

### Pruebas de estilo de codificación

Archivo database.php para verificar el usuario y contraseña en MySQL

```
# cd /var/www/html/siia/application/config
# nano database.php
```

Archivo constants.php para verificar contraseña super administrador "SUPER_PS"
Para verificar correos electronicos de contacto "CORREO_SIA" "CORREO_ATENCION" "CORREO_COORDINADOR" "CORREO_AREA" "CORREO_DIRECTOR"

```
# cd /var/www/html/siia/application/config
# nano constants.php
```

## Producción

Agregar los CronJobs

```
30 2 * * * php -q /var/www/html/sia/index.php Recordar calculo_tiempo &> /var/www/html/sia/application/logs/enviomailtiempo.txt
30 23 * * * php -q /var/www/html/sia/index.php Recordar recordarToAdmin &> /var/www/html/sia/application/logs/enviomailtiempo.txt
```

CodeIgniter requiere hacer

```
# cd /var/www/html/siia/
# nano index.php
	Editar la linea 56.
		define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'testing');
	a
		define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'production');

	Guardar y salir.
```

Cambiar la carpeta root de apache a siia

```
# nano /etc/apache2/sites-available/000-default.conf 

DocumentRoot /var/www/html/siia

Guardar y salir.

# service apache2 restart
```

Cambiar el .htaccess comentando la RewriteBase /siia/

```
# cd /var/www/html/siia
# nano .htaccess

	RewriteBase /
	#RewriteBase /siia/

	Guardar y salir.
```

Cambiar el archivo de configuracion de CodeIgniter
```
# cd /var/www/html/siia/application/config
# nano config.php

	$config['base_url'] = 'http://10.5.5.5';

	$config['cookie_domain'] = '10.5.5.5';

	Guardar y salir.
```

Abrimos el explorador y entramos a la ip del servidor al proyecto por ejemplo: http://10.5.5.5/home

## Creado con

* [CodeIgniter](https://codeigniter.com/) - Framework
* [Apache](https://httpd.apache.org/) - Dependencia
* [PHP](http://php.net/) - Dependencia

## Versiones

Se usa [SemVer](http://semver.org/) para versiones.

## Autores

* **Sergio Daniel Martínez Porras** - *Trabajo Inicial* - [M4RS](https://bitbucket.org/M4RS/)

## Licencia

Este proyecto esta bajo los derechos de autor del desarrollador y de la Unidad Administrativa Especial de Organizaciones Solidarias
