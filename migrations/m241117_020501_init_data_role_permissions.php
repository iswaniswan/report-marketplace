<?php

use app\models\Menu;
use app\models\RolePermissions;
use yii\db\Migration;

/**
 * Class m241117_020501_init_data_role_permissions
 */
class m241117_020501_init_data_role_permissions extends Migration
{
    const ADMIN = 1;

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $allMenu = Menu::find()->all();

        $permissions = [
            'index', 'create', 'read', 'update', 'delete', 'download'
        ];
        $permissions = json_encode($permissions);

        foreach ($allMenu as $menu) {
            $model = new RolePermissions([
                'id_role' => static::ADMIN,
                'id_menu' => $menu->id,
                'action' => 'index',
                'permission' => $permissions
            ]);

            $model->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drop existing
        $this->execute('TRUNCATE TABLE {{%role_permissions}}');
        // echo "m241117_020501_init_data_role_permissions cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241117_020501_init_data_role_permissions cannot be reverted.\n";

        return false;
    }
    */
}
