<?php 

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class FileUploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;

    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, pdf, docx'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $filePath = 'uploads/' . $this->file->baseName . '.' . $this->file->extension;
            $this->file->saveAs($filePath);
            return true;
        } else {
            return false;
        }
    }
}
