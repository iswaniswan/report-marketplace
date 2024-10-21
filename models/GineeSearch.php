<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ginee;

/**
 * GineeSearch represents the model behind the search form of `app\models\Ginee`.
 */
class GineeSearch extends Ginee
{

    public $isServerside = false;



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['no', 'biaya_kartu_kredit', 'waktu_pembaruan', 'sinkronisasi_terakhir', 'adalah_pesanan_palsu', 'tanggal_pembuatan', 'id_pesanan', 'status', 'jenis_pesanan', 'channel', 'nama_toko', 'pembayaran', 'waktu_pembayaran', 'nama_pembeli', 'waktu_pengiriman', 'waktu_penyelesaian', 'telepon_pembeli', 'email_pembeli', 'catatan_pembeli', 'nama_produk', 'variant_produk', 'sku', 'nama_gudang', 'status_produk', 'harga_awal_produk', 'harga_promosi', 'jumlah', 'adalah_hadiah', 'total_berat_g', 'harga_total_promosi', 'subtotal', 'invoice', 'msku', 'nama_penerima', 'no_telepon_penerima', 'alamat_penerima', 'kurir', 'provinsi', 'kota', 'kecamatan', 'kode_pos', 'awb_no_tracking', 'dropshipper', 'no_telepon_dropshipper', 'kirim_sebelum', 'mata_uang', 'total', 'biaya_pengiriman', 'biaya_kirim_ditanggung_pembeli', 'pajak', 'asuransi', 'total_diskon', 'subsidi_marketplace', 'biaya_komisi', 'biaya_layanan', 'ongkir_dibayar_sistem', 'potongan_harga', 'potongan_biaya_pengiriman', 'koin', 'koin_cashback_penjual', 'jumlah_pengembalian_dana', 'voucher_channel', 'diskon_penjual', 'biaya_layanan_kartu_kredit', 'catatan_penjual', 'status_label_pengiriman', 'status_invoice', 'status_packing_list', 'alasan_pembatalan', 'pemotongan_pajak', 'waktu_pembatalan', 'alamat_tagihan', 'biaya_pembayaran', 'biaya_lainnya', 'komisi_lazpick_laztop', 'biaya_promosi_gratis_ongkir', 'kredit'], 'safe'],
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
        $query = Ginee::find();

        $this->load($params);

        // add conditions that should always apply here

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        if (!empty($params['search']['value'])) {
            $searchValue = $params['search']['value'];
            $query->andFilterWhere(['or',
                ['like', 'id_pesanan', $searchValue],
                ['like', 'nama_toko', $searchValue],
                ['like', 'nama_produk', $searchValue],
                ['like', 'variant_produk', $searchValue]
                // Add more fields that you want to include in the search
            ]);
        }

        // $query->andFilterWhere(['like', 'no', $this->no])
        //     ->andFilterWhere(['like', 'biaya_kartu_kredit', $this->biaya_kartu_kredit])
        //     ->andFilterWhere(['like', 'waktu_pembaruan', $this->waktu_pembaruan])
        //     ->andFilterWhere(['like', 'sinkronisasi_terakhir', $this->sinkronisasi_terakhir])
        //     ->andFilterWhere(['like', 'adalah_pesanan_palsu', $this->adalah_pesanan_palsu])
        //     ->andFilterWhere(['like', 'tanggal_pembuatan', $this->tanggal_pembuatan])
        //     ->andFilterWhere(['like', 'id_pesanan', $this->id_pesanan])
        //     ->andFilterWhere(['like', 'status', $this->status])
        //     ->andFilterWhere(['like', 'jenis_pesanan', $this->jenis_pesanan])
        //     ->andFilterWhere(['like', 'channel', $this->channel])
        //     ->andFilterWhere(['like', 'nama_toko', $this->nama_toko])
        //     ->andFilterWhere(['like', 'pembayaran', $this->pembayaran])
        //     ->andFilterWhere(['like', 'waktu_pembayaran', $this->waktu_pembayaran])
        //     ->andFilterWhere(['like', 'nama_pembeli', $this->nama_pembeli])
        //     ->andFilterWhere(['like', 'waktu_pengiriman', $this->waktu_pengiriman])
        //     ->andFilterWhere(['like', 'waktu_penyelesaian', $this->waktu_penyelesaian])
        //     ->andFilterWhere(['like', 'telepon_pembeli', $this->telepon_pembeli])
        //     ->andFilterWhere(['like', 'email_pembeli', $this->email_pembeli])
        //     ->andFilterWhere(['like', 'catatan_pembeli', $this->catatan_pembeli])
        //     ->andFilterWhere(['like', 'nama_produk', $this->nama_produk])
        //     ->andFilterWhere(['like', 'variant_produk', $this->variant_produk])
        //     ->andFilterWhere(['like', 'sku', $this->sku])
        //     ->andFilterWhere(['like', 'nama_gudang', $this->nama_gudang])
        //     ->andFilterWhere(['like', 'status_produk', $this->status_produk])
        //     ->andFilterWhere(['like', 'harga_awal_produk', $this->harga_awal_produk])
        //     ->andFilterWhere(['like', 'harga_promosi', $this->harga_promosi])
        //     ->andFilterWhere(['like', 'jumlah', $this->jumlah])
        //     ->andFilterWhere(['like', 'adalah_hadiah', $this->adalah_hadiah])
        //     ->andFilterWhere(['like', 'total_berat_g', $this->total_berat_g])
        //     ->andFilterWhere(['like', 'harga_total_promosi', $this->harga_total_promosi])
        //     ->andFilterWhere(['like', 'subtotal', $this->subtotal])
        //     ->andFilterWhere(['like', 'invoice', $this->invoice])
        //     ->andFilterWhere(['like', 'msku', $this->msku])
        //     ->andFilterWhere(['like', 'nama_penerima', $this->nama_penerima])
        //     ->andFilterWhere(['like', 'no_telepon_penerima', $this->no_telepon_penerima])
        //     ->andFilterWhere(['like', 'alamat_penerima', $this->alamat_penerima])
        //     ->andFilterWhere(['like', 'kurir', $this->kurir])
        //     ->andFilterWhere(['like', 'provinsi', $this->provinsi])
        //     ->andFilterWhere(['like', 'kota', $this->kota])
        //     ->andFilterWhere(['like', 'kecamatan', $this->kecamatan])
        //     ->andFilterWhere(['like', 'kode_pos', $this->kode_pos])
        //     ->andFilterWhere(['like', 'awb_no_tracking', $this->awb_no_tracking])
        //     ->andFilterWhere(['like', 'dropshipper', $this->dropshipper])
        //     ->andFilterWhere(['like', 'no_telepon_dropshipper', $this->no_telepon_dropshipper])
        //     ->andFilterWhere(['like', 'kirim_sebelum', $this->kirim_sebelum])
        //     ->andFilterWhere(['like', 'mata_uang', $this->mata_uang])
        //     ->andFilterWhere(['like', 'total', $this->total])
        //     ->andFilterWhere(['like', 'biaya_pengiriman', $this->biaya_pengiriman])
        //     ->andFilterWhere(['like', 'biaya_kirim_ditanggung_pembeli', $this->biaya_kirim_ditanggung_pembeli])
        //     ->andFilterWhere(['like', 'pajak', $this->pajak])
        //     ->andFilterWhere(['like', 'asuransi', $this->asuransi])
        //     ->andFilterWhere(['like', 'total_diskon', $this->total_diskon])
        //     ->andFilterWhere(['like', 'subsidi_marketplace', $this->subsidi_marketplace])
        //     ->andFilterWhere(['like', 'biaya_komisi', $this->biaya_komisi])
        //     ->andFilterWhere(['like', 'biaya_layanan', $this->biaya_layanan])
        //     ->andFilterWhere(['like', 'ongkir_dibayar_sistem', $this->ongkir_dibayar_sistem])
        //     ->andFilterWhere(['like', 'potongan_harga', $this->potongan_harga])
        //     ->andFilterWhere(['like', 'potongan_biaya_pengiriman', $this->potongan_biaya_pengiriman])
        //     ->andFilterWhere(['like', 'koin', $this->koin])
        //     ->andFilterWhere(['like', 'koin_cashback_penjual', $this->koin_cashback_penjual])
        //     ->andFilterWhere(['like', 'jumlah_pengembalian_dana', $this->jumlah_pengembalian_dana])
        //     ->andFilterWhere(['like', 'voucher_channel', $this->voucher_channel])
        //     ->andFilterWhere(['like', 'diskon_penjual', $this->diskon_penjual])
        //     ->andFilterWhere(['like', 'biaya_layanan_kartu_kredit', $this->biaya_layanan_kartu_kredit])
        //     ->andFilterWhere(['like', 'catatan_penjual', $this->catatan_penjual])
        //     ->andFilterWhere(['like', 'status_label_pengiriman', $this->status_label_pengiriman])
        //     ->andFilterWhere(['like', 'status_invoice', $this->status_invoice])
        //     ->andFilterWhere(['like', 'status_packing_list', $this->status_packing_list])
        //     ->andFilterWhere(['like', 'alasan_pembatalan', $this->alasan_pembatalan])
        //     ->andFilterWhere(['like', 'pemotongan_pajak', $this->pemotongan_pajak])
        //     ->andFilterWhere(['like', 'waktu_pembatalan', $this->waktu_pembatalan])
        //     ->andFilterWhere(['like', 'alamat_tagihan', $this->alamat_tagihan])
        //     ->andFilterWhere(['like', 'biaya_pembayaran', $this->biaya_pembayaran])
        //     ->andFilterWhere(['like', 'biaya_lainnya', $this->biaya_lainnya])
        //     ->andFilterWhere(['like', 'komisi_lazpick_laztop', $this->komisi_lazpick_laztop])
        //     ->andFilterWhere(['like', 'biaya_promosi_gratis_ongkir', $this->biaya_promosi_gratis_ongkir])
        //     ->andFilterWhere(['like', 'kredit', $this->kredit]);

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
            $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}
