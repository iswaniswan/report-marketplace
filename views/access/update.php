<?php

/* @var $this yii\web\View */
/* @var $model app\models\Access */
/* @var $referrer string */

$this->title = 'Edit Access';
$this->params['breadcrumbs'][] = ['label' => 'Accesses', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Sunting';
?>
<div class="access-update">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer,
        'menuProvider' => $menuProvider
    ]) ?>

</div>
