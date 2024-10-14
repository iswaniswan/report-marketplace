<?php


/* @var $this yii\web\View */
/* @var $model app\models\Access */
/* @var $referrer string */
/* @var $all_menu array */

$this->title = 'Tambah Access';
$this->params['breadcrumbs'][] = ['label' => 'Accesses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="access-create">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer,
        'all_menu' => $all_menu,
        'menuProvider' => $menuProvider
    ]) ?>

</div>
