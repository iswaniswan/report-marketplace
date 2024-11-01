<?php


/* @var $this yii\web\View */
/* @var $model app\models\Offline */
/* @var $referrer string */

$this->title = 'Tambah Offline';
$this->params['breadcrumbs'][] = ['label' => 'Offlines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offline-create">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
