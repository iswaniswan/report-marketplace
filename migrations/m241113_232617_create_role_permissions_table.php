<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%role_permissions}}`.
 */
class m241113_232617_create_role_permissions_table extends Migration
{

    const ADMIN = 1;
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%role_permissions}}', [
            'id' => $this->primaryKey(),
            'id_parent' => $this->integer()->null(),
            'id_role' => $this->integer()->notNull()->comment('Role Type (e.g., admin, editor)'),
            'route' => $this->string(255)->notNull()->comment('Route or controller name (e.g., dashboard, user)'),
            'action' => $this->string(255)->notNull()->comment('Action name (e.g., index, update)'),
            'permission' => $this->text()->null()->comment('Permission (e.g., create, read, update, delete)'),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->comment('Creation Timestamp'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')->comment('Last Update Timestamp'),
            'alias' => $this->string(255)->null()->comment('text alias'),
        ]);

        $this->createIndex(
            'idx-role_permissions',
            '{{%role_permissions}}',
            ['id_parent', 'id_role']
        );

        $this->initData();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-role_permissions', '{{%role_permissions}}');
        $this->dropTable('{{%role_permissions}}');
    }

    public function initData()
    {
        $permissions = [
            'index', 'create', 'read', 'update', 'delete', 'download'
        ];
        $permissions = json_encode($permissions);

        // root
        $this->batchInsert('{{%role_permissions}}', 
                ['id', 'id_role', 'route', 'action', 'permission', 'alias'], 
                [
                    [1, 1, 'dashboard', 'index', $permissions, 'Dashboard'],
                    [2, 1, 'report', 'index', $permissions, 'Report'],
                    [3, 1, 'file-source', 'index', $permissions, 'File Unggah'],
                    [4, 1, 'offline', 'index', $permissions, 'Offline'],
                    [5, 1, 'setting', 'index', $permissions, 'Setting'],
                ]);

        // report
        $this->batchInsert('{{%role_permissions}}', 
                ['id', 'id_parent', 'id_role', 'route', 'action', 'permission', 'alias'], 
                [
                    [6, 2, 1, 'shopee', 'index', $permissions, 'Shopee'],
                    [7, 2, 1, 'tiktok', 'index', $permissions, 'Tiktok'],
                    [8, 2, 1, 'tokopedia', 'index', $permissions, 'Tokopedia'],
                    [9, 2, 1, 'lazada', 'index', $permissions, 'Lazada'],
                    [10, 2, 1, 'offline', 'index', $permissions, 'Offline'],
                ]);

        // shopee
        $this->batchInsert('{{%role_permissions}}', 
                ['id', 'id_parent', 'id_role', 'route', 'action', 'permission', 'alias'], 
                [
                    [11, 6, 1, 'summary', 'index', $permissions, 'Summary'],
                    [12, 6, 1, 'table', 'index', $permissions, 'Tabel'],
                    [13, 6, 1, 'table-income', 'index', $permissions, 'Tabel Income'],
                ]);

        // tiktok
        $this->batchInsert('{{%role_permissions}}', 
                ['id', 'id_parent', 'id_role', 'route', 'action', 'permission', 'alias'], 
                [
                    [14, 7, 1, 'summary', 'index', $permissions, 'Summary'],
                    [15, 7, 1, 'table', 'index', $permissions, 'Tabel'],
                    [16, 7, 1, 'table-income', 'index', $permissions, 'Tabel Income'],
                ]);

        // tokopedia
        $this->batchInsert('{{%role_permissions}}', 
                ['id', 'id_parent', 'id_role', 'route', 'action', 'permission', 'alias'], 
                [
                    [17, 8, 1, 'summary', 'index', $permissions, 'Summary'],
                    [18, 8, 1, 'table', 'index', $permissions, 'Tabel'],
                    [19, 8, 1, 'table-keuangan', 'index', $permissions, 'Tabel Keuangan'],
                ]);

        // lazada
        $this->batchInsert('{{%role_permissions}}', 
                ['id', 'id_parent', 'id_role', 'route', 'action', 'permission', 'alias'], 
                [
                    [20, 9, 1, 'summary', 'index', $permissions, 'Summary'],
                    [21, 9, 1, 'table', 'index', $permissions, 'Tabel'],
                    [22, 9, 1, 'table-income', 'index', $permissions, 'Tabel Income'],
                ]);

        // offline
        $this->batchInsert('{{%role_permissions}}', 
                ['id', 'id_parent', 'id_role', 'route', 'action', 'permission', 'alias'], 
                [
                    [23, 10, 1, 'summary', 'index', $permissions, 'Summary'],
                    [24, 10, 1, 'table', 'index', $permissions, 'Tabel'],
                ]);

        // user
        $this->batchInsert('{{%role_permissions}}', 
                ['id', 'id_parent', 'id_role', 'route', 'action', 'permission', 'alias'], 
                [
                    [25, 5, 1, 'user', 'index', $permissions, 'User'],
                    [26, 5, 1, 'role', 'index', $permissions, 'Role'],
                ]);

    }


}
