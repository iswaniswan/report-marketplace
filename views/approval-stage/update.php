<?php

/* @var $this yii\web\View */
/* @var $model app\models\ApprovalStage */
/* @var $referrer string */

$this->title = 'Edit Approval Stage';
$this->params['breadcrumbs'][] = ['label' => 'Approval Stages', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';
?>
<div class="approval-stage-update">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
