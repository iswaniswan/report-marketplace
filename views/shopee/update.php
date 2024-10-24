<?php

/* @var $this yii\web\View */
/* @var $model app\models\Shopee */
/* @var $referrer string */

$this->title = 'Edit Shopee';
$this->params['breadcrumbs'][] = ['label' => 'Shopees', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';
?>
<div class="shopee-update">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
