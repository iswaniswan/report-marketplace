<?php

/* @var $this yii\web\View */
/* @var $model app\models\Ginee */
/* @var $referrer string */

$this->title = 'Edit Ginee';
$this->params['breadcrumbs'][] = ['label' => 'Ginees', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';
?>
<div class="ginee-update">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
