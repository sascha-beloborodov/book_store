<?php

namespace App\Resources;

use Slim\Http\UploadedFile;

class FileHelper {

    /**
     * @var $file UploadedFile
     */
    private $file;

    /**
     * @var $extension string|boolean
     */
    private $extension;

    /**
     * @var $isMoved bool
     */
    private $isMoved;
    
    /**
     * FileHelper constructor.
     * @param $file UploadedFile
     */
    public function __construct($file = null)
    {
        $this->file = $file;
    }

    /**
     * 
     * @return $this
     */
    public function setRulesTempDir()
    {
        chmod(UPLOAD_TEMP_DIR, 0755);
        return $this;
    }
    
    /**
     * 
     * @return $this
     */
    public function setRulesImageDir()
    {
        chmod(UPLOAD_IMAGE_DIR, 0755);
        return $this;
    }


    /**
     * @return $this
     */
    public function setExtension()
    {
        $f = new \finfo(FILEINFO_MIME_TYPE);
        $this->extension = array_search(
            $f->file($this->file->file),
            array(
                'jpg' => 'image/jpeg',
                'png' => 'image/png',
                'gif' => 'image/gif',
            ),
            true
        );
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExtension()
    {
        return $this->extension;
    }
    
    public function createFileName()
    {
        return time() . mt_rand(0, 1000) . sha1_file($this->file->file);
    }
    
    public function isFileValid()
    {
        return
            MAX_FILE_SIZE > $this->file->getSize() && $this->getExtension() && $this->file->getError() === 0;
    }

    /**
     * @param $file
     */
    public function moveFileFromTempDir($file)
    {
        $fileName = explode(DIRECTORY_SEPARATOR, $file);
        $fileName = $fileName[count($fileName) - 1];
        $file = str_replace('/', "\'", $file);
        $file = str_replace("'", '', $file);

        $this->setRulesTempDir()->setRulesImageDir();

        $oldPlace = PUBLIC_DIR . DIRECTORY_SEPARATOR . $file;
        $newPlace = UPLOAD_IMAGE_DIR . DIRECTORY_SEPARATOR . $fileName;
        $moving = @copy($oldPlace, $newPlace);
        $this->isMoved = $moving;
    }

    /**
     * @return boolean
     */
    public function getIsMoved()
    {
        return $this->isMoved;
    }


    /**
     * Check file during editing
     * @param $newImage
     * @param $oldImage
     * @return bool
     */
    public function isNewImage($newImage, $oldImage)
    {
        $newImage = explode('/', $newImage);
        $newImage = $newImage[count($newImage) - 1];
        $oldImage = explode('/', $oldImage);
        $oldImage = $oldImage[count($oldImage) - 1];
        return $newImage != $oldImage;
    }
}
