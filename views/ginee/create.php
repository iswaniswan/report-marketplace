<?php


/* @var $this yii\web\View */
/* @var $model app\models\Ginee */
/* @var $referrer string */

$this->title = 'Tambah Ginee';
$this->params['breadcrumbs'][] = ['label' => 'Ginees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ginee-create">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
