<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GineeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ginee-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
        <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'no') ?>

    <?= $form->field($model, 'biaya_kartu_kredit') ?>

    <?= $form->field($model, 'waktu_pembaruan') ?>

    <?= $form->field($model, 'sinkronisasi_terakhir') ?>

    <?php // echo $form->field($model, 'adalah_pesanan_palsu') ?>

    <?php // echo $form->field($model, 'tanggal_pembuatan') ?>

    <?php // echo $form->field($model, 'id_pesanan') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'jenis_pesanan') ?>

    <?php // echo $form->field($model, 'channel') ?>

    <?php // echo $form->field($model, 'nama_toko') ?>

    <?php // echo $form->field($model, 'pembayaran') ?>

    <?php // echo $form->field($model, 'waktu_pembayaran') ?>

    <?php // echo $form->field($model, 'nama_pembeli') ?>

    <?php // echo $form->field($model, 'waktu_pengiriman') ?>

    <?php // echo $form->field($model, 'waktu_penyelesaian') ?>

    <?php // echo $form->field($model, 'telepon_pembeli') ?>

    <?php // echo $form->field($model, 'email_pembeli') ?>

    <?php // echo $form->field($model, 'catatan_pembeli') ?>

    <?php // echo $form->field($model, 'nama_produk') ?>

    <?php // echo $form->field($model, 'variant_produk') ?>

    <?php // echo $form->field($model, 'sku') ?>

    <?php // echo $form->field($model, 'nama_gudang') ?>

    <?php // echo $form->field($model, 'status_produk') ?>

    <?php // echo $form->field($model, 'harga_awal_produk') ?>

    <?php // echo $form->field($model, 'harga_promosi') ?>

    <?php // echo $form->field($model, 'jumlah') ?>

    <?php // echo $form->field($model, 'adalah_hadiah') ?>

    <?php // echo $form->field($model, 'total_berat_g') ?>

    <?php // echo $form->field($model, 'harga_total_promosi') ?>

    <?php // echo $form->field($model, 'subtotal') ?>

    <?php // echo $form->field($model, 'invoice') ?>

    <?php // echo $form->field($model, 'msku') ?>

    <?php // echo $form->field($model, 'nama_penerima') ?>

    <?php // echo $form->field($model, 'no_telepon_penerima') ?>

    <?php // echo $form->field($model, 'alamat_penerima') ?>

    <?php // echo $form->field($model, 'kurir') ?>

    <?php // echo $form->field($model, 'provinsi') ?>

    <?php // echo $form->field($model, 'kota') ?>

    <?php // echo $form->field($model, 'kecamatan') ?>

    <?php // echo $form->field($model, 'kode_pos') ?>

    <?php // echo $form->field($model, 'awb_no_tracking') ?>

    <?php // echo $form->field($model, 'dropshipper') ?>

    <?php // echo $form->field($model, 'no_telepon_dropshipper') ?>

    <?php // echo $form->field($model, 'kirim_sebelum') ?>

    <?php // echo $form->field($model, 'mata_uang') ?>

    <?php // echo $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'biaya_pengiriman') ?>

    <?php // echo $form->field($model, 'biaya_kirim_ditanggung_pembeli') ?>

    <?php // echo $form->field($model, 'pajak') ?>

    <?php // echo $form->field($model, 'asuransi') ?>

    <?php // echo $form->field($model, 'total_diskon') ?>

    <?php // echo $form->field($model, 'subsidi_marketplace') ?>

    <?php // echo $form->field($model, 'biaya_komisi') ?>

    <?php // echo $form->field($model, 'biaya_layanan') ?>

    <?php // echo $form->field($model, 'ongkir_dibayar_sistem') ?>

    <?php // echo $form->field($model, 'potongan_harga') ?>

    <?php // echo $form->field($model, 'potongan_biaya_pengiriman') ?>

    <?php // echo $form->field($model, 'koin') ?>

    <?php // echo $form->field($model, 'koin_cashback_penjual') ?>

    <?php // echo $form->field($model, 'jumlah_pengembalian_dana') ?>

    <?php // echo $form->field($model, 'voucher_channel') ?>

    <?php // echo $form->field($model, 'diskon_penjual') ?>

    <?php // echo $form->field($model, 'biaya_layanan_kartu_kredit') ?>

    <?php // echo $form->field($model, 'catatan_penjual') ?>

    <?php // echo $form->field($model, 'status_label_pengiriman') ?>

    <?php // echo $form->field($model, 'status_invoice') ?>

    <?php // echo $form->field($model, 'status_packing_list') ?>

    <?php // echo $form->field($model, 'alasan_pembatalan') ?>

    <?php // echo $form->field($model, 'pemotongan_pajak') ?>

    <?php // echo $form->field($model, 'waktu_pembatalan') ?>

    <?php // echo $form->field($model, 'alamat_tagihan') ?>

    <?php // echo $form->field($model, 'biaya_pembayaran') ?>

    <?php // echo $form->field($model, 'biaya_lainnya') ?>

    <?php // echo $form->field($model, 'komisi_lazpick_laztop') ?>

    <?php // echo $form->field($model, 'biaya_promosi_gratis_ongkir') ?>

    <?php // echo $form->field($model, 'kredit') ?>

    <div class="col-sm-2 col-xs-12">
        <?= Html::submitButton('<i class="fa fa-check"></i> Filter Data', ['class' => 'btn btn-primary btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
