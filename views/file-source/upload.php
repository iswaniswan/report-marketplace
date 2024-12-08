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

// var_dump($code);

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
                            <label for="id_table">Import data ke tabel</label>
                            <select class="form-control" id="id_table" name="FileUploadForm[id_table]" placeholder="Pilih tabel">
                                <option value="">Pilih Tabel</option>
                                <?php foreach (TableUpload::getListUpload() as $key => $value) { ?>
                                    <?php if ($value == 'ginee') {continue;} ?>
                                    <?php $isSelected = (@$fileSource->id_table != null && $fileSource->id_table == $key) ? 'selected' : ''; ?>
                                    <?php if (@$code != null && $code == $value) {
                                        $isSelected = 'selected';
                                    } ?>
                                    <option value="<?= $key ?>" <?= $isSelected ?>><?= $value ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="periode">Periode</label>
                            <?php $periode = ''; if (@$fileSource->month != null && @$fileSource->year != null) {
                                $periode = $fileSource->year . '-' . str_pad($fileSource->month, 2, '0', STR_PAD_LEFT);
                            } ?>

                            <?php if (@$year != null && @$month != null) {
                                $periode = $year . '-' . sprintf('%02d', $month);
                            } ?>
                            <input type="month" id="periode" name="FileUploadForm[periode]" min="2020-01" max="2030-12" value="<?= $periode ?>" class="form-control" onclick="this.showPicker();">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="periode">Info</label>
                            <p class="text-secondary font-italic">File yang diunggah akan memperbarui <strong>(replace)</strong> file sebelumnya sesuai dengan periode yang dipilih.</p>
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
                        'uploadClass' => 'btn btn-warning float-right',
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

                <?= Html::a('<i class="ti-arrow-left"></i><span class="ml-2">Back</span>', $referrer, ['class' => 'btn btn-info mb-1 mt-4']) ?>
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

<?php 

$script = <<<JS
    $(document).ready(function() {
        $('button[type="submit"]').on('click', function() {
            const idTable = $('#id_table').val();
            const periode = $('#periode').val();
            const file = $('input[type="file"]').val();

            if (idTable == '') {
                alert('Tabel belum pilih!');
                return false;
            }

            if (periode == '') {
                alert('Periode belum dipilih!');
                return false;
            }

            if (file == '') {
                alert('File belum dipilih!');
                return false;
            }
            
        })
    });
JS;

$this->registerJs($script);

?>