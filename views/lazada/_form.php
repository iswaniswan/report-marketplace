<?php

use app\components\Mode;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Lazada */
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

<?= $form->field($model, 'order_item_id')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'order_type')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'guarantee')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'delivery_type')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'lazada_id')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'seller_sku')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'lazada_sku')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'ware_house')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'create_time')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'update_time')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'rts_sla')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'tts_sla')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'order_number')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'invoice_required')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'invoice_number')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'delivered_date')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'customer_name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'customer_email')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'national_registration_number')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'shipping_name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'shipping_address')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'shipping_address2')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'shipping_address3')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'shipping_address4')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'shipping_address5')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'shipping_phone')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'shipping_phone2')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'shipping_city')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'shipping_post_code')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'shipping_country')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'shipping_region')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'billing_name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'billing_addr')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'billing_addr2')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'billing_addr3')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'billing_addr4')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'billing_addr5')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'billing_phone')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'billing_phone2')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'billing_city')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'billing_post_code')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'billing_country')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'tax_code')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'branch_number')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'tax_invoice_requested')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'pay_method')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'paid_price')->textInput() ?>

<?= $form->field($model, 'unit_price')->textInput() ?>

<?= $form->field($model, 'seller_discount_total')->textInput() ?>

<?= $form->field($model, 'shipping_fee')->textInput() ?>

<?= $form->field($model, 'wallet_credit')->textInput() ?>

<?= $form->field($model, 'item_name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'variation')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'cd_shipping_provider')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'shipping_provider')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'shipment_type_name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'shipping_provider_type')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'cd_tracking_code')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'tracking_code')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'tracking_url')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'shipping_provider_fm')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'tracking_code_fm')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'tracking_url_fm')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'promised_shipping_time')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'premium')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'buyer_failed_delivery_return_initiator')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'buyer_failed_delivery_reason')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'buyer_failed_delivery_detail')->textInput(['maxlength' => true]) ?>

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