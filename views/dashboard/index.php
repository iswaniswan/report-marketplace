<?php
/** @var yii\web\View $this */

use app\models\TableUpload;
use yii\helpers\Url;


$periodeDefault = date('Y-m');
if ($periode == null) {
    $periode = $periodeDefault;
}

$summaryTotal = (object) @$summaryTotal ?? null;

$color = ($channel == null) ? 'danger' : TableUpload::getListColorTheme()[$channel];


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

<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
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
                            <th>#</th>
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
            </div>
        </div>
    </div>
</div>