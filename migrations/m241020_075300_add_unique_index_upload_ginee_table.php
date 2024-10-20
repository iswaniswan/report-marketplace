<?php

use yii\db\Migration;

/**
 * Class m241020_075300_add_unique_index_upload_ginee_table
 */
class m241020_075300_add_unique_index_upload_ginee_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex(
            'unique_ginee',        // Index name
            'ginee',          // Table name
            ['id_pesanan', 'sku'],     // Columns for unique index
            true                       // Unique index flag
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m241020_075300_add_unique_index_upload_ginee_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241020_075300_add_unique_index_upload_ginee_table cannot be reverted.\n";

        return false;
    }
    */
}
