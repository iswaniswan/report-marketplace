<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tokopedia_keuangan".
 *
 * @property int $id
 * @property int|null $id_file_source
 * @property int|null $nomor
 * @property string|null $nomor_invoice
 * @property string|null $tanggal_pembayaran
 * @property string|null $status_terakhir
 * @property string|null $tanggal_pesanan_selesai
 * @property string|null $waktu_pesanan_selesai
 * @property string|null $tanggal_pesanan_dibatalkan
 * @property string|null $waktu_pesanan_dibatalkan
 * @property string|null $nama_produk
 * @property int|null $jumlah_produk_dibeli
 * @property int|null $harga_jual_idr
 * @property int|null $jumlah_subsidi_tokopedia_idr
 * @property int|null $nilai_kupon_toko_terpakai_idr
 * @property string|null $jenis_kupon_toko_terpakai
 * @property string|null $kode_kupon_toko_yang_digunakan
 * @property int|null $jumlah_produk_yang_dikurangkan
 * @property int|null $total_pengurangan_idr
 * @property string|null $nama_biaya_layanan
 * @property string|null $persentase_biaya_layanan
 * @property int|null $biaya_layanan_termasuk_ppn_dan_pph_idr
 * @property int|null $biaya_layanan_di_luar_ppn_dan_pph_idr
 * @property int|null $ppn_idr
 * @property int|null $pph_idr
 */
class TokopediaKeuangan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tokopedia_keuangan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_file_source', 'nomor', 'jumlah_produk_dibeli', 'harga_jual_idr', 'jumlah_subsidi_tokopedia_idr', 'nilai_kupon_toko_terpakai_idr', 'jumlah_produk_yang_dikurangkan', 'total_pengurangan_idr', 'biaya_layanan_termasuk_ppn_dan_pph_idr', 'biaya_layanan_di_luar_ppn_dan_pph_idr', 'ppn_idr', 'pph_idr'], 'integer'],
            [['nomor_invoice', 'tanggal_pembayaran', 'status_terakhir', 'tanggal_pesanan_selesai', 'waktu_pesanan_selesai', 'tanggal_pesanan_dibatalkan', 'waktu_pesanan_dibatalkan', 'nama_produk', 'jenis_kupon_toko_terpakai', 'kode_kupon_toko_yang_digunakan', 'nama_biaya_layanan', 'persentase_biaya_layanan'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_file_source' => 'Id File Source',
            'nomor' => 'Nomor',
            'nomor_invoice' => 'Nomor Invoice',
            'tanggal_pembayaran' => 'Tanggal Pembayaran',
            'status_terakhir' => 'Status Terakhir',
            'tanggal_pesanan_selesai' => 'Tanggal Pesanan Selesai',
            'waktu_pesanan_selesai' => 'Waktu Pesanan Selesai',
            'tanggal_pesanan_dibatalkan' => 'Tanggal Pesanan Dibatalkan',
            'waktu_pesanan_dibatalkan' => 'Waktu Pesanan Dibatalkan',
            'nama_produk' => 'Nama Produk',
            'jumlah_produk_dibeli' => 'Jumlah Produk Dibeli',
            'harga_jual_idr' => 'Harga Jual Idr',
            'jumlah_subsidi_tokopedia_idr' => 'Jumlah Subsidi Tokopedia Idr',
            'nilai_kupon_toko_terpakai_idr' => 'Nilai Kupon Toko Terpakai Idr',
            'jenis_kupon_toko_terpakai' => 'Jenis Kupon Toko Terpakai',
            'kode_kupon_toko_yang_digunakan' => 'Kode Kupon Toko Yang Digunakan',
            'jumlah_produk_yang_dikurangkan' => 'Jumlah Produk Yang Dikurangkan',
            'total_pengurangan_idr' => 'Total Pengurangan Idr',
            'nama_biaya_layanan' => 'Nama Biaya Layanan',
            'persentase_biaya_layanan' => 'Persentase Biaya Layanan',
            'biaya_layanan_termasuk_ppn_dan_pph_idr' => 'Biaya Layanan Termasuk Ppn Dan Pph Idr',
            'biaya_layanan_di_luar_ppn_dan_pph_idr' => 'Biaya Layanan Di Luar Ppn Dan Pph Idr',
            'ppn_idr' => 'Ppn Idr',
            'pph_idr' => 'Pph Idr',
        ];
    }

    public static function getListStatus()
    {
        $statuses = static::find()
            ->select('status_terakhir')
            ->groupBy('status_terakhir')
            ->column();

        $normalizedStatuses = [];
        foreach ($statuses as $status) {
            $normalizedStatuses[] = str_replace(["\r\n", "\n", "\r"], '%', $status);
        }

        return $normalizedStatuses;
    }
    
}
