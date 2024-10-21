<?php

use app\components\Mode;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ginee */
/* @var $form yii\widgets\ActiveForm */
/* @var $referrer string */
/* @var $mode Mode */

\yii\widgets\MaskedInputAsset::register($this);


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
    ],
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

                    <?php // $form->field($model, 'no')->textarea(['rows' => 1]) ?>

                <?php // $form->field($model, 'biaya_kartu_kredit')->textarea(['rows' => 1]) ?>
                <?= $form->field($model, 'biaya_kartu_kredit')->textInput([
                    'value' => Yii::$app->formatter->asDecimal($model->biaya_kartu_kredit, 2),
                ]) ?>

                <?= $form->field($model, 'waktu_pembaruan')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'sinkronisasi_terakhir')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'adalah_pesanan_palsu')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'tanggal_pembuatan')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'id_pesanan')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'status')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'jenis_pesanan')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'channel')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'nama_toko')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'pembayaran')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'waktu_pembayaran')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'nama_pembeli')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'waktu_pengiriman')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'waktu_penyelesaian')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'telepon_pembeli')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'email_pembeli')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'catatan_pembeli')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'nama_produk')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'variant_produk')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'sku')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'nama_gudang')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'status_produk')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'harga_awal_produk')->textInput([
                        'value' => Yii::$app->formatter->asDecimal($model->harga_awal_produk, 2),
                ]) ?>

                <?= $form->field($model, 'harga_promosi')->textInput([
                        'value' => Yii::$app->formatter->asDecimal($model->harga_promosi, 2),
                ]) ?>

                <?= $form->field($model, 'jumlah')->textInput([
                        'value' => Yii::$app->formatter->asDecimal($model->jumlah, 2),
                ]) ?>

                <?= $form->field($model, 'adalah_hadiah')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'total_berat_g')->textInput([
                        'value' => Yii::$app->formatter->asDecimal($model->total_berat_g, 2),
                ]) ?>

                <?= $form->field($model, 'harga_total_promosi')->textInput([
                        'value' => Yii::$app->formatter->asDecimal($model->harga_total_promosi, 2),
                ]) ?>

                <?= $form->field($model, 'subtotal')->textInput([
                    'value' => Yii::$app->formatter->asDecimal($model->subtotal, 2),
                ]) ?>

                <?= $form->field($model, 'invoice')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'msku')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'nama_penerima')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'no_telepon_penerima')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'alamat_penerima')->textarea(['rows' => 2]) ?>

                <?= $form->field($model, 'kurir')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'provinsi')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'kota')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'kecamatan')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'kode_pos')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'awb_no_tracking')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'dropshipper')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'no_telepon_dropshipper')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'kirim_sebelum')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'mata_uang')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'total')->textInput([
                    'value' => Yii::$app->formatter->asDecimal($model->total, 2),
                ]) ?>

                <?= $form->field($model, 'biaya_pengiriman')->textInput([
                    'value' => Yii::$app->formatter->asDecimal($model->biaya_pengiriman, 2),
                ]) ?>

                <?= $form->field($model, 'biaya_kirim_ditanggung_pembeli')->textInput([
                    'value' => Yii::$app->formatter->asDecimal($model->biaya_kirim_ditanggung_pembeli, 2),
                ]) ?>

                <?= $form->field($model, 'pajak')->textInput([
                    'value' => Yii::$app->formatter->asDecimal($model->pajak, 2),
                ]) ?>

                <?= $form->field($model, 'asuransi')->textInput([
                    'value' => Yii::$app->formatter->asDecimal($model->asuransi, 2),
                ]) ?>

                <?= $form->field($model, 'total_diskon')->textInput([
                    'value' => Yii::$app->formatter->asDecimal($model->total_diskon, 2),
                ]) ?>

                <?= $form->field($model, 'subsidi_marketplace')->textInput([
                    'value' => Yii::$app->formatter->asDecimal($model->subsidi_marketplace, 2),
                ]) ?>

                <?= $form->field($model, 'biaya_komisi')->textInput([
                    'value' => Yii::$app->formatter->asDecimal($model->biaya_komisi, 2),
                ]) ?>

                <?= $form->field($model, 'biaya_layanan')->textInput([
                    'value' => Yii::$app->formatter->asDecimal($model->biaya_layanan, 2),
                ]) ?>

                <?= $form->field($model, 'ongkir_dibayar_sistem')->textInput([
                    'value' => Yii::$app->formatter->asDecimal($model->ongkir_dibayar_sistem, 2),
                ]) ?>

                <?= $form->field($model, 'potongan_harga')->textInput([
                    'value' => Yii::$app->formatter->asDecimal($model->potongan_harga, 2),
                ]) ?>

                <?= $form->field($model, 'potongan_biaya_pengiriman')->textInput([
                    'value' => Yii::$app->formatter->asDecimal($model->potongan_biaya_pengiriman, 2),
                ]) ?>

                <?= $form->field($model, 'koin')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'koin_cashback_penjual')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'jumlah_pengembalian_dana')->textInput([
                    'value' => Yii::$app->formatter->asDecimal($model->jumlah_pengembalian_dana, 2),
                ]) ?>

                <?= $form->field($model, 'voucher_channel')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'diskon_penjual')->textInput([
                    'value' => Yii::$app->formatter->asDecimal($model->diskon_penjual, 2),
                ]) ?>

                <?= $form->field($model, 'biaya_layanan_kartu_kredit')->textInput([
                    'value' => Yii::$app->formatter->asDecimal($model->biaya_layanan_kartu_kredit, 2),
                ]) ?>

                <?= $form->field($model, 'catatan_penjual')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'status_label_pengiriman')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'status_invoice')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'status_packing_list')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'alasan_pembatalan')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'pemotongan_pajak')->textInput([
                    'value' => Yii::$app->formatter->asDecimal($model->pemotongan_pajak, 2),
                ]) ?>

                <?= $form->field($model, 'waktu_pembatalan')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'alamat_tagihan')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'biaya_pembayaran')->textInput([
                    'value' => Yii::$app->formatter->asDecimal($model->biaya_pembayaran, 2),
                ]) ?>

                <?= $form->field($model, 'biaya_lainnya')->textInput([
                    'value' => Yii::$app->formatter->asDecimal($model->biaya_lainnya, 2),
                ]) ?>

                <?= $form->field($model, 'komisi_lazpick_laztop')->textInput([
                    'value' => Yii::$app->formatter->asDecimal($model->komisi_lazpick_laztop, 2),
                ]) ?>

                <?= $form->field($model, 'biaya_promosi_gratis_ongkir')->textInput([
                    'value' => Yii::$app->formatter->asDecimal($model->biaya_promosi_gratis_ongkir, 2),
                ]) ?>

                <?= $form->field($model, 'kredit')->textInput([
                    'value' => Yii::$app->formatter->asDecimal($model->kredit, 2),
                ]) ?>

                </div>
                <?= Html::hiddenInput('referrer', $referrer) ?>
            </div>
        </div>
    </div>
</div>
<div class="row mb-5">
    <div class="container-fluid">
        <?= Html::a('<i class="ti-arrow-left"></i><span class="ml-2">Back</span>', ['index-serverside'], ['class' => 'btn btn-info mb-1']) ?>
        <?php if ($mode == Mode::READ) { ?>
            <?php // Html::a('<i class="ti-pencil-alt"></i><span class="ml-2">Edit</span>', ['update', 'id' => $model->id], ['class' => 'btn btn-warning mb-1']) ?>
        <?php } else { ?>
            <?= Html::submitButton('<i class="ti-check"></i><span class="ml-2">' . ucwords('update') .'</span>', ['class' => 'btn btn-primary mb-1']) ?>
        <?php } ?>
    </div>
</div>

<?php ActiveForm::end(); ?>