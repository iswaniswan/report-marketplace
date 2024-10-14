<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AccessDetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="access-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
        <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_menu') ?>

    <?= $form->field($model, 'id_access') ?>

    <?= $form->field($model, 'is_create') ?>

    <?= $form->field($model, 'is_read') ?>

    <?php // echo $form->field($model, 'is_update') ?>

    <?php // echo $form->field($model, 'is_delete') ?>

    <?php // echo $form->field($model, 'is_approve') ?>

    <?php // echo $form->field($model, 'is_print') ?>

    <?php // echo $form->field($model, 'is_download') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <?php // echo $form->field($model, 'date_updated') ?>

    <div class="col-sm-2 col-xs-12">
        <?= Html::submitButton('<i class="fa fa-check"></i> Filter Data', ['class' => 'btn btn-primary btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
