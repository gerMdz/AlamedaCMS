
# What is MyProduct?

{% hint style="info" %}
**Good to know:** providing a brief overview of your product and its core use cases is a great place to start with product docs. Your product might seem obvious to you – you made it! However, to others, even folks who are trying your product after reading your site or getting a sales demo, it can still be unclear. This is your chance to clarify your product and set the right expectations!
{% endhint %}

Here are a couple of examples of succinct overviews from products with really great docs:

> Loom is a video messaging tool that helps you get your message across through instantly shareable videos.
>
> With Loom, you can record your camera, microphone, and desktop simultaneously. Your video is then instantly available to share through Loom's patented technology.
>
> — From the [Loom Docs](https://support.loom.com/hc/en-us/articles/360002158057-What-is-Loom-)

> The Mailchimp Marketing API provides programmatic access to Mailchimp data and functionality, allowing developers to build custom features to do things like sync email activity and campaign analytics with their database, manage audiences and campaigns, and more.
>
> — From the [Mailchimp Marketing API docs](https://mailchimp.com/developer/marketing/docs/fundamentals/)

## Getting Started

**Got 2 minutes?** Check out a video overview of our product:

{% embed url="https://www.loom.com/share/3bfa83acc9fd41b7b98b803ba9197d90" %}

{% hint style="info" %}
**Good to know:** A succinct video overview is a great way to introduce folks to your product. Embed a Loom, Vimeo or YouTube video and you're good to go! We love this video from the fine folks at [Loom](https://loom.com) as a perfect example of a succinct feature overview.
{% endhint %}

### Guides: Jump right in

Follow our handy guides to get started on the basics as quickly as possible:

{% content-ref url="guides/creating-your-first-project.md" %}
[creating-your-first-project.md](guides/creating-your-first-project.md)
{% endcontent-ref %}

{% content-ref url="guides/creating-your-first-task.md" %}
[creating-your-first-task.md](guides/creating-your-first-task.md)
{% endcontent-ref %}

{% content-ref url="guides/advanced-permissions.md" %}
[advanced-permissions.md](guides/advanced-permissions.md)
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
=======
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

