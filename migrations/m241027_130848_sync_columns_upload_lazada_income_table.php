<?php

use yii\db\Migration;
use PhpOffice\PhpSpreadsheet\IOFactory;
use app\utils\StringHelper as UtilsStringHelper;

/**
 * Class m241027_130848_sync_columns_upload_lazada_income_table
 */
class m241027_130848_sync_columns_upload_lazada_income_table extends Migration
{

    private $tableName = 'lazada_income';
    private $filename = 'lazada-income-header.xlsx';
    private $sheetIndex = 0;
    private $filePath;

    private $columnsToKeep = ['id', 'id_file_source']; 

    private $columnsVarchar = [
        'statement_period', 'statement_number', 'transaction_date', 'fee_name', 'release_status', 'release_date',
        'comment', 'order_creation_date', 'order_number', 'order_line_id', 'seller_sku', 'lazada_sku', 'wht_included_in_amount',
        'order_status', 'product_name'
    ];

    private $columnsNumeric = [
       'amount_include_tax', 'vat_amount', 'wht_amount'
    ];

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
        // echo "m241027_130848_sync_columns_upload_lazada_income_table cannot be reverted.\n";

        // return false;

        $tableSchema = $this->db->schema->getTableSchema($this->tableName);

        if ($tableSchema !== null) {
            // Loop through all columns
            foreach ($tableSchema->columns as $columnName => $column) {
                // Drop the column if it's not in the list of columns to keep
                if (!in_array($columnName, $this->columnsToKeep)) {
                    $this->dropColumn($this->tableName, $columnName);
                }
            }
        }  

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241027_130848_sync_columns_upload_lazada_income_table cannot be reverted.\n";

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
        $spreadsheet->setActiveSheetIndex($this->sheetIndex);
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
                $columnName = UtilsStringHelper::camelToSnakeCase($cell->getValue());
                $columnName = UtilsStringHelper::sanitizeColumnName($columnName);
                             
                $headers[] = $columnName; // Store header values
            }
        }

        // echo '<pre>'; var_dump($headers); echo '</pre>'; die();

        // Read the data rows
        foreach ($headers as $header) {
            $columnName = strtolower(str_replace(' ', '_', $header));
            if (!$this->db->schema->getTableSchema($this->tableName)->getColumn($columnName)) {
                // dipakai untuk index
                if (in_array($columnName, $this->columnsVarchar)) {
                    $this->addColumn($this->tableName, $columnName, $this->string(255)->null());
                } else if (in_array($columnName, $this->columnsNumeric)) {
                    $this->addColumn($this->tableName, $columnName, $this->integer()->null()->defaultValue(0));
                } else {
                    $this->addColumn($this->tableName, $columnName, $this->text()->null());
                }
            }
        }
    }

}
