<?php
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Html;
use app\assets\DropifyAsset;

/* @var $this yii\web\View */
/* @var $model app\models\FileUploadForm */

$this->title = 'Upload File';
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';

DropifyAsset::register($this);

?>
<div class="file-upload">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'file')->widget(FileInput::classname(), [
        'pluginOptions' => [
            'showPreview' => true,
            'showUpload' => false,
            'browseLabel' => 'Select File',
            'browseClass' => 'btn btn-success',
            'showCaption' => true,
            'showCancel' => true,
            'showUpload' => true,
            'uploadClass' => 'btn btn-primary float-right',
            'removeClass' => 'btn btn-danger',
            'removeIcon' => '<span class="ti-trash"></span> ',
            'allowedFileExtensions' => ['xls', 'xlsx'],
        ],
        'options' => [
            'multiple' => false,
            'accept' => '.xls,.xlsx',
            'style' => 'margin-bottom: 200px;'
        ]
    ]); ?>

    <?php ActiveForm::end(); ?>
</div>


<style>
    .help-block {
        display: none !important;
    }
</style>