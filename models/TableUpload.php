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
    const TIKTOK_INCOME = 6;
    const LAZADA_INCOME = 7;
    const SHOPEE_INCOME = 8;
    const OFFLINE = 9;

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
            static::TIKTOK_INCOME => 'tiktok income',
            static::LAZADA_INCOME => 'lazada income',
            static::SHOPEE_INCOME => 'shopee income',
        ];
    }

    public static function getListUpload()
    {
        return [
            static::LAZADA => 'lazada',
            static::LAZADA_INCOME => 'lazada income',
            static::SHOPEE => 'shopee',
            static::SHOPEE_INCOME => 'shopee income',
            static::TIKTOK => 'tiktok',
            static::TIKTOK_INCOME => 'tiktok income',
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
            static::TIKTOK_INCOME => 'dark',
            static::LAZADA_INCOME => 'primary',
            static::SHOPEE_INCOME => 'warning',
            static::OFFLINE => 'secondary',
        ];
    }

    public static function getListChannel()
    {
        return [
            static::LAZADA => 'lazada',
            static::SHOPEE => 'shopee',
            static::TIKTOK => 'tiktok',
            static::TOKOPEDIA => 'tokopedia',
            static::OFFLINE => 'offline'
        ];
    }

}
