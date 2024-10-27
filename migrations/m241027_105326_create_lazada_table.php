<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lazada}}`.
 */
class m241027_105326_create_lazada_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%lazada}}', [
            'id' => $this->primaryKey(),
            'id_file_source' => $this->integer()->null(),  // Add column with integer type and default null
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%lazada}}');
    }
}
