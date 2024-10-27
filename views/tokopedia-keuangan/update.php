<?php

/* @var $this yii\web\View */
/* @var $model app\models\TokopediaKeuangan */
/* @var $referrer string */

$this->title = 'Edit Tokopedia Keuangan';
$this->params['breadcrumbs'][] = ['label' => 'Tokopedia Keuangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';
?>
<div class="tokopedia-keuangan-update">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
