<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "offline".
 *
 * @property int $id
 * @property string|null $no_invoice
 * @property string|null $tanggal_invoice
 * @property string|null $nama_customer
 * @property string|null $alamat_customer
 * @property string|null $no_hp_customer
 * @property string|null $kode_sku
 * @property string|null $nama_barang
 * @property string|null $tanggal_bayar
 * @property int|null $quantity
 * @property int|null $harga_satuan
 * @property int|null $subtotal
 * @property int|null $adjustment
 */
class Offline extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offline';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quantity', 'harga_satuan', 'subtotal', 'adjustment'], 'integer'],
            [['no_invoice', 'tanggal_invoice', 'nama_customer', 'alamat_customer', 'no_hp_customer', 'kode_sku', 'nama_barang', 'tanggal_bayar'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_invoice' => 'No Invoice',
            'tanggal_invoice' => 'Tanggal Invoice',
            'nama_customer' => 'Nama Customer',
            'alamat_customer' => 'Alamat Customer',
            'no_hp_customer' => 'No Hp Customer',
            'kode_sku' => 'Kode Sku',
            'nama_barang' => 'Nama Barang',
            'tanggal_bayar' => 'Tanggal Bayar',
            'quantity' => 'Quantity',
            'harga_satuan' => 'Harga Satuan',
            'subtotal' => 'Subtotal',
            'adjustment' => 'Adjustment',
        ];
    }
}