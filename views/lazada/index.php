<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LazadaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Daftar Lazada';
$this->params['breadcrumbs'][] = $this->title;

echo \app\widgets\Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'title' => 'Lazada'    ],
]) ?>

<div class="row mb-4">
    <div class="container-fluid">
        <div class="dt-button-wrapper">
            <?= Html::a('<i class="ti-plus mr-2"></i> Add', ['create'], ['class' => 'btn btn-primary mb-1']) ?>
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
                        'attribute' => 'id_file_source',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'order_item_id',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'order_type',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'guarantee',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'delivery_type',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'lazada_id',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'seller_sku',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'lazada_sku',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'ware_house',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'create_time',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'update_time',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'rts_sla',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'tts_sla',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'order_number',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'invoice_required',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'invoice_number',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'delivered_date',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'customer_name',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'customer_email',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'national_registration_number',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'shipping_name',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'shipping_address',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'shipping_address2',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'shipping_address3',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'shipping_address4',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'shipping_address5',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'shipping_phone',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'shipping_phone2',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'shipping_city',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'shipping_post_code',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'shipping_country',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'shipping_region',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'billing_name',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'billing_addr',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'billing_addr2',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'billing_addr3',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'billing_addr4',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'billing_addr5',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'billing_phone',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'billing_phone2',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'billing_city',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'billing_post_code',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'billing_country',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'tax_code',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'branch_number',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'tax_invoice_requested',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'pay_method',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'paid_price',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'unit_price',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'seller_discount_total',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'shipping_fee',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'wallet_credit',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'item_name',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'variation',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'cd_shipping_provider',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'shipping_provider',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'shipment_type_name',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'shipping_provider_type',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'cd_tracking_code',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'tracking_code',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'tracking_url',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'shipping_provider_fm',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'tracking_code_fm',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'tracking_url_fm',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'promised_shipping_time',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'premium',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'buyer_failed_delivery_return_initiator',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'buyer_failed_delivery_reason',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                    [
                        'attribute' => 'buyer_failed_delivery_detail',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:left;'],
                        'contentOptions' => ['style' => 'text-align:left'],
                        ],
                                     [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete}',
                    'visibleButtons' => ['view' => true, 'update' => true, 'delete' => true],
                    'buttons' => [
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