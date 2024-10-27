<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lazada_income}}`.
 */
class m241027_130806_create_lazada_income_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%lazada_income}}', [
            'id' => $this->primaryKey(),
            'id_file_source' => $this->integer()->null(),  // Add column with integer type and default null
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%lazada_income}}');
    }
}
