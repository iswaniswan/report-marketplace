<?php

use app\components\Mode;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Shopee */
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

<?= $form->field($model, 'no_pesanan')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'status_pesanan')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'alasan_pembatalan')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'status_pembatalan_pengembalian')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'no_resi')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'opsi_pengiriman')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'antar_ke_counter_pick_up')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'pesanan_harus_dikirimkan_sebelum_menghindari_keterlambatan')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'waktu_pengiriman_diatur')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'waktu_pesanan_dibuat')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'waktu_pembayaran_dilakukan')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'metode_pembayaran')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'sku_induk')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'nama_produk')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'nomor_referensi_sku')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'nama_variasi')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'harga_awal')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'harga_setelah_diskon')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'jumlah')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'returned_quantity')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'total_harga_produk')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'total_diskon')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'diskon_dari_penjual')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'diskon_dari_shopee')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'berat_produk')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'jumlah_produk_di_pesan')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'total_berat')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'voucher_ditanggung_penjual')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'cashback_koin')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'voucher_ditanggung_shopee')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'paket_diskon')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'paket_diskon_diskon_dari_shopee')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'paket_diskon_diskon_dari_penjual')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'potongan_koin_shopee')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'diskon_kartu_kredit')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'ongkos_kirim_dibayar_oleh_pembeli')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'estimasi_potongan_biaya_pengiriman')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'ongkos_kirim_pengembalian_barang')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'total_pembayaran')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'perkiraan_ongkos_kirim')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'catatan_dari_pembeli')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'catatan')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'username_pembeli')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'nama_penerima')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'no_telepon')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'alamat_pengiriman')->textarea(['rows' => 2]) ?>

<?= $form->field($model, 'kota_kabupaten')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'provinsi')->textarea(['rows' => 1]) ?>

<?= $form->field($model, 'waktu_pesanan_selesai')->textarea(['rows' => 1]) ?>

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