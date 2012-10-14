<?php

/**
 * Identifica el valor de calidad de una imagen JPG.
 * valores de 0 a 100. 
 * 0: menor calidad, menor tamaño
 * 100: mayor calidad, mayor tamaño
 */
$jpg_quality = 95;

/**
 * Identifica el valor de compresión de una imagen PNG 
 * valores de 0 a 9
 * 0: sin compresión, mayor tamaño.
 * 9: máxima compresión, menor tamaño.
 */
$png_compression = 1;

/**
 * La ubicación relativa de donde se almacenarán las 
 * imágenes de avatar subidas al momento de registrarse. 
 */
$uploads_directory = '../../../';

class ResizeIMG {

    function __construct() {
        
    }

    function resize($pathOrigen, $pathDestino, $type) {


        //$rutaImagenOriginal = $pathOrigen;

        if ($type == IMG_JPG || $type == IMG_JPEG) {
            //echo "A";
            $imgOriginal = imagecreatefromjpeg($pathOrigen);
        } elseif ($type == IMG_GIF) {
            $imgOriginal = imagecreatefromgif($pathOrigen);
        } elseif ($type == IMG_PNG) {
            $imgOriginal = imagecreatefrompng($pathOrigen);
        }

        $max_ancho = 50;
        $max_alto = 60;
        list($ancho, $alto) = getimagesize($pathOrigen);
        $x_ratio = $max_ancho / $ancho;
        $y_ratio = $max_alto / $alto;

        if (($ancho <= $max_ancho) && ($alto <= $max_alto)) {
            $ancho_final = $ancho;
            $largo_alto = $alto;
        } elseif (($x_ratio * $alto) < $max_alto) {
            $alto_final = ceil($x_ratio * $alto);
            $ancho_final = $max_ancho;
        } else {
            $ancho_final = ceil($y_ratio * $ancho);
            $alto_final = $max_alto;
        }

        
        
        if ($type != IMG_PNG) {
            $tmp = imagecreatetruecolor($ancho_final, $alto_final);
            imagecopyresampled($tmp, $imgOriginal, 0, 0, 0, 0, $ancho_final, $alto_final, $ancho, $alto);
            imagedestroy($imgOriginal);

            if ($type == IMG_JPG || $type == IMG_JPEG) {
                imagejpeg($tmp, $pathDestino, $GLOBALS["jpg_quality"]);
            } elseif ($type == IMG_GIF) {
                imagegif($tmp, $pathDestino);
            }
        } else {
            $tmp = imagecreatetruecolor($ancho_final, $alto_final);
            imagealphablending($tmp, false);
            imagesavealpha($tmp, true);
            $transparente = imagecolorallocatealpha($tmp, 255, 255, 255, 127);
            imagefilledrectangle($tmp, 0, 0, $ancho_final, $alto_final, $transparente);
            imagecopyresampled($tmp, $imgOriginal, 0, 0, 0, 0, $ancho_final, $alto_final, $ancho, $alto);
            imagedestroy($imgOriginal);

            imagepng($tmp, $pathDestino, $GLOBALS["png_compression"]);
            
            
        }
    }

}

/**
 * Handle file uploads via XMLHttpRequest
 */
class qqUploadedFileXhr {

    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save($path) {
        $input = fopen("php://input", "r");
        $temp = tmpfile();
        $realSize = stream_copy_to_stream($input, $temp);
        fclose($input);

        if ($realSize != $this->getSize()) {
            return false;
        }

        $target = fopen($path, "w");
        fseek($temp, 0, SEEK_SET);
        stream_copy_to_stream($temp, $target);
        fclose($target);


        $rimg = new ResizeIMG();

        $ext = explode(".", $path);
        $ext = strtolower(array_pop($ext));

        if ($ext == "jpg" || $ext == "jpeg") {
            //echo $ext;
            $rimg->resize($path, $path, IMG_JPG);
        } elseif ($ext == "gif") {
            $rimg->resize($path, $path, IMG_GIF);
        } elseif ($ext == "png") {
            $rimg->resize($path, $path, IMG_PNG);
        }

        return true;
    }

    function getName() {
        return $_GET['qqfile'];
    }

    function getSize() {
        if (isset($_SERVER["CONTENT_LENGTH"])) {
            return (int) $_SERVER["CONTENT_LENGTH"];
        } else {
            throw new Exception('Getting content length is not supported.');
        }
    }

}

/**
 * Handle file uploads via regular form post (uses the $_FILES array)
 */
class qqUploadedFileForm {

    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save($path) {
        if (!move_uploaded_file($_FILES['qqfile']['tmp_name'], $path)) {
            return false;
        }
        return true;
    }

    function getName() {

        return $_FILES['qqfile']['name'];
    }

    function getSize() {
        return $_FILES['qqfile']['size'];
    }

}

class qqFileUploader {

    private $allowedExtensions = array();
    private $sizeLimit = 5242880;
    private $file;

    function __construct(array $allowedExtensions = array(), $sizeLimit = 5242880) {
        $allowedExtensions = array_map("strtolower", $allowedExtensions);

        $this->allowedExtensions = $allowedExtensions;
        $this->sizeLimit = $sizeLimit;

        $this->checkServerSettings();

        if (isset($_GET['qqfile'])) {
            $this->file = new qqUploadedFileXhr();
        } elseif (isset($_FILES['qqfile'])) {
            $this->file = new qqUploadedFileForm();
        } else {
            $this->file = false;
        }
    }

    private function checkServerSettings() {
        $postSize = $this->toBytes(ini_get('post_max_size'));
        $uploadSize = $this->toBytes(ini_get('upload_max_filesize'));

        if ($postSize < $this->sizeLimit || $uploadSize < $this->sizeLimit) {
            $size = max(1, $this->sizeLimit / 1024 / 1024) . 'M';
            die("{'error':'increase post_max_size and upload_max_filesize to $size'}");
        }
    }

    private function toBytes($str) {
        $val = trim($str);
        $last = strtolower($str[strlen($str) - 1]);
        switch ($last) {
            case 'g': $val *= 1024;
            case 'm': $val *= 1024;
            case 'k': $val *= 1024;
        }
        return $val;
    }

    /**
     * Returns array('success'=>true) or array('error'=>'error message')
     */
    function handleUpload($uploadDirectory, $replaceOldFile = TRUE) {
        if (!is_writable($uploadDirectory)) {
            return array('error' => "Server error. Upload directory isn't writable.");
        }

        if (!$this->file) {
            return array('error' => 'No files were uploaded.');
        }

        $size = $this->file->getSize();

        if ($size == 0) {
            return array('error' => 'File is empty');
        }

        if ($size > $this->sizeLimit) {
            return array('error' => 'File is too large');
        }


        $pathinfo = pathinfo($this->file->getName());

        $filename = utf8_decode(json_decode($_GET['nombre']));
        //$filename = $pathinfo['filename'];
        //$filename = md5(uniqid());

        $ext = strtolower($pathinfo['extension']);

        //$pathinfo = pathinfo($_GET['nombre']);

        if ($this->allowedExtensions && !in_array(strtolower($ext), $this->allowedExtensions)) {
            $these = implode(', ', $this->allowedExtensions);
            return array('error' => 'File has an invalid extension, it should be one of ' . $these . '.');
        }

        if (!$replaceOldFile) {
            /// don't overwrite previous files that were uploaded
            while (file_exists($uploadDirectory . $filename . '.' . $ext)) {
                $filename .= rand(10, 99);
            }
        }

        if ($this->file->save($uploadDirectory . $filename . '.' . $ext)) {
            return array('success' => true);
        } else {
            return array('error' => 'Could not save uploaded file.' .
                'The upload was cancelled, or server error encountered');
        }
    }

}

// list of valid extensions, ex. array("jpeg", "xml", "bmp")
$allowedExtensions = array();
// max file size in bytes
$sizeLimit = 2 * 1024 * 1024;

$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
$result = $uploader->handleUpload($GLOBALS["uploads_directory"]);
// to pass data through iframe you will need to encode all html tags
echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
