<?php


/* @var $this yii\web\View */
/* @var $model app\models\LazadaIncome */
/* @var $referrer string */

$this->title = 'Tambah Lazada Income';
$this->params['breadcrumbs'][] = ['label' => 'Lazada Incomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lazada-income-create">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
