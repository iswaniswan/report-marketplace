<?php

/* @var $this yii\web\View */
/* @var $model app\models\RolePermissions */
/* @var $referrer string */

$this->title = 'Edit Role Permissions';
$this->params['breadcrumbs'][] = ['label' => 'Role Permissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';
?>
<div class="role-permissions-update">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
