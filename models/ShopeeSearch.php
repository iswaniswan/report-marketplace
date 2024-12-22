<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Shopee;

/**
 * ShopeeSearch represents the model behind the search form of `app\models\Shopee`.
 */
class ShopeeSearch extends Shopee
{

    public $isServerside = false;
    public $year;
    public $month;
    public $date_start;
    public $date_end;
    public $status;
    public $channel;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_file_source'], 'integer'],
            [['no_pesanan', 'status_pesanan', 'alasan_pembatalan', 'status_pembatalan_pengembalian', 'no_resi', 'opsi_pengiriman', 'antar_ke_counter_pick_up', 'pesanan_harus_dikirimkan_sebelum_menghindari_keterlambatan', 'waktu_pengiriman_diatur', 'waktu_pesanan_dibuat', 'waktu_pembayaran_dilakukan', 'metode_pembayaran', 'sku_induk', 'nama_produk', 'nomor_referensi_sku', 'nama_variasi', 'harga_awal', 'harga_setelah_diskon', 'jumlah', 'returned_quantity', 'total_harga_produk', 'total_diskon', 'diskon_dari_penjual', 'diskon_dari_shopee', 'berat_produk', 'jumlah_produk_di_pesan', 'total_berat', 'voucher_ditanggung_penjual', 'cashback_koin', 'voucher_ditanggung_shopee', 'paket_diskon', 'paket_diskon_diskon_dari_shopee', 'paket_diskon_diskon_dari_penjual', 'potongan_koin_shopee', 'diskon_kartu_kredit', 'ongkos_kirim_dibayar_oleh_pembeli', 'estimasi_potongan_biaya_pengiriman', 'ongkos_kirim_pengembalian_barang', 'total_pembayaran', 'perkiraan_ongkos_kirim', 'catatan_dari_pembeli', 'catatan', 'username_pembeli', 'nama_penerima', 'no_telepon', 'alamat_pengiriman', 'kota_kabupaten', 'provinsi', 'waktu_pesanan_selesai'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function getQuerySearch($params)
    {
        $query = Shopee::find();

        $this->load($params);

        if ($this->date_start != null && $this->date_end != null) {
            // Adding the BETWEEN clause to filter by date range
            $query->andFilterWhere(['between', 
                new \yii\db\Expression("STR_TO_DATE(waktu_pesanan_dibuat, '%Y-%m-%d')"), 
                $this->date_start, 
                $this->date_end
            ]);
        } else {

            if ($this->date_start != null) {
                $query->andFilterWhere(['>=', 
                    new \yii\db\Expression("STR_TO_DATE(waktu_pesanan_dibuat, '%Y-%m-%d')"), 
                    date('Y-m-d', strtotime($this->date_start))
                ]);
            }

            if ($this->date_end != null) {
                $query->andFilterWhere(['<=', 
                    new \yii\db\Expression("STR_TO_DATE(waktu_pesanan_dibuat, '%Y-%m-%d')"), 
                    date('Y-m-d', strtotime($this->date_end))
                ]);
            }
        }

        if ($this->status !== null) {
            $statuses = json_decode($this->status, true); // Decode JSON and set `true` for associative array
            if (is_array($statuses)) {
                $orConditions = ['or'];
                foreach ($statuses as $_status) {
                    if (strtolower($_status) == 'retur') {
                        $orConditions[] = ['>', 'returned_quantity', '0'];
                    } else {
                        $orConditions[] = ['like', 'status_pesanan', $_status];
                        $orConditions[] = ['like', 'status_pembatalan_pengembalian', $_status];
                    }
                }
                $query->andFilterWhere($orConditions);
            } else {
                $query->andFilterWhere(['like', 'status_pesanan', $this->status]);
                $query->andFilterWhere(['like', 'status_pembatalan_pengembalian', $this->status]);
            }
        }
        

        // if ($this->channel != null) {
        //     $query->andFilterWhere(['and',
        //         ['like', 'channel', $this->channel]
        //     ]);
        // }

        // add conditions that should always apply here

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_file_source' => $this->id_file_source,
        ]);

        if (!empty($params['search']['value'])) {
            $searchValue = $params['search']['value'];
            $query->andFilterWhere(['or',
                ['like', 'no_pesanan', $searchValue],
                ['like', 'status_pesanan', $searchValue],
                // Add more fields that you want to include in the search
            ]);
        }

        // $query->andFilterWhere(['like', 'no_pesanan', $this->no_pesanan])
        //     ->andFilterWhere(['like', 'status_pesanan', $this->status_pesanan])
        //     ->andFilterWhere(['like', 'alasan_pembatalan', $this->alasan_pembatalan])
        //     ->andFilterWhere(['like', 'status_pembatalan_pengembalian', $this->status_pembatalan_pengembalian])
        //     ->andFilterWhere(['like', 'no_resi', $this->no_resi])
        //     ->andFilterWhere(['like', 'opsi_pengiriman', $this->opsi_pengiriman])
        //     ->andFilterWhere(['like', 'antar_ke_counter_pick_up', $this->antar_ke_counter_pick_up])
        //     ->andFilterWhere(['like', 'pesanan_harus_dikirimkan_sebelum_menghindari_keterlambatan', $this->pesanan_harus_dikirimkan_sebelum_menghindari_keterlambatan])
        //     ->andFilterWhere(['like', 'waktu_pengiriman_diatur', $this->waktu_pengiriman_diatur])
        //     ->andFilterWhere(['like', 'waktu_pesanan_dibuat', $this->waktu_pesanan_dibuat])
        //     ->andFilterWhere(['like', 'waktu_pembayaran_dilakukan', $this->waktu_pembayaran_dilakukan])
        //     ->andFilterWhere(['like', 'metode_pembayaran', $this->metode_pembayaran])
        //     ->andFilterWhere(['like', 'sku_induk', $this->sku_induk])
        //     ->andFilterWhere(['like', 'nama_produk', $this->nama_produk])
        //     ->andFilterWhere(['like', 'nomor_referensi_sku', $this->nomor_referensi_sku])
        //     ->andFilterWhere(['like', 'nama_variasi', $this->nama_variasi])
        //     ->andFilterWhere(['like', 'harga_awal', $this->harga_awal])
        //     ->andFilterWhere(['like', 'harga_setelah_diskon', $this->harga_setelah_diskon])
        //     ->andFilterWhere(['like', 'jumlah', $this->jumlah])
        //     ->andFilterWhere(['like', 'returned_quantity', $this->returned_quantity])
        //     ->andFilterWhere(['like', 'total_harga_produk', $this->total_harga_produk])
        //     ->andFilterWhere(['like', 'total_diskon', $this->total_diskon])
        //     ->andFilterWhere(['like', 'diskon_dari_penjual', $this->diskon_dari_penjual])
        //     ->andFilterWhere(['like', 'diskon_dari_shopee', $this->diskon_dari_shopee])
        //     ->andFilterWhere(['like', 'berat_produk', $this->berat_produk])
        //     ->andFilterWhere(['like', 'jumlah_produk_di_pesan', $this->jumlah_produk_di_pesan])
        //     ->andFilterWhere(['like', 'total_berat', $this->total_berat])
        //     ->andFilterWhere(['like', 'voucher_ditanggung_penjual', $this->voucher_ditanggung_penjual])
        //     ->andFilterWhere(['like', 'cashback_koin', $this->cashback_koin])
        //     ->andFilterWhere(['like', 'voucher_ditanggung_shopee', $this->voucher_ditanggung_shopee])
        //     ->andFilterWhere(['like', 'paket_diskon', $this->paket_diskon])
        //     ->andFilterWhere(['like', 'paket_diskon_diskon_dari_shopee', $this->paket_diskon_diskon_dari_shopee])
        //     ->andFilterWhere(['like', 'paket_diskon_diskon_dari_penjual', $this->paket_diskon_diskon_dari_penjual])
        //     ->andFilterWhere(['like', 'potongan_koin_shopee', $this->potongan_koin_shopee])
        //     ->andFilterWhere(['like', 'diskon_kartu_kredit', $this->diskon_kartu_kredit])
        //     ->andFilterWhere(['like', 'ongkos_kirim_dibayar_oleh_pembeli', $this->ongkos_kirim_dibayar_oleh_pembeli])
        //     ->andFilterWhere(['like', 'estimasi_potongan_biaya_pengiriman', $this->estimasi_potongan_biaya_pengiriman])
        //     ->andFilterWhere(['like', 'ongkos_kirim_pengembalian_barang', $this->ongkos_kirim_pengembalian_barang])
        //     ->andFilterWhere(['like', 'total_pembayaran', $this->total_pembayaran])
        //     ->andFilterWhere(['like', 'perkiraan_ongkos_kirim', $this->perkiraan_ongkos_kirim])
        //     ->andFilterWhere(['like', 'catatan_dari_pembeli', $this->catatan_dari_pembeli])
        //     ->andFilterWhere(['like', 'catatan', $this->catatan])
        //     ->andFilterWhere(['like', 'username_pembeli', $this->username_pembeli])
        //     ->andFilterWhere(['like', 'nama_penerima', $this->nama_penerima])
        //     ->andFilterWhere(['like', 'no_telepon', $this->no_telepon])
        //     ->andFilterWhere(['like', 'alamat_pengiriman', $this->alamat_pengiriman])
        //     ->andFilterWhere(['like', 'kota_kabupaten', $this->kota_kabupaten])
        //     ->andFilterWhere(['like', 'provinsi', $this->provinsi])
        //     ->andFilterWhere(['like', 'waktu_pesanan_selesai', $this->waktu_pesanan_selesai]);

        return $query;
    }

    /**
    * Creates data provider instance with search query applied
    *
    * @param array $params
    *
    * @return ActiveDataProvider
    */
    public function search($params)
    {
        $query = $this->getQuerySearch($params);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($this->isServerside) {
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => $params['length'] ?? 10,
                    'page' => isset($params['start']) ? ($params['start'] / ($params['length'] ?? 10)) : 0,
                ],
                'sort' => [
                    'defaultOrder' => ['id' => SORT_DESC],
                ],
            ]);

            // Handle sorting
            if (isset($params['order'][0]['column'])) {
                $sortColumnIndex = $params['order'][0]['column'];
                $sortDirection = $params['order'][0]['dir'] === 'asc' ? SORT_ASC : SORT_DESC;

                if (isset($params['columns'][$sortColumnIndex]['data']) && $params['columns'][$sortColumnIndex]['data']) {
                    $sortColumn = $params['columns'][$sortColumnIndex]['data'];
                    $dataProvider->sort->attributes[$sortColumn] = [
                        'asc' => [$sortColumn => SORT_ASC],
                        'desc' => [$sortColumn => SORT_DESC],
                    ];
                    $dataProvider->query->orderBy([$sortColumn => $sortDirection]);
                }
            }

            $this->load($params);
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}
