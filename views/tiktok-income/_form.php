<?php

use app\components\Mode;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TiktokIncome */
/* @var $form yii\widgets\ActiveForm */
/* @var $referrer string */
/* @var $mode Mode */


$inputOptions = [];
if (@$mode == Mode::READ) {
    $inputOptions = ['disabled' => true];
}

?>

<?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'enableAjaxValidation' => false,
    'enableClientValidation' => false,
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'label' => 'col-2',
            'wrapper' => 'col',
            'error' => '',
            'hint' => '',
            'field' => 'mb-3 row',
        ],
        'options' => ['style' => 'padding:unset'],
        'inputOptions' => $inputOptions,
    ]
]); ?>

<div class="row">
    <div class="container-fluid">
        <div class="member-form card-box">
            <div class="card-body row">
                <div class="col-12" style="border-bottom: 1px solid #ccc; margin-bottom: 2rem;">
                    <h4 class="card-title mb-3"><?= $this->title ?></h4>
                </div>

                <div class="container-fluid">
                    <?= $form->errorSummary($model) ?>

                    <?php // $form->field($model, 'id_file_source')->textInput() ?>

<?= $form->field($model, 'order_adjustment_id')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'order_created_time_utc')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'order_settled_time_utc')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'total_settlement_amount')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->total_settlement_amount)
]) ?>

<?= $form->field($model, 'total_revenue')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->total_revenue)
]) ?>

<?= $form->field($model, 'subtotal_after_seller_discounts')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->subtotal_after_seller_discounts)
]) ?>

<?= $form->field($model, 'subtotal_before_discounts')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->subtotal_before_discounts)
]) ?>

<?= $form->field($model, 'seller_discounts')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->seller_discounts)
]) ?>

<?= $form->field($model, 'refund_subtotal_after_seller_discounts')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->refund_subtotal_after_seller_discounts)
]) ?>

<?= $form->field($model, 'refund_subtotal_before_seller_discounts')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->refund_subtotal_before_seller_discounts)
]) ?>

<?= $form->field($model, 'refund_of_seller_discounts')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->refund_of_seller_discounts)
]) ?>

<?= $form->field($model, 'total_fees')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->total_fees)
]) ?>

<?= $form->field($model, 'tiktok_shop_commission_fee')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'flat_fee')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->flat_fee)
]) ?>

<?= $form->field($model, 'sales_fee')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->sales_fee)
]) ?>

<?= $form->field($model, 'mall_service_fee')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->mall_service_fee)
]) ?>

<?= $form->field($model, 'payment_fee')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->payment_fee)
]) ?>

<?= $form->field($model, 'shipping_cost')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->shipping_cost)
]) ?>

<?= $form->field($model, 'shipping_costs_passed_on_to_the_logistics_provider')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->shipping_costs_passed_on_to_the_logistics_provider)
]) ?>

<?= $form->field($model, 'shipping_cost_borne_by_the_platform')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->shipping_cost_borne_by_the_platform)
]) ?>

<?= $form->field($model, 'shipping_cost_paid_by_the_customer')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->shipping_cost_paid_by_the_customer)
]) ?>

<?= $form->field($model, 'refunded_shipping_cost_paid_by_the_customer')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->refunded_shipping_cost_paid_by_the_customer)
]) ?>

<?= $form->field($model, 'return_shipping_costs_passed_on_to_the_customer')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->return_shipping_costs_passed_on_to_the_customer)
]) ?>

<?= $form->field($model, 'shipping_cost_subsidy')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->shipping_cost_subsidy)
]) ?>

<?= $form->field($model, 'affiliate_commission')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->affiliate_commission)
]) ?>

<?= $form->field($model, 'affiliate_partner_commission')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->affiliate_partner_commission)
]) ?>

<?= $form->field($model, 'affiliate_shop_ads_commission')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->affiliate_shop_ads_commission)
]) ?>

<?= $form->field($model, 'sfp_service_fee')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->sfp_service_fee)
]) ?>

<?= $form->field($model, 'live_specials_service_fee')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->live_specials_service_fee)
]) ?>

<?= $form->field($model, 'bonus_cashback_service_fee')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->bonus_cashback_service_fee)
]) ?>

<?= $form->field($model, 'ajustment_amount')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->ajustment_amount)
]) ?>

<?= $form->field($model, 'related_order_id')->textInput(['maxlength' => true]) ?>

<?php // $form->field($model, '_')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'customer_payment')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->customer_payment)
]) ?>

<?= $form->field($model, 'customer_refund')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->customer_refund)
]) ?>

<?= $form->field($model, 'seller_co_funded_voucher_discount')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->seller_co_funded_voucher_discount)
]) ?>

<?= $form->field($model, 'refund_of_seller_co_funded_voucher_discount')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->refund_of_seller_co_funded_voucher_discount)
]) ?>

<?= $form->field($model, 'platform_discounts')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->platform_discounts)
]) ?>

<?= $form->field($model, 'refund_of_platform_discounts')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->refund_of_platform_discounts)
]) ?>

<?= $form->field($model, 'platform_co_funded_voucher_discounts')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->platform_co_funded_voucher_discounts)
]) ?>

<?= $form->field($model, 'refund_of_platform_co_funded_voucher_discounts')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->refund_of_platform_co_funded_voucher_discounts)
]) ?>

<?= $form->field($model, 'seller_shipping_cost_discount')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->seller_shipping_cost_discount)
]) ?>

<?= $form->field($model, 'estimated_package_weight_g')->textInput() ?>

<?= $form->field($model, 'actual_package_weight_g')->textInput() ?>

<?= $form->field($model, 'shopping_center_items')->textInput(['maxlength' => true]) ?>

                </div>
                <?= Html::hiddenInput('referrer', $referrer) ?>
            </div>
        </div>
    </div>
</div>
<div class="row mb-5">
    <div class="container-fluid">
        <?= Html::a('<i class="ti-arrow-left"></i><span class="ml-2">Back</span>', $referrer, ['class' => 'btn btn-info mb-1']) ?>
        <?php if ($mode == Mode::READ) { ?>
            <?php // Html::a('<i class="ti-pencil-alt"></i><span class="ml-2">Edit</span>', ['update', 'id' => $model->id], ['class' => 'btn btn-warning mb-1']) ?>
        <?php } else { ?>
            <?= Html::submitButton('<i class="ti-check"></i><span class="ml-2">' . ucwords('update') .'</span>', ['class' => 'btn btn-primary mb-1']) ?>
        <?php } ?>
    </div>
</div>

<?php ActiveForm::end(); ?>