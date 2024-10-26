<?php

/* @var $this yii\web\View */
/* @var $model app\models\TiktokIncome */
/* @var $referrer string */

$this->title = 'Edit Tiktok Income';
$this->params['breadcrumbs'][] = ['label' => 'Tiktok Incomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';
?>
<div class="tiktok-income-update">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
