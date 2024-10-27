<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LazadaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lazada-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
        <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_file_source') ?>

    <?= $form->field($model, 'order_item_id') ?>

    <?= $form->field($model, 'order_type') ?>

    <?= $form->field($model, 'guarantee') ?>

    <?php // echo $form->field($model, 'delivery_type') ?>

    <?php // echo $form->field($model, 'lazada_id') ?>

    <?php // echo $form->field($model, 'seller_sku') ?>

    <?php // echo $form->field($model, 'lazada_sku') ?>

    <?php // echo $form->field($model, 'ware_house') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <?php // echo $form->field($model, 'rts_sla') ?>

    <?php // echo $form->field($model, 'tts_sla') ?>

    <?php // echo $form->field($model, 'order_number') ?>

    <?php // echo $form->field($model, 'invoice_required') ?>

    <?php // echo $form->field($model, 'invoice_number') ?>

    <?php // echo $form->field($model, 'delivered_date') ?>

    <?php // echo $form->field($model, 'customer_name') ?>

    <?php // echo $form->field($model, 'customer_email') ?>

    <?php // echo $form->field($model, 'national_registration_number') ?>

    <?php // echo $form->field($model, 'shipping_name') ?>

    <?php // echo $form->field($model, 'shipping_address') ?>

    <?php // echo $form->field($model, 'shipping_address2') ?>

    <?php // echo $form->field($model, 'shipping_address3') ?>

    <?php // echo $form->field($model, 'shipping_address4') ?>

    <?php // echo $form->field($model, 'shipping_address5') ?>

    <?php // echo $form->field($model, 'shipping_phone') ?>

    <?php // echo $form->field($model, 'shipping_phone2') ?>

    <?php // echo $form->field($model, 'shipping_city') ?>

    <?php // echo $form->field($model, 'shipping_post_code') ?>

    <?php // echo $form->field($model, 'shipping_country') ?>

    <?php // echo $form->field($model, 'shipping_region') ?>

    <?php // echo $form->field($model, 'billing_name') ?>

    <?php // echo $form->field($model, 'billing_addr') ?>

    <?php // echo $form->field($model, 'billing_addr2') ?>

    <?php // echo $form->field($model, 'billing_addr3') ?>

    <?php // echo $form->field($model, 'billing_addr4') ?>

    <?php // echo $form->field($model, 'billing_addr5') ?>

    <?php // echo $form->field($model, 'billing_phone') ?>

    <?php // echo $form->field($model, 'billing_phone2') ?>

    <?php // echo $form->field($model, 'billing_city') ?>

    <?php // echo $form->field($model, 'billing_post_code') ?>

    <?php // echo $form->field($model, 'billing_country') ?>

    <?php // echo $form->field($model, 'tax_code') ?>

    <?php // echo $form->field($model, 'branch_number') ?>

    <?php // echo $form->field($model, 'tax_invoice_requested') ?>

    <?php // echo $form->field($model, 'pay_method') ?>

    <?php // echo $form->field($model, 'paid_price') ?>

    <?php // echo $form->field($model, 'unit_price') ?>

    <?php // echo $form->field($model, 'seller_discount_total') ?>

    <?php // echo $form->field($model, 'shipping_fee') ?>

    <?php // echo $form->field($model, 'wallet_credit') ?>

    <?php // echo $form->field($model, 'item_name') ?>

    <?php // echo $form->field($model, 'variation') ?>

    <?php // echo $form->field($model, 'cd_shipping_provider') ?>

    <?php // echo $form->field($model, 'shipping_provider') ?>

    <?php // echo $form->field($model, 'shipment_type_name') ?>

    <?php // echo $form->field($model, 'shipping_provider_type') ?>

    <?php // echo $form->field($model, 'cd_tracking_code') ?>

    <?php // echo $form->field($model, 'tracking_code') ?>

    <?php // echo $form->field($model, 'tracking_url') ?>

    <?php // echo $form->field($model, 'shipping_provider_fm') ?>

    <?php // echo $form->field($model, 'tracking_code_fm') ?>

    <?php // echo $form->field($model, 'tracking_url_fm') ?>

    <?php // echo $form->field($model, 'promised_shipping_time') ?>

    <?php // echo $form->field($model, 'premium') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'buyer_failed_delivery_return_initiator') ?>

    <?php // echo $form->field($model, 'buyer_failed_delivery_reason') ?>

    <?php // echo $form->field($model, 'buyer_failed_delivery_detail') ?>

    <div class="col-sm-2 col-xs-12">
        <?= Html::submitButton('<i class="fa fa-check"></i> Filter Data', ['class' => 'btn btn-primary btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
