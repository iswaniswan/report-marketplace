<?php


/* @var $this yii\web\View */
/* @var $model app\models\FileSource */
/* @var $referrer string */

$this->title = 'Tambah File Source';
$this->params['breadcrumbs'][] = ['label' => 'File Sources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-source-create">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
