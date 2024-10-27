<?php

/* @var $this yii\web\View */
/* @var $model app\models\Lazada */
/* @var $referrer string */

$this->title = 'Edit Lazada';
$this->params['breadcrumbs'][] = ['label' => 'Lazadas', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';
?>
<div class="lazada-update">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
