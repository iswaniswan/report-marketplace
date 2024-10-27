<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LazadaIncome;

/**
 * LazadaIncomeSearch represents the model behind the search form of `app\models\LazadaIncome`.
 */
class LazadaIncomeSearch extends LazadaIncome
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
            [['id', 'id_file_source', 'amount_include_tax', 'vat_amount', 'wht_amount'], 'integer'],
            [['statement_period', 'statement_number', 'transaction_date', 'fee_name', 'release_status', 'release_date', 'comment', 'order_creation_date', 'order_number', 'order_line_id', 'seller_sku', 'lazada_sku', 'wht_included_in_amount', 'order_status', 'product_name'], 'safe'],
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
        $query = LazadaIncome::find();

        $this->load($params);

        if ($this->date_start != null && $this->date_end != null) {
            // Adding the BETWEEN clause to filter by date range
            $query->andFilterWhere(['between', 
                new \yii\db\Expression("STR_TO_DATE(order_creation_date, '%d %b %Y')"), 
                $this->date_start, 
                $this->date_end
            ]);
        } else {

            if ($this->date_start != null) {
                $query->andFilterWhere(['>=', 
                    new \yii\db\Expression("STR_TO_DATE(order_creation_date, '%d %b %Y')"), 
                    date('Y-m-d', strtotime($this->date_start))
                ]);
            }

            if ($this->date_end != null) {
                $query->andFilterWhere(['<=', 
                    new \yii\db\Expression("STR_TO_DATE(order_creation_date, '%d %b %Y')"), 
                    date('Y-m-d', strtotime($this->date_end))
                ]);
            }
        }

        if ($this->status != null) {
            $query->andFilterWhere(['and',
                ['like', 'order_status', $this->status]
            ]);
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
                ['like', 'order_item_id', $searchValue],
                ['like', 'order_status', $searchValue],
                // Add more fields that you want to include in the search
            ]);
        }

        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'id_file_source' => $this->id_file_source,
        //     'amount_include_tax' => $this->amount_include_tax,
        //     'vat_amount' => $this->vat_amount,
        //     'wht_amount' => $this->wht_amount,
        // ]);

        // $query->andFilterWhere(['like', 'statement_period', $this->statement_period])
        //     ->andFilterWhere(['like', 'statement_number', $this->statement_number])
        //     ->andFilterWhere(['like', 'transaction_date', $this->transaction_date])
        //     ->andFilterWhere(['like', 'fee_name', $this->fee_name])
        //     ->andFilterWhere(['like', 'release_status', $this->release_status])
        //     ->andFilterWhere(['like', 'release_date', $this->release_date])
        //     ->andFilterWhere(['like', 'comment', $this->comment])
        //     ->andFilterWhere(['like', 'order_creation_date', $this->order_creation_date])
        //     ->andFilterWhere(['like', 'order_number', $this->order_number])
        //     ->andFilterWhere(['like', 'order_line_id', $this->order_line_id])
        //     ->andFilterWhere(['like', 'seller_sku', $this->seller_sku])
        //     ->andFilterWhere(['like', 'lazada_sku', $this->lazada_sku])
        //     ->andFilterWhere(['like', 'wht_included_in_amount', $this->wht_included_in_amount])
        //     ->andFilterWhere(['like', 'order_status', $this->order_status])
        //     ->andFilterWhere(['like', 'product_name', $this->product_name]);

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
