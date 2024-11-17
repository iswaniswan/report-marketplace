<?php

use app\models\Menu;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%role_permissions}}`.
 */
class m241117_015733_create_role_permissions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // drop existing
        $this->execute('DROP TABLE IF EXISTS {{%role_permissions}}');

        $this->createTable('{{%role_permissions}}', [
            'id' => $this->primaryKey(),
            'id_role' => $this->integer()->notNull()->comment('Role Type (e.g., admin, editor)'),
            'id_menu' => $this->integer()->notNull()->comment('Role Type (e.g., admin, editor)'),
            'action' => $this->string(255)->notNull()->comment('Action name (e.g., index, update)'),
            'permission' => $this->text()->null()->comment('Permission (e.g., create, read, update, delete)'),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->comment('Creation Timestamp'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')->comment('Last Update Timestamp')
        ]);

        $this->createIndex(
            'idx-role_permissions',
            '{{%role_permissions}}',
            ['id_role', 'id_menu']
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-role_permissions', '{{%role_permissions}}');
        $this->dropTable('{{%role_permissions}}');
    }

}
