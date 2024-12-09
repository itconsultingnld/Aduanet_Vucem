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
        $tiempo = str_replace('.', '', abs(microtime(true)));

        $file = RUTA_BASE . 'tmp/base_' . $tiempo . '.pdf';
        $temp_name = RUTA_BASE . 'tmp/output_' . $tiempo . '.pdf';

        try {
            $archivo = str_replace('data:application/pdf;base64,', '', $archivo);
            $archivo = str_replace(' ', '+', $archivo);
            $archivo = base64_decode($archivo);
            file_put_contents($file, $archivo);

            $handle = fopen($file, "r");
            $contents = fread($handle, filesize($file));
            fclose($handle);

            if (stristr($contents, "/Encrypt")) {
                unlink($file); // Elimina el archivo original
                throw new InvalidArgumentException('El archivo no puede tener contraseña');
            }

            /* $imagen = new Imagick($file);

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
                    // $image->setImageCompression(Imagick::COMPRESSION_JPEG);
                    // $image->setImageCompressionQuality(50);
                    $pdf->addImage($image);
                }
            } */

            /* $pdf->writeImages($temp_name, true); // adjoin is true

            header('Content-type: application/pdf');

            echo $pdf->getImagesBlob();
            $pdf->destroy(); */

            $command = "gs -sDEVICE=pdfwrite -sProcessColorModel=DeviceGray -sColorConversionStrategy=Gray -dUseFastColor -o -dGrayLevels=8 -dNOPAUSE -dBATCH -dSAFER -r300 -dNOINTERACTIVEFORMS  -dCompatibilityLevel=1.4 -dNOSCRIPTING -sOutputFile=" . $temp_name . " " . $file;
            shell_exec($command);

            // Leemos el archivo PDF
            $pdfData = file_get_contents($temp_name);

            // Codificamos en Base64
            echo base64_encode($pdfData);
        } catch (InvalidArgumentException $ex) {
            echo '{"mensaje":"' . $ex->getMessage() . '"}';
        } catch (Exception) {
            echo '{"mensaje":"Error al procesar"}';
        } finally {
            if (file_exists($temp_name)) {
                unlink($temp_name); // Delete the temporary file
            }
            if (file_exists($file)) {
                unlink($file); // Elimina el archivo original
            }
        }
    }

    public function revisar_tamanio($archivo)
    {
        $tiempo = str_replace('.', '', abs(microtime(true)));

        $file = RUTA_BASE . 'tmp/tamanio_' . $tiempo . '.pdf';

        try {
            $archivo = str_replace('data:application/pdf;base64,', '', $archivo);
            $archivo = str_replace(' ', '+', $archivo);
            $archivo = base64_decode($archivo);
            file_put_contents($file, $archivo);

            $tamanio = filesize($file);

            $respuesta = array(
                'error' => false,
                'is_heavy' => $tamanio >= 3 * 1024 * 1024,
            );
        } catch (Exception $ex) {
            $respuesta = array(
                'error' => false,
                'mensaje' => $ex->getMessage(),
            );
        } finally {
            if (file_exists($file)) {
                unlink($file); // Elimina el archivo original
            }
        }
        return $respuesta;
    }
}
