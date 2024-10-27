<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tokopedia_keuangan}}`.
 */
class m241027_012334_create_tokopedia_keuangan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tokopedia_keuangan}}', [
            'id' => $this->primaryKey(),
            'id_file_source' => $this->integer()->null(),  // Add column with integer type and default null
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tokopedia_keuangan}}');
    }
}
