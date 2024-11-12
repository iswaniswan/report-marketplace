<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TokopediaKeuangan;

/**
 * TokopediaKeuanganSearch represents the model behind the search form of `app\models\TokopediaKeuangan`.
 */
class TokopediaKeuanganSearch extends TokopediaKeuangan
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
            [['id', 'id_file_source', 'nomor', 'jumlah_produk_dibeli', 'harga_jual_idr', 'jumlah_subsidi_tokopedia_idr', 'nilai_kupon_toko_terpakai_idr', 'jumlah_produk_yang_dikurangkan', 'total_pengurangan_idr', 'biaya_layanan_termasuk_ppn_dan_pph_idr', 'biaya_layanan_di_luar_ppn_dan_pph_idr', 'ppn_idr', 'pph_idr'], 'integer'],
            [['nomor_invoice', 'tanggal_pembayaran', 'status_terakhir', 'tanggal_pesanan_selesai', 'waktu_pesanan_selesai', 'tanggal_pesanan_dibatalkan', 'waktu_pesanan_dibatalkan', 'nama_produk', 'jenis_kupon_toko_terpakai', 'kode_kupon_toko_yang_digunakan', 'nama_biaya_layanan', 'persentase_biaya_layanan'], 'safe'],
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
        $query = TokopediaKeuangan::find();

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
        //     'harga_jual_idr' => $this->harga_jual_idr,
        //     'jumlah_subsidi_tokopedia_idr' => $this->jumlah_subsidi_tokopedia_idr,
        //     'nilai_kupon_toko_terpakai_idr' => $this->nilai_kupon_toko_terpakai_idr,
        //     'jumlah_produk_yang_dikurangkan' => $this->jumlah_produk_yang_dikurangkan,
        //     'total_pengurangan_idr' => $this->total_pengurangan_idr,
        //     'biaya_layanan_termasuk_ppn_dan_pph_idr' => $this->biaya_layanan_termasuk_ppn_dan_pph_idr,
        //     'biaya_layanan_di_luar_ppn_dan_pph_idr' => $this->biaya_layanan_di_luar_ppn_dan_pph_idr,
        //     'ppn_idr' => $this->ppn_idr,
        //     'pph_idr' => $this->pph_idr,
        // ]);

        // $query->andFilterWhere(['like', 'nomor_invoice', $this->nomor_invoice])
        //     ->andFilterWhere(['like', 'tanggal_pembayaran', $this->tanggal_pembayaran])
        //     ->andFilterWhere(['like', 'status_terakhir', $this->status_terakhir])
        //     ->andFilterWhere(['like', 'tanggal_pesanan_selesai', $this->tanggal_pesanan_selesai])
        //     ->andFilterWhere(['like', 'waktu_pesanan_selesai', $this->waktu_pesanan_selesai])
        //     ->andFilterWhere(['like', 'tanggal_pesanan_dibatalkan', $this->tanggal_pesanan_dibatalkan])
        //     ->andFilterWhere(['like', 'waktu_pesanan_dibatalkan', $this->waktu_pesanan_dibatalkan])
        //     ->andFilterWhere(['like', 'nama_produk', $this->nama_produk])
        //     ->andFilterWhere(['like', 'jenis_kupon_toko_terpakai', $this->jenis_kupon_toko_terpakai])
        //     ->andFilterWhere(['like', 'kode_kupon_toko_yang_digunakan', $this->kode_kupon_toko_yang_digunakan])
        //     ->andFilterWhere(['like', 'nama_biaya_layanan', $this->nama_biaya_layanan])
        //     ->andFilterWhere(['like', 'persentase_biaya_layanan', $this->persentase_biaya_layanan]);

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
