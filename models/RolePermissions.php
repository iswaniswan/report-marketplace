<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "role_permissions".
 *
 * @property int $id
 * @property int $id_role Role Type (e.g., admin, editor)
 * @property int $id_menu Role Type (e.g., admin, editor)
 * @property string $action Action name (e.g., index, update)
 * @property string|null $permission Permission (e.g., create, read, update, delete)
 * @property string $created_at Creation Timestamp
 * @property string $updated_at Last Update Timestamp
 * @property Menu|null $roleMenu
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
            [['id_role', 'id_menu', 'action'], 'required'],
            [['id_role', 'id_menu'], 'integer'],
            [['permission'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['action'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_role' => 'Id Role',
            'id_menu' => 'Id Menu',
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

    public static function getAllRolePermission($id_role)
    {
        $query = static::find()->where([
            'id_role' => $id_role
        ]);

        return $query->all();
    }

    public function getRoleMenu()
    {
        return $this->hasOne(Menu::class, ['id' => 'id_menu']);
    }

}
