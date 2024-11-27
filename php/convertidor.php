<?php

header('Content-type: application/pdf');
try {

    $RUTA_BASE = 'C:/xampp/htdocs/Aduanet_Vucem/';

    $file = $RUTA_BASE . 'pdfs/nest-cheatsheet.pdf';
    // $imagen = new Imagick("C:/xampp/htdocs/eventos/imagen.png");
    $imagen = new Imagick($file);

    $noOfPagesInPDF = $imagen->getNumberImages();

    $pdf = new Imagick();
    $pdf->setFormat('pdf');

    if ($noOfPagesInPDF) {

        for ($i = 0; $i < $noOfPagesInPDF; $i++) {
            $url = $file . '[' . $i . ']';
            $image = new Imagick();
            $image->setResolution(300, 300);
            $image->readimage($url);
            $image->setImageFormat('jpg');
            $image->setImageColorspace(Imagick::COLORSPACE_GRAY);
            // $image->writeImage($RUTA_BASE . 'images/' . ($i + 1) . '-' . rand() . '.jpg');
            $pdf->addImage($image);
        }
    }

    // Guardar la imagen modificada como PDF de una página
    // $imagen->writeImage('pdf_gris.pdf');
    // echo $imagen;

    // First we create a temporary file and write the pdf to it
    $temp_name = $RUTA_BASE . 'tmp/output.pdf';
    $pdf->writeImages($temp_name, true); // adjoin is true
    unlink($temp_name); // Delete the temporary file

    echo $pdf->getImagesBlob();
    $pdf->destroy();
} catch (error $e) {
    echo $e;
}
