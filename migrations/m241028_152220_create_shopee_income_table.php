<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shopee_income}}`.
 */
class m241028_152220_create_shopee_income_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shopee_income}}', [
            'id' => $this->primaryKey(),
            'id_file_source' => $this->integer()->null(),  // Add column with integer type and default null
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shopee_income}}');
    }
}
