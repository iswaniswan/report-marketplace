<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "access".
 *
 * @property int $id
 * @property string|null $name
 * @property string $date_created
 * @property string|null $date_updated
 * 
 */
class TableUpload extends \yii\db\ActiveRecord
{
    public $menu;

    const GINEE = 1;
    const LAZADA = 2;
    const SHOPEE = 3;
    const TIKTOK = 4;
    const TOKOPEDIA = 5;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'table_upload';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_created', 'date_updated'], 'safe'],
            [['name'], 'string', 'max' => 255],
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
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
        ];
    }

    public static function getList()
    {
        return [
            static::GINEE => 'ginee',
            static::LAZADA => 'lazada',
            static::SHOPEE => 'shopee',
            static::TIKTOK => 'tiktok',
            static::TOKOPEDIA => 'tokopedia',
        ];
    }

    public static function getCountRows($idTable, $formatted=false)
    {
        $count = 0;

        switch ($idTable) {
            case static::GINEE: {
                $count = Ginee::getCountRows();
                break;
            }

            default: break;
        }

        if ($formatted) {
            return number_format($count, 0);
        }

        return $count;
    }

    public static function getListColorTheme()
    {
        return [
            static::GINEE => 'purple',
            static::LAZADA => 'primary',
            static::SHOPEE => 'warning',
            static::TIKTOK => 'dark',
            static::TOKOPEDIA => 'success',
        ];
    }

}
