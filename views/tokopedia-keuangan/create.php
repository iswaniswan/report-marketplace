<?php


/* @var $this yii\web\View */
/* @var $model app\models\TokopediaKeuangan */
/* @var $referrer string */

$this->title = 'Tambah Tokopedia Keuangan';
$this->params['breadcrumbs'][] = ['label' => 'Tokopedia Keuangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tokopedia-keuangan-create">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
