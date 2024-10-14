<?php


/* @var $this yii\web\View */
/* @var $model app\models\Menu */
/* @var $referrer string */

$this->title = 'Tambah Menu';
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-create">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
