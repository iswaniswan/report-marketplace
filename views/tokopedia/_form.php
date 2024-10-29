<?php

use app\components\Mode;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tokopedia */
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

<?= $form->field($model, 'tipe_produk')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'nomor_sku')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'catatan_produk_pembeli')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'catatan_produk_penjual')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'jumlah_produk_dibeli')->textInput() ?>

<?= $form->field($model, 'harga_awal_idr')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->harga_awal_idr)
]) ?>

<?= $form->field($model, 'harga_satuan_bundling_idr')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->harga_satuan_bundling_idr)
]) ?>

<?= $form->field($model, 'diskon_produk_idr')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->diskon_produk_idr)
]) ?>

<?= $form->field($model, 'harga_jual_idr')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->harga_jual_idr)
]) ?>

<?= $form->field($model, 'jumlah_subsidi_tokopedia_idr')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->jumlah_subsidi_tokopedia_idr)
]) ?>

<?= $form->field($model, 'nilai_kupon_toko_terpakai_idr')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->nilai_kupon_toko_terpakai_idr)
]) ?>

<?= $form->field($model, 'jenis_kupon_toko_terpakai')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'kode_kupon_toko_yang_digunakan')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'biaya_pengiriman_tunai_idr')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'biaya_asuransi_pengiriman_idr')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'total_biaya_pengiriman_idr')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'total_penjualan_idr')->textInput([
    'value' => Yii::$app->formatter->asDecimal($model->total_penjualan_idr)
]) ?>

<?= $form->field($model, 'nama_pembeli')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'no_telp_pembeli')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'nama_penerima')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'no_telp_penerima')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'alamat_pengiriman')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'kota')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'provinsi')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'nama_kurir')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'tipe_pengiriman_regular_same_day_etc')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'no_resi_kode_booking')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'tanggal_pengiriman_barang')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'waktu_pengiriman_barang')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'gudang_pengiriman')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'nama_campaign')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'nama_bundling')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'tipe_bebas_ongkir_bebas_ongkir_bebas_ongkir_dt')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'cod')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'jumlah_produk_yang_dikurangkan')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'total_pengurangan_idr')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'nama_penawaran_terpakai')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'tingkatan_promosi_terpakai')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'diskon_penawaran_terpakai_idr')->textInput(['maxlength' => true]) ?>

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