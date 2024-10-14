<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "access_detail".
 *
 * @property int $id
 * @property int|null $id_menu
 * @property int|null $id_access
 * @property int|null $is_create
 * @property int|null $is_read
 * @property int|null $is_update
 * @property int|null $is_delete
 * @property int|null $is_approve
 * @property int|null $is_print
 * @property int|null $is_download
 * @property string $date_created
 * @property string|null $date_updated
 * @property Menu $menu
 */
class AccessDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'access_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_menu', 'id_access', 'is_create', 'is_read', 'is_update', 'is_delete', 'is_approve', 'is_print', 'is_download'], 'integer'],
            [['date_created', 'date_updated'], 'safe'],
            [['is_create', 'is_read', 'is_update', 'is_delete', 'is_approve', 'is_print', 'is_download'], 'default', 'value' => 0],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_menu' => 'Id Menu',
            'id_access' => 'Id Access',
            'is_create' => 'Create',
            'is_read' => 'Read',
            'is_update' => 'Update',
            'is_delete' => 'Delete',
            'is_approve' => 'Approve',
            'is_print' => 'Print',
            'is_download' => 'Download',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
        ];
    }

    public function getMenu()
    {
        return $this->hasOne(Menu::class, ['id' => 'id_menu']);
    }


}
