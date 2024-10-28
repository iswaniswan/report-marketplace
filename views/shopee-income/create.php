<?php


/* @var $this yii\web\View */
/* @var $model app\models\ShopeeIncome */
/* @var $referrer string */

$this->title = 'Tambah Shopee Income';
$this->params['breadcrumbs'][] = ['label' => 'Shopee Incomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shopee-income-create">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
