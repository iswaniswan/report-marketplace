<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Menu".
 *
 * @property int $id
 * @property int|null $id_parent
 * @property string $route Route or controller name (e.g., dashboard, user)
 * @property string|null $alias text alias
 * @property string $created_at Creation Timestamp
 * @property string $updated_at Last Update Timestamp
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_parent'], 'integer'],
            [['route'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['route', 'alias'], 'string', 'max' => 255],
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
            'route' => 'Route',
            'alias' => 'Alias',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getParent()
    {
        return $this->hasOne(Menu::class, ['id' => 'id_parent']);
    }

    public static function getListMenu()
    {
        $query = static::find()->where([
            'status' => 1
        ])->orderBy(['id_parent' => SORT_ASC, 'id' => SORT_ASC])
            ->all();

        return ArrayHelper::map($query, 'id', 'name');
    }

    public static function isCan($id_menu=null, $id_access=null, $permission=null)
    {
        $is_can = false;

        if ($id_menu != null and $id_access != null and $permission != null) {
            $accessDetail = AccessDetail::find()->where([
                'id_access' => $id_access,
                'id_menu' => $id_menu
            ])->one();

            if ($accessDetail != null and $accessDetail->{'is_'.strtolower($permission)} == 1) {
                $is_can = true;
            }
        }

        return $is_can;
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
