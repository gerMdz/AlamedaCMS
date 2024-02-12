# ¿Qué es AlamedaCMS?

> AlamedaCMS es un sistema de gestión, un entorno de trabajo para la creación y administración, de contenidos web.
>
> Principalmente indicado para entornos con acceso ssh y pleno control del server (ej. VPS).
>
> Basado en [Symfony](https://symfony.com), un [framework](https://symfony.com) líder en PHP, y por tanto en estándares modernos, donde pueda tener pleno control del código, siendo fácil de actualizar, fácil de mantener, con un árbol de directorios claro.

> Incluye el módulo de reservas ([payunpile](https://github.com/gerMdz/payunpile)) y de enlaces ([incalinks](https://germdz.github.io/incalinks/))

#### Detalle v4.0.0

Por los cambios realizados en el manejo de las miniaturas hay que cambiar o reubicar las imagenes de caches en media/cache/resolver o media/caches según corresponda.



## Empezando

Para usar AlamedaCMS debes bajarlo de [github](https://github.com/gerMdz/AlamedaCMS.git), y luego bajar sus dependencias de paquetes.

git clone https://github.com/gerMdz/AlamedaCMS.git&#x20;

cd project&#x20;

composer install&#x20;

yarn install

``

### Guides: Jump right in

Follow our handy guides to get started on the basics as quickly as possible:

{% content-ref url="guias/creating-your-first-project.md" %}
[creating-your-first-project.md](guias/creating-your-first-project.md)
{% endcontent-ref %}

{% content-ref url="guias/creating-your-first-task.md" %}
[creating-your-first-task.md](guias/creating-your-first-task.md)
{% endcontent-ref %}

{% content-ref url="guias/advanced-permissions.md" %}
[advanced-permissions.md](guias/advanced-permissions.md)
{% endcontent-ref %}

{% hint style="info" %}
**Good to know:** your product docs aren't just a reference of all your features! use them to encourage folks to perform certain actions and discover the value in your product.
{% endhint %}

### Fundamentals: Dive a little deeper

Learn the fundamentals of MyProduct to get a deeper understanding of our main features:

{% content-ref url="fundamentals/projects.md" %}
[projects.md](fundamentals/projects.md)
{% endcontent-ref %}

{% content-ref url="fundamentals/members.md" %}
[members.md](fundamentals/members.md)
{% endcontent-ref %}

{% content-ref url="fundamentals/task-lists.md" %}
[task-lists.md](fundamentals/task-lists.md)
{% endcontent-ref %}

{% content-ref url="fundamentals/tasks.md" %}
[tasks.md](fundamentals/tasks.md)
{% endcontent-ref %}

{% hint style="info" %}
**Good to know:** Splitting your product into fundamental concepts, objects, or areas can be a great way to let readers deep dive into the concepts that matter most to them. Combine guides with this approach to 'fundamentals' and you're well on your way to great documentation!
{% endhint %}

\======= ## Bienvenido a AlamedaCMS

Cms básico, basado en Symfony para entornos con acceso ssh y pleno control del server (ej. VPS), incluye reservas ([payunpile](https://github.com/gerMdz/payunpile)) y enlaces ([incalinks](https://germdz.github.io/incalinks/))

### ¿Que resuelve?

Tener CMS basado en estándares modernos, donde pueda tener pleno control del código, y con un [framework](https://symfony.com) líder en PHP como lo es [Symfony](https://symfony.com) Fácil de actualizar, fácil de mantener, con un árbol de directorios claro.

### ¿Qué más tiene?

Tiene un manejo básico de usuarios para la administración de los contenidos. Permite la creación de reservas para eventos, basado en (PayunPILE)[6](https://github.com/gerMdz/payunpile). Permite la creación de sus propios enlaces cortos, cuando dependa de vínculos de terceros. [IncaLINKS](https://germdz.github.io/incalinks/)

### ¿Cómo lo obtengo?

Para usar AlamedaCMS debes bajarlo de [github](https://github.com/gerMdz/AlamedaCMS.git), y luego bajar sus dependencias de paquetes.

```
git clone https://github.com/gerMdz/AlamedaCMS.git
cd project
composer install
yarn install 
```

## Requerimientos

* PHP 7.2.9 o superior;
* PDO-SQLite PHP extension enabled (o el PDO para tu base de datos);
* y los [usuales requerimientos de una aplicación Symfony](https://symfony.com/doc/current/reference/requirements.html).

## Uso

Las configuraciones básicas son

* la URL de su base de datos ej.:
  * DATABASE\_URL=mysql://db\_user:db\_password@127.0.0.1:3306/db\_name?serverVersion=5.7
* el DSN de su servidor smtp de correos
  * MAILER\_DSN=smtp://localhost

Luego con el binario de [Symfony](https://symfony.com/download), ejecute los siguientes comandos que crearan los datos básicos de usuarios y un contenido de inicio:

```bash
$ php bin/console doctrine:fixtures:load
$ symfony serve -d
```

Luego acceda a la aplicación en su navegador con la URL dada ([https://localhost:8000](https://localhost:8000) generalmente).

Si no tiene instalado el binario de Symfony, ejecute `php -S localhost:8000 -t public/` para utilizar el servidor web PHP incorporado o [configure un servidor web](https://symfony.com/doc/current/cookbook/configuration/web\_server\_configuration.html) como Nginx o Apache para ejecutar la aplicación.

## Tests

Ejecute este comando para correr los tests:

```bash
$ ./bin/phpunit
```

#### AlamedaCMS se base en

- [Symfony][1] framework PHP.
- [Bootstrap](https://getbootstrap.com/) plantillas.
- [FontAwesome](https://fortawesome.github.io/Font-Awesome/) icons.

##### Gracias a (y seguro se me están quedando afuera alguno)
Uso [PhpStorm][5]

A mi parecer, soy 25% más productivo gracias a PHPStorm.

 [Stream - UI Kit](https://htmlstream.com/preview/stream-ui-kit/)

 Stream UI Kit is beautiful Open Source Bootstrap 4 UI Kit under MIT license. The UI Kit comes with 5 beautiful complete pages and includes over 20 reusable and customizable UI Blocks. It’s lightweight and only ~17kb when minified.


Con licencia [MIT](https://github.com/gerMdz/AlamedaCMS/blob/AlamedaCMS/LICENSE)



