<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tiktok}}`.
 */
class m241026_085210_create_tiktok_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tiktok}}', [
            'id' => $this->primaryKey(),
            'id_file_source' => $this->integer()->null(),  // Add column with integer type and default null
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tiktok}}');
    }
}
