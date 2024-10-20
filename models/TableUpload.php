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
            static::GINEE => 'ginee'
        ];
    }

}
