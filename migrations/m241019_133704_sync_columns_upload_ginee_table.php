<?php

use yii\db\Migration;
use PhpOffice\PhpSpreadsheet\IOFactory;
use app\components\StringHelper;
use app\utils\StringHelper as UtilsStringHelper;

/**
 * Class m241019_133704_sync_columns_upload_ginee_table
 */
class m241019_133704_sync_columns_upload_ginee_table extends Migration
{
    private $tableName = 'ginee';
    private $filename = 'ginee-header.xlsx';
    private $filePath;


    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->initFile();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m241019_133704_sync_columns_upload_ginee_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241019_133704_sync_columns_upload_ginee_table cannot be reverted.\n";

        return false;
    }
    */

    public function initFile()
    {
        $this->filePath = Yii::getAlias('@app').'/web/uploads/' . $this->filename;

        if (!file_exists($this->filePath)) {
            var_dump($this->filePath) .PHP_EOL;
            die('file not exists!');
        }


        $spreadsheet = IOFactory::load($this->filePath);
        $worksheet = $spreadsheet->getActiveSheet();

        $headers = [];
        // Read the header row
        foreach ($worksheet->getRowIterator(1, 1) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            foreach ($cellIterator as $cell) {
                /**
                 * standarized the naming of column 
                 * Lowercase Conversion: Converts all characters to lowercase to ensure consistency.
                 * Replace Invalid Characters: Uses a regular expression to replace any character that is not a letter, number, or underscore with an underscore.
                 * Trim Extra Underscores: Removes leading or trailing underscores to keep the column name clean.
                 * 
                */
                $columnName = UtilsStringHelper::sanitizeColumnName($cell->getValue());
                $headers[] = $columnName; // Store header values
            }
        }

        // echo '<pre>'; var_dump($headers); echo '</pre>'; die();

        // Read the data rows
        foreach ($headers as $header) {
            $columnName = strtolower(str_replace(' ', '_', $header));
            if (!$this->db->schema->getTableSchema($this->tableName)->getColumn($columnName)) {
                // dipakai untuk index
                if ($columnName == 'id_pesanan' || $columnName == 'sku') {
                    $this->addColumn($this->tableName, $columnName, $this->string(255)->null());
                } else {
                    $this->addColumn($this->tableName, $columnName, $this->text()->null());
                }
            }
        }
    }

}
