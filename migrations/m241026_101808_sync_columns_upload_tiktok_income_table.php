<?php

use yii\db\Migration;
use PhpOffice\PhpSpreadsheet\IOFactory;
use app\utils\StringHelper as UtilsStringHelper;

/**
 * Class m241026_101808_sync_columns_upload_tiktok_income_table
 */
class m241026_101808_sync_columns_upload_tiktok_income_table extends Migration
{
    private $tableName = 'tiktok_income';
    private $filename = 'tiktok-income-header.xlsx';
    private $filePath;

    private $columnsToKeep = ['id', 'id_file_source']; 

    private $columnsVarchar = [
        'order_adjustment_id', 'type', 'order_created_time_UTC', 'order_settled_time_UTC', 'currency', 'related_order_id', 'shopping_center_items'
    ];

    private $columnsNumeric = [
        'total_settlement_amount', 'total_revenue', 'subtotal_after_seller_discounts', 'subtotal_before_discounts', 'seller_discounts',
        'refund_subtotal_after_seller_discounts', 'refund_subtotal_before_seller_discounts', 'refund_of_seller_discounts', 'total_fees',
        'tiktok_shop_commission_fee', 'flat_fee', 'sales_fee', 'mall_service_fee', 'payment_fee', 'shipping_cost', 'shipping_costs_passed_on_to_the_logistics_provider',
        'shipping_cost_borne_by_the_platform', 'shipping_cost_paid_by_the_customer', 'refunded_shipping_cost_paid_by_the_customer', 'return_shipping_costs_passed_on_to_the_customer',
        'shipping_cost_subsidy', 'affiliate_commission', 'affiliate_partner_commission', 'affiliate_shop_ads_commission', 'sfp_service_fee', 
        'live_specials_service_fee', 'bonus_cashback_service_fee', 'ajustment_amount', 'customer_payment', 'customer_refund', 'seller_co_funded_voucher_discount',
        'refund_of_seller_co_funded_voucher_discount', 'platform_discounts', 'refund_of_platform_discounts', 'platform_co_funded_voucher_discounts', 'refund_of_platform_co_funded_voucher_discounts',
        'seller_shipping_cost_discount', 'estimated_package_weight_g', 'actual_package_weight_g'
    ];

    private $emptyColumnCount = 0;

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
        // echo "m241026_101808_sync_columns_upload_tiktok_income_table cannot be reverted.\n";

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
        echo "m241026_101808_sync_columns_upload_tiktok_income_table cannot be reverted.\n";

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
                if ($columnName == '') {
                    $this->emptyColumnCount += 1;
                    $columnName = $this->renameEmptyColumnName();
                }                
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

    private function renameEmptyColumnName() {
        $text = '';
        for ($i=0; $i<$this->emptyColumnCount; $i++) {
            $text .= '#';
        }

        return $text;
    }

}
