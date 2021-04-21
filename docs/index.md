## Bienvenido a AlamedaCMS

Cms básico, basado en Symfony para entornos con acceso ssh y pleno control del server (ej. VPS), incluye reservas ([payunpile][6]) y enlaces ([incalinks][7])


### ¿Que resuelve?
Tener CMS basado en estándares modernos, donde pueda tener pleno control del código, y con un [framework][1] líder en PHP como lo es [Symfony][1]
Fácil de actualizar, fácil de mantener, con un árbol de directorios claro.

### ¿Qué más tiene?

Tiene un manejo básico de usuarios para la administración de los contenidos.
Permite la creación de reservas para eventos, basado en (PayunPILE)[6].
Permite la creación de sus propios enlaces cortos, cuando dependa de vínculos de terceros. [IncaLINKS][7]

### ¿Cómo lo obtengo?

Para usar AlamedaCMS debes bajarlo de [github][8], y luego bajar sus dependencias de paquetes. 

```
git clone https://github.com/gerMdz/AlamedaCMS.git
cd project
composer install
yarn install 
```


Requerimientos
------------

* PHP 7.2.9 o superior;
* PDO-SQLite PHP extension enabled (o el PDO para tu base de datos);
* y los [usuales requerimientos de una aplicación Symfony][2].

Uso
-----

Las configuraciones básicas son 
* la URL de su base de datos ej.:
   * DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7 
* el DSN de su servidor smtp de correos
  * MAILER_DSN=smtp://localhost
     
Luego con el binario de [Symfony][4], ejecute los siguientes comandos que crearan los datos básicos de usuarios y un contenido de inicio:

```bash
$ php bin/console doctrine:fixtures:load
$ symfony serve -d
```

Luego acceda a la aplicación en su navegador con la URL dada (<https://localhost:8000> generalmente).

Si no tiene instalado el binario de Symfony, ejecute `php -S localhost:8000 -t public/`
para utilizar el servidor web PHP incorporado o [configure un servidor web][3] como Nginx o
Apache para ejecutar la aplicación.

Tests
-----

Ejecute este comando para correr los tests:

```bash
$ ./bin/phpunit
```


## Atajos de teclado

#### Admin > Menú
> Windows - Linux


>Firefox 	Alt + Shift + m
Google Chrome 	Alt + m
Safari 	Alt + m


> Mac

>En Firefox 14 o posteriores, Control + Alt + m
En Firefox 13 o anteriores, Control + m
Control + Alt + m
Control + Alt + m

> Cualquier S.O.

>Opera 	Shift + Esc abre una lista de contenidos, los cuales son accesibles a través de accesskey, después se puede elegir un item presionando m


#### AlamedaCMS se base en
- [Symfony][1] framework PHP.
- [Bootstrap](https://getbootstrap.com/) plantillas.
- [FontAwesome](https://fortawesome.github.io/Font-Awesome/) icons.

Con licencia [MIT](https://github.com/gerMdz/AlamedaCMS/blob/AlamedaCMS/LICENSE)
Uso [PhpStorm][5] 


[1]: https://symfony.com
[2]: https://symfony.com/doc/current/reference/requirements.html
[3]: https://symfony.com/doc/current/cookbook/configuration/web_server_configuration.html
[4]: https://symfony.com/download
[5]: https://jb.gg/OpenSource.
[6]: https://github.com/gerMdz/payunpile
[7]: https://germdz.github.io/incalinks/
[8]: https://github.com/gerMdz/AlamedaCMS.git
