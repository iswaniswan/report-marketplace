<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "access".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $permission
 * @property int $status
 * @property string $date_created
 * @property string|null $date_updated
 * @property MENU[] $allMenu
 * @property AccessDetail[] $allAccessDetail
 */
class Access extends \yii\db\ActiveRecord
{
    public $menu;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'access';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['permission'], 'string'],
            [['status'], 'integer'],
            [['date_created', 'date_updated'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['status'], 'default', 'value' => 1],
            [['menu'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'permission' => 'Permission',
            'status' => 'Status',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
        ];
    }

    public function getAllAccessDetail()
    {
        return $this->hasMany(AccessDetail::class, ['id_access' => 'id']);
    }

    public function deleteAccessDetail()
    {
        return AccessDetail::deleteAll([
            'id_access' => $this->id
        ]);
    }

    public function getBadgeStatus()
    {
        $text = $this->status == '1' ? 'Active' : 'Inactive';

        $html = <<<HTML
                <span class="badge badge-light-dark">$text</span>
        HTML;

        if ($this->status == '1') {
            $html = <<<HTML
                    <span class="badge badge-light-success">$text</span>
            HTML;
        }

        return $html;
    }

}
