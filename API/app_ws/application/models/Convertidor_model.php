<?php
class Convertidor_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
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
        try {
            $archivo_str = $archivo;
            if (!str_starts_with($archivo_str, 'data:application/pdf;base64,')) {
                $archivo = 'data:application/pdf;base64,' . $archivo_str;
            }
            $archivo_str_len = strlen($archivo_str);

            $respuesta = array(
                'error' => false,
                'is_heavy' => $archivo_str_len >= 3 * 1024 * 1024,
            );
        } catch (Exception $ex) {
            $respuesta = array(
                'error' => false,
                'mensaje' => $ex->getMessage(),
            );
        }
        return $respuesta;
    }
}
