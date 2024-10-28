<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ShopeeIncome;

/**
 * ShopeeIncomeSearch represents the model behind the search form of `app\models\ShopeeIncome`.
 */
class ShopeeIncomeSearch extends ShopeeIncome
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
            [['id', 'id_file_source', 'no', 'harga_asli_produk', 'total_diskon_produk', 'jumlah_pengembalian_dana_ke_pembeli', 'diskon_produk_dari_shopee', 'diskon_voucher_ditanggung_penjual', 'cashback_koin_yang_ditanggung_penjual', 'ongkir_dibayar_pembeli', 'diskon_ongkir_ditanggung_jasa_kirim', 'gratis_ongkir_dari_shopee', 'ongkir_yang_diteruskan_oleh_shopee_ke_jasa_kirim', 'ongkos_kirim_pengembalian_barang', 'pengembalian_biaya_kirim', 'biaya_komisi_ams', 'biaya_administrasi_termasuk_ppn_11', 'biaya_layanan_termasuk_ppn_11', 'premi', 'biaya_program', 'biaya_kartu_kredit', 'biaya_kampanye', 'bea_masuk_ppn_pph', 'total_penghasilan', 'kompensasi', 'promo_gratis_ongkir_dari_penjual', 'pengembalian_dana_ke_pembeli', 'pro_rata_koin_yang_ditukarkan_untuk_pengembalian_barang', 'pro_rata_voucher_shopee_untuk_pengembalian_barang', 'pro_rated_bank_payment_channel_promotion_for_return_refund_items'], 'integer'],
            [['no_pesanan', 'no_pengajuan', 'username_pembeli', 'waktu_pesanan_dibuat', 'metode_pembayaran_pembeli', 'tanggal_dana_dilepaskan', 'kode_voucher', 'jasa_kirim', 'nama_kurir', '#', 'pro_rated_shopee_payment_channel_promotion_for_return_refund_ite'], 'safe'],
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
        $query = ShopeeIncome::find();

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
                // Add more fields that you want to include in the search
            ]);
        }

        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'id_file_source' => $this->id_file_source,
        //     'no' => $this->no,
        //     'harga_asli_produk' => $this->harga_asli_produk,
        //     'total_diskon_produk' => $this->total_diskon_produk,
        //     'jumlah_pengembalian_dana_ke_pembeli' => $this->jumlah_pengembalian_dana_ke_pembeli,
        //     'diskon_produk_dari_shopee' => $this->diskon_produk_dari_shopee,
        //     'diskon_voucher_ditanggung_penjual' => $this->diskon_voucher_ditanggung_penjual,
        //     'cashback_koin_yang_ditanggung_penjual' => $this->cashback_koin_yang_ditanggung_penjual,
        //     'ongkir_dibayar_pembeli' => $this->ongkir_dibayar_pembeli,
        //     'diskon_ongkir_ditanggung_jasa_kirim' => $this->diskon_ongkir_ditanggung_jasa_kirim,
        //     'gratis_ongkir_dari_shopee' => $this->gratis_ongkir_dari_shopee,
        //     'ongkir_yang_diteruskan_oleh_shopee_ke_jasa_kirim' => $this->ongkir_yang_diteruskan_oleh_shopee_ke_jasa_kirim,
        //     'ongkos_kirim_pengembalian_barang' => $this->ongkos_kirim_pengembalian_barang,
        //     'pengembalian_biaya_kirim' => $this->pengembalian_biaya_kirim,
        //     'biaya_komisi_ams' => $this->biaya_komisi_ams,
        //     'biaya_administrasi_termasuk_ppn_11' => $this->biaya_administrasi_termasuk_ppn_11,
        //     'biaya_layanan_termasuk_ppn_11' => $this->biaya_layanan_termasuk_ppn_11,
        //     'premi' => $this->premi,
        //     'biaya_program' => $this->biaya_program,
        //     'biaya_kartu_kredit' => $this->biaya_kartu_kredit,
        //     'biaya_kampanye' => $this->biaya_kampanye,
        //     'bea_masuk_ppn_pph' => $this->bea_masuk_ppn_pph,
        //     'total_penghasilan' => $this->total_penghasilan,
        //     'kompensasi' => $this->kompensasi,
        //     'promo_gratis_ongkir_dari_penjual' => $this->promo_gratis_ongkir_dari_penjual,
        //     'pengembalian_dana_ke_pembeli' => $this->pengembalian_dana_ke_pembeli,
        //     'pro_rata_koin_yang_ditukarkan_untuk_pengembalian_barang' => $this->pro_rata_koin_yang_ditukarkan_untuk_pengembalian_barang,
        //     'pro_rata_voucher_shopee_untuk_pengembalian_barang' => $this->pro_rata_voucher_shopee_untuk_pengembalian_barang,
        //     'pro_rated_bank_payment_channel_promotion_for_return_refund_items' => $this->pro_rated_bank_payment_channel_promotion_for_return_refund_items,
        // ]);

        // $query->andFilterWhere(['like', 'no_pesanan', $this->no_pesanan])
        //     ->andFilterWhere(['like', 'no_pengajuan', $this->no_pengajuan])
        //     ->andFilterWhere(['like', 'username_pembeli', $this->username_pembeli])
        //     ->andFilterWhere(['like', 'waktu_pesanan_dibuat', $this->waktu_pesanan_dibuat])
        //     ->andFilterWhere(['like', 'metode_pembayaran_pembeli', $this->metode_pembayaran_pembeli])
        //     ->andFilterWhere(['like', 'tanggal_dana_dilepaskan', $this->tanggal_dana_dilepaskan])
        //     ->andFilterWhere(['like', 'kode_voucher', $this->kode_voucher])
        //     ->andFilterWhere(['like', 'jasa_kirim', $this->jasa_kirim])
        //     ->andFilterWhere(['like', 'nama_kurir', $this->nama_kurir])
        //     ->andFilterWhere(['like', '#', $this->#])
        //     ->andFilterWhere(['like', 'pro_rated_shopee_payment_channel_promotion_for_return_refund_ite', $this->pro_rated_shopee_payment_channel_promotion_for_return_refund_ite]);

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
