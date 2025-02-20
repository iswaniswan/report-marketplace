<?php

use app\assets\DataTableAsset;
use app\utils\StringHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GineeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

DataTableAsset::register($this);

$this->title = 'Summary Offline';
$this->params['breadcrumbs'][] = $this->title;

echo \app\widgets\Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'title' => 'Summary Offline'
    ],
]);

$periodeDefault = date('Y-m');
if ($periode == null) {
    $periode = $periodeDefault;
}


// var_dump($summaryTotal[0]); die();
$summaryTotal = (object) $summaryTotal[0];
?>

<form action="<?= Url::to(['offline-report/index-summary']) ?>" method="GET">
    <div class="row mb-4">
        <div class="container-fluid">
            <div class="member-index card-box shadow mb-4">
                <div class="mb-4">
                    <h4 class="header-title" style="">Filter</h4>
                </div>            
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="periode">Periode</label>
                            <input type="month" id="periode" name="1[periode]" min="2020-01" max="2030-12" value="<?= $periode ?>" class="form-control" onclick="this.showPicker();">
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

<div class="row mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-basket-loaded float-right text-primary"></i>
            <h6 class="text-primary text-uppercase">Jumlah Transaksi</h6>
            <h3><span data-plugin="counterup"><?= number_format(@$summaryTotal->jumlah_transaksi) ?></span></h3>
        </div>
    </div>    
    <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-handbag float-right text-primary"></i>
            <h6 class="text-danger text-uppercase">Quantity</h6>
            <h3><span data-plugin="counterup"><?= number_format(@$summaryTotal->quantity) ?></span></h3>
        </div>
    </div> 
    <?php /*
    <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-paypal float-right text-primary"></i>
            <h6 class="text-purple text-uppercase">Fee Marketplace</h6>
            <?php $feeMarketplace = @$summaryTotal->fee_marketplace; 
            if ($feeMarketplace < 0) {
                $feeMarketplace = abs($feeMarketplace);
            } ?>
            <h3><span data-plugin="counterup"><?= number_format($feeMarketplace) ?></span></h3>
        </div>
    </div>   
    <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-paypal float-right text-primary"></i>
            <h6 class="text-info text-uppercase">% Fee Marketplace</h6>
            <?php if ((int) @$summaryTotal->amount_hjp > 0) { ?>
                <h3><span data-plugin="counterup"><?= number_format(@$feeMarketplace/@$summaryTotal->amount_hjp * 100, 2) ?></span></h3>
            <?php } ?>
        </div>
    </div> 
    */ ?>
    <div class="col-xl-6 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-credit-card float-right text-primary"></i>
            <h6 class="text-success text-uppercase">Amount Net</h6>
            <h3><span data-plugin="counterup"><?= number_format(@$summaryTotal->amount_net) ?></span></h3>
        </div>
    </div>  
</div>

<?php /*
<div class="row mb-4"> 
    <div class="col-xl-6 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-credit-card float-right text-primary"></i>
            <h6 class="text-warning text-uppercase">Amount HJP</h6>
            <h3><span data-plugin="counterup"><?= number_format(@$summaryTotal->amount_hjp) ?></span></h3>
        </div>
    </div>
    <div class="col-xl-6 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-credit-card float-right text-primary"></i>
            <h6 class="text-success text-uppercase">Amount Net</h6>
            <h3><span data-plugin="counterup"><?= number_format(@$summaryTotal->amount_net) ?></span></h3>
        </div>
    </div>   
</div>
*/ ?>


<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="bg-light text-dark">
                        <th style="text-align: left;">Tanggal</th>
                        <th style="text-align: center;">Jumlah Transaksi</th>
                        <th style="text-align: center;">Qty</th>
                        <th style="text-align: center;">Amount Net</th>
                    </thead>
                    <tbody>
                        <?php 
                            $grand_jumlah_transaksi = 0;
                            $grand_quantity = 0;
                            $grand_amount_net = 0;
                        ?>
                        <?php foreach (@$summaryByDateRange as $result) { $result = (object) $result; ?>
                            <?php 
                                $grand_jumlah_transaksi += $result->jumlah_transaksi;
                                $grand_quantity += $result->quantity;
                                $grand_amount_net += $result->amount_net;
                            ?>
                            <tr>
                                <td><?= date('d-m-Y', strtotime($result->tanggal)) ?></td>
                                <td style="text-align: right;"><?= number_format($result->jumlah_transaksi) ?></td>
                                <td style="text-align: right;"><?= number_format($result->quantity) ?></td>
                                <td style="text-align: right;"><?= number_format($result->amount_net) ?></td>                                
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr class="bg-light text-dark">
                            <th>#</th>
                            <th style="text-align: right;"><?= number_format($grand_jumlah_transaksi) ?></th>
                            <th style="text-align: right;"><?= number_format($grand_quantity) ?></th>
                            <th style="text-align: right;"><?= number_format($grand_amount_net) ?></th>
                        </tr>
                    </tfoot>
                </table>
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

    $(document).ready(function() {
        $('#btn-clear').on('click', function() {
            const periode = '$periodeDefault';
            $('#periode').val(periode);
        })
    })

JS;

$this->registerJs($script, \yii\web\View::POS_END);

?>