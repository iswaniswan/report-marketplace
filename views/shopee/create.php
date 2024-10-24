<?php


/* @var $this yii\web\View */
/* @var $model app\models\Shopee */
/* @var $referrer string */

$this->title = 'Tambah Shopee';
$this->params['breadcrumbs'][] = ['label' => 'Shopees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shopee-create">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
