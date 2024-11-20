<?php
/** @var yii\web\View $this */

use app\models\TableUpload;
use yii\helpers\Url;
use yii\helpers\Html;
use app\assets\DataTableAsset;


// DataTableAsset::register($this);


$periodeDefault = date('Y-m');
if ($periode == null) {
    $periode = $periodeDefault;
}

$summaryTotal = (object) @$summaryTotal ?? null;

$color = ($channel == null) ? 'danger' : TableUpload::getListColorTheme()[$channel];

$style = <<<CSS
    #chart-wrapper {
        margin-bottom: 2rem;
    }
CSS;
$this->registerCss($style);

?>
<h4 class="text-secondary mb-4"></h4>

<?php /*
<div class="row mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two">
            <a href="<?= Url::to(['ginee/index-serverside']) ?>" class="btn btn-sm btn-purple waves-effect waves-light float-right">View</a>
            <h6 class="text-muted text-uppercase mt-0">Ginee</h6>
            <h3 class="mb-4"><span>on progress</span></h3>
            <div class="progress progress-md">
                <div class="progress-bar progress-bar-striped bg-purple" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>  
    <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two">
            <a href="<?= Url::to(['shopee/index-summary']) ?>" class="btn btn-sm btn-warning waves-effect waves-light float-right">View</a>
            <h6 class="text-muted text-uppercase mt-0">Shopee</h6>
            <h3 class="mb-4"><span>on progress</span></h3>
            <div class="progress progress-md">
                <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two">
            <a href="<?= Url::to(['tiktok/index-summary']) ?>" class="btn btn-sm btn-dark waves-effect waves-light float-right">View</a>
            <h6 class="text-muted text-uppercase mt-0">Tiktok</h6>
            <h3 class="mb-4"><span>on progress</span></h3>
            <div class="progress progress-md">
                <div class="progress-bar progress-bar-striped bg-dark" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two">
            <a href="<?= Url::to(['tokopedia/index-summary']) ?>" class="btn btn-sm btn-success waves-effect waves-light float-right">View</a>
            <h6 class="text-muted text-uppercase mt-0">Tokopedia</h6>
            <h3 class="mb-4"><span>on progress</span></h3>
            <div class="progress progress-md">
                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two">
            <a href="<?= Url::to(['lazada/index-summary']) ?>" class="btn btn-sm btn-primary waves-effect waves-light float-right">View</a>
            <h6 class="text-muted text-uppercase mt-0">Lazada</h6>
            <h3 class="mb-4"><span>on progress</span></h3>
            <div class="progress progress-md">
                <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
</div>
*/ ?>

<form action="<?= Url::to(['dashboard/index-summary']) ?>" method="GET">
    <div class="row mb-4">
        <div class="container-fluid">
            <div class="member-index card-box shadow mb-4">
                <div class="mb-4">
                    <h4 class="header-title" style="">Dashboard Filter</h4>
                </div>            
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="periode">Periode</label>
                            <input type="month" id="periode" name="1[periode]" min="2020-01" max="2030-12" value="<?= $periode ?>" class="form-control" onclick="this.showPicker();">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="channel">Channel</label>
                            <select name="1[channel]" id="channel" class="form-control">
                                <option value="">Semua channel</option>
                                <?php foreach (TableUpload::getListChannel() as $key => $value) { ?>
                                    <?php $isSelected = (@$channel == $key) ? 'selected' : '' ?>
                                    <option value="<?= $key ?>" <?= $isSelected ?>><?= $value ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>               
                    <div class="col-3">
                        <div class="form-group justify-content-start">                            
                            <label for="">&nbsp;</label>
                            <div class="row px-2">
                                <button type="button" class="btn btn-secondary" id="btn-clear" style="display: block;">
                                    <i class="ti-reload"></i> Clear
                                </button>
                                <button type="submit" class="btn btn-primary ml-2" id="btn-submit" style="display: block;">
                                    <i class="ti-search"></i> Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<div id="chart-wrapper">
<?php
/* default chart */
use miloschuman\highcharts\Highcharts;

$titleChart = 'Semua Channel';
if ($channel != null) {
    $titleChart = TableUpload::getListChannel()[$channel];
    $titleChart = ucwords($titleChart);
}

// echo Highcharts::widget([
//     'options' => [
//         'chart' => [
//             'type' => 'column'
//         ],
//         'title' => [
//             'text' => $titleChart
//         ],
//         'xAxis' => [
//             'categories' => $dataChart['dates'],
//             'crosshair' => true
//         ],
//         'yAxis' => [
//             [
//                 'title' => ['text' => 'Amount HJP/ Amount Net'],
//                 'opposite' => false,
//             ],
//             [
//                 'title' => ['text' => 'Jumlah/Jumlah Transaksi'],
//                 'opposite' => true,
//             ]
//         ],
//         'series' => [
//             [
//                 'type' => 'column',
//                 'name' => 'Amount Net',
//                 'data' => $dataChart['amountNet'],
//                 'yAxis' => 0,
//             ],
//             [
//                 'type' => 'column',
//                 'name' => 'Amount HJP',
//                 'data' => $dataChart['amountHjp'],
//                 'yAxis' => 0,
//             ],
//             [
//                 'type' => 'line',
//                 'name' => 'Jumlah Transaksi',
//                 'data' => $dataChart['jumlahTransaksi'],
//                 'yAxis' => 1,
//                 'marker' => [
//                     'enabled' => true,
//                 ]
//             ],
//             [
//                 'type' => 'line',
//                 'name' => 'Jumlah',
//                 'data' => $dataChart['jumlah'],
//                 'yAxis' => 1,
//                 'marker' => [
//                     'enabled' => true,
//                 ]
//             ],
//         ]
//     ]
// ])


echo Highcharts::widget([
    'options' => [
        'chart' => [
            'type' => 'column'
        ],
        'title' => [
            'text' => $titleChart
        ],
        'xAxis' => [
            'categories' => $dataChart['dates'],
            'crosshair' => true
        ],
        'yAxis' => [
            [
                'title' => ['text' => 'Amount HJP/ Amount Net'],
                'opposite' => false,
            ],
            [
                'title' => ['text' => 'Jumlah/Jumlah Transaksi'],
                'opposite' => true,
            ]
        ],
        'series' => [
            [
                'type' => 'column',
                'name' => 'Amount Net',
                'data' => $dataChart['amountNet'],
                'yAxis' => 0,
            ],
            [
                'type' => 'column',
                'name' => 'Amount HJP',
                'data' => $dataChart['amountHjp'],
                'yAxis' => 0,
            ],
            [
                'type' => 'line',
                'name' => 'Jumlah Transaksi',
                'data' => $dataChart['jumlahTransaksi'],
                'yAxis' => 1,
                'marker' => [
                    'enabled' => true,
                ]
            ],
            [
                'type' => 'line',
                'name' => 'Jumlah',
                'data' => $dataChart['jumlah'],
                'yAxis' => 1,
                'marker' => [
                    'enabled' => true,
                ]
            ],
            [
                'type' => 'pie',
                'name' => 'Amount Net',
                'data' => $pieData,
                'center' => ['10%', '10%'], // Adjust position to place above main chart
                'size' => 100, // Size of the pie chart
                'showInLegend' => true,
                'dataLabels' => ['enabled' => false]
            ]
        ],
    ]
]);

?>
</div>

<div class="row mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-basket-loaded float-right text-<?= $color ?>"></i>
            <h6 class="text-primary text-uppercase">Jumlah Transaksi</h6>
            <h3><span data-plugin="counterup"><?= number_format(@$summaryTotal->jumlah_transaksi) ?></span></h3>
        </div>
    </div>    
    <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-handbag float-right text-<?= $color ?>"></i>
            <h6 class="text-danger text-uppercase">Quantity</h6>
            <h3><span data-plugin="counterup"><?= number_format(@$summaryTotal->jumlah) ?></span></h3>
        </div>
    </div> 
    <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-paypal float-right text-<?= $color ?>"></i>
            <h6 class="text-purple text-uppercase">Fee Marketplace</h6>
            <h3><span data-plugin="counterup"><?= number_format(@$summaryTotal->fee_marketplace) ?></span></h3>
        </div>
    </div>   
    <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-paypal float-right text-<?= $color ?>"></i>
            <h6 class="text-info text-uppercase">% Fee Marketplace</h6>
            <?php if ((int) @$summaryTotal->amount_hjp > 0) { ?>
                <h3><span data-plugin="counterup"><?= number_format(@$summaryTotal->fee_marketplace/@$summaryTotal->amount_hjp * 100, 2) ?></span></h3>
            <?php } ?>
        </div>
    </div> 
</div>

<div class="row mb-4"> 
    <div class="col-xl-6 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-credit-card float-right text-<?= $color ?>"></i>
            <h6 class="text-warning text-uppercase">Amount HJP</h6>
            <h3><span data-plugin="counterup"><?= number_format(@$summaryTotal->amount_hjp) ?></span></h3>
        </div>
    </div>
    <div class="col-xl-6 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-credit-card float-right text-<?= $color ?>"></i>
            <h6 class="text-success text-uppercase">Amount Net</h6>
            <h3><span data-plugin="counterup"><?= number_format(@$summaryTotal->amount_net) ?></span></h3>
        </div>
    </div>   
</div>


<div class="row mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-close float-right text-danger"></i>
            <h6 class="text-danger text-uppercase">Pesanan Batal & Retur</h6>
            <h3><span data-plugin="counterup"><?= number_format(@$allStatusPesanan['batal']) ?></span></h3>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-close float-right text-danger"></i>
            <h6 class="text-danger text-uppercase">Amount HJP Batal & Retur</h6>
            <h3><span data-plugin="counterup"><?= number_format(@$allHjpPesanan['batal']) ?></span></h3>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-action-redo float-right text-warning"></i>
            <h6 class="text-warning text-uppercase">Pesanan Dikirim</h6>
            <h3><span data-plugin="counterup"><?= number_format(@$allStatusPesanan['sedang dikirim']) ?></span></h3>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-action-redo float-right text-warning"></i>
            <h6 class="text-warning text-uppercase">Amount HJP Dikirim</h6>
            <h3><span data-plugin="counterup"><?= number_format(@$allHjpPesanan['sedang dikirim']) ?></span></h3>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="dt-button-wrapper" style="display: flex; flex-direction: row-reverse; justify-content:start">
                <?php // Html::a('<i class="ti-plus mr-2"></i> Add', ['create'], ['class' => 'btn btn-primary mb-1']) ?>
                <?= Html::a('<i class="ti-download mr-2"></i> Excel', ['export-excel', 'periode' => $periode, 'channel' => $channel], ['class' => 'btn btn-success mb-1 mr-1', 'target' => '_blank']) ?>                    
                <?= Html::a('<i class="ti-printer mr-2"></i> Print', 'javascript:void(0)', ['class' => 'btn btn-info mb-1 mr-1', 'id' => 'btn-print' ]) ?>
                <h5 style="flex-grow: 1;">Detail per Month (<?= $titleChart ?>)</h5>
            </div>
            <div class="table-responsive mb-4" id="table-detail-per-month-wrapper">
                <table class="table table-hover table-bordered" id="table-detail-per-month">
                    <thead class="bg-<?= $color ?> text-white">
                        <th style="text-align: left;">Tanggal</th>
                        <th style="text-align: center;">Jumlah Transaksi</th>
                        <th style="text-align: center;">Qty</th>
                        <th style="text-align: center;">Amount HJP</th>
                        <th style="text-align: center;">Amount Net</th>
                        <th style="text-align: center;">Fee Marketplace</th>
                        <th style="text-align: center;">% Fee Marketplace</th>
                    </thead>
                    <tbody>
                        <?php 
                            $grand_jumlah_transaksi = 0;
                            $grand_jumlah = 0;
                            $grand_amount_hjp = 0;
                            $grand_amount_net = 0;
                            $grand_fee_marketplace = 0;
                        ?>
                        <?php foreach (@$summaryByDateRange as $result) { $result = (object) $result; ?>
                            <?php 
                                $grand_jumlah_transaksi += $result->jumlah_transaksi;
                                $grand_jumlah += $result->jumlah;
                                $grand_amount_hjp += $result->amount_hjp;
                                $grand_amount_net += $result->amount_net;
                                $grand_fee_marketplace += $result->fee_marketplace;
                            ?>
                            <tr>
                                <td><?= date('d-m-Y', strtotime($result->waktu_pesanan_dibuat)) ?></td>
                                <td style="text-align: right;"><?= number_format($result->jumlah_transaksi) ?></td>
                                <td style="text-align: right;"><?= number_format($result->jumlah) ?></td>
                                <td style="text-align: right;"><?= number_format($result->amount_hjp) ?></td>
                                <td style="text-align: right;"><?= number_format($result->amount_net) ?></td>
                                <td style="text-align: right;"><?= number_format($result->fee_marketplace) ?></td>
                                <td style="text-align: right;">
                                    <?php if ((int) @$result->amount_hjp > 0) { ?>
                                        <?= number_format($result->fee_marketplace/$result->amount_hjp * 100, 2) ?>%
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr class="bg-<?= $color ?> text-white">
                            <th><?= $titleChart ?></th>
                            <th style="text-align: right;"><?= number_format($grand_jumlah_transaksi) ?></th>
                            <th style="text-align: right;"><?= number_format($grand_jumlah) ?></th>
                            <th style="text-align: right;"><?= number_format($grand_amount_hjp) ?></th>
                            <th style="text-align: right;"><?= number_format($grand_amount_net) ?></th>
                            <th style="text-align: right;"><?= number_format($grand_fee_marketplace) ?></th>
                            <th style="text-align: right;">
                                <?php if ((int) $grand_amount_hjp > 0) { ?>
                                    <?= number_format($grand_fee_marketplace/$grand_amount_hjp * 100, 2) ?>%
                                <?php } ?>
                            </th>
                        </tr>                        
                    </tfoot>
                </table>
                <h5 class="mt-4">Grand Total Per Marketplace - <?= date('F Y', strtotime($periode . '-01')) ?></h5>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align: left;">Channel</th>
                            <th style="text-align: center;">Jumlah Transaksi</th>
                            <th style="text-align: center;">Qty</th>
                            <th style="text-align: center;">Amount HJP</th>
                            <th style="text-align: center;">Amount Net</th>
                            <th style="text-align: center;">Fee Marketplace</th>
                            <th style="text-align: center;">% Fee Marketplace</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (@$footerMarketplace as $object) { ?>
    
                            <?php foreach ($object as $key => $items) { ?>
    
                                <?php if (strtolower($key) == strtolower($titleChart)) { continue; } ?>
    
                                <?php $tColor = TableUpload::getListColorTheme($useText=true)[$key] ?? 'primary'; ?>
                                <tr class="bg-<?= $tColor ?> text-white">
                                    <th><?= ucwords($key) ?></th>
                                    <th style="text-align: right"><?= number_format($items['jumlah_transaksi']) ?></th>
                                    <th style="text-align: right"><?= number_format($items['jumlah']) ?></th>
                                    <th style="text-align: right"><?= number_format($items['amount_hjp']) ?></th>
                                    <th style="text-align: right"><?= number_format($items['amount_net']) ?></th>
                                    <th style="text-align: right"><?= number_format($items['fee_marketplace']) ?></th>
                                    <?php if ($items['amount_hjp'] > 0) { ?>
                                        <th style="text-align: right"><?= number_format($items['fee_marketplace']/$items['amount_hjp'] * 100, 2) ?>%</th>
                                    <?php } else { ?>
                                        <th style="text-align: right">0%</th>
                                    <?php } ?>
                                </tr>
    
                            <?php } ?>
    
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>


<?php 

$periodePrint = date('F Y', strtotime($periode . '-01'));

$script = <<<JS
    var periodePrint = '$periodePrint';
    var styles = `<style>
        /* General Table Styling */
            table {
                border-collapse: collapse;
                width: 100%;
                margin: 0 auto;
                font-family: Arial, sans-serif;
                font-size: 14px;
            }

            table th,
            table td {
                padding: 10px;
                text-align: center;
                border: 1px solid #ddd;
            }

            /* Header Styling */
            table thead th {
                background-color: #ff5722; /* Red-orange for header */
                color: white;
                font-weight: bold;
            }

            /* Footer Row Styling */
            table tfoot td {
                background-color: #ff5722; /* Matches header color */
                color: white;
                font-weight: bold;
            }

            /* Highlight Rows */
            table tbody tr:nth-child(odd) {
                background-color: #f9f9f9;
            }

            table tbody tr:nth-child(even) {
                background-color: #fff;
            }

            /* Sub-table Headers */
            .sub-table th {
                background-color: #ffc107; /* Yellow for sub-table */
                color: white;
                font-weight: bold;
            }

            /* Sub-table Rows */
            .sub-table tr:nth-child(odd) {
                background-color: #e3e3e3; /* Light gray */
            }

            .sub-table tr:nth-child(even) {
                background-color: white;
            }

            /* Sub-table Footer */
            .sub-table tfoot td {
                background-color: #ffc107; /* Matches sub-header */
                color: white;
                font-weight: bold;
            }

            /* Padding Around Printed Content */
            body {
                margin: 20px;
                padding: 20px;
            }

            /* Optional: Centered Print Title */
            .print-title {
                text-align: center;
                font-size: 20px;
                margin-bottom: 10px;
                font-weight: bold;
            }
</style>`;

    document.getElementById('btn-print').addEventListener('click', function () {
        var table = document.getElementById('table-detail-per-month-wrapper').outerHTML;
        var newWindow = window.open('', '_blank');
        const html = `<html>
                        <head>
                        <title>Detail per month - `+periodePrint+`</title>
                        `+styles+`</head>
                        <body>
                            <h2>Detail per Month (Semua Channel)</h2>
                        `+table+`
                        </body>
                    </html>`
        newWindow.document.write(html);
        newWindow.document.close();
        newWindow.print();
    });


    $('#btn-clear').on('click', function() {
        $('#periode').val('');
        $('#channel').val('');
    })

    // document.getElementById('btn-excel').addEventListener('click', function () {
    //     var table = document.getElementById('table-detail-per-month-wrapper'); // Get the table element
    //     var workbook = XLSX.utils.table_to_book(table, { sheet: "Sheet 1" }); // Convert table to workbook
    //     var ws = workbook.Sheets["Sheet 1"];      
        
    //     for (let col = 0; col < document.getElementById('table-detail-per-month').rows[0].cells.length; col++) {
    //         const cellAddress = { r: 0, c: col }; // First row (index 0)
    //         const cellRef = XLSX.utils.encode_cell(cellAddress);
    //         if (!ws[cellRef]) {
    //             ws[cellRef] = {}; // Ensure cell exists
    //             console.log(ws[cellRef]);
    //         } else {
    //             console.log('not exists');
    //         }
    //         ws[cellRef].s = { font: { bold: true } }; // Set font style to bold
    //     }
        
    //     // XLSX.writeFile(workbook, 'summary ' + periodePrint + '.xlsx'); // Export workbook to .xlsx
    // });


JS;

$this->registerJs($script, \yii\web\View::POS_END);

?>