<?php

use app\components\Mode;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\Offline */
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
    ],
    'enableClientScript' => false
]); ?>

<div class="row">
    <div class="container-fluid">
        <div class="member-form card-box">
            <div class="card-body row">
                <div class="col-12" style="border-bottom: 1px solid #ccc; margin-bottom: 2rem;">
                    <h4 class="card-title mb-3">Tambah Penjualan Offline</h4>
                </div>

                <div class="container-fluid">
                    <?= $form->errorSummary($model) ?>

                    <?= $form->field($model, 'no_invoice')->textInput(['maxlength' => true]) ?>
    
                    <?= $form->field($model, 'tanggal_invoice')->textInput([
                        'type' => 'date',
                        'onclick' => 'this.showPicker()'
                    ]) ?>

                    <?= $form->field($model, 'nama_customer')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'alamat_customer')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'no_hp_customer')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'kode_sku')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'nama_barang')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'quantity')->textInput(['type' => 'number']) ?>

                    <?php // $form->field($model, 'harga_satuan')->textInput() ?>

                    <div class="mb-3 row field-offline-harga_satuan" style="padding:unset">
                        <label class="col-2" for="offline-harga_satuan">Harga Satuan</label>
                        <div class="col">
                            <div class="input-group mb-3 mr-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">IDR</span>
                                </div>
                                <input type="number" id="offline-harga_satuan" class="form-control" name="Offline[harga_satuan]" value="<?= @$model->harga_satuan ?>">
                            </div>
                            <div class="invalid-feedback "></div>
                        </div>
                    </div>                    

                    <?php // $form->field($model, 'subtotal')->textInput() ?>
                    <div class="mb-3 row field-offline-subtotal" style="padding:unset">
                        <label class="col-2" for="offline-subtotal">Subtotal</label>
                        <div class="col">
                            <div class="input-group mb-3 mr-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">IDR</span>
                                </div>
                                <input type="number" id="offline-subtotal" class="form-control" name="Offline[subtotal]" value="<?= @$model->subtotal ?>" readonly>
                            </div>
                            <div class="invalid-feedback "></div>
                        </div>
                    </div>

                    <?php // $form->field($model, 'subtotal')->textInput() ?>
                    <div class="mb-3 row field-offline-terbilang" style="padding:unset">
                        <label class="col-2" for="offline-terbilang">Terbilang</label>
                        <div class="col">
                            <textarea name="terbilang" id="terbilang" rows="2" class="form-control" readonly></textarea>
                            <div class="invalid-feedback "></div>
                        </div>
                    </div>

                    <?= $form->field($model, 'tanggal_bayar')->textInput([
                        'type' => 'date',
                        'onclick' => 'this.showPicker()'
                    ]) ?>

                    <?php // $form->field($model, 'adjustment')->textInput() ?>

                </div>
                <?= Html::hiddenInput('referrer', $referrer) ?>
            </div>
        </div>
    </div>
</div>
<div class="row mb-5">
    <div class="container-fluid">
        <?= Html::a('<i class="ti-arrow-left"></i><span class="ml-2">Back</span>', ['index'], ['class' => 'btn btn-info mb-1']) ?>
        <?php if ($mode == Mode::READ) { ?>
            <?= Html::a('<i class="ti-pencil-alt"></i><span class="ml-2">Edit</span>', ['update', 'id' => $model->id], ['class' => 'btn btn-warning mb-1']) ?>
        <?php } else { ?>
            <?= Html::submitButton('<i class="ti-check"></i><span class="ml-2">' . ucwords('submit') .'</span>', ['class' => 'btn btn-primary mb-1']) ?>
        <?php } ?>
    </div>
</div>

<?php ActiveForm::end(); ?>


<?php 

$script = <<<JS

    String.prototype.properCase = function() {
        return this.toLowerCase().replace(/\b\w/g, (char) => char.toUpperCase());
    };

    function terbilang(nilai) {
        // deklarasi variabel nilai sebagai angka matemarika
        // Objek Math bertujuan agar kita bisa melakukan tugas matemarika dengan javascript
        nilai = Math.floor(Math.abs(nilai));
        
        // deklarasi nama angka dalam bahasa indonesia
        var huruf = [
            '',
            'Satu',
            'Dua',
            'Tiga',
            'Empat',
            'Lima',
            'Enam',
            'Tujuh',
            'Delapan',
            'Sembilan',
            'Sepuluh',
            'Sebelas',
        ];
        
        // menyimpan nilai default untuk pembagian
        var bagi = 0;
        // deklarasi variabel penyimpanan untuk menyimpan proses rumus terbilang
        var penyimpanan = '';
        
        // rumus terbilang
        if (nilai < 12) {
            penyimpanan = ' ' + huruf[nilai];
        } else if (nilai < 20) {
            penyimpanan = terbilang(Math.floor(nilai - 10)) + ' Belas';
        } else if (nilai < 100) {
            bagi = Math.floor(nilai / 10);
            penyimpanan = terbilang(bagi) + ' Puluh' + terbilang(nilai % 10);
        } else if (nilai < 200) {
            penyimpanan = ' Seratus' + terbilang(nilai - 100);
        } else if (nilai < 1000) {
            bagi = Math.floor(nilai / 100);
            penyimpanan = terbilang(bagi) + ' Ratus' + terbilang(nilai % 100);
        } else if (nilai < 2000) {
            penyimpanan = ' Seribu' + terbilang(nilai - 1000);
        } else if (nilai < 1000000) {
            bagi = Math.floor(nilai / 1000);
            penyimpanan = terbilang(bagi) + ' Ribu' + terbilang(nilai % 1000);
        } else if (nilai < 1000000000) {
            bagi = Math.floor(nilai / 1000000);
            penyimpanan = terbilang(bagi) + ' Juta' + terbilang(nilai % 1000000);
        } else if (nilai < 1000000000000) {
            bagi = Math.floor(nilai / 1000000000);
            penyimpanan = terbilang(bagi) + ' Miliar' + terbilang(nilai % 1000000000);
        } else if (nilai < 1000000000000000) {
            bagi = Math.floor(nilai / 1000000000000);
            penyimpanan = terbilang(nilai / 1000000000000) + ' Triliun' + terbilang(nilai % 1000000000000);
        }
        
        // mengambalikan nilai yang ada dalam variabel penyimpanan
        return penyimpanan;
        }

    function hitungSubtotal(elem1, elem2) {
        let v1 = $(elem1).val();
        if (isNaN(v1)) {
            v1 = 0;
        }

        let v2 = $(elem2).val();
        if (isNaN(v2)) {
            v2 = 0;
        }

        return v1 * v2;
    }

    $(document).ready(function() {
        $('#offline-quantity, #offline-harga_satuan').on('input', function() {
            const subTotal = hitungSubtotal('#offline-quantity', '#offline-harga_satuan');
            $("#offline-subtotal").val(subTotal);
            const _terbilang = terbilang(subTotal);
            $('#terbilang').val(_terbilang + "Rupiah");
        })
    })

JS;

$this->registerJs($script, View::POS_READY);

?>