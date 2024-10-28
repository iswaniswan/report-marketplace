<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ShopeeIncomeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shopee-income-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
        <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_file_source') ?>

    <?= $form->field($model, 'no') ?>

    <?= $form->field($model, 'no_pesanan') ?>

    <?= $form->field($model, 'no_pengajuan') ?>

    <?php // echo $form->field($model, 'username_pembeli') ?>

    <?php // echo $form->field($model, 'waktu_pesanan_dibuat') ?>

    <?php // echo $form->field($model, 'metode_pembayaran_pembeli') ?>

    <?php // echo $form->field($model, 'tanggal_dana_dilepaskan') ?>

    <?php // echo $form->field($model, 'harga_asli_produk') ?>

    <?php // echo $form->field($model, 'total_diskon_produk') ?>

    <?php // echo $form->field($model, 'jumlah_pengembalian_dana_ke_pembeli') ?>

    <?php // echo $form->field($model, 'diskon_produk_dari_shopee') ?>

    <?php // echo $form->field($model, 'diskon_voucher_ditanggung_penjual') ?>

    <?php // echo $form->field($model, 'cashback_koin_yang_ditanggung_penjual') ?>

    <?php // echo $form->field($model, 'ongkir_dibayar_pembeli') ?>

    <?php // echo $form->field($model, 'diskon_ongkir_ditanggung_jasa_kirim') ?>

    <?php // echo $form->field($model, 'gratis_ongkir_dari_shopee') ?>

    <?php // echo $form->field($model, 'ongkir_yang_diteruskan_oleh_shopee_ke_jasa_kirim') ?>

    <?php // echo $form->field($model, 'ongkos_kirim_pengembalian_barang') ?>

    <?php // echo $form->field($model, 'pengembalian_biaya_kirim') ?>

    <?php // echo $form->field($model, 'biaya_komisi_ams') ?>

    <?php // echo $form->field($model, 'biaya_administrasi_termasuk_ppn_11') ?>

    <?php // echo $form->field($model, 'biaya_layanan_termasuk_ppn_11') ?>

    <?php // echo $form->field($model, 'premi') ?>

    <?php // echo $form->field($model, 'biaya_program') ?>

    <?php // echo $form->field($model, 'biaya_kartu_kredit') ?>

    <?php // echo $form->field($model, 'biaya_kampanye') ?>

    <?php // echo $form->field($model, 'bea_masuk_ppn_pph') ?>

    <?php // echo $form->field($model, 'total_penghasilan') ?>

    <?php // echo $form->field($model, 'kode_voucher') ?>

    <?php // echo $form->field($model, 'kompensasi') ?>

    <?php // echo $form->field($model, 'promo_gratis_ongkir_dari_penjual') ?>

    <?php // echo $form->field($model, 'jasa_kirim') ?>

    <?php // echo $form->field($model, 'nama_kurir') ?>

    <?php // echo $form->field($model, '#') ?>

    <?php // echo $form->field($model, 'pengembalian_dana_ke_pembeli') ?>

    <?php // echo $form->field($model, 'pro_rata_koin_yang_ditukarkan_untuk_pengembalian_barang') ?>

    <?php // echo $form->field($model, 'pro_rata_voucher_shopee_untuk_pengembalian_barang') ?>

    <?php // echo $form->field($model, 'pro_rated_bank_payment_channel_promotion_for_return_refund_items') ?>

    <?php // echo $form->field($model, 'pro_rated_shopee_payment_channel_promotion_for_return_refund_ite') ?>

    <div class="col-sm-2 col-xs-12">
        <?= Html::submitButton('<i class="fa fa-check"></i> Filter Data', ['class' => 'btn btn-primary btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
