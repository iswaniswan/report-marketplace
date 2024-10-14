<?php

/* @var $this yii\web\View */
/* @var $model app\models\Role */
/* @var $referrer string */

$this->title = 'Edit Role';
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';
?>
<div class="role-update">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
