<?php

use yii\db\Migration;
use PhpOffice\PhpSpreadsheet\IOFactory;
use app\utils\StringHelper as UtilsStringHelper;

/**
 * Class m241027_105354_sync_columns_upload_lazada_table
 */
class m241027_105354_sync_columns_upload_lazada_table extends Migration
{

    private $tableName = 'lazada';
    private $filename = 'lazada-header.xlsx';
    private $sheetIndex = 0;
    private $filePath;

    private $columnsToKeep = ['id', 'id_file_source']; 

    private $columnsVarchar = [
        'order_item_id', 'order_type', 'guarantee', 'delivery_type', 'lazada_id', 'seller_sku', 'lazada_sku',
        'ware_house', 'create_time', 'update_time', 'rts_sla', 'tts_sla', 'order_number', 'invoice_required',
        'invoice_number', 'delivered_date', 'customer_name', 'customer_email', 'national_registration_number',        
        'shipping_phone', 'shipping_phone2', 'shipping_city', 'shipping_post_code', 'shipping_country', 'shipping_region',
        'billing_name',
        'billing_phone', 'billing_phone2', 'billing_city', 'billing_post_code', 'billing_country', 'tax_code',
        'branch_number', 'tax_invoice_requested', 'pay_method', 
        'item_name', 'variation', 'cd_shipping_provider', 'shipping_provider', 'shipment_type_name', 'shipping_provider_type',
        'cd_tracking_code', 'tracking_code', 'tracking_url', 'shipping_provider_fm', 'tracking_code_fm', 'tracking_url_fm', 
        'promised_shipping_time', 'premium', 'status'
    ];

    private $columnsNumeric = [
       'paid_price', 'unit_price', 'seller_discount_total', 'shipping_fee', 'wallet_credit', 'bundle_discount', 'refund_amount'
    ];

    private $columnText = [
        'shipping_name', 'shipping_address', 'shipping_address2', 'shipping_address3', 'shipping_address4', 'shipping_address5',
        'billing_addr', 'billing_addr2', 'billing_addr3', 'billing_addr4', 'billing_addr5',
        'buyer_failed_delivery_return_initiator', 'buyer_failed_delivery_reason',
        'buyer_failed_delivery_detail', 'buyer_failed_delivery_user_name',
        'bundle_id', 'semi_managed', 'flexible_delivery_time', 
        'seller_note'
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
        // echo "m241027_105354_sync_columns_upload_lazada_table cannot be reverted.\n";

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
        echo "m241027_105354_sync_columns_upload_lazada_table cannot be reverted.\n";

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
