<?php

namespace app\models;

use app\utils\Permission;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property int|null $id_parent
 * @property string|null $name
 * @property string|null $code
 * @property int|null $status
 * @property string|null $date_created
 * @property string|null $date_updated
 * @property Menu|null $parent
 * @property Menu|null $childs
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_parent', 'status', 'n_order'], 'integer'],
            [['date_created', 'date_updated'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 288],
            [['status'], 'default', 'value' => 1],
            [['n_order'], 'default', 'value' => 0]
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
            'name' => 'Name',
            'code' => 'Code',
            'n_order' => 'Order',
            'status' => 'Status',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
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
        ])->orderBy(['id_parent' => SORT_ASC, 'n_order' => SORT_ASC])
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
