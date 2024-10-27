<?php

use app\components\Mode;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LazadaIncome */
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

<?= $form->field($model, 'statement_period')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'statement_number')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'transaction_date')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'fee_name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'amount_include_tax')->textInput() ?>

<?= $form->field($model, 'vat_amount')->textInput() ?>

<?= $form->field($model, 'release_status')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'release_date')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'order_creation_date')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'order_number')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'order_line_id')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'seller_sku')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'lazada_sku')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'wht_amount')->textInput() ?>

<?= $form->field($model, 'wht_included_in_amount')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'order_status')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

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