<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ginee}}`.
 */
class m241019_132028_create_ginee_table extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {        
        $this->createTable('{{%ginee}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ginee}}');
    }

}
