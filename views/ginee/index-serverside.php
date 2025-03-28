<?php

use app\assets\DataTableAsset;
use app\models\Ginee;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GineeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

DataTableAsset::register($this);

$this->title = 'Tabel Ginee';
$this->params['breadcrumbs'][] = $this->title;

echo \app\widgets\Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'title' => 'Ginee'
    ],
]);

$style = <<<CSS
    #table-serverside tbody tr td:nth-child(6),
    #table-serverside tbody tr td:nth-child(7), 
    #table-serverside tbody tr td:nth-child(8),
    #table-serverside tbody tr td:nth-child(9),
    #table-serverside tbody tr td:nth-child(10),
    #table-serverside tbody tr td:nth-child(11) {
        text-align: right
    }
CSS;

$this->registerCss($style);

?>
<form action="<?= Url::to(['ginee/index-serverside']) ?>" method="GET">
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
                    <div class="col-3">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="1[status]" id="status" class="form-control">
                                <option value="">Pilih Status</option>
                                <?php foreach (Ginee::getListStatus() as $_status) { ?>
                                    <?php $isSelected = (@$status == $_status) ? 'selected' : '' ?>
                                    <option value="<?= $_status ?>" <?= $isSelected ?>><?= $_status ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="channel">Channel</label>
                            <select name="1[channel]" id="channel" class="form-control">
                                <option value="">Pilih channel</option>
                                <?php foreach (Ginee::getListChannel() as $_channel) { ?>
                                    <?php $isSelected = (@$channel == $_channel) ? 'selected' : '' ?>
                                    <option value="<?= $_channel ?>" <?= $isSelected ?>><?= $_channel ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group justify-content-start">
                            <button class="btn btn-secondary" id="btn-clear">
                                <i class="ti-reload"></i> Clear
                            </button>
                            <button class="btn btn-primary" id="btn-submit">
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
               <table class="table table-hover table-bordered" id="table-serverside">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal<br/>Pembuatan</th>
                            <th>ID Pesanan</th>
                            <th>Status</th>
                            <th>Channel</th>
                            <th>Harga<br/>Awal Produk</th>
                            <th>Harga<br/>Promosi</th>
                            <th>Jumlah</th>
                            <th>Harga<br/>Total Promosi</th>
                            <th>Subtotal</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
               </table>
            </div>
        </div>
    </div>
</div>

<?php
$urlServerside = Url::to(['ginee/serverside']);

if ($date_start == null) {
    $date_start = "";
}

if ($date_end == null) {
    $date_end = "";
}

if ($status == null) {
    $status = "";
}

if ($channel == null) {
    $channel = "";
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
                    channel: '$channel',
                });
            }
        },
        columns: [
            { data: null, title: '#', orderable: false, searchable: false, defaultContent: ''},
            { data: 'tanggal_pembuatan', orderable: false},
            { data: 'id_pesanan', orderable: false},
            { data: 'status', orderable: false},
            { data: 'channel', orderable: false},
            { data: 'harga_awal_produk', orderable: false},
            { data: 'harga_promosi', orderable: false},
            { data: 'jumlah', orderable: false},
            { data: 'harga_total_promosi', orderable: false},
            { data: 'subtotal', orderable: false},
            { data: 'total', orderable: false},
            { data: 'action', orderable: false},
        ],
        rowCallback: function(row, data, index) {
            var table = $('#table-serverside').DataTable();
            var pageInfo = table.page.info();
            // Calculate the sequence number based on the page index and page length
            $('td:eq(0)', row).html(pageInfo.start + index + 1);
        }
    });

    $('#btn-clear').on('click', function() {
        $('#date_start').val('');
        $('#date_end').val('');
        $('#status').val('');
        $('#channel').val('');
    })

JS;

$this->registerJs($script, \yii\web\View::POS_END);

?>