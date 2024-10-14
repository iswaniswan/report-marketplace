<?php


/* @var $this yii\web\View */
/* @var $model app\models\ApprovalStage */
/* @var $referrer string */

$this->title = 'Tambah Approval Stage';
$this->params['breadcrumbs'][] = ['label' => 'Approval Stages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="approval-stage-create">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
