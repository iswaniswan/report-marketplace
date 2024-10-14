<?php

/* @var $this yii\web\View */
/* @var $model app\models\AccessDetail */
/* @var $referrer string */

$this->title = 'Edit Access Detail';
$this->params['breadcrumbs'][] = ['label' => 'Access Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';
?>
<div class="access-detail-update">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
