<?php

use yii\db\Migration;

/**
 * Class m241121_231039_upgrade_menu_table
 */
class m241121_231039_upgrade_menu_table extends Migration
{
    protected $tableName = 'menu';

    protected $newColumns = [
        'icon',
        'url'
    ];

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {        
        foreach ($this->newColumns as $columnName) {
            $this->addColumn($this->tableName, $columnName, $this->string(255)->null());
        }

        $this->reInitialization();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // echo "m241121_231039_upgrade_menu_table cannot be reverted.\n";

        $tableSchema = $this->db->schema->getTableSchema($this->tableName);

        if ($tableSchema !== null) {
            // Loop through all columns
            foreach ($tableSchema->columns as $columnName => $column) {
                // Drop the column if it's not in the list of columns to keep
                if (in_array($columnName, $this->newColumns)) {
                    $this->dropColumn($this->tableName, $columnName);
                }
            }
        }  
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241121_231039_upgrade_menu_table cannot be reverted.\n";

        return false;
    }
    */

    public function reInitialization()
    {
        $this->truncateTable('menu');

         // root
         $this->batchInsert('{{%menu}}', 
         ['id', 'id_parent', 'route', 'name', 'n_order', 'icon', 'url'], 
         [
             [1, 0, 'dashboard', 'Dashboard', '1', 'ti-dashboard', '/dashboard/index'],
             [2, 0, 'report', 'Report', '2', 'ti-file', null],
             [3, 0, 'file-source', 'File Unggah', '3', 'ti-file', '/file-source/index"'],
             [4, 0, 'offline', 'Offline', '4', 'ti-receipt', '/offline/index'],
             [5, 0, 'setting', 'Setting', '5', 'ti-settings', null],
         ]);

         // report
        $this->batchInsert('{{%menu}}', 
        ['id', 'id_parent', 'route', 'name', 'n_order', 'icon', 'url'], 
        [
            [6, 2, 'shopee', 'Shopee', '201', null, null],
            [7, 2, 'tiktok', 'Tiktok', '202', null, null],
            [8, 2, 'tokopedia', 'Tokopedia', '203', null, null],
            [9, 2, 'lazada', 'Lazada', '204', null, null],
            [10, 2, 'offline', 'Offline', '205', null, null],
        ]);

        // shopee
        $this->batchInsert('{{%menu}}', 
            ['id', 'id_parent', 'route', 'name', 'n_order', 'icon', 'url'], 
            [
                [11, 6, 'summary', 'Summary', '20101', null, '/shopee/index-summary'],
                [12, 6, 'table', 'Tabel', '20102', null, '/shopee/index-serverside'],
                [13, 6, 'table-income', 'Tabel Income', '20103', null, '/shopee-income/index-serverside'],
            ]);

        // tiktok
        $this->batchInsert('{{%menu}}', 
            ['id', 'id_parent', 'route', 'name', 'n_order', 'icon', 'url'], 
            [
                [14, 7, 'summary', 'Summary', '20201', null, '/tiktok/index-summary'],
                [15, 7, 'table', 'Tabel', '20202', null, '/tiktok/index-serverside'],
                [16, 7, 'table-income', 'Tabel Income', '20203', null, '/tiktok-income/index-serverside'],
            ]);

        // tokopedia
        $this->batchInsert('{{%menu}}', 
            ['id', 'id_parent', 'route', 'name', 'n_order', 'icon', 'url'], 
            [
                [17, 8, 'summary', 'Summary', '20301', null, '/tokopedia/index-summary'],
                [18, 8, 'table', 'Tabel', '20302', null, '/tokopedia/index-serverside'],
                [19, 8, 'table-keuangan', 'Tabel Keuangan', '20303', null, '/tokopedia-keuangan/index-serverside'],
            ]);

         // lazada
         $this->batchInsert('{{%menu}}', 
            ['id', 'id_parent', 'route', 'name', 'n_order', 'icon', 'url'], 
            [
                [20, 9, 'summary', 'Summary', '20401', null, '/lazada/index-summary'],
                [21, 9, 'table', 'Tabel', '20402', null, '/lazada/index-serverside'],
                [22, 9, 'table-income', 'Tabel Income', '20403', null, '/lazada-income/index-serverside'],
            ]);

         // offline
        $this->batchInsert('{{%menu}}', 
            ['id', 'id_parent', 'route', 'name', 'n_order', 'icon', 'url'], 
            [
                [23, 10, 'summary', 'Summary', '20501', null, '/offline-report/index-summary'],
                [24, 10, 'table', 'Tabel', '20502', null, '/offline-report/index-serverside'],
            ]);
            
        // user
        $this->batchInsert('{{%menu}}', 
            ['id', 'id_parent', 'route', 'name', 'n_order', 'icon', 'url'], 
            [
                [25, 5, 'user', 'User', '501', null, '/user'],
                [26, 5, 'role', 'Role', '502', null, '/role'],
            ]);
        
    }

}
