<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tokopedia;

/**
 * TokopediaSearch represents the model behind the search form of `app\models\Tokopedia`.
 */
class TokopediaSearch extends Tokopedia
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
            [['id', 'id_file_source', 'nomor', 'jumlah_produk_dibeli', 'harga_awal_idr', 'harga_satuan_bundling_idr', 'diskon_produk_idr', 'harga_jual_idr', 'jumlah_subsidi_tokopedia_idr', 'nilai_kupon_toko_terpakai_idr', 'total_penjualan_idr'], 'integer'],
            [['nomor_invoice', 'tanggal_pembayaran', 'status_terakhir', 'tanggal_pesanan_selesai', 'waktu_pesanan_selesai', 'tanggal_pesanan_dibatalkan', 'waktu_pesanan_dibatalkan', 'nama_produk', 'tipe_produk', 'nomor_sku', 'catatan_produk_pembeli', 'catatan_produk_penjual', 'jenis_kupon_toko_terpakai', 'kode_kupon_toko_yang_digunakan', 'biaya_pengiriman_tunai_idr', 'biaya_asuransi_pengiriman_idr', 'total_biaya_pengiriman_idr', 'nama_pembeli', 'no_telp_pembeli', 'nama_penerima', 'no_telp_penerima', 'alamat_pengiriman', 'kota', 'provinsi', 'nama_kurir', 'tipe_pengiriman_regular_same_day_etc', 'no_resi_kode_booking', 'tanggal_pengiriman_barang', 'waktu_pengiriman_barang', 'gudang_pengiriman', 'nama_campaign', 'nama_bundling', 'tipe_bebas_ongkir_bebas_ongkir_bebas_ongkir_dt', 'cod', 'jumlah_produk_yang_dikurangkan', 'total_pengurangan_idr', 'nama_penawaran_terpakai', 'tingkatan_promosi_terpakai', 'diskon_penawaran_terpakai_idr'], 'safe'],
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
        $query = Tokopedia::find();

        $this->load($params);

        if ($this->date_start != null && $this->date_end != null) {
            // Adding the BETWEEN clause to filter by date range
            $query->andFilterWhere(['between', 
                new \yii\db\Expression("STR_TO_DATE(tanggal_pembayaran, '%d-%m-%Y')"), 
                $this->date_start, 
                $this->date_end
            ]);
        } else {

            if ($this->date_start != null) {
                $query->andFilterWhere(['>=', 
                    new \yii\db\Expression("STR_TO_DATE(tanggal_pembayaran, '%d-%m-%Y')"), 
                    date('Y-m-d', strtotime($this->date_start))
                ]);
            }

            if ($this->date_end != null) {
                $query->andFilterWhere(['<=', 
                    new \yii\db\Expression("STR_TO_DATE(tanggal_pembayaran, '%d-%m-%Y')"), 
                    date('Y-m-d', strtotime($this->date_end))
                ]);
            }
        }

        if ($this->status !== null) {
            $cleanedString = trim($this->status, '"[]');
            $array = preg_split('/","/', $cleanedString);
    
            // Optionally, remove any remaining quotes around each element
            $array = array_map(function($item) {
                return trim($item, '"');
            }, $array);
    
            $statuses = $array;

            // $statuses = json_decode($this->status, true); // Decode JSON and set `true` for associative array
            // var_dump($statuses); die();
            if (is_array($statuses)) {
                $orConditions = ['or'];
                foreach ($statuses as $_status) {
                    // Normalize newlines in the search term to handle database format
                    $normalizedStatus = str_replace(["\r\n", "\n", "\r"], '%', $_status);
                    $orConditions[] = ['like', 'status_terakhir', $normalizedStatus, false];
                }
                $query->andFilterWhere($orConditions);
            } else {
                // Handle single status case, normalizing newlines in the search term
                $normalizedStatus = str_replace(["\r\n", "\n", "\r"], '%', $this->status);
                $query->andFilterWhere(['like', 'status_terakhir', $normalizedStatus, false]);
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
                ['like', 'nomor_invoice', $searchValue],
                ['like', 'status_terakhir', $searchValue],
                // Add more fields that you want to include in the search
            ]);
        }

        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'id_file_source' => $this->id_file_source,
        //     'nomor' => $this->nomor,
        //     'jumlah_produk_dibeli' => $this->jumlah_produk_dibeli,
        //     'harga_awal_idr' => $this->harga_awal_idr,
        //     'harga_satuan_bundling_idr' => $this->harga_satuan_bundling_idr,
        //     'diskon_produk_idr' => $this->diskon_produk_idr,
        //     'harga_jual_idr' => $this->harga_jual_idr,
        //     'jumlah_subsidi_tokopedia_idr' => $this->jumlah_subsidi_tokopedia_idr,
        //     'nilai_kupon_toko_terpakai_idr' => $this->nilai_kupon_toko_terpakai_idr,
        //     'total_penjualan_idr' => $this->total_penjualan_idr,
        // ]);

        // $query->andFilterWhere(['like', 'nomor_invoice', $this->nomor_invoice])
        //     ->andFilterWhere(['like', 'tanggal_pembayaran', $this->tanggal_pembayaran])
        //     ->andFilterWhere(['like', 'status_terakhir', $this->status_terakhir])
        //     ->andFilterWhere(['like', 'tanggal_pesanan_selesai', $this->tanggal_pesanan_selesai])
        //     ->andFilterWhere(['like', 'waktu_pesanan_selesai', $this->waktu_pesanan_selesai])
        //     ->andFilterWhere(['like', 'tanggal_pesanan_dibatalkan', $this->tanggal_pesanan_dibatalkan])
        //     ->andFilterWhere(['like', 'waktu_pesanan_dibatalkan', $this->waktu_pesanan_dibatalkan])
        //     ->andFilterWhere(['like', 'nama_produk', $this->nama_produk])
        //     ->andFilterWhere(['like', 'tipe_produk', $this->tipe_produk])
        //     ->andFilterWhere(['like', 'nomor_sku', $this->nomor_sku])
        //     ->andFilterWhere(['like', 'catatan_produk_pembeli', $this->catatan_produk_pembeli])
        //     ->andFilterWhere(['like', 'catatan_produk_penjual', $this->catatan_produk_penjual])
        //     ->andFilterWhere(['like', 'jenis_kupon_toko_terpakai', $this->jenis_kupon_toko_terpakai])
        //     ->andFilterWhere(['like', 'kode_kupon_toko_yang_digunakan', $this->kode_kupon_toko_yang_digunakan])
        //     ->andFilterWhere(['like', 'biaya_pengiriman_tunai_idr', $this->biaya_pengiriman_tunai_idr])
        //     ->andFilterWhere(['like', 'biaya_asuransi_pengiriman_idr', $this->biaya_asuransi_pengiriman_idr])
        //     ->andFilterWhere(['like', 'total_biaya_pengiriman_idr', $this->total_biaya_pengiriman_idr])
        //     ->andFilterWhere(['like', 'nama_pembeli', $this->nama_pembeli])
        //     ->andFilterWhere(['like', 'no_telp_pembeli', $this->no_telp_pembeli])
        //     ->andFilterWhere(['like', 'nama_penerima', $this->nama_penerima])
        //     ->andFilterWhere(['like', 'no_telp_penerima', $this->no_telp_penerima])
        //     ->andFilterWhere(['like', 'alamat_pengiriman', $this->alamat_pengiriman])
        //     ->andFilterWhere(['like', 'kota', $this->kota])
        //     ->andFilterWhere(['like', 'provinsi', $this->provinsi])
        //     ->andFilterWhere(['like', 'nama_kurir', $this->nama_kurir])
        //     ->andFilterWhere(['like', 'tipe_pengiriman_regular_same_day_etc', $this->tipe_pengiriman_regular_same_day_etc])
        //     ->andFilterWhere(['like', 'no_resi_kode_booking', $this->no_resi_kode_booking])
        //     ->andFilterWhere(['like', 'tanggal_pengiriman_barang', $this->tanggal_pengiriman_barang])
        //     ->andFilterWhere(['like', 'waktu_pengiriman_barang', $this->waktu_pengiriman_barang])
        //     ->andFilterWhere(['like', 'gudang_pengiriman', $this->gudang_pengiriman])
        //     ->andFilterWhere(['like', 'nama_campaign', $this->nama_campaign])
        //     ->andFilterWhere(['like', 'nama_bundling', $this->nama_bundling])
        //     ->andFilterWhere(['like', 'tipe_bebas_ongkir_bebas_ongkir_bebas_ongkir_dt', $this->tipe_bebas_ongkir_bebas_ongkir_bebas_ongkir_dt])
        //     ->andFilterWhere(['like', 'cod', $this->cod])
        //     ->andFilterWhere(['like', 'jumlah_produk_yang_dikurangkan', $this->jumlah_produk_yang_dikurangkan])
        //     ->andFilterWhere(['like', 'total_pengurangan_idr', $this->total_pengurangan_idr])
        //     ->andFilterWhere(['like', 'nama_penawaran_terpakai', $this->nama_penawaran_terpakai])
        //     ->andFilterWhere(['like', 'tingkatan_promosi_terpakai', $this->tingkatan_promosi_terpakai])
        //     ->andFilterWhere(['like', 'diskon_penawaran_terpakai_idr', $this->diskon_penawaran_terpakai_idr]);

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
