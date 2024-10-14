<?php 

namespace app\models;

use yii;
use yii\base\Model;
use yii\web\UploadedFile;

class FileUploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;
    public $filePath;
    public $path;

    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xls, xlsx', 'checkExtensionByMimeType' => true],
        ];
    }

    public function upload()
    {
        $filePath = Yii::getAlias('@app').'/web/uploads/' . $this->file->baseName . '.' . $this->file->extension;
        $this->filePath = $filePath;
        $this->path = '/web/uploads/' . $this->file->baseName . '.' . $this->file->extension;

         // Check if the file already exists and delete it
         if (file_exists($filePath)) {
            unlink($filePath); // Delete the existing file
        }

        if ($this->validate()) {
            $this->file->saveAs($this->filePath);
            return true;
        } else {
            Yii::error('Failed to save file to path: ' . $this->filePath);
            return false;
        }
    }

    public function deleteFile($fileName)
    {
        $filePath = 'uploads/' . $fileName;
        if (file_exists($filePath)) {
            return unlink($filePath);
        }
        return false;
    }

}
