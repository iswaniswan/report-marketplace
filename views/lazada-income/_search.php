<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LazadaIncomeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lazada-income-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
        <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_file_source') ?>

    <?= $form->field($model, 'statement_period') ?>

    <?= $form->field($model, 'statement_number') ?>

    <?= $form->field($model, 'transaction_date') ?>

    <?php // echo $form->field($model, 'fee_name') ?>

    <?php // echo $form->field($model, 'amount_include_tax') ?>

    <?php // echo $form->field($model, 'vat_amount') ?>

    <?php // echo $form->field($model, 'release_status') ?>

    <?php // echo $form->field($model, 'release_date') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'order_creation_date') ?>

    <?php // echo $form->field($model, 'order_number') ?>

    <?php // echo $form->field($model, 'order_line_id') ?>

    <?php // echo $form->field($model, 'seller_sku') ?>

    <?php // echo $form->field($model, 'lazada_sku') ?>

    <?php // echo $form->field($model, 'wht_amount') ?>

    <?php // echo $form->field($model, 'wht_included_in_amount') ?>

    <?php // echo $form->field($model, 'order_status') ?>

    <?php // echo $form->field($model, 'product_name') ?>

    <div class="col-sm-2 col-xs-12">
        <?= Html::submitButton('<i class="fa fa-check"></i> Filter Data', ['class' => 'btn btn-primary btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
