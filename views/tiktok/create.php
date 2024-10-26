<?php


/* @var $this yii\web\View */
/* @var $model app\models\Tiktok */
/* @var $referrer string */

$this->title = 'Tambah Tiktok';
$this->params['breadcrumbs'][] = ['label' => 'Tiktoks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tiktok-create">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
