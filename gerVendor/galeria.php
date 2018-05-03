<?php

/**
 * Librería encargada de las funciones de
 * la galería de imágenes
 *
 * @author Inazio
 */
class Galeria {

    /**
     * Carga en un array los ficheros de un directorio pasado por parámetro.
     * @param string $ruta directorio de la carpeta donde extraer los ficheros
     * @return array con la ruta de los ficheros o NULL si directorio inválido
     */
    public function cargarImagenes($ruta){

        // Compruebo si el parámetro pasado es una ruta
        if (is_dir($ruta)){

            // Abro un gestor de directorios
            $gestor = opendir($ruta);

            $imagenes = array();

            // Recorro archivos del directorio
            while(($archivo = readdir($gestor)) !== false){
                if (is_file($ruta . "/" . $archivo)){
                    $imagen = $ruta . "/" . $archivo;
                    array_push($imagenes, $imagen);
                }
            }

            closedir($gestor);

            return $imagenes;
        }
        else{
            return NULL;
        }
    }
}