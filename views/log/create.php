<?php


/* @var $this yii\web\View */
/* @var $model app\models\Log */
/* @var $referrer string */

$this->title = 'Tambah Log';
$this->params['breadcrumbs'][] = ['label' => 'Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-create">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
