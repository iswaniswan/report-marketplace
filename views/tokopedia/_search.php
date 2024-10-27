<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TokopediaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tokopedia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
        <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_file_source') ?>

    <?= $form->field($model, 'nomor') ?>

    <?= $form->field($model, 'nomor_invoice') ?>

    <?= $form->field($model, 'tanggal_pembayaran') ?>

    <?php // echo $form->field($model, 'status_terakhir') ?>

    <?php // echo $form->field($model, 'tanggal_pesanan_selesai') ?>

    <?php // echo $form->field($model, 'waktu_pesanan_selesai') ?>

    <?php // echo $form->field($model, 'tanggal_pesanan_dibatalkan') ?>

    <?php // echo $form->field($model, 'waktu_pesanan_dibatalkan') ?>

    <?php // echo $form->field($model, 'nama_produk') ?>

    <?php // echo $form->field($model, 'tipe_produk') ?>

    <?php // echo $form->field($model, 'nomor_sku') ?>

    <?php // echo $form->field($model, 'catatan_produk_pembeli') ?>

    <?php // echo $form->field($model, 'catatan_produk_penjual') ?>

    <?php // echo $form->field($model, 'jumlah_produk_dibeli') ?>

    <?php // echo $form->field($model, 'harga_awal_idr') ?>

    <?php // echo $form->field($model, 'harga_satuan_bundling_idr') ?>

    <?php // echo $form->field($model, 'diskon_produk_idr') ?>

    <?php // echo $form->field($model, 'harga_jual_idr') ?>

    <?php // echo $form->field($model, 'jumlah_subsidi_tokopedia_idr') ?>

    <?php // echo $form->field($model, 'nilai_kupon_toko_terpakai_idr') ?>

    <?php // echo $form->field($model, 'jenis_kupon_toko_terpakai') ?>

    <?php // echo $form->field($model, 'kode_kupon_toko_yang_digunakan') ?>

    <?php // echo $form->field($model, 'biaya_pengiriman_tunai_idr') ?>

    <?php // echo $form->field($model, 'biaya_asuransi_pengiriman_idr') ?>

    <?php // echo $form->field($model, 'total_biaya_pengiriman_idr') ?>

    <?php // echo $form->field($model, 'total_penjualan_idr') ?>

    <?php // echo $form->field($model, 'nama_pembeli') ?>

    <?php // echo $form->field($model, 'no_telp_pembeli') ?>

    <?php // echo $form->field($model, 'nama_penerima') ?>

    <?php // echo $form->field($model, 'no_telp_penerima') ?>

    <?php // echo $form->field($model, 'alamat_pengiriman') ?>

    <?php // echo $form->field($model, 'kota') ?>

    <?php // echo $form->field($model, 'provinsi') ?>

    <?php // echo $form->field($model, 'nama_kurir') ?>

    <?php // echo $form->field($model, 'tipe_pengiriman_regular_same_day_etc') ?>

    <?php // echo $form->field($model, 'no_resi_kode_booking') ?>

    <?php // echo $form->field($model, 'tanggal_pengiriman_barang') ?>

    <?php // echo $form->field($model, 'waktu_pengiriman_barang') ?>

    <?php // echo $form->field($model, 'gudang_pengiriman') ?>

    <?php // echo $form->field($model, 'nama_campaign') ?>

    <?php // echo $form->field($model, 'nama_bundling') ?>

    <?php // echo $form->field($model, 'tipe_bebas_ongkir_bebas_ongkir_bebas_ongkir_dt') ?>

    <?php // echo $form->field($model, 'cod') ?>

    <?php // echo $form->field($model, 'jumlah_produk_yang_dikurangkan') ?>

    <?php // echo $form->field($model, 'total_pengurangan_idr') ?>

    <?php // echo $form->field($model, 'nama_penawaran_terpakai') ?>

    <?php // echo $form->field($model, 'tingkatan_promosi_terpakai') ?>

    <?php // echo $form->field($model, 'diskon_penawaran_terpakai_idr') ?>

    <div class="col-sm-2 col-xs-12">
        <?= Html::submitButton('<i class="fa fa-check"></i> Filter Data', ['class' => 'btn btn-primary btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
