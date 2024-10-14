<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "paket".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $price
 * @property int|null $poin
 * @property string|null $remark
 * @property int|null $is_active
 */
class Paket extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'paket';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price', 'poin', 'is_active'], 'integer'],
            [['name', 'remark'], 'string', 'max' => 255],
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
            'price' => 'Price',
            'poin' => 'Poin',
            'remark' => 'Remark',
            'is_active' => 'Is Active',
        ];
    }
}
