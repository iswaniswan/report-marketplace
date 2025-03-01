<?php

/* @var $this yii\web\View */
/* @var $model app\models\Log */
/* @var $referrer string */

$this->title = 'Edit Log';
$this->params['breadcrumbs'][] = ['label' => 'Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';
?>
<div class="log-update">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
