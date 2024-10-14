<?php


/* @var $this yii\web\View */
/* @var $model app\models\Role */
/* @var $referrer string */

$this->title = 'Tambah Role';
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-create">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
