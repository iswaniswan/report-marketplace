<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%menu}}`.
 */
class m241117_012646_create_menu_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // drop existing
        $this->execute('DROP TABLE IF EXISTS {{%menu}}');

        $this->createTable('{{%menu}}', [
            'id' => $this->primaryKey(),
            'id_parent' => $this->integer()->notNull()->defaultValue(0),
            'name' => $this->string(255)->notNull()->comment('name (e.g., dashboard, user)'),
            'route' => $this->string(255)->notNull()->comment('Route or controller name (e.g., dashboard, user)'),
            'alias' => $this->string(255)->null()->comment('text alias'),
            'status' => $this->integer()->notNull()->defaultValue(1),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->comment('Creation Timestamp'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')->comment('Last Update Timestamp'),
        ]);

        $this->createIndex(
            'idx-menu',
            '{{%menu}}',
            ['id_parent', 'route']
        );

        $this->initData();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%menu}}');
    }

    private function initData()
    {
         // root
         $this->batchInsert('{{%menu}}', 
         ['id', 'id_parent', 'route', 'name'], 
         [
             [1, 0, 'dashboard', 'Dashboard'],
             [2, 0, 'report', 'Report'],
             [3, 0, 'file-source', 'File Unggah'],
             [4, 0, 'offline', 'Offline'],
             [5, 0, 'setting', 'Setting'],
         ]);

         // report
        $this->batchInsert('{{%menu}}', 
        ['id', 'id_parent', 'route', 'name'], 
        [
            [6, 2, 'shopee', 'Shopee'],
            [7, 2, 'tiktok', 'Tiktok'],
            [8, 2, 'tokopedia', 'Tokopedia'],
            [9, 2, 'lazada', 'Lazada'],
            [10, 2, 'offline', 'Offline'],
        ]);

        // shopee
        $this->batchInsert('{{%menu}}', 
            ['id', 'id_parent', 'route', 'name'], 
            [
                [11, 6, 'summary', 'Summary'],
                [12, 6, 'table', 'Tabel'],
                [13, 6, 'table-income', 'Tabel Income'],
            ]);

        // tiktok
        $this->batchInsert('{{%menu}}', 
            ['id', 'id_parent', 'route', 'name'], 
            [
                [14, 7, 'summary', 'Summary'],
                [15, 7, 'table', 'Tabel'],
                [16, 7, 'table-income', 'Tabel Income'],
            ]);

        // tokopedia
        $this->batchInsert('{{%menu}}', 
            ['id', 'id_parent', 'route', 'name'], 
            [
                [17, 8, 'summary', 'Summary'],
                [18, 8, 'table', 'Tabel'],
                [19, 8, 'table-keuangan', 'Tabel Keuangan'],
            ]);

         // lazada
         $this->batchInsert('{{%menu}}', 
            ['id', 'id_parent', 'route', 'name'], 
            [
                [20, 9, 'summary', 'Summary'],
                [21, 9, 'table', 'Tabel'],
                [22, 9, 'table-income', 'Tabel Income'],
            ]);

         // offline
        $this->batchInsert('{{%menu}}', 
            ['id', 'id_parent', 'route', 'name'], 
            [
                [23, 10, 'summary', 'Summary'],
                [24, 10, 'table', 'Tabel'],
            ]);
            
        // user
        $this->batchInsert('{{%menu}}', 
            ['id', 'id_parent', 'route', 'name'], 
            [
                [25, 5, 'user', 'User'],
                [26, 5, 'role', 'Role'],
            ]);
    }

}
