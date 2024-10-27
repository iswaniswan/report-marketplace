<?php
/** @var yii\web\View $this */

use yii\helpers\Url;

?>
<h4 class="text-secondary mb-4">Dashboard</h4>

<div class="row mb-4">
    <?php /*
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
    */ ?>
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