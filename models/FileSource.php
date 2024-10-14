<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "file_source".
 *
 * @property int $id
 * @property string|null $filename
 * @property string|null $path
 * @property string $date_created
 * @property string|null $date_updated
 */
class FileSource extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file_source';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_created', 'date_updated'], 'safe'],
            [['filename', 'path'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'filename' => 'Filename',
            'path' => 'Path',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
        ];
    }
}
