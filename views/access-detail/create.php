<?php


/* @var $this yii\web\View */
/* @var $model app\models\AccessDetail */
/* @var $referrer string */

$this->title = 'Tambah Access Detail';
$this->params['breadcrumbs'][] = ['label' => 'Access Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="access-detail-create">

    <?= $this->render('_form', [
        'model' => $model,
        'referrer'=> $referrer
    ]) ?>

</div>
