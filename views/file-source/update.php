<?php

/* @var $this yii\web\View */
/* @var $model app\models\FileSource */
/* @var $referrer string */

$this->title = 'Edit File Source';
$this->params['breadcrumbs'][] = ['label' => 'File Sources', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';
?>
<div class="file-source-update">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
