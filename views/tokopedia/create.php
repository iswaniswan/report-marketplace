<?php


/* @var $this yii\web\View */
/* @var $model app\models\Tokopedia */
/* @var $referrer string */

$this->title = 'Tambah Tokopedia';
$this->params['breadcrumbs'][] = ['label' => 'Tokopedias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tokopedia-create">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
