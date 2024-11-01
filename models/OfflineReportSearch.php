<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Offline;

/**
 * OfflineReportSearch represents the model behind the search form of `app\models\Offline`.
 */
class OfflineReportSearch extends Offline
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
            [['id', 'quantity', 'harga_satuan', 'subtotal', 'adjustment'], 'integer'],
            [['no_invoice', 'tanggal_invoice', 'nama_customer', 'alamat_customer', 'no_hp_customer', 'kode_sku', 'nama_barang', 'tanggal_bayar'], 'safe'],
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
        $query = Offline::find();

        $this->load($params);

        if ($this->date_start != null && $this->date_end != null) {
            // Adding the BETWEEN clause to filter by date range
            $query->andFilterWhere(['between', 
                new \yii\db\Expression("STR_TO_DATE(tanggal_invoice, '%Y-%m-%d')"), 
                $this->date_start, 
                $this->date_end
            ]);
        } else {

            if ($this->date_start != null) {
                $query->andFilterWhere(['>=', 
                    new \yii\db\Expression("STR_TO_DATE(tanggal_invoice, '%Y-%m-%d')"), 
                    date('Y-m-d', strtotime($this->date_start))
                ]);
            }

            if ($this->date_end != null) {
                $query->andFilterWhere(['<=', 
                    new \yii\db\Expression("STR_TO_DATE(tanggal_invoice, '%Y-%m-%d')"), 
                    date('Y-m-d', strtotime($this->date_end))
                ]);
            }
        }

        // if ($this->status != null) {
        //     $query->andFilterWhere(['and',
        //         ['like', 'status_pesanan', $this->status]
        //     ]);
        // }

        // add conditions that should always apply here

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            // 'quantity' => $this->quantity,
            // 'harga_satuan' => $this->harga_satuan,
            // 'subtotal' => $this->subtotal,
            // 'adjustment' => $this->adjustment,
        ]);

        $query->andFilterWhere(['like', 'no_invoice', $this->no_invoice])
            ->andFilterWhere(['like', 'tanggal_invoice', $this->tanggal_invoice])
            // ->andFilterWhere(['like', 'nama_customer', $this->nama_customer])
            // ->andFilterWhere(['like', 'alamat_customer', $this->alamat_customer])
            // ->andFilterWhere(['like', 'no_hp_customer', $this->no_hp_customer])
            // ->andFilterWhere(['like', 'kode_sku', $this->kode_sku])
            // ->andFilterWhere(['like', 'nama_barang', $this->nama_barang])
            ->andFilterWhere(['like', 'tanggal_bayar', $this->tanggal_bayar]);

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
