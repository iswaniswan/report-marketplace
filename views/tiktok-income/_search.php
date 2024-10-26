<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TiktokIncomeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tiktok-income-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
        <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_file_source') ?>

    <?= $form->field($model, 'order_adjustment_id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'order_created_time_utc') ?>

    <?php // echo $form->field($model, 'order_settled_time_utc') ?>

    <?php // echo $form->field($model, 'currency') ?>

    <?php // echo $form->field($model, 'total_settlement_amount') ?>

    <?php // echo $form->field($model, 'total_revenue') ?>

    <?php // echo $form->field($model, 'subtotal_after_seller_discounts') ?>

    <?php // echo $form->field($model, 'subtotal_before_discounts') ?>

    <?php // echo $form->field($model, 'seller_discounts') ?>

    <?php // echo $form->field($model, 'refund_subtotal_after_seller_discounts') ?>

    <?php // echo $form->field($model, 'refund_subtotal_before_seller_discounts') ?>

    <?php // echo $form->field($model, 'refund_of_seller_discounts') ?>

    <?php // echo $form->field($model, 'total_fees') ?>

    <?php // echo $form->field($model, 'tiktok_shop_commission_fee') ?>

    <?php // echo $form->field($model, 'flat_fee') ?>

    <?php // echo $form->field($model, 'sales_fee') ?>

    <?php // echo $form->field($model, 'mall_service_fee') ?>

    <?php // echo $form->field($model, 'payment_fee') ?>

    <?php // echo $form->field($model, 'shipping_cost') ?>

    <?php // echo $form->field($model, 'shipping_costs_passed_on_to_the_logistics_provider') ?>

    <?php // echo $form->field($model, 'shipping_cost_borne_by_the_platform') ?>

    <?php // echo $form->field($model, 'shipping_cost_paid_by_the_customer') ?>

    <?php // echo $form->field($model, 'refunded_shipping_cost_paid_by_the_customer') ?>

    <?php // echo $form->field($model, 'return_shipping_costs_passed_on_to_the_customer') ?>

    <?php // echo $form->field($model, 'shipping_cost_subsidy') ?>

    <?php // echo $form->field($model, 'affiliate_commission') ?>

    <?php // echo $form->field($model, 'affiliate_partner_commission') ?>

    <?php // echo $form->field($model, 'affiliate_shop_ads_commission') ?>

    <?php // echo $form->field($model, 'sfp_service_fee') ?>

    <?php // echo $form->field($model, 'live_specials_service_fee') ?>

    <?php // echo $form->field($model, 'bonus_cashback_service_fee') ?>

    <?php // echo $form->field($model, 'ajustment_amount') ?>

    <?php // echo $form->field($model, 'related_order_id') ?>

    <?php // echo $form->field($model, '_') ?>

    <?php // echo $form->field($model, 'customer_payment') ?>

    <?php // echo $form->field($model, 'customer_refund') ?>

    <?php // echo $form->field($model, 'seller_co_funded_voucher_discount') ?>

    <?php // echo $form->field($model, 'refund_of_seller_co_funded_voucher_discount') ?>

    <?php // echo $form->field($model, 'platform_discounts') ?>

    <?php // echo $form->field($model, 'refund_of_platform_discounts') ?>

    <?php // echo $form->field($model, 'platform_co_funded_voucher_discounts') ?>

    <?php // echo $form->field($model, 'refund_of_platform_co_funded_voucher_discounts') ?>

    <?php // echo $form->field($model, 'seller_shipping_cost_discount') ?>

    <?php // echo $form->field($model, 'estimated_package_weight_g') ?>

    <?php // echo $form->field($model, 'actual_package_weight_g') ?>

    <?php // echo $form->field($model, 'shopping_center_items') ?>

    <div class="col-sm-2 col-xs-12">
        <?= Html::submitButton('<i class="fa fa-check"></i> Filter Data', ['class' => 'btn btn-primary btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
