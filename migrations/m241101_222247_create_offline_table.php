<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%offline}}`.
 */
class m241101_222247_create_offline_table extends Migration
{
    private $tableName = 'offline';

    private $columnsVarchar = [
       'no_invoice', 'tanggal_invoice', 'nama_customer', 'alamat_customer', 'no_hp_customer', 'kode_sku', 'nama_barang',  'tanggal_bayar'
    ];

    private $columnsNumeric = [
       'quantity', 'harga_satuan', 'subtotal', 'adjustment', 
    ];

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%offline}}', [
            'id' => $this->primaryKey(),
        ]);

        $this->initColumns();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%offline}}');
    }

    private function initColumns()
    {
        foreach ($this->columnsVarchar as $columnName) {
            if (!$this->db->schema->getTableSchema($this->tableName)->getColumn($columnName)) {
                $this->addColumn($this->tableName, $columnName, $this->string(255)->null());
            }
        }

        foreach ($this->columnsNumeric as $columnName) {
            if (!$this->db->schema->getTableSchema($this->tableName)->getColumn($columnName)) {
                $this->addColumn($this->tableName, $columnName, $this->integer()->null()->defaultValue(0));
            }
        }
    }


}
