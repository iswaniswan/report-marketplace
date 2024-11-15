<?php


/* @var $this yii\web\View */
/* @var $model app\models\RolePermissions */
/* @var $referrer string */

$this->title = 'Tambah Role Permissions';
$this->params['breadcrumbs'][] = ['label' => 'Role Permissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-permissions-create">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
