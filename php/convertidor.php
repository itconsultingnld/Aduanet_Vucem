<?php

header('Content-type: application/pdf');
try {
    // $imagen = new Imagick("C:/xampp/htdocs/eventos/imagen.png");
    $imagen = new Imagick("C:/xampp/htdocs/Aduanet_Vucem/pdfs/nest-cheatsheet.pdf[1]");
    $imagen->setImageColorspace(Imagick::COLORSPACE_GRAY);

    // Guardar la imagen modificada como PDF de una página
    $imagen->writeImage('pdf_gris.pdf');
    echo $imagen;
} catch (error $e) {
    echo $e;
}
