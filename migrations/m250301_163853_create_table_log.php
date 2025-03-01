<?php

use yii\db\Migration;

/**
 * Class m250301_163853_create_table_log
 */
class m250301_163853_create_table_log extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%log}}', [
            'id'       => $this->primaryKey(),
            'level'    => $this->string(),
            'category' => $this->string(),
            'log_time' => $this->double(),
            'prefix'   => $this->text(),  // added column
            'message'  => $this->text(),
        ]);
        $this->createIndex('idx-log-category', '{{%log}}', 'category');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // echo "m250301_163853_create_table_log cannot be reverted.\n";
        $this->dropTable('{{%log}}');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250301_163853_create_table_log cannot be reverted.\n";

        return false;
    }
    */
}
