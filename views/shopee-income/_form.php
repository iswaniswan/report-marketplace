<?php

use app\components\Mode;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ShopeeIncome */
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

<?= $form->field($model, 'no')->textInput() ?>

<?= $form->field($model, 'no_pesanan')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'no_pengajuan')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'username_pembeli')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'waktu_pesanan_dibuat')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'metode_pembayaran_pembeli')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'tanggal_dana_dilepaskan')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'harga_asli_produk')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->harga_asli_produk)
]) ?>

<?= $form->field($model, 'total_diskon_produk')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->total_diskon_produk)
]) ?>

<?= $form->field($model, 'jumlah_pengembalian_dana_ke_pembeli')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->jumlah_pengembalian_dana_ke_pembeli)
]) ?>

<?= $form->field($model, 'diskon_produk_dari_shopee')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->diskon_produk_dari_shopee)
]) ?>

<?= $form->field($model, 'diskon_voucher_ditanggung_penjual')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->diskon_voucher_ditanggung_penjual)
]) ?>

<?= $form->field($model, 'cashback_koin_yang_ditanggung_penjual')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->cashback_koin_yang_ditanggung_penjual)
]) ?>

<?= $form->field($model, 'ongkir_dibayar_pembeli')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->ongkir_dibayar_pembeli)
]) ?>

<?= $form->field($model, 'diskon_ongkir_ditanggung_jasa_kirim')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->diskon_ongkir_ditanggung_jasa_kirim)
]) ?>

<?= $form->field($model, 'gratis_ongkir_dari_shopee')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->gratis_ongkir_dari_shopee)
]) ?>

<?= $form->field($model, 'ongkir_yang_diteruskan_oleh_shopee_ke_jasa_kirim')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->ongkir_yang_diteruskan_oleh_shopee_ke_jasa_kirim)
]) ?>

<?= $form->field($model, 'ongkos_kirim_pengembalian_barang')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->ongkos_kirim_pengembalian_barang)
]) ?>

<?= $form->field($model, 'pengembalian_biaya_kirim')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->pengembalian_biaya_kirim)
]) ?>

<?= $form->field($model, 'biaya_komisi_ams')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->biaya_komisi_ams)
]) ?>

<?= $form->field($model, 'biaya_administrasi_termasuk_ppn_11')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->biaya_administrasi_termasuk_ppn_11)
]) ?>

<?= $form->field($model, 'biaya_layanan_termasuk_ppn_11')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->biaya_layanan_termasuk_ppn_11)
]) ?>

<?= $form->field($model, 'premi')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->premi)
]) ?>

<?= $form->field($model, 'biaya_program')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->biaya_program)
]) ?>

<?= $form->field($model, 'biaya_kartu_kredit')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->biaya_kartu_kredit)
]) ?>

<?= $form->field($model, 'biaya_kampanye')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->biaya_kampanye)
]) ?>

<?= $form->field($model, 'bea_masuk_ppn_pph')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->bea_masuk_ppn_pph)
]) ?>

<?= $form->field($model, 'total_penghasilan')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->total_penghasilan)
]) ?>

<?= $form->field($model, 'kode_voucher')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'kompensasi')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->kompensasi)
]) ?>

<?= $form->field($model, 'promo_gratis_ongkir_dari_penjual')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->promo_gratis_ongkir_dari_penjual)
]) ?>

<?= $form->field($model, 'jasa_kirim')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'nama_kurir')->textInput(['maxlength' => true]) ?>

<?php // $form->field($model, '#')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'pengembalian_dana_ke_pembeli')->textInput() ?>

<?= $form->field($model, 'pro_rata_koin_yang_ditukarkan_untuk_pengembalian_barang')->textInput() ?>

<?= $form->field($model, 'pro_rata_voucher_shopee_untuk_pengembalian_barang')->textInput() ?>

<?= $form->field($model, 'pro_rated_bank_payment_channel_promotion_for_return_refund_items')->textInput() ?>

<?= $form->field($model, 'pro_rated_shopee_payment_channel_promotion_for_return_refund_ite')->textarea(['rows' => 6]) ?>

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