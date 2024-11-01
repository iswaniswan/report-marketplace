<?php

/* @var $this yii\web\View */
/* @var $model app\models\Offline */
/* @var $referrer string */

$this->title = 'Edit Offline';
$this->params['breadcrumbs'][] = ['label' => 'Offlines', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';
?>
<div class="offline-update">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
