### 2.2.1 o 3.0.0 vamos a ver

### Branch 106

### Branch 108

#### Agregar manejo de imágenes

*  [Rama 108](https://github.com/gerMdz/AlamedaCMS/tree/108-manejo-de-im%C3%A1genes)

#### Elfinder

Agregando elfinder a las entradas.
No muestra la opción de elegir.

#### LiipImagineBundle

    https://github.com/liip/LiipImagineBundle
    https://symfony.com/bundles/LiipImagineBundle/current/index.html

#### Imagine

    https://github.com/php-imagine/Imagine
    https://imagine.readthedocs.io/en/stable/
    https://imagine.readthedocs.io/en/stable/_static/API/
    https://www.youtube.com/watch?v=duPAX9LGlYo&list=PLfyZf2Mk8MQDryvz548CijLzX2eZNgjGa&t=1s

#### VichUploader

    https://www.youtube.com/watch?v=DiasdOj5LGQ
    https://www.youtube.com/watch?v=_gN7QajbvTY

##### Etapas

    En una etapa de desición sobre como agregar imágenes.

###### Dudas

    Como agregar en el registro del template el size y otras anotaciones necesarias para el manejo correcto de 
    cualquier template

###### Problemas

elfinder no muestra las opciones de carga de imágenes, muestra pantalla en blanco

probables soluciones

    //* Verificar que la ruta al directorio raíz de ElFinder esté configurada correctamente. Debe apuntar a la carpeta en tu servidor donde se encuentran los archivos que quieres administrar con ElFinder.

    //* Asegurar de que el directorio raíz de ElFinder tenga los permisos de lectura y escritura necesarios para el usuario del servidor web. Si los permisos no son correctos, ElFinder no podrá cargar los archivos.

    * Verificar que la versión de jQuery utilizada en tu aplicación sea compatible con la versión de jQuery UI utilizada por ElFinder. Si hay incompatibilidades, esto podría causar que la pantalla se quede en blanco.

    * Revisar la configuración del bundle ElFinder en tu archivo config.yml y asegúrate de que esté configurado correctamente. Por ejemplo, verifica que los valores de locale y editor estén configurados adecuadamente.

    * Verificar que no existan algún conflicto con otros scripts o librerías utilizados en tu aplicación Symfony. En este caso, intenta desactivar temporalmente otros scripts o librerías para ver si esto soluciona el problema.

[https://jnjsite.com/symfony-como-montar-un-gestor-de-archivos-web-en-menos-de-1-hora/](https://jnjsite.com/symfony-como-montar-un-gestor-de-archivos-web-en-menos-de-1-hora/)

[https://symfony.com/bundles/FOSCKEditorBundle/current/usage/file-browse-upload.html](https://symfony.com/bundles/FOSCKEditorBundle/current/usage/file-browse-upload.html)

[https://stackoverflow.com/questions/61308414/symfony-ckeditor-elfinder-is-it-possible-to-convert-automatically-uploaded
](https://stackoverflow.com/questions/61308414/symfony-ckeditor-elfinder-is-it-possible-to-convert-automatically-uploaded)

[https://stackoverflow.com/questions/29514345/upload-file-type-with-fmelfinder-browser-on-symfony](https://stackoverflow.com/questions/29514345/upload-file-type-with-fmelfinder-browser-on-symfony)

[https://stackoverflow.com/questions/72252131/symfony-route-conflicts-between-controller-and-bundle](https://stackoverflow.com/questions/72252131/symfony-route-conflicts-between-controller-and-bundle)

[https://stackoverflow.com/questions/64480120/using-elfinder-on-symfony-i-cant-select-images](https://stackoverflow.com/questions/64480120/using-elfinder-on-symfony-i-cant-select-images)

