<?php

use yii\db\Migration;
use PhpOffice\PhpSpreadsheet\IOFactory;
use app\utils\StringHelper as UtilsStringHelper;

/**
 * Class m241027_005154_sync_columns_upload_tokopedia_table
 */
class m241027_005154_sync_columns_upload_tokopedia_table extends Migration
{
    private $tableName = 'tokopedia';
    private $filename = 'tokopedia-header.xlsx';
    private $sheetIndex = 0;
    private $filePath;

    private $columnsToKeep = ['id', 'id_file_source']; 

    private $columnsVarchar = [
        'nomor_invoice', 'tanggal_pembayaran', 'status_terakhir', 'tanggal_pesanan_selesai', 'waktu_pesanan_selesai', 'tanggal_pesanan_dibatalkan',
        'waktu_pesanan_dibatalkan', 'nama_produk', 'tipe_produk', 'nomor_sku', 'jenis_kupon_toko_terpakai', 'kode_kupon_toko_yang_digunakan', 
        'biaya_pengiriman_tunai_idr', 'biaya_asuransi_pengiriman_idr', 'total_biaya_pengiriman_idr',
        'nama_pembeli', 'no_telp_pembeli', 'nama_penerima', 'no_telp_penerima', 'alamat_pengiriman', 'kota', 'provinsi', 'nama_kurir','tipe_pengiriman_regular_same_day_etc',
        'no_resi__kode_booking', 'tanggal_pengiriman_barang', 'waktu_pengiriman_barang', 'gudang_pengiriman',
        'nama_campaign', 'nama_bundling', 'tipe_bebas_ongkir_bebas_ongkir_bebas_ongkir_dt',
        'cod', 'jumlah_produk_yang_dikurangkan', 'total_pengurangan_idr','nama_penawaran_terpakai',
        'tingkatan_promosi_terpakai','diskon_penawaran_terpakai_idr'
    ];

    private $columnsNumeric = [
        'nomor', 'jumlah_produk_dibeli', 'harga_awal_idr', 'harga_satuan_bundling_idr', 'diskon_produk_idr', 'harga_jual_idr', 'jumlah_subsidi_tokopedia_idr',
        'nilai_kupon_toko_terpakai_idr', 'total_penjualan_idr'
    ];

    private $columnText = [
        'catatan_produk_pembeli', 'catatan_produk_penjual'
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
        // echo "m241027_005154_sync_columns_upload_tokopedia_table cannot be reverted.\n";

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
        echo "m241027_005154_sync_columns_upload_tokopedia_table cannot be reverted.\n";

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
