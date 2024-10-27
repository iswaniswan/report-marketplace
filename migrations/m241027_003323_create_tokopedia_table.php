<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tokopedia}}`.
 */
class m241027_003323_create_tokopedia_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tokopedia}}', [
            'id' => $this->primaryKey(),
            'id_file_source' => $this->integer()->null(),  // Add column with integer type and default null
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tokopedia}}');
    }
}
