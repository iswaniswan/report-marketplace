<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OfflineReportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="offline-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
        <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'no_invoice') ?>

    <?= $form->field($model, 'tanggal_invoice') ?>

    <?= $form->field($model, 'nama_customer') ?>

    <?= $form->field($model, 'alamat_customer') ?>

    <?php // echo $form->field($model, 'no_hp_customer') ?>

    <?php // echo $form->field($model, 'kode_sku') ?>

    <?php // echo $form->field($model, 'nama_barang') ?>

    <?php // echo $form->field($model, 'tanggal_bayar') ?>

    <?php // echo $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'harga_satuan') ?>

    <?php // echo $form->field($model, 'subtotal') ?>

    <?php // echo $form->field($model, 'adjustment') ?>

    <div class="col-sm-2 col-xs-12">
        <?= Html::submitButton('<i class="fa fa-check"></i> Filter Data', ['class' => 'btn btn-primary btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
