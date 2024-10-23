<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ginee".
 *
 * @property int $id
 * @property string|null $no
 * @property string|null $biaya_kartu_kredit
 * @property string|null $waktu_pembaruan
 * @property string|null $sinkronisasi_terakhir
 * @property string|null $adalah_pesanan_palsu
 * @property string|null $tanggal_pembuatan
 * @property string|null $id_pesanan
 * @property string|null $status
 * @property string|null $jenis_pesanan
 * @property string|null $channel
 * @property string|null $nama_toko
 * @property string|null $pembayaran
 * @property string|null $waktu_pembayaran
 * @property string|null $nama_pembeli
 * @property string|null $waktu_pengiriman
 * @property string|null $waktu_penyelesaian
 * @property string|null $telepon_pembeli
 * @property string|null $email_pembeli
 * @property string|null $catatan_pembeli
 * @property string|null $nama_produk
 * @property string|null $variant_produk
 * @property string|null $sku
 * @property string|null $nama_gudang
 * @property string|null $status_produk
 * @property string|null $harga_awal_produk
 * @property string|null $harga_promosi
 * @property string|null $jumlah
 * @property string|null $adalah_hadiah
 * @property string|null $total_berat_g
 * @property string|null $harga_total_promosi
 * @property string|null $subtotal
 * @property string|null $invoice
 * @property string|null $msku
 * @property string|null $nama_penerima
 * @property string|null $no_telepon_penerima
 * @property string|null $alamat_penerima
 * @property string|null $kurir
 * @property string|null $provinsi
 * @property string|null $kota
 * @property string|null $kecamatan
 * @property string|null $kode_pos
 * @property string|null $awb_no_tracking
 * @property string|null $dropshipper
 * @property string|null $no_telepon_dropshipper
 * @property string|null $kirim_sebelum
 * @property string|null $mata_uang
 * @property string|null $total
 * @property string|null $biaya_pengiriman
 * @property string|null $biaya_kirim_ditanggung_pembeli
 * @property string|null $pajak
 * @property string|null $asuransi
 * @property string|null $total_diskon
 * @property string|null $subsidi_marketplace
 * @property string|null $biaya_komisi
 * @property string|null $biaya_layanan
 * @property string|null $ongkir_dibayar_sistem
 * @property string|null $potongan_harga
 * @property string|null $potongan_biaya_pengiriman
 * @property string|null $koin
 * @property string|null $koin_cashback_penjual
 * @property string|null $jumlah_pengembalian_dana
 * @property string|null $voucher_channel
 * @property string|null $diskon_penjual
 * @property string|null $biaya_layanan_kartu_kredit
 * @property string|null $catatan_penjual
 * @property string|null $status_label_pengiriman
 * @property string|null $status_invoice
 * @property string|null $status_packing_list
 * @property string|null $alasan_pembatalan
 * @property string|null $pemotongan_pajak
 * @property string|null $waktu_pembatalan
 * @property string|null $alamat_tagihan
 * @property string|null $biaya_pembayaran
 * @property string|null $biaya_lainnya
 * @property string|null $komisi_lazpick_laztop
 * @property string|null $biaya_promosi_gratis_ongkir
 * @property string|null $kredit
 */
class Ginee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ginee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no', 'biaya_kartu_kredit', 'waktu_pembaruan', 'sinkronisasi_terakhir', 'adalah_pesanan_palsu', 'tanggal_pembuatan', 'id_pesanan', 'status', 'jenis_pesanan', 'channel', 'nama_toko', 'pembayaran', 'waktu_pembayaran', 'nama_pembeli', 'waktu_pengiriman', 'waktu_penyelesaian', 'telepon_pembeli', 'email_pembeli', 'catatan_pembeli', 'nama_produk', 'variant_produk', 'sku', 'nama_gudang', 'status_produk', 'harga_awal_produk', 'harga_promosi', 'jumlah', 'adalah_hadiah', 'total_berat_g', 'harga_total_promosi', 'subtotal', 'invoice', 'msku', 'nama_penerima', 'no_telepon_penerima', 'alamat_penerima', 'kurir', 'provinsi', 'kota', 'kecamatan', 'kode_pos', 'awb_no_tracking', 'dropshipper', 'no_telepon_dropshipper', 'kirim_sebelum', 'mata_uang', 'total', 'biaya_pengiriman', 'biaya_kirim_ditanggung_pembeli', 'pajak', 'asuransi', 'total_diskon', 'subsidi_marketplace', 'biaya_komisi', 'biaya_layanan', 'ongkir_dibayar_sistem', 'potongan_harga', 'potongan_biaya_pengiriman', 'koin', 'koin_cashback_penjual', 'jumlah_pengembalian_dana', 'voucher_channel', 'diskon_penjual', 'biaya_layanan_kartu_kredit', 'catatan_penjual', 'status_label_pengiriman', 'status_invoice', 'status_packing_list', 'alasan_pembatalan', 'pemotongan_pajak', 'waktu_pembatalan', 'alamat_tagihan', 'biaya_pembayaran', 'biaya_lainnya', 'komisi_lazpick_laztop', 'biaya_promosi_gratis_ongkir', 'kredit'], 'string'],
            [['id_pesanan', 'sku'], 'unique', 'targetAttribute' => ['id_pesanan', 'sku']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no' => 'No',
            'biaya_kartu_kredit' => 'Biaya Kartu Kredit',
            'waktu_pembaruan' => 'Waktu Pembaruan',
            'sinkronisasi_terakhir' => 'Sinkronisasi Terakhir',
            'adalah_pesanan_palsu' => 'Adalah Pesanan Palsu',
            'tanggal_pembuatan' => 'Tanggal Pembuatan',
            'id_pesanan' => 'Id Pesanan',
            'status' => 'Status',
            'jenis_pesanan' => 'Jenis Pesanan',
            'channel' => 'Channel',
            'nama_toko' => 'Nama Toko',
            'pembayaran' => 'Pembayaran',
            'waktu_pembayaran' => 'Waktu Pembayaran',
            'nama_pembeli' => 'Nama Pembeli',
            'waktu_pengiriman' => 'Waktu Pengiriman',
            'waktu_penyelesaian' => 'Waktu Penyelesaian',
            'telepon_pembeli' => 'Telepon Pembeli',
            'email_pembeli' => 'Email Pembeli',
            'catatan_pembeli' => 'Catatan Pembeli',
            'nama_produk' => 'Nama Produk',
            'variant_produk' => 'Variant Produk',
            'sku' => 'Sku',
            'nama_gudang' => 'Nama Gudang',
            'status_produk' => 'Status Produk',
            'harga_awal_produk' => 'Harga Awal Produk',
            'harga_promosi' => 'Harga Promosi',
            'jumlah' => 'Jumlah',
            'adalah_hadiah' => 'Adalah Hadiah',
            'total_berat_g' => 'Total Berat G',
            'harga_total_promosi' => 'Harga Total Promosi',
            'subtotal' => 'Subtotal',
            'invoice' => 'Invoice',
            'msku' => 'Msku',
            'nama_penerima' => 'Nama Penerima',
            'no_telepon_penerima' => 'No Telepon Penerima',
            'alamat_penerima' => 'Alamat Penerima',
            'kurir' => 'Kurir',
            'provinsi' => 'Provinsi',
            'kota' => 'Kota',
            'kecamatan' => 'Kecamatan',
            'kode_pos' => 'Kode Pos',
            'awb_no_tracking' => 'Awb No Tracking',
            'dropshipper' => 'Dropshipper',
            'no_telepon_dropshipper' => 'No Telepon Dropshipper',
            'kirim_sebelum' => 'Kirim Sebelum',
            'mata_uang' => 'Mata Uang',
            'total' => 'Total',
            'biaya_pengiriman' => 'Biaya Pengiriman',
            'biaya_kirim_ditanggung_pembeli' => 'Biaya Kirim Ditanggung Pembeli',
            'pajak' => 'Pajak',
            'asuransi' => 'Asuransi',
            'total_diskon' => 'Total Diskon',
            'subsidi_marketplace' => 'Subsidi Marketplace',
            'biaya_komisi' => 'Biaya Komisi',
            'biaya_layanan' => 'Biaya Layanan',
            'ongkir_dibayar_sistem' => 'Ongkir Dibayar Sistem',
            'potongan_harga' => 'Potongan Harga',
            'potongan_biaya_pengiriman' => 'Potongan Biaya Pengiriman',
            'koin' => 'Koin',
            'koin_cashback_penjual' => 'Koin Cashback Penjual',
            'jumlah_pengembalian_dana' => 'Jumlah Pengembalian Dana',
            'voucher_channel' => 'Voucher Channel',
            'diskon_penjual' => 'Diskon Penjual',
            'biaya_layanan_kartu_kredit' => 'Biaya Layanan Kartu Kredit',
            'catatan_penjual' => 'Catatan Penjual',
            'status_label_pengiriman' => 'Status Label Pengiriman',
            'status_invoice' => 'Status Invoice',
            'status_packing_list' => 'Status Packing List',
            'alasan_pembatalan' => 'Alasan Pembatalan',
            'pemotongan_pajak' => 'Pemotongan Pajak',
            'waktu_pembatalan' => 'Waktu Pembatalan',
            'alamat_tagihan' => 'Alamat Tagihan',
            'biaya_pembayaran' => 'Biaya Pembayaran',
            'biaya_lainnya' => 'Biaya Lainnya',
            'komisi_lazpick_laztop' => 'Komisi Lazpick Laztop',
            'biaya_promosi_gratis_ongkir' => 'Biaya Promosi Gratis Ongkir',
            'kredit' => 'Kredit',
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
            ->select('status')
            ->groupBy('status')
            ->column();
    }

    public static function getListChannel()
    {
        return static::find()
            ->select('channel')
            ->groupBy('channel')
            ->column();
    }

}
