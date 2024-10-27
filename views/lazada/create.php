<?php


/* @var $this yii\web\View */
/* @var $model app\models\Lazada */
/* @var $referrer string */

$this->title = 'Tambah Lazada';
$this->params['breadcrumbs'][] = ['label' => 'Lazadas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lazada-create">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
