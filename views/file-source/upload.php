<?php
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FileUploadForm */

$this->title = 'Upload File';
?>

<div class="file-upload">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'file')->widget(FileInput::class, [
        'options' => ['accept' => 'image/*,application/pdf,.docx'],
        'pluginOptions' => [
            'showPreview' => true,
            'showUpload' => false,
            'browseLabel' => 'Select File',
            'removeLabel' => '',
            'allowedFileExtensions' => ['jpg', 'png', 'jpeg', 'pdf', 'docx'],
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Upload', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
