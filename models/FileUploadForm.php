<?php 

namespace app\models;

use app\utils\StringHelper;
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
    public $id_table;
    public $periode;
    public $year;
    public $month;

    public $id_file_source;

    protected $table_ginee = 'ginee';

    public function rules()
    {
        return [
            [['is_proses_data', 'is_unmerge_cells', 'is_header_otomatis', 'id_table', 'periode', 'year', 'month', 'id_file_source'], 'safe'],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xls, xlsx', 'checkExtensionByMimeType' => false, 'maxSize' => 50 * 1024 * 1024],
        ];
    }

    public function upload()
    {
        // $filePath = Yii::getAlias('@app').'/web/uploads/' . $this->file->baseName . '.' . $this->file->extension;
        // $this->filePath = $filePath;

        $filePath = Yii::getAlias('@app').'/web/uploads/' . $this->getCodeName() . '.' . $this->file->extension;
        $this->filePath = $filePath;

        $this->path = '/web/uploads/' . $this->getCodeName() . '.' . $this->file->extension;
        
        $isDeleteInsert = false;
        // Check if the file already exists and delete it
        if (file_exists($filePath)) {
            unlink($filePath); // Delete the existing file

            // delete the existing data from table
            $isDeleteInsert = true;            
        }
        
        if ($this->validate()) {
            $this->file->saveAs($this->filePath);
            
            if ($this->id_table != null && (int) $this->id_table > 0 && $this->id_file_source != null && (int) $this->id_file_source > 0) {
                switch ($this->id_table) {
                    case TableUpload::GINEE: {
                        $this->importToGinee($isDeleteInsert);
                        break;
                    }

                    default: break;
                }
            }

            return true;
        } else {
            // Yii::error('Failed to save file to path: ' . $this->filePath);
            var_dump($this->file->extension).PHP_EOL;
            var_dump($this->errors);
            die('Failed to save file to path: ' . $this->filePath);
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

    public function importToGinee($isDeleteInsert=false)
    {
        $spreadsheet = IOFactory::load($this->filePath);
        $worksheet = $this->unmergeCells($spreadsheet, $this->filePath);
    
        $header = [];
        $data = [];

        // init id_table
        if ($this->id_file_source == null) { 
            Yii::error('Error ID File Source !!!'); die();
        }
        
        if ($isDeleteInsert) {
            // delete existing data from table ginee
            Ginee::deleteAll([
                'id_file_source' => $this->id_file_source
            ]);
        }
    
        // Read the header row
        foreach ($worksheet->getRowIterator(1, 1) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            foreach ($cellIterator as $cell) {
                // Standardize header values using a utility function if needed
                $header[] = StringHelper::sanitizeColumnName($cell->getValue());
            }
        }
            
        $header[] = 'id_file_source';

        // Maximum number of rows to insert per batch
        $batchSize = 1000;

        // Read the data rows
        foreach ($worksheet->getRowIterator(2) as $row) { // Start from row 2 to skip the header
            $rowData = [];
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            $columnIndex = 0;
    
            foreach ($cellIterator as $cell) {                
                $headerValue = $header[$columnIndex] ?? 'undefined'; // Get header value                
                $value = StringHelper::sanitizeValue($cell->getValue());
                $rowData[$headerValue] = $value;
                $columnIndex++;
            }
    
            $rowData['id_file_source'] = $this->id_file_source;
            if (!empty($rowData)) {
                $data[] = $rowData; // Store the row data
            }

            // echo '<pre>'; var_dump($header);
            // echo '<pre>'; var_dump($rowData); echo '</pre>'; die();
    
            // Insert in batches of 1000 rows
            if (count($data) >= $batchSize) {
                // echo '<pre>'; var_dump($data); echo '</pre>'; die();
                // $this->insertOrUpdateBatch($header, $data);
                $this->insertIgnoreBatch($header, $data);
                $data = []; // Clear the data array after each batch insert
            }
        }        
    
        // Insert any remaining data that didn't complete a full batch
        if (!empty($data)) {
            // $this->insertOrUpdateBatch($header, $data);
            $this->insertIgnoreBatch($header, $data);
        }
    }
    

    public function unmergeCells($spreadsheet, $filePath)
    {        
        $worksheet = $spreadsheet->getActiveSheet();
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
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();
        return $worksheet;
    }

        /**
     * Function to insert or update batch of data.
     * 
     * @param array $header Column names
     * @param array $data Data to insert
     */
    private function insertOrUpdateBatch($header, $data)
    {
        $db = Yii::$app->db;
        $sql = $db->queryBuilder->batchInsert($this->table_ginee, $header, $data);
        $sql .= ' ON DUPLICATE KEY UPDATE ';

        // Append update part of the SQL query
        $updates = [];
        foreach ($header as $column) {
            $updates[] = "$column = VALUES($column)";
        }
        $sql .= implode(', ', $updates);

        $db->createCommand($sql)->execute();
    }

    private function insertIgnoreBatch($header, $data)
    {
        $db = Yii::$app->db;
        $batchSize = 1000; // Maximum batch size

        foreach (array_chunk($data, $batchSize) as $batch) {
            // Build the base SQL for batch insert using INSERT IGNORE
            $sql = 'INSERT IGNORE INTO ' . $this->table_ginee . ' (' . implode(', ', $header) . ') VALUES ';

            // Build the values part of the SQL query
            $valuePlaceholders = [];
            $params = [];
            foreach ($batch as $row) {
                $placeholders = [];
                foreach ($row as $value) {
                    $placeholder = ':param' . count($params); // Create a unique placeholder
                    $placeholders[] = $placeholder;
                    $params[$placeholder] = $value;
                }
                $valuePlaceholders[] = '(' . implode(', ', $placeholders) . ')';
            }

            $sql .= implode(', ', $valuePlaceholders);

            // Execute the command
            try {
                // $command = $db->createCommand($sql, $params);
                // var_dump($command->getRawSql()); die();  // Outputs the raw SQL query
                // $command->execute();
                $db->createCommand($sql, $params)->execute();
            } catch (\yii\db\Exception $e) {
                Yii::error('Error inserting batch: ' . $e->getMessage());
            }
        }
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

    public function getYear()
    {
        if ($this->year == null && $this->periode != null) {
            $this->year = explode('-', $this->periode)[0];
        }
        return $this->year;
    }

    public function getMonth()
    {
        if ($this->month == null && $this->periode != null) {
            $this->month = explode('-', $this->periode)[1];
        }
        return $this->month;
    }

    public function getTableUploadName()
    {
        return TableUpload::getList()[$this->id_table] ?? null;
    }

    public function getCodeName()
    {
        $tableName = $this->getTableUploadName();

        return $tableName . $this->getYear() . $this->getMonth();
    }

}
