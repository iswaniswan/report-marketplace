<?php

use app\assets\DataTableAsset;
use yii\helpers\Html;;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ShopeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

DataTableAsset::register($this);

$this->title = 'Tabel Tiktok Income';
$this->params['breadcrumbs'][] = $this->title;

echo \app\widgets\Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'title' => 'Tiktok Income'
    ],
]);

$style = <<<CSS
    #table-serverside tbody tr td {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    #table-serverside tbody tr td:nth-child(5),
    #table-serverside tbody tr td:nth-child(6) {
        text-align: right
    }
CSS;

$this->registerCss($style);

?>
<form action="<?= Url::to(['tiktok-income/index-serverside']) ?>" method="GET">
    <div class="row mb-4">
        <div class="container-fluid">
            <div class="member-index card-box shadow mb-4">
                <div class="mb-4">
                    <h4 class="header-title" style="">Filter</h4>
                </div>            
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="date_start">Tanggal Awal</label>
                            <input type="date" onclick="this.showPicker()" class="form-control" id="date_start" name="1[date_start]" placeholder="" value="<?= @$date_start ?>"/>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="date_end">Tanggal Akhir</label>
                            <input type="date" onclick="this.showPicker()" class="form-control" id="date_end" name="1[date_end]" placeholder="" value="<?= $date_end ?>"/>
                        </div>
                    </div>                    
                    <?php /*
                    <div class="col-3">
                        <div class="form-group">
                            <label for="channel">Channel</label>
                            <select name="1[channel]" id="channel" class="form-control">
                                <option value="">Pilih channel</option>
                                <?php foreach (Shopee::getListChannel() as $_channel) { ?>
                                    <?php $isSelected = (@$channel == $_channel) ? 'selected' : '' ?>
                                    <option value="<?= $_channel ?>" <?= $isSelected ?>><?= $_channel ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    */ ?>
                    <div class="col-12">
                        <div class="form-group justify-content-start">
                            <button type="button" class="btn btn-secondary" id="btn-clear">
                                <i class="ti-reload"></i> Clear
                            </button>
                            <button type="submit" class="btn btn-primary" id="btn-submit">
                                <i class="ti-search"></i> Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


<div class="row mb-4">
    <div class="container-fluid">
        <div class="dt-button-wrapper">
            <?php // Html::a('<i class="ti-plus mr-2"></i> Add', ['create'], ['class' => 'btn btn-primary mb-1']) ?>
            <?= Html::a('<i class="ti-printer mr-2"></i> Print', 'javascript:void(0)', ['class' => 'btn btn-info mb-1', 'onclick' => 'dtPrint()' ]) ?>
            <div class="btn-group mr-1">
                <?= Html::a('<i class="ti-download mr-2"></i> Export', ['#'], [
                    'class' => 'btn btn-success mb-1 dropdown-toggle',
                    'data-toggle' => 'dropdown'
                ]) ?>
                <div class="dropdown-menu" x-placement="bottom-start">
                    <?= Html::a('Excel', 'javascript:void(0)', ['class' => 'dropdown-item', 'onclick' => 'dtExportExcel(event);']) ?>
                    <?= Html::a('Pdf', 'javascript:void(0)', ['class' => 'dropdown-item', 'onclick' => 'dtExportPdf()']) ?>
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
               <table class="table table-hover table-bordered" id="table-serverside">
                    <thead>
                        <tr>
                            <th style="width: 4%">#</th>
                            <th style="width: 16%">Order<br/>Adjustment ID</th>
                            <th style="width: 16%">Order<br/>Created Time</th>
                            <th style="width: 16%">Order<br/>Settled Time</th>
                            <th style="width:16%">Total<br/>Settlement Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
               </table>
            </div>
        </div>
    </div>
</div>

<?php
$urlServerside = Url::to(['tiktok-income/serverside']);

if ($date_start == null) {
    $date_start = "";
}

if ($date_end == null) {
    $date_end = "";
}

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

    $('#table-serverside').DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: '$urlServerside',
            type: 'GET', // or 'POST' depending on your server configuration
            data: function (d) {
                return $.extend({}, d, {
                    // Additional data if needed
                    date_start: '$date_start',
                    date_end: '$date_end',
                    status: '$status',
                });
            }
        },
        columns: [
            { data: null, title: '#', orderable: false, searchable: false, defaultContent: ''},
            { data: 'order_adjustment_id', orderable: false},
            { data: 'order_created_time_utc', orderable: false},
            { data: 'order_settled_time_utc', orderable: false},
            { data: 'total_settlement_amount', orderable: false, createdCell: function (td) {
                $(td).css('text-align', 'right'); // Example right-align
            }},
            { data: 'action', orderable: false, createdCell: function (td) {
                $(td).css('text-align', 'left'); // Example right-align
            }},
        ],
        rowCallback: function(row, data, index) {
            var table = $('#table-serverside').DataTable();
            var pageInfo = table.page.info();
            // Calculate the sequence number based on the page index and page length
            $('td:eq(0)', row).html(pageInfo.start + index + 1);
        },
        dom: 'Blfrtip', // Include the 'B' in 'dom' to show buttons
        buttons: [
            { extend: 'copy', text: 'Copy' },
            { extend: 'csv', text: 'CSV' },
            { extend: 'excel', text: 'Excel', exportOptions: {
                columns: ':not(:last-child)', // include visible columns only
                format: {
                    body: function (data, row, column, node) {
                        if (column === 0) {
                            // Adjust sequence number for PDF export
                            var pageInfo = $('#table-serverside').DataTable().page.info();
                            return pageInfo.start + row + 1;
                        }
                        return data;
                    }
                }},
            },
            { extend: 'pdf', text: 'PDF', exportOptions: {
                columns: ':not(:last-child)', // include visible columns only
                format: {
                    body: function (data, row, column, node) {
                        if (column === 0) {
                            // Adjust sequence number for PDF export
                            var pageInfo = $('#table-serverside').DataTable().page.info();
                            return pageInfo.start + row + 1;
                        }
                        return data;
                    }
                }},
                customize: function (doc) {
                    // Optional: Customize PDF document margins
                    doc.pageMargins = [10, 5, 5, 5]; // Set custom margins for left, top, right, bottom
                }
            },
            { extend: 'print', text: 'Print', exportOptions: {
                columns: ':not(:last-child)', // include visible columns only
                format: {
                    body: function (data, row, column, node) {
                        if (column === 0) {
                            // Adjust sequence number for PDF export
                            var pageInfo = $('#table-serverside').DataTable().page.info();
                            return pageInfo.start + row + 1;
                        }
                        return data;
                    }
                }},
            }
        ],
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
    });

    $('#btn-clear').on('click', function() {
        $('#date_start').val('');
        $('#date_end').val('');
        $('#status').val('');
    })

JS;

$this->registerJs($script, \yii\web\View::POS_END);

?>