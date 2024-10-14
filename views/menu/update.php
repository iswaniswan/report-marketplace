<?php

/* @var $this yii\web\View */
/* @var $model app\models\Menu */
/* @var $referrer string */

$this->title = 'Edit Menu';
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';
?>
<div class="menu-update">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
