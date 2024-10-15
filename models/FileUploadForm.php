<?php 

namespace app\models;

use yii;
use yii\base\Model;
use yii\web\UploadedFile;
use PhpOffice\PhpSpreadsheet\IOFactory;

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
            
            // read the content
            // $this->readData($filePath);

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

    public function readData($filePath)
    {
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();

        $header = [];
        $data = [];

        // Read the header row
        foreach ($worksheet->getRowIterator(1, 1) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            foreach ($cellIterator as $cell) {
                $header[] = $cell->getValue(); // Store header values
            }
        }

        // echo '<pre>'; var_dump($header); echo '</pre>'; 

        // Read the data rows
        foreach ($worksheet->getRowIterator(2) as $row) { // Start from row 2 to skip the header
            $rowData = [];
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            $columnIndex = 0;
            foreach ($cellIterator as $cell) {
                $headerValue = $header[$columnIndex] ?? 'undefined'; // Get header value
                $rowData[$headerValue] = $cell->getValue(); // Map data to header
                $columnIndex++;
            }
            $data[] = $rowData; // Store the row data
        }

    }

}
