<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ShopeeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shopee-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
        <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_file_source') ?>

    <?= $form->field($model, 'no_pesanan') ?>

    <?= $form->field($model, 'status_pesanan') ?>

    <?= $form->field($model, 'alasan_pembatalan') ?>

    <?php // echo $form->field($model, 'status_pembatalan_pengembalian') ?>

    <?php // echo $form->field($model, 'no_resi') ?>

    <?php // echo $form->field($model, 'opsi_pengiriman') ?>

    <?php // echo $form->field($model, 'antar_ke_counter_pick_up') ?>

    <?php // echo $form->field($model, 'pesanan_harus_dikirimkan_sebelum_menghindari_keterlambatan') ?>

    <?php // echo $form->field($model, 'waktu_pengiriman_diatur') ?>

    <?php // echo $form->field($model, 'waktu_pesanan_dibuat') ?>

    <?php // echo $form->field($model, 'waktu_pembayaran_dilakukan') ?>

    <?php // echo $form->field($model, 'metode_pembayaran') ?>

    <?php // echo $form->field($model, 'sku_induk') ?>

    <?php // echo $form->field($model, 'nama_produk') ?>

    <?php // echo $form->field($model, 'nomor_referensi_sku') ?>

    <?php // echo $form->field($model, 'nama_variasi') ?>

    <?php // echo $form->field($model, 'harga_awal') ?>

    <?php // echo $form->field($model, 'harga_setelah_diskon') ?>

    <?php // echo $form->field($model, 'jumlah') ?>

    <?php // echo $form->field($model, 'returned_quantity') ?>

    <?php // echo $form->field($model, 'total_harga_produk') ?>

    <?php // echo $form->field($model, 'total_diskon') ?>

    <?php // echo $form->field($model, 'diskon_dari_penjual') ?>

    <?php // echo $form->field($model, 'diskon_dari_shopee') ?>

    <?php // echo $form->field($model, 'berat_produk') ?>

    <?php // echo $form->field($model, 'jumlah_produk_di_pesan') ?>

    <?php // echo $form->field($model, 'total_berat') ?>

    <?php // echo $form->field($model, 'voucher_ditanggung_penjual') ?>

    <?php // echo $form->field($model, 'cashback_koin') ?>

    <?php // echo $form->field($model, 'voucher_ditanggung_shopee') ?>

    <?php // echo $form->field($model, 'paket_diskon') ?>

    <?php // echo $form->field($model, 'paket_diskon_diskon_dari_shopee') ?>

    <?php // echo $form->field($model, 'paket_diskon_diskon_dari_penjual') ?>

    <?php // echo $form->field($model, 'potongan_koin_shopee') ?>

    <?php // echo $form->field($model, 'diskon_kartu_kredit') ?>

    <?php // echo $form->field($model, 'ongkos_kirim_dibayar_oleh_pembeli') ?>

    <?php // echo $form->field($model, 'estimasi_potongan_biaya_pengiriman') ?>

    <?php // echo $form->field($model, 'ongkos_kirim_pengembalian_barang') ?>

    <?php // echo $form->field($model, 'total_pembayaran') ?>

    <?php // echo $form->field($model, 'perkiraan_ongkos_kirim') ?>

    <?php // echo $form->field($model, 'catatan_dari_pembeli') ?>

    <?php // echo $form->field($model, 'catatan') ?>

    <?php // echo $form->field($model, 'username_pembeli') ?>

    <?php // echo $form->field($model, 'nama_penerima') ?>

    <?php // echo $form->field($model, 'no_telepon') ?>

    <?php // echo $form->field($model, 'alamat_pengiriman') ?>

    <?php // echo $form->field($model, 'kota_kabupaten') ?>

    <?php // echo $form->field($model, 'provinsi') ?>

    <?php // echo $form->field($model, 'waktu_pesanan_selesai') ?>

    <div class="col-sm-2 col-xs-12">
        <?= Html::submitButton('<i class="fa fa-check"></i> Filter Data', ['class' => 'btn btn-primary btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
