<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "role_permissions".
 *
 * @property int $id
 * @property int|null $id_parent
 * @property int $id_role Role Type (e.g., admin, editor)
 * @property string $action Action name (e.g., index, update)
 * @property string $permission Permission (e.g., create, read, update, delete)
 * @property string $created_at Creation Timestamp
 * @property string $updated_at Last Update Timestamp
 */
class RolePermissions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'role_permissions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_parent', 'id_role'], 'integer'],
            [['id_role', 'action', 'permission'], 'safe'],
            [['created_at', 'updated_at'], 'safe'],
            [['action', 'permission'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_parent' => 'Id Parent',
            'id_role' => 'Id Role',
            'action' => 'Action',
            'permission' => 'Permission',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function getRootMenu()
    {
        return static::find()->where([
            'id_parent' => null
        ])->all();
    }

    public static function getChildMenu($id)
    {
        return static::find()->where([
            'id_parent' => $id
        ])->all();
    }

    public static function getDefaultPermissions($all=false)
    {
        if ($all) {
            return [
                'index', 'create', 'read', 'update', 'delete', 'download'
            ];
        }

        return [
            'read'
        ];
    }

    public function isHasChild()
    {
        $query = static::find()->where([
            'id_parent' => $this->id
        ]);

        return $query->count() >= 1 ? true : false;
    }

    public static function getAllUserPermission($id_role, $root=false)
    {
        if ($id_role == null) {
            $role = new Role();
            $role->save();
            $id_role = $role->id;

            $allRootMenu = static::getRootMenu();
            foreach ($allRootMenu as $menu) {
                $model = new RolePermissions([
                    'id_role' => $id_role,
                    'route' => $menu->route,
                    'action' => $menu->action,
                    'permission' => $menu->permission,
                    'alias' => $menu->alias
                ]);

                $model->save();
            }

            $query = static::find()->where([
                'id_role' => $id_role
            ]);

            return $query->all();
        }

        $query = static::find()->where([
            'id_role' => $id_role
        ]);

        if ($root) {
            $query->andWhere([
                'id_parent' => null
            ]);
        }

        return $query->all();
    }

}


