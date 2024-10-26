<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tiktok_income}}`.
 */
class m241026_101712_create_tiktok_income_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tiktok_income}}', [
            'id' => $this->primaryKey(),
            'id_file_source' => $this->integer()->null(),  // Add column with integer type and default null
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tiktok_income}}');
    }
}
