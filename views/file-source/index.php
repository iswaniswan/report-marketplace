<?php

use app\models\TableUpload;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FileSourceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Daftar File Unggah';
// $this->params['breadcrumbs'][] = $this->title;

$this->params['breadcrumbs'][] = ['label' => 'Home', 'url' => ['site/index']];
$this->params['breadcrumbs'][] = ['label' => 'File Unggah'];

echo \app\widgets\Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'title' => 'File Unggah'    ],
]) ?>

<div class="row mb-4">
    <div class="container-fluid">
        <div class="dt-button-wrapper">
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
                <h4 class="header-title" style="">
                    <?= $this->title ?>
                </h4>
            </div>
            <div class="table-responsive">
                <?= \app\widgets\DataTables::widget([
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
                            'attribute' => 'id_table',
                            'header' => 'Tabel',
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:left;'],
                            'contentOptions' => ['style' => 'text-align:left'],
                            'value' => function ($model) {
                                if ($model->id_table != null) {
                                    $text = TableUpload::getList()[$model->id_table];
                                    return '<span class="badge badge-pill badge-purple px-2 py-1">'. $text .'</span>';
                                }
                            }
                            ],
                                    [
                        'attribute' => 'filename',
                        'header' => 'Nama File',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                        [
                            'attribute' => 'year',
                            'header' => 'Tahun',
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:left;'],
                            'contentOptions' => ['style' => 'text-align:left'],
                            ],
                        [
                            'attribute' => 'month',
                            'header' => 'Bulan',
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:left;'],
                            'contentOptions' => ['style' => 'text-align:left'],
                            'value' => function ($model) {
                                    if ($model->month != null) {
                                        return $model->month . '. ' . date("F", strtotime(date("Y") ."-". $model->month ."-01"));
                                    }
                                }
                            ],
                        //             [
                        // 'attribute' => 'path',
                        // 'format' => 'raw',
                        // 'headerOptions' => ['style' => 'text-align:left;'],
                        // 'contentOptions' => ['style' => 'text-align:left'],
                        // ],
                        //             [
                        // 'attribute' => 'date_created',
                        // 'format' => 'raw',
                        // 'headerOptions' => ['style' => 'text-align:left;'],
                        // 'contentOptions' => ['style' => 'text-align:left'],
                        // ],
                                    [
                        'attribute' => 'date_updated',
                        'header' => 'Tanggal Unggah',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        'value' => function ($model) {
                            return $model->date_updated ?? $model->date_created;
                        }
                        ],
                                     [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{download} {view} {update} {delete}',
                    'header' => 'Aksi',
                    'visibleButtons' => ['download' => true, 'view' => true, 'update' => true, 'delete' => true],
                    'buttons' => [
                        'download' => function ($url, $model) {
                            return Html::a('<i class="ti-download"></i>', ['download', 'id' => @$model->id], ['title' => 'Download', 'target' => '_blank', 'class' => 'pr-1']);
                        },
                        'view' => function ($url, $model) {
                            return Html::a('<i class="ti-server"></i>', ['show', 'id' => @$model->id], ['title' => 'Lihat tabel', 'target' => '_blank', 'data-pjax' => '0', 'class' => 'px-1 text-warning']);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<i class="ti-pencil-alt"></i>', ['upload', 'id' => @$model->id], ['title' => 'Detail', 'data-pjax' => '0', 'class' => 'text-success', 'class' => 'px-1 text-success']);
                            },
                        'delete' => function ($url, $model) {
                            return Html::a('<i class="ti-trash"></i>', ['delete', 'id' => @$model->id],[
                                'class' => 'text-danger',
                                'title' => 'Delete', 'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'), 'data-method'  => 'post'
                            ]);
                            },
                    ],
                ],
                ],
                ]);?>
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