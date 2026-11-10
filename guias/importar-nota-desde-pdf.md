# Guía: Transformación de PDF a Nota Interactiva (Entrada Editable)

Esta guía explica cómo utilizar la funcionalidad de **Importación y Transformación de PDF a Nota del Mensaje**, que permite subir el PDF semanal de notas, convertirlo automáticamente en una **Entrada editable** para corregir posibles detalles de extracción, y publicarlo como vista interactiva en Twig.

---

## 1. ¿Cómo funciona la transformación automática?

Al procesar un archivo PDF de notas (como `02 EL ANTIDOTO PARA EL RUIDO.pdf`), el servicio `App\Service\PdfToNotaService`:

1. **Extrae el texto del PDF** utilizando `pdftotext` en UTF-8.
2. **Limpia errores frecuentes de corte de sílabas** propios de los PDFs (por ejemplo, `esp iral` $\rightarrow$ `espiral`, `signifi ca` $\rightarrow$ `significa`, `fi los` $\rightarrow$ `filos`).
3. **Omite los pies de página institucionales** (redes sociales, dirección, textos fijos del QR y etiquetas sueltas de gráficos).
4. **Detecta los espacios para completar (`_______`)** y los reemplaza secuencialmente por marcadores cortos y legibles para el editor:
   - `{{uno}}`, `{{dos}}`, `{{tres}}`, `{{cuatro}}`, ..., hasta `{{veinticinco}}`.
5. **Formatea automáticamente la estructura HTML**:
   - **Títulos de sección:** `<h4 class="text-centrado text-600">...</h4>`
   - **Puntos numerados y frases para completar (`MENTIRA:`, `VERDAD:`, `1.`, `2.`, etc.):** `<h5 class="text-izq text-600">...</h5>`
   - **Versículos bíblicos entre comillas y su cita final (`Libro cap:vers (Versión)`):**
     ```html
     <p class="text-14-300 font-italic pl-4 text-centrado">
         "Texto del versículo..."
         <br/>
         <small class="float-end">
             Cita bíblica (Versión)
         </small>
     </p><br/>
     ```

---

## 2. Flujo de uso desde el Panel de Administración

### Opción A: Crear una Entrada nueva subiendo el PDF

1. Ingresar al listado de entradas en **`/admin/entrada`**.
2. Hacer clic en el botón verde **"Importar Nota desde PDF"** (`/admin/entrada/importar-pdf`).
3. Seleccionar el archivo `.pdf` de las notas del mensaje.
   - *Opcional:* Indicar un título personalizado (si se deja vacío, toma automáticamente la primera línea del PDF).
   - *Opcional:* Marcar la casilla **"Actualizar también `templates/bases/_nota.html.twig` inmediatamente"**.
4. Hacer clic en **"Transformar PDF y Editar Entrada"**.
5. El sistema:
   - Creará la nueva `Entrada` con el HTML generado en el campo `contenido`.
   - Adjuntará automáticamente el archivo PDF como **Referencia** (`EntradaReference`) de esa entrada para que quede listo para descargar en el botón *"Notas"*.
   - Te redirigirá a la pantalla de **Edición Simple (`/admin/entrada/{id}/edit-complex`)**.

### Opción B: Transformar un PDF ya subido en una Entrada existente

Si ya habías creado la `Entrada` y subiste el PDF en la sección **Referencias** (Dropzone):

1. Ir a la vista de detalle de la entrada (**`/admin/entrada/{id}/show`**).
2. Al pie, junto al enlace del PDF en **Referencias**, hacer clic en **"Transformar PDF a contenido editable"**.
3. El sistema procesará ese PDF, volcará el HTML en el contenido de la entrada y abrirá el editor para que puedas revisarlo.

---

## 3. Edición y Corrección de la Nota

En la pantalla de edición (`/admin/entrada/{id}/edit-complex` o `/admin/entrada/{id}/edit`):

- Podés corregir cualquier texto, agregar subrayados (`<u>...</u>`) o ajustar saltos de línea.
- **Campos interactivos para completar:** Donde quieras que aparezca la estrella y la caja de texto para que las personas completen con sus propias palabras, mantené o escribí los marcadores en orden:
  - `{{uno}}`
  - `{{dos}}`
  - `{{tres}}`
  - `{{cuatro}}`
  - `{{cinco}}`
  - `{{seis}}` *(hasta `{{veinticinco}}`)*
- Hacé clic en **Guardar** para conservar los cambios en la base de datos.

---

## 4. Vista Previa y Publicación en `_nota.html.twig`

Una vez guardados los cambios en la `Entrada`:

1. En **`/admin/entrada/{id}/show`** (o desde el botón al pie de **`/admin/entrada/{id}/edit-complex`**) podés ver la **vista previa interactiva** del contenido renderizado mediante `completa_texto(entrada.contenido) | raw`.
2. Para publicar esa versión corregida en la plantilla general del sitio, hacé clic en el botón verde:
   > **"Publicar como Nota Activa (`_nota.html.twig`)"**
3. Al confirmar, el sistema convierte automáticamente cada `{{uno}}` en `{{ completa_lugar('uno') | raw }}` y actualiza el archivo `templates/bases/_nota.html.twig`.

> **Alternativa por Template de Entrada:** También está disponible el template `templates/models/entradas/nota.html.twig` (y `templates/modelEntrada/nota.html.twig`), que renderiza directamente `{{ completa_texto(entrada.contenido) | raw }}` junto con `{{ encore_entry_script_tags('nota_mensaje') }}`.

---

## 5. Prefijo de almacenamiento local (`nota_mensaje.js`)

El script `assets/js/nota_mensaje.js` guarda en el `localStorage` del navegador de cada persona las palabras ingresadas en los campos `'uno'` a `'veinticinco'`.

Al cambiar de serie o mensaje (por ejemplo, de `tmv09P` a `qdtm02P`), recordá actualizar el prefijo en `assets/js/nota_mensaje.js` y compilar los assets (`yarn encore dev` o `yarn encore prod`) para que los campos aparezcan limpios para la nueva charla.

---

## 6. Uso desde la Consola de Symfony (CLI)

También podés ejecutar la transformación desde la terminal mediante el comando `entrada:pdf-a-nota`:

```bash
# Mostrar en consola el HTML transformado del PDF
php bin/console entrada:pdf-a-nota "/ruta/al/archivo.pdf"

# Transformar el PDF y actualizar directamente templates/bases/_nota.html.twig
php bin/console entrada:pdf-a-nota "/ruta/al/archivo.pdf" --publicar
```

---

## 7. Resumen de Archivos Involucrados

| Archivo | Función |
| :--- | :--- |
| `src/Service/PdfToNotaService.php` | Servicio que extrae el texto del PDF con `pdftotext`, estructura el HTML con `{{uno}}..{{veinticinco}}` y exporta a `_nota.html.twig`. |
| `src/Controller/AdminEntradaController.php` | Rutas `admin_entrada_import_pdf`, `admin_entrada_convert_reference` y `admin_entrada_publish_nota_twig`. |
| `src/Twig/BaseExtension.php` | Función Twig `completa_texto()` y `completa_lugar()` que generan los `<input id="p...">`, `<label id="lp...">` e ícono `<i id="xp...">`. |
| `templates/admin/entrada/import_pdf.html.twig` | Formulario de subida de PDF para crear una entrada de nota editable. |
| `templates/admin/entrada/edit_contenido.html.twig` | Editor del contenido de la entrada con acceso directo a la vista previa y publicación en `_nota.html.twig`. |
| `templates/admin/entrada/show.html.twig` | Vista previa con `completa_texto` y botones para transformar referencias PDF o publicar en `_nota.html.twig`. |
| `templates/bases/_nota.html.twig` | Plantilla Twig principal donde se publica la nota activa. |
| `templates/models/entradas/nota.html.twig` | Plantilla de modelo de entrada para renderizar una `Entrada` directamente como nota interactiva. |
| `src/Command/PdfToNotaCommand.php` | Comando CLI `entrada:pdf-a-nota`. |
| `assets/js/nota_mensaje.js` | Lógica JavaScript (`jQuery` + `localStorage`) para completar y guardar las palabras de cada usuario. |
