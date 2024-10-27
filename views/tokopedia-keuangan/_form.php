<?php

use app\components\Mode;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TokopediaKeuangan */
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

<?php // $form->field($model, 'nomor')->textInput() ?>

<?= $form->field($model, 'nomor_invoice')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'tanggal_pembayaran')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'status_terakhir')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'tanggal_pesanan_selesai')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'waktu_pesanan_selesai')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'tanggal_pesanan_dibatalkan')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'waktu_pesanan_dibatalkan')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'nama_produk')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'jumlah_produk_dibeli')->textInput() ?>

<?= $form->field($model, 'harga_jual_idr')->textInput() ?>

<?= $form->field($model, 'jumlah_subsidi_tokopedia_idr')->textInput() ?>

<?= $form->field($model, 'nilai_kupon_toko_terpakai_idr')->textInput() ?>

<?= $form->field($model, 'jenis_kupon_toko_terpakai')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'kode_kupon_toko_yang_digunakan')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'jumlah_produk_yang_dikurangkan')->textInput() ?>

<?= $form->field($model, 'total_pengurangan_idr')->textInput() ?>

<?= $form->field($model, 'nama_biaya_layanan')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'persentase_biaya_layanan')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'biaya_layanan_termasuk_ppn_dan_pph_idr')->textInput() ?>

<?= $form->field($model, 'biaya_layanan_di_luar_ppn_dan_pph_idr')->textInput() ?>

<?= $form->field($model, 'ppn_idr')->textInput() ?>

<?= $form->field($model, 'pph_idr')->textInput() ?>

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