# Primeros pasos

### Crear el usuario admin

En AlamedaCMS el primer usuario es el ADMIN y se crea desde consola

```bash
php bin/console app:add-user --role=ADMIN
```

Y seguir los pasos del wizard

### Acceder a los datos del metabase

[tuSitio/admin/metabase/new](tuSitio/admin/metabase/new)

Y completar los datos que allí nos pide.

La parte de favicon es un textarea donde agregaremos el link del favicon o varios

```html 

<link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
```