<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TokopediaKeuanganSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tokopedia-keuangan-search">

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

    <?php // echo $form->field($model, 'jumlah_produk_dibeli') ?>

    <?php // echo $form->field($model, 'harga_jual_idr') ?>

    <?php // echo $form->field($model, 'jumlah_subsidi_tokopedia_idr') ?>

    <?php // echo $form->field($model, 'nilai_kupon_toko_terpakai_idr') ?>

    <?php // echo $form->field($model, 'jenis_kupon_toko_terpakai') ?>

    <?php // echo $form->field($model, 'kode_kupon_toko_yang_digunakan') ?>

    <?php // echo $form->field($model, 'jumlah_produk_yang_dikurangkan') ?>

    <?php // echo $form->field($model, 'total_pengurangan_idr') ?>

    <?php // echo $form->field($model, 'nama_biaya_layanan') ?>

    <?php // echo $form->field($model, 'persentase_biaya_layanan') ?>

    <?php // echo $form->field($model, 'biaya_layanan_termasuk_ppn_dan_pph_idr') ?>

    <?php // echo $form->field($model, 'biaya_layanan_di_luar_ppn_dan_pph_idr') ?>

    <?php // echo $form->field($model, 'ppn_idr') ?>

    <?php // echo $form->field($model, 'pph_idr') ?>

    <div class="col-sm-2 col-xs-12">
        <?= Html::submitButton('<i class="fa fa-check"></i> Filter Data', ['class' => 'btn btn-primary btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
