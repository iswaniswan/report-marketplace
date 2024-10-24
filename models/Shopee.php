<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shopee".
 *
 * @property int $id
 * @property int|null $id_file_source
 * @property string|null $no_pesanan
 * @property string|null $status_pesanan
 * @property string|null $alasan_pembatalan
 * @property string|null $status_pembatalan_pengembalian
 * @property string|null $no_resi
 * @property string|null $opsi_pengiriman
 * @property string|null $antar_ke_counter_pick_up
 * @property string|null $pesanan_harus_dikirimkan_sebelum_menghindari_keterlambatan
 * @property string|null $waktu_pengiriman_diatur
 * @property string|null $waktu_pesanan_dibuat
 * @property string|null $waktu_pembayaran_dilakukan
 * @property string|null $metode_pembayaran
 * @property string|null $sku_induk
 * @property string|null $nama_produk
 * @property string|null $nomor_referensi_sku
 * @property string|null $nama_variasi
 * @property string|null $harga_awal
 * @property string|null $harga_setelah_diskon
 * @property string|null $jumlah
 * @property string|null $returned_quantity
 * @property string|null $total_harga_produk
 * @property string|null $total_diskon
 * @property string|null $diskon_dari_penjual
 * @property string|null $diskon_dari_shopee
 * @property string|null $berat_produk
 * @property string|null $jumlah_produk_di_pesan
 * @property string|null $total_berat
 * @property string|null $voucher_ditanggung_penjual
 * @property string|null $cashback_koin
 * @property string|null $voucher_ditanggung_shopee
 * @property string|null $paket_diskon
 * @property string|null $paket_diskon_diskon_dari_shopee
 * @property string|null $paket_diskon_diskon_dari_penjual
 * @property string|null $potongan_koin_shopee
 * @property string|null $diskon_kartu_kredit
 * @property string|null $ongkos_kirim_dibayar_oleh_pembeli
 * @property string|null $estimasi_potongan_biaya_pengiriman
 * @property string|null $ongkos_kirim_pengembalian_barang
 * @property string|null $total_pembayaran
 * @property string|null $perkiraan_ongkos_kirim
 * @property string|null $catatan_dari_pembeli
 * @property string|null $catatan
 * @property string|null $username_pembeli
 * @property string|null $nama_penerima
 * @property string|null $no_telepon
 * @property string|null $alamat_pengiriman
 * @property string|null $kota_kabupaten
 * @property string|null $provinsi
 * @property string|null $waktu_pesanan_selesai
 */
class Shopee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shopee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_file_source'], 'integer'],
            [['status_pesanan', 'alasan_pembatalan', 'status_pembatalan_pengembalian', 'opsi_pengiriman', 'antar_ke_counter_pick_up', 'pesanan_harus_dikirimkan_sebelum_menghindari_keterlambatan', 'waktu_pengiriman_diatur', 'waktu_pesanan_dibuat', 'waktu_pembayaran_dilakukan', 'metode_pembayaran', 'sku_induk', 'nama_produk', 'nama_variasi', 'harga_awal', 'harga_setelah_diskon', 'jumlah', 'returned_quantity', 'total_harga_produk', 'total_diskon', 'diskon_dari_penjual', 'diskon_dari_shopee', 'berat_produk', 'jumlah_produk_di_pesan', 'total_berat', 'voucher_ditanggung_penjual', 'cashback_koin', 'voucher_ditanggung_shopee', 'paket_diskon', 'paket_diskon_diskon_dari_shopee', 'paket_diskon_diskon_dari_penjual', 'potongan_koin_shopee', 'diskon_kartu_kredit', 'ongkos_kirim_dibayar_oleh_pembeli', 'estimasi_potongan_biaya_pengiriman', 'ongkos_kirim_pengembalian_barang', 'total_pembayaran', 'perkiraan_ongkos_kirim', 'catatan_dari_pembeli', 'catatan', 'username_pembeli', 'nama_penerima', 'no_telepon', 'alamat_pengiriman', 'kota_kabupaten', 'provinsi', 'waktu_pesanan_selesai'], 'string'],
            [['no_pesanan', 'no_resi', 'nomor_referensi_sku'], 'string', 'max' => 255],
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
            'no_pesanan' => 'No Pesanan',
            'status_pesanan' => 'Status Pesanan',
            'alasan_pembatalan' => 'Alasan Pembatalan',
            'status_pembatalan_pengembalian' => 'Status Pembatalan Pengembalian',
            'no_resi' => 'No Resi',
            'opsi_pengiriman' => 'Opsi Pengiriman',
            'antar_ke_counter_pick_up' => 'Antar Ke Counter Pick Up',
            'pesanan_harus_dikirimkan_sebelum_menghindari_keterlambatan' => 'Pesanan Harus Dikirimkan Sebelum Menghindari Keterlambatan',
            'waktu_pengiriman_diatur' => 'Waktu Pengiriman Diatur',
            'waktu_pesanan_dibuat' => 'Waktu Pesanan Dibuat',
            'waktu_pembayaran_dilakukan' => 'Waktu Pembayaran Dilakukan',
            'metode_pembayaran' => 'Metode Pembayaran',
            'sku_induk' => 'Sku Induk',
            'nama_produk' => 'Nama Produk',
            'nomor_referensi_sku' => 'Nomor Referensi Sku',
            'nama_variasi' => 'Nama Variasi',
            'harga_awal' => 'Harga Awal',
            'harga_setelah_diskon' => 'Harga Setelah Diskon',
            'jumlah' => 'Jumlah',
            'returned_quantity' => 'Returned Quantity',
            'total_harga_produk' => 'Total Harga Produk',
            'total_diskon' => 'Total Diskon',
            'diskon_dari_penjual' => 'Diskon Dari Penjual',
            'diskon_dari_shopee' => 'Diskon Dari Shopee',
            'berat_produk' => 'Berat Produk',
            'jumlah_produk_di_pesan' => 'Jumlah Produk Di Pesan',
            'total_berat' => 'Total Berat',
            'voucher_ditanggung_penjual' => 'Voucher Ditanggung Penjual',
            'cashback_koin' => 'Cashback Koin',
            'voucher_ditanggung_shopee' => 'Voucher Ditanggung Shopee',
            'paket_diskon' => 'Paket Diskon',
            'paket_diskon_diskon_dari_shopee' => 'Paket Diskon Diskon Dari Shopee',
            'paket_diskon_diskon_dari_penjual' => 'Paket Diskon Diskon Dari Penjual',
            'potongan_koin_shopee' => 'Potongan Koin Shopee',
            'diskon_kartu_kredit' => 'Diskon Kartu Kredit',
            'ongkos_kirim_dibayar_oleh_pembeli' => 'Ongkos Kirim Dibayar Oleh Pembeli',
            'estimasi_potongan_biaya_pengiriman' => 'Estimasi Potongan Biaya Pengiriman',
            'ongkos_kirim_pengembalian_barang' => 'Ongkos Kirim Pengembalian Barang',
            'total_pembayaran' => 'Total Pembayaran',
            'perkiraan_ongkos_kirim' => 'Perkiraan Ongkos Kirim',
            'catatan_dari_pembeli' => 'Catatan Dari Pembeli',
            'catatan' => 'Catatan',
            'username_pembeli' => 'Username Pembeli',
            'nama_penerima' => 'Nama Penerima',
            'no_telepon' => 'No Telepon',
            'alamat_pengiriman' => 'Alamat Pengiriman',
            'kota_kabupaten' => 'Kota Kabupaten',
            'provinsi' => 'Provinsi',
            'waktu_pesanan_selesai' => 'Waktu Pesanan Selesai',
        ];
    }

    public static function getCountRows()
    {
        return static::find()->count();
    }

    public static function getSum($columnName, $conditions = [], $notConditions = [])
    {
        if ($columnName == null || $columnName == '') {
            return 0;
        }

        $query = static::find();

        // Apply conditions if any
        if (!empty($conditions)) {
            $query->andWhere($conditions);
        }

        // Apply NOT conditions if any
        if (!empty($notConditions)) {
            $query->andWhere(['not', $notConditions]);
        }


        return $query->sum($columnName);
    }

    public static function getListStatus()
    {
        return static::find()
            ->select('status_pesanan')
            ->groupBy('status_pesanan')
            ->column();
    }

    // public static function getListChannel()
    // {
    //     return static::find()
    //         ->select('channel')
    //         ->groupBy('channel')
    //         ->column();
    // }

    public static function getCountUnique($columnName, $parameter=[])
    {
        $query = static::find()
            ->select($columnName)
            ->distinct();

        if (!empty($parameter)) {
            $query->andWhere($parameter);
        }

        return $query->count();
    }

}
