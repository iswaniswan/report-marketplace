<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Lazada;

/**
 * LazadaSearch represents the model behind the search form of `app\models\Lazada`.
 */
class LazadaSearch extends Lazada
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
            [['id', 'id_file_source', 'paid_price', 'unit_price', 'seller_discount_total', 'shipping_fee', 'wallet_credit'], 'integer'],
            [['order_item_id', 'order_type', 'guarantee', 'delivery_type', 'lazada_id', 'seller_sku', 'lazada_sku', 'ware_house', 'create_time', 'update_time', 'rts_sla', 'tts_sla', 'order_number', 'invoice_required', 'invoice_number', 'delivered_date', 'customer_name', 'customer_email', 'national_registration_number', 'shipping_name', 'shipping_address', 'shipping_address2', 'shipping_address3', 'shipping_address4', 'shipping_address5', 'shipping_phone', 'shipping_phone2', 'shipping_city', 'shipping_post_code', 'shipping_country', 'shipping_region', 'billing_name', 'billing_addr', 'billing_addr2', 'billing_addr3', 'billing_addr4', 'billing_addr5', 'billing_phone', 'billing_phone2', 'billing_city', 'billing_post_code', 'billing_country', 'tax_code', 'branch_number', 'tax_invoice_requested', 'pay_method', 'item_name', 'variation', 'cd_shipping_provider', 'shipping_provider', 'shipment_type_name', 'shipping_provider_type', 'cd_tracking_code', 'tracking_code', 'tracking_url', 'shipping_provider_fm', 'tracking_code_fm', 'tracking_url_fm', 'promised_shipping_time', 'premium', 'status', 'buyer_failed_delivery_return_initiator', 'buyer_failed_delivery_reason', 'buyer_failed_delivery_detail'], 'safe'],
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
        $query = Lazada::find();

        $this->load($params);

        if ($this->date_start != null && $this->date_end != null) {
            // Adding the BETWEEN clause to filter by date range
            $query->andFilterWhere(['between', 
                new \yii\db\Expression("STR_TO_DATE(create_time, '%d %b %Y')"), 
                $this->date_start, 
                $this->date_end
            ]);
        } else {

            if ($this->date_start != null) {
                $query->andFilterWhere(['>=', 
                    new \yii\db\Expression("STR_TO_DATE(create_time, '%d %b %Y')"), 
                    date('Y-m-d', strtotime($this->date_start))
                ]);
            }

            if ($this->date_end != null) {
                $query->andFilterWhere(['<=', 
                    new \yii\db\Expression("STR_TO_DATE(create_time, '%d %b %Y')"), 
                    date('Y-m-d', strtotime($this->date_end))
                ]);
            }
        }

        if ($this->status != null) {
            $query->andFilterWhere(['and',
                ['like', 'status', $this->status]
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
                ['like', 'status', $searchValue],
                // Add more fields that you want to include in the search
            ]);
        }

        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'id_file_source' => $this->id_file_source,
        //     'paid_price' => $this->paid_price,
        //     'unit_price' => $this->unit_price,
        //     'seller_discount_total' => $this->seller_discount_total,
        //     'shipping_fee' => $this->shipping_fee,
        //     'wallet_credit' => $this->wallet_credit,
        // ]);

        // $query->andFilterWhere(['like', 'order_item_id', $this->order_item_id])
        //     ->andFilterWhere(['like', 'order_type', $this->order_type])
        //     ->andFilterWhere(['like', 'guarantee', $this->guarantee])
        //     ->andFilterWhere(['like', 'delivery_type', $this->delivery_type])
        //     ->andFilterWhere(['like', 'lazada_id', $this->lazada_id])
        //     ->andFilterWhere(['like', 'seller_sku', $this->seller_sku])
        //     ->andFilterWhere(['like', 'lazada_sku', $this->lazada_sku])
        //     ->andFilterWhere(['like', 'ware_house', $this->ware_house])
        //     ->andFilterWhere(['like', 'create_time', $this->create_time])
        //     ->andFilterWhere(['like', 'update_time', $this->update_time])
        //     ->andFilterWhere(['like', 'rts_sla', $this->rts_sla])
        //     ->andFilterWhere(['like', 'tts_sla', $this->tts_sla])
        //     ->andFilterWhere(['like', 'order_number', $this->order_number])
        //     ->andFilterWhere(['like', 'invoice_required', $this->invoice_required])
        //     ->andFilterWhere(['like', 'invoice_number', $this->invoice_number])
        //     ->andFilterWhere(['like', 'delivered_date', $this->delivered_date])
        //     ->andFilterWhere(['like', 'customer_name', $this->customer_name])
        //     ->andFilterWhere(['like', 'customer_email', $this->customer_email])
        //     ->andFilterWhere(['like', 'national_registration_number', $this->national_registration_number])
        //     ->andFilterWhere(['like', 'shipping_name', $this->shipping_name])
        //     ->andFilterWhere(['like', 'shipping_address', $this->shipping_address])
        //     ->andFilterWhere(['like', 'shipping_address2', $this->shipping_address2])
        //     ->andFilterWhere(['like', 'shipping_address3', $this->shipping_address3])
        //     ->andFilterWhere(['like', 'shipping_address4', $this->shipping_address4])
        //     ->andFilterWhere(['like', 'shipping_address5', $this->shipping_address5])
        //     ->andFilterWhere(['like', 'shipping_phone', $this->shipping_phone])
        //     ->andFilterWhere(['like', 'shipping_phone2', $this->shipping_phone2])
        //     ->andFilterWhere(['like', 'shipping_city', $this->shipping_city])
        //     ->andFilterWhere(['like', 'shipping_post_code', $this->shipping_post_code])
        //     ->andFilterWhere(['like', 'shipping_country', $this->shipping_country])
        //     ->andFilterWhere(['like', 'shipping_region', $this->shipping_region])
        //     ->andFilterWhere(['like', 'billing_name', $this->billing_name])
        //     ->andFilterWhere(['like', 'billing_addr', $this->billing_addr])
        //     ->andFilterWhere(['like', 'billing_addr2', $this->billing_addr2])
        //     ->andFilterWhere(['like', 'billing_addr3', $this->billing_addr3])
        //     ->andFilterWhere(['like', 'billing_addr4', $this->billing_addr4])
        //     ->andFilterWhere(['like', 'billing_addr5', $this->billing_addr5])
        //     ->andFilterWhere(['like', 'billing_phone', $this->billing_phone])
        //     ->andFilterWhere(['like', 'billing_phone2', $this->billing_phone2])
        //     ->andFilterWhere(['like', 'billing_city', $this->billing_city])
        //     ->andFilterWhere(['like', 'billing_post_code', $this->billing_post_code])
        //     ->andFilterWhere(['like', 'billing_country', $this->billing_country])
        //     ->andFilterWhere(['like', 'tax_code', $this->tax_code])
        //     ->andFilterWhere(['like', 'branch_number', $this->branch_number])
        //     ->andFilterWhere(['like', 'tax_invoice_requested', $this->tax_invoice_requested])
        //     ->andFilterWhere(['like', 'pay_method', $this->pay_method])
        //     ->andFilterWhere(['like', 'item_name', $this->item_name])
        //     ->andFilterWhere(['like', 'variation', $this->variation])
        //     ->andFilterWhere(['like', 'cd_shipping_provider', $this->cd_shipping_provider])
        //     ->andFilterWhere(['like', 'shipping_provider', $this->shipping_provider])
        //     ->andFilterWhere(['like', 'shipment_type_name', $this->shipment_type_name])
        //     ->andFilterWhere(['like', 'shipping_provider_type', $this->shipping_provider_type])
        //     ->andFilterWhere(['like', 'cd_tracking_code', $this->cd_tracking_code])
        //     ->andFilterWhere(['like', 'tracking_code', $this->tracking_code])
        //     ->andFilterWhere(['like', 'tracking_url', $this->tracking_url])
        //     ->andFilterWhere(['like', 'shipping_provider_fm', $this->shipping_provider_fm])
        //     ->andFilterWhere(['like', 'tracking_code_fm', $this->tracking_code_fm])
        //     ->andFilterWhere(['like', 'tracking_url_fm', $this->tracking_url_fm])
        //     ->andFilterWhere(['like', 'promised_shipping_time', $this->promised_shipping_time])
        //     ->andFilterWhere(['like', 'premium', $this->premium])
        //     ->andFilterWhere(['like', 'status', $this->status])
        //     ->andFilterWhere(['like', 'buyer_failed_delivery_return_initiator', $this->buyer_failed_delivery_return_initiator])
        //     ->andFilterWhere(['like', 'buyer_failed_delivery_reason', $this->buyer_failed_delivery_reason])
        //     ->andFilterWhere(['like', 'buyer_failed_delivery_detail', $this->buyer_failed_delivery_detail]);

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
