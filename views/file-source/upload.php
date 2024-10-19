<?php
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Html;
use app\assets\DropifyAsset;

/* @var $this yii\web\View */
/* @var $model app\models\FileUploadForm */

$this->title = 'Upload Excel File';
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Upload';

DropifyAsset::register($this);


echo \app\widgets\Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'title' => 'Upload Excel File'
    ],
]) ?>

<div class="row mb-4">
    <div class="container-fluid">
        <div class="dt-button-wrapper">            
        </div>

        <div class="member-index card-box shadow mb-4">
            <div class="file-upload">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                <div class="form-group">
                    <label for="exampleInputEmail1">Pengaturan</label>
                </div>
                <div class="row mb-4">
                    <div class="col-3">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="is_proses_data" name="FileUploadForm[is_proses_data]" checked>
                            <label class="form-check-label" for="is_proses_data">Proses Data</label>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="is_header_otomatis" name="FileUploadForm[is_header_otomatis]" checked>
                            <label class="form-check-label" for="is_header_otomatis">Header otomatis</label>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="is_unmerge_cells" name="FileUploadForm[is_unmerge_cells]" checked>
                            <label class="form-check-label" for="is_unmerge_cells">Unmerge Cells</label>
                        </div>
                    </div>
                </div>
                

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
        </div>
    </div>
</div>


<style>
    .help-block {
        display: none !important;
    }
</style>