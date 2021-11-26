

## Qué son las entradas
 La entrada es un tipo de bloque en AlamedaCMS.
 En ella se puede ingresar texto, imagen y es la 
 única que acepta recursos extras como imágenes para 
 descargar o pdf.
 
Pueden tener asignada un model_template /entrada

Una entrada solo puede ser parte del bloque mayor section.

Para ver el listado de entradas se debe ingresar a
```
'tu-sitio/admin/entrada'
``` 
Se debe tener como mínimo el "ROLE_ESCRITOR" para poder 
acceder al mismo.

El 'ROLE_ESCRITOR' puede acceder solo a las entradas creadas
por él.

El 'ROLE_EDITOR' o superior accede a todas las entradas de 
AlamedaCMS.

El filtro de busqueda general se puede utilizar en las 
entradas y filtrará por 'Autor (Nombre)', 'Entrada (título)' 
y 'Entrada (contenido)', utilizando like, es decir que los 
campos 'contengan' el texto buscado. 


### Roadmap

 - Arreglar la busqueda en ROLE_AUTOR, para filtrar por 
título y contenido 

                     
[Comienzo](index.md)
