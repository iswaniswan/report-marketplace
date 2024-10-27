<?php

/* @var $this yii\web\View */
/* @var $model app\models\LazadaIncome */
/* @var $referrer string */

$this->title = 'Edit Lazada Income';
$this->params['breadcrumbs'][] = ['label' => 'Lazada Incomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';
?>
<div class="lazada-income-update">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
