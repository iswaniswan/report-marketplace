<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TiktokSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tiktok-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
        <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_file_source') ?>

    <?= $form->field($model, 'order_id') ?>

    <?= $form->field($model, 'order_status') ?>

    <?= $form->field($model, 'order_substatus') ?>

    <?php // echo $form->field($model, 'cancelation_return_type') ?>

    <?php // echo $form->field($model, 'normal_or_pre_order') ?>

    <?php // echo $form->field($model, 'sku_id') ?>

    <?php // echo $form->field($model, 'seller_sku') ?>

    <?php // echo $form->field($model, 'product_name') ?>

    <?php // echo $form->field($model, 'variation') ?>

    <?php // echo $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'sku_quantity_of_return') ?>

    <?php // echo $form->field($model, 'sku_unit_original_price') ?>

    <?php // echo $form->field($model, 'sku_subtotal_before_discount') ?>

    <?php // echo $form->field($model, 'sku_platform_discount') ?>

    <?php // echo $form->field($model, 'sku_seller_discount') ?>

    <?php // echo $form->field($model, 'sku_subtotal_after_discount') ?>

    <?php // echo $form->field($model, 'shipping_fee_after_discount') ?>

    <?php // echo $form->field($model, 'original_shipping_fee') ?>

    <?php // echo $form->field($model, 'shipping_fee_seller_discount') ?>

    <?php // echo $form->field($model, 'shipping_fee_platform_discount') ?>

    <?php // echo $form->field($model, 'payment_platform_discount') ?>

    <?php // echo $form->field($model, 'buyer_service_fee') ?>

    <?php // echo $form->field($model, 'taxes') ?>

    <?php // echo $form->field($model, 'order_amount') ?>

    <?php // echo $form->field($model, 'order_refund_amount') ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <?php // echo $form->field($model, 'paid_time') ?>

    <?php // echo $form->field($model, 'rts_time') ?>

    <?php // echo $form->field($model, 'shipped_time') ?>

    <?php // echo $form->field($model, 'delivered_time') ?>

    <?php // echo $form->field($model, 'cancelled_time') ?>

    <?php // echo $form->field($model, 'cancel_by') ?>

    <?php // echo $form->field($model, 'cancel_reason') ?>

    <?php // echo $form->field($model, 'fulfillment_type') ?>

    <?php // echo $form->field($model, 'warehouse_name') ?>

    <?php // echo $form->field($model, 'tracking_id') ?>

    <?php // echo $form->field($model, 'delivery_option') ?>

    <?php // echo $form->field($model, 'shipping_provider_name') ?>

    <?php // echo $form->field($model, 'buyer_message') ?>

    <?php // echo $form->field($model, 'buyer_username') ?>

    <?php // echo $form->field($model, 'recipient') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'zipcode') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'province') ?>

    <?php // echo $form->field($model, 'regency_and_city') ?>

    <?php // echo $form->field($model, 'districts') ?>

    <?php // echo $form->field($model, 'villages') ?>

    <?php // echo $form->field($model, 'detail_address') ?>

    <?php // echo $form->field($model, 'additional_address_information') ?>

    <?php // echo $form->field($model, 'payment_method') ?>

    <?php // echo $form->field($model, 'weight_kg') ?>

    <?php // echo $form->field($model, 'product_category') ?>

    <?php // echo $form->field($model, 'package_id') ?>

    <?php // echo $form->field($model, 'seller_note') ?>

    <?php // echo $form->field($model, 'checked_status') ?>

    <?php // echo $form->field($model, 'checked_marked_by') ?>

    <div class="col-sm-2 col-xs-12">
        <?= Html::submitButton('<i class="fa fa-check"></i> Filter Data', ['class' => 'btn btn-primary btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
