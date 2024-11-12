<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tokopedia".
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
 * @property string|null $tipe_produk
 * @property string|null $nomor_sku
 * @property string|null $catatan_produk_pembeli
 * @property string|null $catatan_produk_penjual
 * @property int|null $jumlah_produk_dibeli
 * @property int|null $harga_awal_idr
 * @property int|null $harga_satuan_bundling_idr
 * @property int|null $diskon_produk_idr
 * @property int|null $harga_jual_idr
 * @property int|null $jumlah_subsidi_tokopedia_idr
 * @property int|null $nilai_kupon_toko_terpakai_idr
 * @property string|null $jenis_kupon_toko_terpakai
 * @property string|null $kode_kupon_toko_yang_digunakan
 * @property string|null $biaya_pengiriman_tunai_idr
 * @property string|null $biaya_asuransi_pengiriman_idr
 * @property string|null $total_biaya_pengiriman_idr
 * @property int|null $total_penjualan_idr
 * @property string|null $nama_pembeli
 * @property string|null $no_telp_pembeli
 * @property string|null $nama_penerima
 * @property string|null $no_telp_penerima
 * @property string|null $alamat_pengiriman
 * @property string|null $kota
 * @property string|null $provinsi
 * @property string|null $nama_kurir
 * @property string|null $tipe_pengiriman_regular_same_day_etc
 * @property string|null $no_resi_kode_booking
 * @property string|null $tanggal_pengiriman_barang
 * @property string|null $waktu_pengiriman_barang
 * @property string|null $gudang_pengiriman
 * @property string|null $nama_campaign
 * @property string|null $nama_bundling
 * @property string|null $tipe_bebas_ongkir_bebas_ongkir_bebas_ongkir_dt
 * @property string|null $cod
 * @property string|null $jumlah_produk_yang_dikurangkan
 * @property string|null $total_pengurangan_idr
 * @property string|null $nama_penawaran_terpakai
 * @property string|null $tingkatan_promosi_terpakai
 * @property string|null $diskon_penawaran_terpakai_idr
 */
class Tokopedia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tokopedia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_file_source', 'nomor', 'jumlah_produk_dibeli', 'harga_awal_idr', 'harga_satuan_bundling_idr', 'diskon_produk_idr', 'harga_jual_idr', 'jumlah_subsidi_tokopedia_idr', 'nilai_kupon_toko_terpakai_idr', 'total_penjualan_idr'], 'integer'],
            [['catatan_produk_pembeli', 'catatan_produk_penjual', 'no_resi_kode_booking'], 'string'],
            [['nomor_invoice', 'tanggal_pembayaran', 'status_terakhir', 'tanggal_pesanan_selesai', 'waktu_pesanan_selesai', 'tanggal_pesanan_dibatalkan', 'waktu_pesanan_dibatalkan', 'nama_produk', 'tipe_produk', 'nomor_sku', 'jenis_kupon_toko_terpakai', 'kode_kupon_toko_yang_digunakan', 'biaya_pengiriman_tunai_idr', 'biaya_asuransi_pengiriman_idr', 'total_biaya_pengiriman_idr', 'nama_pembeli', 'no_telp_pembeli', 'nama_penerima', 'no_telp_penerima', 'alamat_pengiriman', 'kota', 'provinsi', 'nama_kurir', 'tipe_pengiriman_regular_same_day_etc', 'tanggal_pengiriman_barang', 'waktu_pengiriman_barang', 'gudang_pengiriman', 'nama_campaign', 'nama_bundling', 'tipe_bebas_ongkir_bebas_ongkir_bebas_ongkir_dt', 'cod', 'jumlah_produk_yang_dikurangkan', 'total_pengurangan_idr', 'nama_penawaran_terpakai', 'tingkatan_promosi_terpakai', 'diskon_penawaran_terpakai_idr'], 'string', 'max' => 255],
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
            'tipe_produk' => 'Tipe Produk',
            'nomor_sku' => 'Nomor Sku',
            'catatan_produk_pembeli' => 'Catatan Produk Pembeli',
            'catatan_produk_penjual' => 'Catatan Produk Penjual',
            'jumlah_produk_dibeli' => 'Jumlah Produk Dibeli',
            'harga_awal_idr' => 'Harga Awal IDR',
            'harga_satuan_bundling_idr' => 'Harga Satuan Bundling IDR',
            'diskon_produk_idr' => 'Diskon Produk IDR',
            'harga_jual_idr' => 'Harga Jual IDR',
            'jumlah_subsidi_tokopedia_idr' => 'Jumlah Subsidi Tokopedia IDR',
            'nilai_kupon_toko_terpakai_idr' => 'Nilai Kupon Toko Terpakai IDR',
            'jenis_kupon_toko_terpakai' => 'Jenis Kupon Toko Terpakai',
            'kode_kupon_toko_yang_digunakan' => 'Kode Kupon Toko Yang Digunakan',
            'biaya_pengiriman_tunai_idr' => 'Biaya Pengiriman Tunai IDR',
            'biaya_asuransi_pengiriman_idr' => 'Biaya Asuransi Pengiriman IDR',
            'total_biaya_pengiriman_idr' => 'Total Biaya Pengiriman IDR',
            'total_penjualan_idr' => 'Total Penjualan IDR',
            'nama_pembeli' => 'Nama Pembeli',
            'no_telp_pembeli' => 'No Telp Pembeli',
            'nama_penerima' => 'Nama Penerima',
            'no_telp_penerima' => 'No Telp Penerima',
            'alamat_pengiriman' => 'Alamat Pengiriman',
            'kota' => 'Kota',
            'provinsi' => 'Provinsi',
            'nama_kurir' => 'Nama Kurir',
            'tipe_pengiriman_regular_same_day_etc' => 'Tipe Pengiriman Regular Same Day Etc',
            'no_resi_kode_booking' => 'No Resi Kode Booking',
            'tanggal_pengiriman_barang' => 'Tanggal Pengiriman Barang',
            'waktu_pengiriman_barang' => 'Waktu Pengiriman Barang',
            'gudang_pengiriman' => 'Gudang Pengiriman',
            'nama_campaign' => 'Nama Campaign',
            'nama_bundling' => 'Nama Bundling',
            'tipe_bebas_ongkir_bebas_ongkir_bebas_ongkir_dt' => 'Tipe Bebas Ongkir Bebas Ongkir Bebas Ongkir Dt',
            'cod' => 'Cod',
            'jumlah_produk_yang_dikurangkan' => 'Jumlah Produk Yang Dikurangkan',
            'total_pengurangan_idr' => 'Total Pengurangan IDR',
            'nama_penawaran_terpakai' => 'Nama Penawaran Terpakai',
            'tingkatan_promosi_terpakai' => 'Tingkatan Promosi Terpakai',
            'diskon_penawaran_terpakai_idr' => 'Diskon Penawaran Terpakai IDR',
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

    public static function getSummaryByDateRange($date_start, $date_end, $is_total=false)
    {
        $sql = <<<SQL
                    SELECT 
                        a.tanggal_pembayaran AS tanggal, 
                        count(DISTINCT nomor_invoice) jumlah_transaksi,
                        sum(jumlah_produk_dibeli) quantity, 
                        sum(amount_hjp) amount_hjp, 
                        sum(biaya_layanan_termasuk_ppn_dan_pph_idr) fee_marketplace,
                        (
                            sum(amount_hjp) - sum(biaya_layanan_termasuk_ppn_dan_pph_idr) 
                        ) amount_net
                    FROM (
                            SELECT 
                                STR_TO_DATE(a.tanggal_pembayaran, '%d-%m-%Y') AS tanggal_pembayaran,
                                a.nomor_invoice,
                                sum(a.jumlah_produk_dibeli) AS jumlah_produk_dibeli,			
                                sum(a.jumlah_produk_dibeli * a.harga_jual_idr) AS amount_hjp,
                                0 AS biaya_layanan_termasuk_ppn_dan_pph_idr
                            FROM tokopedia a
                            WHERE a.status_terakhir NOT LIKE '%Dibatalkan%'
                            GROUP BY 1,2	
                            UNION ALL 
                            SELECT 
                                STR_TO_DATE(a.tanggal_pembayaran, '%d-%m-%Y') AS tanggal_pembayaran,
                                a.nomor_invoice,
                                0 AS jumlah_produk_dibeli,
                                0 AS amount_hjp,
                                sum(biaya_layanan_termasuk_ppn_dan_pph_idr) biaya_layanan_termasuk_ppn_dan_pph_idr
                            FROM tokopedia_keuangan a
                            WHERE a.status_terakhir NOT LIKE '%Dibatalkan%'
                            GROUP BY 1, 2
                    ) a
                    WHERE tanggal_pembayaran BETWEEN '$date_start' AND '$date_end'
                    GROUP BY tanggal_pembayaran
        SQL;

        if ($is_total) {
            $sql = <<<SQL
                        SELECT 
                            count(DISTINCT nomor_invoice) jumlah_transaksi,
                            sum(jumlah_produk_dibeli) quantity, 
                            sum(amount_hjp) amount_hjp, 
                            sum(biaya_layanan_termasuk_ppn_dan_pph_idr) fee_marketplace,
                            (
                                sum(amount_hjp) - sum(biaya_layanan_termasuk_ppn_dan_pph_idr) 
                            ) amount_net
                        FROM (
                                SELECT 
                                    STR_TO_DATE(a.tanggal_pembayaran, '%d-%m-%Y') AS tanggal_pembayaran,
                                    a.nomor_invoice,
                                    sum(a.jumlah_produk_dibeli) AS jumlah_produk_dibeli,			
                                    sum(a.jumlah_produk_dibeli * a.harga_jual_idr) AS amount_hjp,
                                    0 AS biaya_layanan_termasuk_ppn_dan_pph_idr
                                FROM tokopedia a
                                WHERE a.status_terakhir NOT LIKE '%Dibatalkan%'
                                GROUP BY 1,2	
                                UNION ALL 
                                SELECT 
                                    STR_TO_DATE(a.tanggal_pembayaran, '%d-%m-%Y') AS tanggal_pembayaran,
                                    a.nomor_invoice,
                                    0 AS jumlah_produk_dibeli,
                                    0 AS amount_hjp,
                                    sum(biaya_layanan_termasuk_ppn_dan_pph_idr) biaya_layanan_termasuk_ppn_dan_pph_idr
                                FROM tokopedia_keuangan a
                                WHERE a.status_terakhir NOT LIKE '%Dibatalkan%'
                                GROUP BY 1, 2
                        ) a
                        WHERE tanggal_pembayaran BETWEEN '$date_start' AND '$date_end'
            SQL;
        }
    
        return Yii::$app->db->createCommand($sql)
            ->queryAll(\PDO::FETCH_OBJ);
    }   

}
