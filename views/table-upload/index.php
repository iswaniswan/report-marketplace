<?php

use app\models\TableUpload;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FileSourceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Daftar Tabel';
// $this->params['breadcrumbs'][] = $this->title;

$this->params['breadcrumbs'][] = ['label' => 'Home', 'url' => ['site/index']];
$this->params['breadcrumbs'][] = ['label' => 'Tabel'];

echo \app\widgets\Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'title' => 'Tabel'    ],
]) ?>

<div class="row mb-4">
    <div class="container-fluid">
        <div class="dt-button-wrapper">
            <?php /* Html::a('<i class="ti-plus mr-2"></i> Add', ['upload'], ['class' => 'btn btn-primary mb-1']) */ ?>
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
                <h4 class="header-title" style="">
                    <?= $this->title ?>
                </h4>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 3%;">#</th>
                            <th>Nama</th>
                            <th style="width: 20%;">Jumlah Baris</th>
                            <th style="width: 10%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $index = 0; foreach (TableUpload::getList() as $key => $value) { ?>
                            <tr>
                                <td><?= $index +1 ?></td>
                                <td><?= $value ?></td>
                                <td><?= TableUpload::getCountRows($key, $formatted=true) ?></td>
                                <td><?= Html::a('<i class="ti-shift-right"></i>', ['ginee/index', 'id' => @$key], ['title' => 'Tampilkan']); ?></td>
                            </tr>
                        <?php $index++; } ?>
                    </tbody>
                </table>
                <?php /* \app\widgets\DataTables::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => ['class' => 'table table-hover table-bordered'],
                'clientOptions' => [
                'dom' => 'lfrtipB',
                'buttons' => ['copy', 'csv', 'excel', 'pdf', 'print']
                ],
                'columns' => [
                                                        ['class' => 'yii\grid\SerialColumn'],
                                    [
                        'attribute' => 'filename',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                        //             [
                        // 'attribute' => 'path',
                        // 'format' => 'raw',
                        // 'headerOptions' => ['style' => 'text-align:left;'],
                        // 'contentOptions' => ['style' => 'text-align:left'],
                        // ],
                                    [
                        'attribute' => 'date_created',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'date_updated',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                     [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{download} {view} {update} {delete}',
                    'visibleButtons' => ['download' => true, 'view' => false, 'update' => false, 'delete' => true],
                    'buttons' => [
                        'download' => function ($url, $model) {
                            return Html::a('<i class="ti-download"></i>', ['download', 'id' => @$model->id], ['title' => 'Download', 'target' => '_blank']);
                        },
                        'view' => function ($url, $model) {
                            return Html::a('<i class="ti-eye"></i>', ['view', 'id' => @$model->id], ['title' => 'Detail', 'data-pjax' => '0']);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<i class="ti-pencil"></i>', ['update', 'id' => @$model->id], ['title' => 'Detail', 'data-pjax' => '0']);
                            },
                        'delete' => function ($url, $model) {
                            return Html::a('<i class="ti-trash"></i>', ['delete', 'id' => @$model->id],['title' => 'Delete', 'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'), 'data-method'  => 'post']);
                            },
                    ],
                ],
                ],
                ]); */?>
            </div>
        </div>
    </div>
</div>

<?php
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
JS;

$this->registerJs($script, \yii\web\View::POS_END);

?>