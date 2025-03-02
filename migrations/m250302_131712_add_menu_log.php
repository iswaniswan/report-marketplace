<?php

use yii\db\Migration;

/**
 * Class m250302_131712_add_menu_log
 */
class m250302_131712_add_menu_log extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('report_marketplace.menu', [
            'id' => 29,
            'id_parent' => 0,
            'name' => 'Log',
            'route' => 'log',
            'alias' => null,
            'status' => 1,
            'n_order' => 6,
            'created_at' => '0000-00-00 00:00:00',
            'updated_at' => '2025-03-02 20:15:38',
            'icon' => 'ti-notepad',
            'url' => '/log',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('report_marketplace.menu', ['id' => 29]);

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250302_131712_add_menu_log cannot be reverted.\n";

        return false;
    }
    */
}
