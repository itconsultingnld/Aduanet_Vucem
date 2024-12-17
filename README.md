# Aduanet - VUCEM

Solución para la digitalización de documentos PDF para VUCEM.

## Índice

- [Descripción](#descripción)
- [Requerimientos](#requerimientos)
- [Back-End](#back-end)

## Descripción

Esta solución permite obtener un archivo PDF y convertirlo en una cadena base 64 que contenga las características requeridas para su aceptación por parte de VUCEM.

Durante el procedimiento, también se permite eliminar páginas del documento procesado.

## Requerimientos

- Apache 2.4.56
- PHP 8.2
- ImageMagick 7.1.1
- PHP Imagick 3.7.0
- Ghostscript 10.04.0

## Back-End

La solución contiene dos funciones en PHP, las cuales son llamadas a través de APIs en Code Igniter.

La función **“convertir”** recibe un archivo PDF en base 64 y lo regresa tras realizar ciertas adecuaciones al mismo. Parte del procesamiento incluye:

- Se revisa si el documento contiene encriptación (si el documento PDF tiene contraseña). En caso positivo, se arroja un error indicando que el documento no puede tener contraseña.
- Se aplican las siguientes características al documento:
    - Sin formularios, compactados, objetos OLE incrustados o código JavaScript.
    - En escala de grises a 8 bits de profundidad.
    - En resolución de 300 DPI.
- Se regresa el documento en base 64.

La función **“revisar tamaño”** recibe un archivo PDF en base 64 y regresa un objeto JSON que demuestra si un archivo supera el límite permitido para un archivo digitalizado (3 MB).

**Nota:** La ruta para los archivos generados durante el procesamiento de las APIs se puede modificar al final del archivo [constants.php](API/app_ws/application/config/constants.php).
