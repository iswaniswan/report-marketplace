<?php

use app\components\Mode;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tiktok */
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

<?= $form->field($model, 'order_id')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'order_status')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'order_substatus')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'cancelation_return_type')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'normal_or_pre_order')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'sku_id')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'seller_sku')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'product_name')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'variation')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'quantity')->textInput() ?>

<?= $form->field($model, 'sku_quantity_of_return')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'sku_unit_original_price')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->sku_unit_original_price)
]) ?>

<?= $form->field($model, 'sku_subtotal_before_discount')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->sku_subtotal_before_discount)
]) ?>

<?= $form->field($model, 'sku_platform_discount')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->sku_platform_discount)
]) ?>

<?= $form->field($model, 'sku_seller_discount')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->sku_seller_discount)
]) ?>

<?= $form->field($model, 'sku_subtotal_after_discount')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->sku_subtotal_after_discount)
]) ?>

<?= $form->field($model, 'shipping_fee_after_discount')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->shipping_fee_after_discount)
]) ?>

<?= $form->field($model, 'original_shipping_fee')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->original_shipping_fee)
]) ?>

<?= $form->field($model, 'shipping_fee_seller_discount')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'shipping_fee_platform_discount')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->shipping_fee_platform_discount)
]) ?>

<?= $form->field($model, 'payment_platform_discount')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->payment_platform_discount)
]) ?>

<?= $form->field($model, 'buyer_service_fee')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->buyer_service_fee)
]) ?>

<?= $form->field($model, 'taxes')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->taxes)
]) ?>

<?= $form->field($model, 'order_amount')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->order_amount)
]) ?>

<?= $form->field($model, 'order_refund_amount')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->order_refund_amount)
]) ?>

<?= $form->field($model, 'created_time')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'paid_time')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'rts_time')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'shipped_time')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'delivered_time')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'cancelled_time')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'cancel_by')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'cancel_reason')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'fulfillment_type')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'warehouse_name')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'tracking_id')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'delivery_option')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'shipping_provider_name')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'buyer_message')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'buyer_username')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'recipient')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'phone')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'zipcode')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'country')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'province')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'regency_and_city')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'districts')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'villages')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'detail_address')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'additional_address_information')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'payment_method')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'weight_kg')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'product_category')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'package_id')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'seller_note')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'checked_status')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'checked_marked_by')->textarea(['rows' => 1]) ?>

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