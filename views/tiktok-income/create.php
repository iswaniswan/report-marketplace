<?php


/* @var $this yii\web\View */
/* @var $model app\models\TiktokIncome */
/* @var $referrer string */

$this->title = 'Tambah Tiktok Income';
$this->params['breadcrumbs'][] = ['label' => 'Tiktok Incomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tiktok-income-create">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
