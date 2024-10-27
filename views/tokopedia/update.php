<?php

/* @var $this yii\web\View */
/* @var $model app\models\Tokopedia */
/* @var $referrer string */

$this->title = 'Edit Tokopedia';
$this->params['breadcrumbs'][] = ['label' => 'Tokopedias', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';
?>
<div class="tokopedia-update">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
