<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "approval_stage".
 *
 * @property int $id
 * @property string $model
 * @property int $id_model
 * @property int $n_order
 */
class ApprovalStage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'approval_stage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['model', 'id_model', 'n_order'], 'required'],
            [['id_model', 'n_order'], 'integer'],
            [['model'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'model' => 'Model',
            'id_model' => 'Id Model',
            'n_order' => 'N Order',
        ];
    }
}
