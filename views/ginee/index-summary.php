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

$this->title = 'Summary Ginee';
$this->params['breadcrumbs'][] = $this->title;

echo \app\widgets\Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options' => [
        'title' => 'Summary Ginee'
    ],
]);


if ($periode == null) {
    $periode = "";
}

if ($channel == null) {
    $channel = "";
}


?>

<form action="<?= Url::to(['ginee/index-summary']) ?>" method="GET">
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


<?php /*
<div class="row mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-chart float-right text-muted"></i>
            <h6 class="text-primary text-uppercase">Produk Terjual</h6>
            <h3><span data-plugin="counterup"><?= number_format(@$produkTerjual) ?></span></h3>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-chart float-right text-muted"></i>
            <h6 class="text-success text-uppercase">Produk Selesai</h6>
            <h3><span data-plugin="counterup"><?= number_format(@$produkSelesai) ?></span></h3>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-chart float-right text-muted"></i>
            <h6 class="text-danger text-uppercase">Produk Batal/Return</h6>
            <h3><span data-plugin="counterup"><?= number_format(@$produkBatal) ?></span></h3>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-chart float-right text-muted"></i>
            <h6 class="text-warning text-uppercase">Produk Dikirim</h6>
            <h3><span data-plugin="counterup"><?= number_format(@$produkDikirim) ?></span></h3>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-xl-6 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-paypal float-right text-muted"></i>
            <h6 class="text-primary text-uppercase">Harga Total Promosi</h6>
            <h3><span data-plugin="counterup"><?= number_format(@$totalHargaTotalPromosi) ?></span></h3>
        </div>
    </div>
    <div class="col-xl-6 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-paypal float-right text-muted"></i>
            <h6 class="text-success text-uppercase">Total</h6>
            <h3><span data-plugin="counterup"><?= number_format(@$totalTotal) ?></span></h3>
        </div>
    </div>
</div>
<hr/>
*/ ?>

<div class="row mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-chart float-right text-muted"></i>
            <h6 class="text-primary text-uppercase">Jumlah Transaksi</h6>
            <h3><span data-plugin="counterup"><?= number_format(@$jumlahTransaksi) ?></span></h3>
        </div>
    </div>    
    <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-chart float-right text-muted"></i>
            <h6 class="text-danger text-uppercase">Quantity</h6>
            <h3><span data-plugin="counterup"><?= number_format(@$produkSelesai) ?></span></h3>
        </div>
    </div> 
    <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-chart float-right text-muted"></i>
            <h6 class="text-purple text-uppercase">Fee Marketplace</h6>
            <h3><span data-plugin="counterup"><?= number_format(@$feeMarketplace) ?></span></h3>
        </div>
    </div>   
    <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-chart float-right text-muted"></i>
            <h6 class="text-info text-uppercase">% Fee Marketplace</h6>
            <h3><span data-plugin="counterup"><?= number_format(@$persenFeeMarketplace, 2) ?></span></h3>
        </div>
    </div> 
</div>

<div class="row mb-4"> 
    <div class="col-xl-6 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-chart float-right text-muted"></i>
            <h6 class="text-warning text-uppercase">Amount HJP</h6>
            <h3><span data-plugin="counterup"><?= number_format(@$jumlahSubtotal) ?></span></h3>
        </div>
    </div>
    <div class="col-xl-6 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-chart float-right text-muted"></i>
            <h6 class="text-success text-uppercase">Amount Net</h6>
            <h3><span data-plugin="counterup"><?= number_format(@$jumlahTotal) ?></span></h3>
        </div>
    </div>   
</div>

<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="responsive-table-plugin">
                <div class="table-rep-plugin">
                    <div class="table-wrapper">
                        <div class="btn-toolbar d-none">
                            <div class="btn-group focus-btn-group">
                                <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-screenshot"></span> Focus</button></div>
                                <div class="btn-group dropdown-btn-group pull-right"><button type="button" class="btn btn-default">Display all</button>
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Display <span class="caret"></span></button>
                                <ul class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(94px, 38px, 0px);"><li class="checkbox-row"><input type="checkbox" name="toggle-tech-companies-1-col-1" id="toggle-tech-companies-1-col-1" value="tech-companies-1-col-1"> <label for="toggle-tech-companies-1-col-1">Last Trade</label></li><li class="checkbox-row"><input type="checkbox" name="toggle-tech-companies-1-col-2" id="toggle-tech-companies-1-col-2" value="tech-companies-1-col-2"> <label for="toggle-tech-companies-1-col-2">Trade Time</label></li><li class="checkbox-row"><input type="checkbox" name="toggle-tech-companies-1-col-3" id="toggle-tech-companies-1-col-3" value="tech-companies-1-col-3"> <label for="toggle-tech-companies-1-col-3">Change</label></li><li class="checkbox-row"><input type="checkbox" name="toggle-tech-companies-1-col-4" id="toggle-tech-companies-1-col-4" value="tech-companies-1-col-4"> <label for="toggle-tech-companies-1-col-4">Prev Close</label></li><li class="checkbox-row"><input type="checkbox" name="toggle-tech-companies-1-col-5" id="toggle-tech-companies-1-col-5" value="tech-companies-1-col-5"> <label for="toggle-tech-companies-1-col-5">Open</label></li><li class="checkbox-row"><input type="checkbox" name="toggle-tech-companies-1-col-6" id="toggle-tech-companies-1-col-6" value="tech-companies-1-col-6"> <label for="toggle-tech-companies-1-col-6">Bid</label></li><li class="checkbox-row"><input type="checkbox" name="toggle-tech-companies-1-col-7" id="toggle-tech-companies-1-col-7" value="tech-companies-1-col-7"> <label for="toggle-tech-companies-1-col-7">Ask</label></li><li class="checkbox-row"><input type="checkbox" name="toggle-tech-companies-1-col-8" id="toggle-tech-companies-1-col-8" value="tech-companies-1-col-8"> <label for="toggle-tech-companies-1-col-8">1y Target Est</label></li></ul></div></div>
                                <div class="table-responsive fixed-solution" data-pattern="priority-columns">
                        <div class="sticky-table-header" style="height: 49.1094px; visibility: hidden; width: auto; top: -1px;">
                            <table id="tech-companies-1-clone" class="table table-striped">
                                <thead>
                                <tr>
                                    <th id="tech-companies-1-col-0-clone">Company</th>
                                    <th data-priority="1" id="tech-companies-1-col-1-clone">Last Trade</th>
                                    <th data-priority="3" id="tech-companies-1-col-2-clone">Trade Time</th>
                                    <th data-priority="1" id="tech-companies-1-col-3-clone">Change</th>
                                    <th data-priority="3" id="tech-companies-1-col-4-clone">Prev Close</th>
                                    <th data-priority="3" id="tech-companies-1-col-5-clone">Open</th>
                                    <th data-priority="6" id="tech-companies-1-col-6-clone">Bid</th>
                                    <th data-priority="6" id="tech-companies-1-col-7-clone">Ask</th>
                                    <th data-priority="6" id="tech-companies-1-col-8-clone">1y Target Est</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php for($i=0; $i<31; $i++) { ?>
                                        <tr>
                                            <th data-org-colspan="1" data-columns="tech-companies-1-col-0">GOOG <span class="co-name">Google Inc.</span></th>
                                            <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-1">597.74</td>
                                            <td data-org-colspan="1" data-priority="3" data-columns="tech-companies-1-col-2">12:12PM</td>
                                            <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-3">14.81 (2.54%)</td>
                                            <td data-org-colspan="1" data-priority="3" data-columns="tech-companies-1-col-4">582.93</td>
                                            <td data-org-colspan="1" data-priority="3" data-columns="tech-companies-1-col-5">597.95</td>
                                            <td data-org-colspan="1" data-priority="6" data-columns="tech-companies-1-col-6">597.73 x 100</td>
                                            <td data-org-colspan="1" data-priority="6" data-columns="tech-companies-1-col-7">597.91 x 300</td>
                                            <td data-org-colspan="1" data-priority="6" data-columns="tech-companies-1-col-8"><?= $i ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end .table-responsive -->

                </div> <!-- end .table-rep-plugin-->
            </div> <!-- end .responsive-table-plugin-->
        </div> <!-- end card-box -->
    </div> <!-- end col -->
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
            $('#periode').val('');
            $('#channel').val('');
        })
    });

JS;

$this->registerJs($script, \yii\web\View::POS_END);

?>
