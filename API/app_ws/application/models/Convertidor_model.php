<?php
class Convertidor_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        /* $this->load->database(); */
    }

    public function convertir($archivo)
    {
        try {
            $RUTA_BASE = 'C:/xampp/htdocs/Aduanet_Vucem/';

            $tiempo = str_replace('.', '', abs(microtime(true)));

            $file = $RUTA_BASE . 'tmp/base_' . $tiempo . '.pdf';

            $archivo = str_replace('data:application/pdf;base64,', '', $archivo);
            $archivo = str_replace(' ', '+', $archivo);
            $archivo = base64_decode($archivo);
            file_put_contents($file, $archivo);

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
                    $image->setImageDepth(8);
                    $pdf->addImage($image);
                }
            }

            // First we create a temporary file and write the pdf to it
            $temp_name = $RUTA_BASE . 'tmp/output_' . $tiempo . '.pdf';
            $pdf->writeImages($temp_name, true); // adjoin is true

            header('Content-type: application/pdf');

            echo $pdf->getImagesBlob();
            $pdf->destroy();

            unlink($temp_name); // Delete the temporary file
            unlink($file); // Elimina el archivo original
        } catch (Exception) {
        }
    }
}
