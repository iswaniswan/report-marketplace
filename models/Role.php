<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "role".
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int|null $level
 * @property int|null $status
 * @property string $date_created
 * @property string|null $date_updated
 */
class Role extends \yii\db\ActiveRecord
{
    const ADMIN = 1;

    public $permissions;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'code'], 'safe'],
            [['level', 'status'], 'integer'],
            [['date_created', 'date_updated', 'permissions'], 'safe'],
            [['name', 'code'], 'string', 'max' => 255],
            [['status'], 'default', 'value' => 1]
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
            'code' => 'Code',
            'level' => 'Level',
            'status' => 'Status',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
        ];
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

    public static function getList()
    {
        return ArrayHelper::map(static::find()->all(),'id',function ($model) {
            return ucwords($model->name);
        });
    }
}
