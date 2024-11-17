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
            'n_order' => $this->string(255)->null(),
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
         ['id', 'id_parent', 'route', 'name', 'n_order'], 
         [
             [1, 0, 'dashboard', 'Dashboard', '1'],
             [2, 0, 'report', 'Report', '2'],
             [3, 0, 'file-source', 'File Unggah', '3'],
             [4, 0, 'offline', 'Offline', '4'],
             [5, 0, 'setting', 'Setting', '5'],
         ]);

         // report
        $this->batchInsert('{{%menu}}', 
        ['id', 'id_parent', 'route', 'name', 'n_order'], 
        [
            [6, 2, 'shopee', 'Shopee', '201'],
            [7, 2, 'tiktok', 'Tiktok', '202'],
            [8, 2, 'tokopedia', 'Tokopedia', '203'],
            [9, 2, 'lazada', 'Lazada', '204'],
            [10, 2, 'offline', 'Offline', '205'],
        ]);

        // shopee
        $this->batchInsert('{{%menu}}', 
            ['id', 'id_parent', 'route', 'name', 'n_order'], 
            [
                [11, 6, 'summary', 'Summary', '20101'],
                [12, 6, 'table', 'Tabel', '20102'],
                [13, 6, 'table-income', 'Tabel Income', '20103'],
            ]);

        // tiktok
        $this->batchInsert('{{%menu}}', 
            ['id', 'id_parent', 'route', 'name', 'n_order'], 
            [
                [14, 7, 'summary', 'Summary', '20201'],
                [15, 7, 'table', 'Tabel', '20202'],
                [16, 7, 'table-income', 'Tabel Income', '20203'],
            ]);

        // tokopedia
        $this->batchInsert('{{%menu}}', 
            ['id', 'id_parent', 'route', 'name', 'n_order'], 
            [
                [17, 8, 'summary', 'Summary', '20301'],
                [18, 8, 'table', 'Tabel', '20302'],
                [19, 8, 'table-keuangan', 'Tabel Keuangan', '20303'],
            ]);

         // lazada
         $this->batchInsert('{{%menu}}', 
            ['id', 'id_parent', 'route', 'name', 'n_order'], 
            [
                [20, 9, 'summary', 'Summary', '20401'],
                [21, 9, 'table', 'Tabel', '20402'],
                [22, 9, 'table-income', 'Tabel Income', '20403'],
            ]);

         // offline
        $this->batchInsert('{{%menu}}', 
            ['id', 'id_parent', 'route', 'name', 'n_order'], 
            [
                [23, 10, 'summary', 'Summary', '20501'],
                [24, 10, 'table', 'Tabel', '20502'],
            ]);
            
        // user
        $this->batchInsert('{{%menu}}', 
            ['id', 'id_parent', 'route', 'name', 'n_order'], 
            [
                [25, 5, 'user', 'User', '501'],
                [26, 5, 'role', 'Role', '502'],
            ]);
    }

}
