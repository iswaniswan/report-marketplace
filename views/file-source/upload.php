<?php
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Html;
use app\assets\DropifyAsset;
use app\assets\Select2Asset;
use app\models\TableUpload;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\FileUploadForm */

$this->title = 'Upload Excel File';
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Upload';

DropifyAsset::register($this);
Select2Asset::register($this);

$style = <<<CSS
    .select2 .selection span.selection > span {
        /* display: flex;
        justify-content: space-between;
        align-items: center; */
    }
    #select2-fileuploadform-id_table-container, .select2-selection__rendered {
        /* display: flex;
        justify-content: space-between;
        align-items: center; */
        /* flex-direction: row-reverse; */
        /* width: 100%;
        padding: .25rem .5rem; */
    }
CSS;

// $this->registerCss($style);

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

                <div class="row mb-4">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="exampleSelect1">Import data ke tabel</label>
                            <select class="form-control" name="FileUploadForm[id_table]" placeholder="Pilih tabel">
                                <option value="">Pilih Tabel</option>
                                <?php foreach (TableUpload::getList() as $key => $value) { ?>
                                    <option value="<?= $key ?>"><?= $value ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>                    
                </div>

                <?php /*
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
                */ ?>                

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