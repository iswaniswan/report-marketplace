<?php

/* @var $this yii\web\View */
/* @var $model app\models\ShopeeIncome */
/* @var $referrer string */

$this->title = 'Edit Shopee Income';
$this->params['breadcrumbs'][] = ['label' => 'Shopee Incomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';
?>
<div class="shopee-income-update">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
