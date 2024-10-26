<?php

/* @var $this yii\web\View */
/* @var $model app\models\Tiktok */
/* @var $referrer string */

$this->title = 'Edit Tiktok';
$this->params['breadcrumbs'][] = ['label' => 'Tiktoks', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';
?>
<div class="tiktok-update">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
