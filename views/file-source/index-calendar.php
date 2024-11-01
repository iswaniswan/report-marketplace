<?php

use app\models\TableUpload;
use app\models\FileSource;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FileSourceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Daftar File Unggah';
// $this->params['breadcrumbs'][] = $this->title;

$this->params['breadcrumbs'][] = ['label' => 'Home', 'url' => ['site/index']];
$this->params['breadcrumbs'][] = ['label' => 'File Unggah'];

$listColor = TableUpload::getListColorTheme();

// echo '<pre>'; var_dump($listCodeName[0]); echo '</pre>'; die();

if (@$year == null) {
    $year = date('Y');
}

echo \app\widgets\Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'title' => 'File Unggah'    ],
]) ?>

<div class="row mb-4">
    <div class="container-fluid">
        <div class="dt-button-wrapper">
            <?= Html::a('<i class="ti-layout mr-2"></i> Tabel', ['index'], ['class' => 'btn btn-purple mb-1']) ?>
            <?= Html::a('<i class="ti-plus mr-2"></i> Add', ['upload'], ['class' => 'btn btn-primary mb-1']) ?>
            <?= Html::a('<i class="ti-printer mr-2"></i> Print', ['#'], ['class' => 'btn btn-info mb-1', 'onclick' => 'dtPrint()' ]) ?>
            <div class="btn-group mr-1">
                <?= Html::a('<i class="ti-download mr-2"></i> Export', ['#'], [
                    'class' => 'btn btn-success mb-1 dropdown-toggle',
                    'data-toggle' => 'dropdown'
                ]) ?>
                <div class="dropdown-menu" x-placement="bottom-start">
                    <?= Html::a('Excel', ['#'], ['class' => 'dropdown-item', 'onclick' => 'dtExportExcel()']) ?>
                    <?= Html::a('Pdf', ['#'], ['class' => 'dropdown-item', 'onclick' => 'dtExportPdf()']) ?>
                </div>
            </div>
        </div>

        <div class="member-index card-box shadow mb-4">
            <div class="mb-4">
                <div class="col-3">
                    <div class="form-group">
                        <label for="year">Tahun</label>
                        <select name="year" id="year" class="form-control">
                            <?php for($i=2023; $i<=2030; $i++) { ?>
                                <?php $isSelected = ($year == $i) ? 'selected' : ''; ?>
                                <option value="<?= $i ?>" <?= $isSelected ?>><?= $i ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="">
                                <th>Channel</th>
                                <?php for ($i=1; $i<13; $i++) { ?>
                                    <th><?= date('M', strtotime("2024-$i-1")) ?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $colorTheme = TableUpload::getListColorTheme(); ?>
                            <?php $listChannel = TableUpload::getListUpload(); foreach ($listChannel as $channel => $value) { ?>
                                <tr>
                                    <td><span class="badge badge-pill px-2 py-1 badge-<?= $colorTheme[$channel] ?>"><?= $value ?></span></td>
                                    <?php for ($i=1; $i<13; $i++) { ?>
                                        <td>
                                            <?php $codeName = "$value$year".sprintf('%02d', $i); ?>
                                            <?php $url = Url::to([
                                                'upload-calendar', 'code_name' => $codeName,
                                                'year' => $year,
                                                'month' => sprintf('%0d', $i),
                                                'code' => $value
                                            ]); ?>
                                            <a class="px-1 text-primary" href="<?= $url ?>" title="Edit or Upload" data-pjax="0">
                                                <?php $html = "<i class='ti-plus'></i>"; ?>
                                                <?php if (in_array($codeName, $listCodeName)) {
                                                    $html = "<i class='ti-pencil-alt text-purple'></i>";
                                                } echo $html; ?>
                                            </a>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$url = Url::to(['index-calendar']);

$script = <<<JS
    const dtPrint = () => {
        const dtBtn = $('.btn.buttons-print');
        dtBtn.trigger('click');
    }
    const dtExportPdf = () => {
        const dtBtn = $('.btn.buttons-pdf.buttons-html5');
        dtBtn.trigger('click');
    }
    const dtExportExcel = (e) => {
        const dtBtn = $('.btn.buttons-excel.buttons-html5');
        dtBtn.trigger('click');
    }

    $(document).ready(function() {
        $('#year').on('change', function() {
            const url = '$url'+'?year='+$(this).val();
            window.location.href = url;
        })
    });

JS;

$this->registerJs($script, \yii\web\View::POS_END);

?>