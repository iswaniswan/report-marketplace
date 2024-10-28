<?php

use yii\db\Migration;
use PhpOffice\PhpSpreadsheet\IOFactory;
use app\utils\StringHelper as UtilsStringHelper;

/**
 * Class m241028_152303_sync_columns_upload_shopee_income_table
 */
class m241028_152303_sync_columns_upload_shopee_income_table extends Migration
{

    private $tableName = 'shopee_income';
    private $filename = 'shopee-income-header.xlsx';
    private $sheetIndex = 0;
    private $sheetName = 'income';
    private $filePath;

    private $columnsToKeep = ['id', 'id_file_source']; 

    private $columnsVarchar = [
        'no_pesanan', 'no_pengajuan', 'username_pembeli', 'waktu_pesanan_dibuat', 'metode_pembayaran_pembeli', 'tanggal_dana_dilepaskan',
        'kode_voucher',  'jasa_kirim', 'nama_kurir'
    ];

    private $columnsNumeric = [       
        'no', 'harga_asli_produk', 'total_diskon_produk', 'jumlah_pengembalian_dana_ke_pembeli', 'diskon_produk_dari_shopee', 'diskon_voucher_ditanggung_penjual', 'cashback_koin_yang_ditanggung_penjual', 'ongkir_dibayar_pembeli', 'diskon_ongkir_ditanggung_jasa_kirim',
        'gratis_ongkir_dari_shopee', 'ongkir_yang_diteruskan_oleh_shopee_ke_jasa_kirim', 'ongkos_kirim_pengembalian_barang', 'pengembalian_biaya_kirim', 'biaya_komisi_ams', 'biaya_administrasi_termasuk_ppn_11', 'biaya_layanan_termasuk_ppn_11', 'premi', 'biaya_program',
        'biaya_kartu_kredit', 'biaya_kampanye', 'bea_masuk_ppn_pph', 'total_penghasilan', 'kompensasi', 'promo_gratis_ongkir_dari_penjual',
        'pengembalian_dana_ke_pembeli', 'pro_rata_koin_yang_ditukarkan_untuk_pengembalian_barang', 'pro_rata_voucher_shopee_untuk_pengembalian_barang',
        'pro_rated_bank_payment_channel_promotion_for_return_refund_items', 'pro_rated_shopee_payment_channel_promotion_for_return_refund_items'
    ];

    private $columnsText = [
       
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
        // echo "m241028_152303_sync_columns_upload_shopee_income_table cannot be reverted.\n";

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
        echo "m241028_152303_sync_columns_upload_shopee_income_table cannot be reverted.\n";

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
                $columnName = UtilsStringHelper::truncateString($columnName);
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
