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
 * @property int|null $year
 * @property int|null $month
 * @property int|null $id_table
 * @property string|null $code_name
 */
class FileSource extends \yii\db\ActiveRecord
{

    public $periode;

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
            [['date_created', 'date_updated', 'periode'], 'safe'],
            [['year', 'month', 'id_table'], 'integer'],
            [['filename', 'path', 'code_name'], 'string', 'max' => 255],
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
            'year' => 'Year',
            'month' => 'Month',
            'id_table' => 'Id Table',
            'code_name' => 'Code Name',
        ];
    }
    public static function isFileExists($code_name=null)
    {
        $query = FileSource::find();

        return $query->where([
            'code_name' => $code_name
        ])->one();
    }

    public function getYear()
    {
        if ($this->year == null && $this->periode != null) {
            $this->year = explode('-', $this->periode)[0];
        }
        return $this->year;
    }

    public function getMonth()
    {
        if ($this->month == null && $this->periode != null) {
            $this->month = explode('-', $this->periode)[1];
        }
        return $this->month;
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            // This code will run before inserting a new record
            $this->year = (int) $this->getYear();
            $this->month = (int) $this->getMonth();
        }

        // Call the parent implementation which will continue the save process
        return parent::beforeSave($insert);
    }

    public static function getListCodeName($year=null)
    {
        $query = static::find();

        if ($year != null) {
            return $query->where(['year' => $year])->select('code_name')->column();
        }   
        
        return $query->select('code_name')->column();
    }

}
