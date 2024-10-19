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

    public $is_unmerge_cells;
    public $is_header_otomatis;
    public $is_proses_data;

    public function rules()
    {
        return [
            [['is_proses_data', 'is_unmerge_cells', 'is_header_otomatis'], 'safe'],
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
            
            if ($this->is_proses_data) {
                // read the content
                $this->readData($filePath);
            }

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

        if ($this->is_unmerge_cells) {
            // Get all merged cell ranges in the sheet
            $mergedCells = $worksheet->getMergeCells();

            // Loop through each merged cell range
            foreach ($mergedCells as $mergedRange) {
                // Unmerge the cells
                $worksheet->unmergeCells($mergedRange);

                // Get the starting cell of the merged range
                $startCell = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::extractAllCellReferencesInRange($mergedRange)[0];
                $value = $worksheet->getCell($startCell)->getValue();

                // Fill all cells in the range with the original merged value
                $cellsInRange = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::extractAllCellReferencesInRange($mergedRange);
                foreach ($cellsInRange as $cell) {
                    $worksheet->setCellValue($cell, $value);
                }
            }

            // Save the unmerged spreadsheet to a new file
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save($filePath);

            // reload after saved
            // $spreadsheet = IOFactory::load($filePath);
            // $worksheet = $spreadsheet->getActiveSheet();
        }

        // $header = [];
        // $data = [];

        // // Read the header row
        // foreach ($worksheet->getRowIterator(1, 1) as $row) {
        //     $cellIterator = $row->getCellIterator();
        //     $cellIterator->setIterateOnlyExistingCells(false);
        //     foreach ($cellIterator as $cell) {
        //         $header[] = $cell->getValue(); // Store header values
        //     }
        // }

        // // echo '<pre>'; var_dump($header); echo '</pre>'; 

        // // Read the data rows
        // foreach ($worksheet->getRowIterator(2) as $row) { // Start from row 2 to skip the header
        //     $rowData = [];
        //     $cellIterator = $row->getCellIterator();
        //     $cellIterator->setIterateOnlyExistingCells(false);
        //     $columnIndex = 0;
        //     foreach ($cellIterator as $cell) {
        //         $headerValue = $header[$columnIndex] ?? 'undefined'; // Get header value
        //         $rowData[$headerValue] = $cell->getValue(); // Map data to header
        //         $columnIndex++;
        //     }
        //     $data[] = $rowData; // Store the row data
        // }

    }

}
