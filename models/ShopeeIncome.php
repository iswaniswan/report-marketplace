<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shopee_income".
 *
 * @property int $id
 * @property int|null $id_file_source
 * @property int|null $no
 * @property string|null $no_pesanan
 * @property string|null $no_pengajuan
 * @property string|null $username_pembeli
 * @property string|null $waktu_pesanan_dibuat
 * @property string|null $metode_pembayaran_pembeli
 * @property string|null $tanggal_dana_dilepaskan
 * @property int|null $harga_asli_produk
 * @property int|null $total_diskon_produk
 * @property int|null $jumlah_pengembalian_dana_ke_pembeli
 * @property int|null $diskon_produk_dari_shopee
 * @property int|null $diskon_voucher_ditanggung_penjual
 * @property int|null $cashback_koin_yang_ditanggung_penjual
 * @property int|null $ongkir_dibayar_pembeli
 * @property int|null $diskon_ongkir_ditanggung_jasa_kirim
 * @property int|null $gratis_ongkir_dari_shopee
 * @property int|null $ongkir_yang_diteruskan_oleh_shopee_ke_jasa_kirim
 * @property int|null $ongkos_kirim_pengembalian_barang
 * @property int|null $pengembalian_biaya_kirim
 * @property int|null $biaya_komisi_ams
 * @property int|null $biaya_administrasi_termasuk_ppn_11
 * @property int|null $biaya_layanan_termasuk_ppn_11
 * @property int|null $premi
 * @property int|null $biaya_program
 * @property int|null $biaya_kartu_kredit
 * @property int|null $biaya_kampanye
 * @property int|null $bea_masuk_ppn_pph
 * @property int|null $total_penghasilan
 * @property string|null $kode_voucher
 * @property int|null $kompensasi
 * @property int|null $promo_gratis_ongkir_dari_penjual
 * @property string|null $jasa_kirim
 * @property string|null $nama_kurir
 * @property string|null $#
 * @property int|null $pengembalian_dana_ke_pembeli
 * @property int|null $pro_rata_koin_yang_ditukarkan_untuk_pengembalian_barang
 * @property int|null $pro_rata_voucher_shopee_untuk_pengembalian_barang
 * @property int|null $pro_rated_bank_payment_channel_promotion_for_return_refund_items
 * @property string|null $pro_rated_shopee_payment_channel_promotion_for_return_refund_ite
 */
class ShopeeIncome extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shopee_income';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_file_source', 'no', 'harga_asli_produk', 'total_diskon_produk', 'jumlah_pengembalian_dana_ke_pembeli', 'diskon_produk_dari_shopee', 'diskon_voucher_ditanggung_penjual', 'cashback_koin_yang_ditanggung_penjual', 'ongkir_dibayar_pembeli', 'diskon_ongkir_ditanggung_jasa_kirim', 'gratis_ongkir_dari_shopee', 'ongkir_yang_diteruskan_oleh_shopee_ke_jasa_kirim', 'ongkos_kirim_pengembalian_barang', 'pengembalian_biaya_kirim', 'biaya_komisi_ams', 'biaya_administrasi_termasuk_ppn_11', 'biaya_layanan_termasuk_ppn_11', 'premi', 'biaya_program', 'biaya_kartu_kredit', 'biaya_kampanye', 'bea_masuk_ppn_pph', 'total_penghasilan', 'kompensasi', 'promo_gratis_ongkir_dari_penjual', 'pengembalian_dana_ke_pembeli', 'pro_rata_koin_yang_ditukarkan_untuk_pengembalian_barang', 'pro_rata_voucher_shopee_untuk_pengembalian_barang', 'pro_rated_bank_payment_channel_promotion_for_return_refund_items'], 'integer'],
            [['#', 'pro_rated_shopee_payment_channel_promotion_for_return_refund_ite'], 'string'],
            [['no_pesanan', 'no_pengajuan', 'username_pembeli', 'waktu_pesanan_dibuat', 'metode_pembayaran_pembeli', 'tanggal_dana_dilepaskan', 'kode_voucher', 'jasa_kirim', 'nama_kurir'], 'string', 'max' => 255],
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
            'no' => 'No',
            'no_pesanan' => 'No Pesanan',
            'no_pengajuan' => 'No Pengajuan',
            'username_pembeli' => 'Username Pembeli',
            'waktu_pesanan_dibuat' => 'Waktu Pesanan Dibuat',
            'metode_pembayaran_pembeli' => 'Metode Pembayaran Pembeli',
            'tanggal_dana_dilepaskan' => 'Tanggal Dana Dilepaskan',
            'harga_asli_produk' => 'Harga Asli Produk',
            'total_diskon_produk' => 'Total Diskon Produk',
            'jumlah_pengembalian_dana_ke_pembeli' => 'Jumlah Pengembalian Dana Ke Pembeli',
            'diskon_produk_dari_shopee' => 'Diskon Produk Dari Shopee',
            'diskon_voucher_ditanggung_penjual' => 'Diskon Voucher Ditanggung Penjual',
            'cashback_koin_yang_ditanggung_penjual' => 'Cashback Koin Yang Ditanggung Penjual',
            'ongkir_dibayar_pembeli' => 'Ongkir Dibayar Pembeli',
            'diskon_ongkir_ditanggung_jasa_kirim' => 'Diskon Ongkir Ditanggung Jasa Kirim',
            'gratis_ongkir_dari_shopee' => 'Gratis Ongkir Dari Shopee',
            'ongkir_yang_diteruskan_oleh_shopee_ke_jasa_kirim' => 'Ongkir Yang Diteruskan Oleh Shopee Ke Jasa Kirim',
            'ongkos_kirim_pengembalian_barang' => 'Ongkos Kirim Pengembalian Barang',
            'pengembalian_biaya_kirim' => 'Pengembalian Biaya Kirim',
            'biaya_komisi_ams' => 'Biaya Komisi Ams',
            'biaya_administrasi_termasuk_ppn_11' => 'Biaya Administrasi Termasuk Ppn 11',
            'biaya_layanan_termasuk_ppn_11' => 'Biaya Layanan Termasuk Ppn 11',
            'premi' => 'Premi',
            'biaya_program' => 'Biaya Program',
            'biaya_kartu_kredit' => 'Biaya Kartu Kredit',
            'biaya_kampanye' => 'Biaya Kampanye',
            'bea_masuk_ppn_pph' => 'Bea Masuk Ppn Pph',
            'total_penghasilan' => 'Total Penghasilan',
            'kode_voucher' => 'Kode Voucher',
            'kompensasi' => 'Kompensasi',
            'promo_gratis_ongkir_dari_penjual' => 'Promo Gratis Ongkir Dari Penjual',
            'jasa_kirim' => 'Jasa Kirim',
            'nama_kurir' => 'Nama Kurir',
            '#' => '#',
            'pengembalian_dana_ke_pembeli' => 'Pengembalian Dana Ke Pembeli',
            'pro_rata_koin_yang_ditukarkan_untuk_pengembalian_barang' => 'Pro Rata Koin Yang Ditukarkan Untuk Pengembalian Barang',
            'pro_rata_voucher_shopee_untuk_pengembalian_barang' => 'Pro Rata Voucher Shopee Untuk Pengembalian Barang',
            'pro_rated_bank_payment_channel_promotion_for_return_refund_items' => 'Pro Rated Bank Payment Channel Promotion For Return Refund Items',
            'pro_rated_shopee_payment_channel_promotion_for_return_refund_ite' => 'Pro Rated Shopee Payment Channel Promotion For Return Refund Ite',
        ];
    }

    public static function getSummaryByDateRange($date_start, $date_end, $is_total=false)
    {
        $sql = <<<SQL
                WITH CTE AS (
                            SELECT 
                                waktu_pesanan_dibuat, 
                                count(distinct no_pesanan) jumlah_transaksi, 
                                sum(jumlah) AS jumlah, 
                                0 AS amount_hjp, 
                                0 AS amount_net
                            FROM (
                                    SELECT no_pesanan, STR_TO_DATE(waktu_pesanan_dibuat, '%Y-%m-%d') waktu_pesanan_dibuat, jumlah
                                    FROM shopee 
                                    WHERE status_pesanan NOT LIKE '%Batal%'
                                    AND STR_TO_DATE(waktu_pesanan_dibuat, '%Y-%m-%d') BETWEEN '$date_start' AND '$date_end'
                                    GROUP BY 1
                                    ORDER BY jumlah DESC 
                                ) a
                            GROUP BY 1
                            UNION ALL 
                            SELECT 
                                waktu_pesanan_dibuat, 
                                0 AS jumlah_transaksi,
                                0 AS jumlah,
                                sum(total_harga_produk) AS amount_hjp, 
                                0 AS amount_net
                            FROM (
                                    SELECT no_pesanan, STR_TO_DATE(waktu_pesanan_dibuat, '%Y-%m-%d') waktu_pesanan_dibuat, REPLACE(total_harga_produk, '.', '') total_harga_produk
                                    FROM shopee 
                                    WHERE status_pesanan NOT LIKE '%Batal%'
                                        AND STR_TO_DATE(waktu_pesanan_dibuat, '%Y-%m-%d') BETWEEN '$date_start' AND '$date_end'
                            ) b
                            GROUP BY 1
                            UNION ALL 
                            SELECT 
                                waktu_pesanan_dibuat,
                                0 AS jumlah_transaksi,
                                0 AS jumlah, 
                                0 AS amount_hjp, 
                                sum(total_penghasilan) AS amount_net
                            FROM shopee_income
                            WHERE STR_TO_DATE(waktu_pesanan_dibuat, '%Y-%m-%d') BETWEEN '$date_start' AND '$date_end'
                            GROUP BY 1
                )
                SELECT 
                    waktu_pesanan_dibuat, 
                    sum(jumlah_transaksi) jumlah_transaksi,
                    sum(jumlah) jumlah, 
                    sum(amount_hjp) amount_hjp, 
                    sum(amount_net) amount_net,
                    (sum(amount_hjp) - sum(amount_net)) AS fee_marketplace
                FROM CTE a
                GROUP BY 1
        SQL;

        if ($is_total) {
            $sql = <<<SQL
                        WITH CTE AS (
                                    SELECT 
                                        waktu_pesanan_dibuat, 
                                        count(distinct no_pesanan) jumlah_transaksi, 
                                        sum(jumlah) AS jumlah, 
                                        0 AS amount_hjp, 
                                        0 AS amount_net
                                    FROM (
                                            SELECT no_pesanan, STR_TO_DATE(waktu_pesanan_dibuat, '%Y-%m-%d') waktu_pesanan_dibuat, jumlah
                                            FROM shopee 
                                            WHERE status_pesanan NOT LIKE '%Batal%'
                                            AND STR_TO_DATE(waktu_pesanan_dibuat, '%Y-%m-%d') BETWEEN '$date_start' AND '$date_end'
                                            GROUP BY 1
                                            ORDER BY jumlah DESC 
                                        ) a
                                    GROUP BY 1
                                    UNION ALL 
                                    SELECT 
                                        waktu_pesanan_dibuat, 
                                        0 AS jumlah_transaksi,
                                        0 AS jumlah,
                                        sum(total_harga_produk) AS amount_hjp, 
                                        0 AS amount_net
                                    FROM (
                                            SELECT no_pesanan, STR_TO_DATE(waktu_pesanan_dibuat, '%Y-%m-%d') waktu_pesanan_dibuat, REPLACE(total_harga_produk, '.', '') total_harga_produk
                                            FROM shopee 
                                            WHERE status_pesanan NOT LIKE '%Batal%'
                                                AND STR_TO_DATE(waktu_pesanan_dibuat, '%Y-%m-%d') BETWEEN '$date_start' AND '$date_end'
                                    ) b
                                    GROUP BY 1
                                    UNION ALL 
                                    SELECT 
                                        waktu_pesanan_dibuat,
                                        0 AS jumlah_transaksi,
                                        0 AS jumlah, 
                                        0 AS amount_hjp, 
                                        sum(total_penghasilan) AS amount_net
                                    FROM shopee_income
                                    WHERE STR_TO_DATE(waktu_pesanan_dibuat, '%Y-%m-%d') BETWEEN '$date_start' AND '$date_end'
                                    GROUP BY 1
                        )
                        SELECT 
                            sum(jumlah_transaksi) jumlah_transaksi,
                            sum(jumlah) jumlah, 
                            sum(amount_hjp) amount_hjp, 
                            sum(amount_net) amount_net,
                            (sum(amount_hjp) - sum(amount_net)) AS fee_marketplace
                        FROM CTE a
                SQL;
        }
    
        $command = Yii::$app->db->createCommand($sql);
        return $command->queryAll();
    }

    public static function getExportAll($date_start, $date_end, $status)
    {
        $query = static::find();
        $query->andFilterWhere(['between', 
                new \yii\db\Expression("STR_TO_DATE(waktu_pesanan_dibuat, '%Y-%m-%d')"), 
                $date_start, 
                $date_end
            ]);

        $statuses = json_decode($status, true); // Decode JSON and set `true` for associative array
        if (is_array($statuses)) {
            $orConditions = ['or'];
            foreach ($statuses as $_status) {
                if (strtolower($_status) == 'retur') {
                    $orConditions[] = ['>', 'returned_quantity', '0'];
                } else {
                    $orConditions[] = ['like', 'status_pesanan', $_status];
                }
            }
            $query->andFilterWhere($orConditions);
        } else {
            $query->andFilterWhere(['like', 'status_pesanan', $status]);
        }

        return $query;        
    }

}
