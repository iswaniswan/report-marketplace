<?php

use app\assets\DataTableAsset;
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
        'title' => 'Ginee'
    ],
]);


?>

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
    <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-paypal float-right text-muted"></i>
            <h6 class="text-primary text-uppercase">Harga Total Promosi</h6>
            <h3><span data-plugin="counterup"><?= number_format(@$totalHargaTotalPromosi) ?></span></h3>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two">
            <i class="icon-paypal float-right text-muted"></i>
            <h6 class="text-success text-uppercase">Total</h6>
            <h3><span data-plugin="counterup"><?= number_format(@$totalTotal) ?></span></h3>
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