<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tiktok;

/**
 * TiktokSearch represents the model behind the search form of `app\models\Tiktok`.
 */
class TiktokSearch extends Tiktok
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
            [['id', 'id_file_source', 'quantity', 'sku_unit_original_price', 'sku_subtotal_before_discount', 'sku_platform_discount', 'sku_seller_discount', 'sku_subtotal_after_discount', 'shipping_fee_after_discount', 'original_shipping_fee', 'shipping_fee_platform_discount', 'payment_platform_discount', 'buyer_service_fee', 'taxes', 'order_amount', 'order_refund_amount'], 'integer'],
            [['order_id', 'order_status', 'order_substatus', 'cancelation_return_type', 'normal_or_pre_order', 'sku_id', 'seller_sku', 'product_name', 'variation', 'sku_quantity_of_return', 'shipping_fee_seller_discount', 'created_time', 'paid_time', 'rts_time', 'shipped_time', 'delivered_time', 'cancelled_time', 'cancel_by', 'cancel_reason', 'fulfillment_type', 'warehouse_name', 'tracking_id', 'delivery_option', 'shipping_provider_name', 'buyer_message', 'buyer_username', 'recipient', 'phone', 'zipcode', 'country', 'province', 'regency_and_city', 'districts', 'villages', 'detail_address', 'additional_address_information', 'payment_method', 'weight_kg', 'product_category', 'package_id', 'seller_note', 'checked_status', 'checked_marked_by'], 'safe'],
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
        $query = Tiktok::find();

        $this->load($params);

        if ($this->date_start != null && $this->date_end != null) {
            // Adding the BETWEEN clause to filter by date range
            $query->andFilterWhere(['between', 
                new \yii\db\Expression("STR_TO_DATE(created_time, '%d/%m/%Y')"), 
                $this->date_start, 
                $this->date_end
            ]);
        } else {

            if ($this->date_start != null) {
                $query->andFilterWhere(['>=', 
                    new \yii\db\Expression("STR_TO_DATE(created_time, '%d/%m/%Y')"), 
                    date('Y-m-d', strtotime($this->date_start))
                ]);
            }

            if ($this->date_end != null) {
                $query->andFilterWhere(['<=', 
                    new \yii\db\Expression("STR_TO_DATE(created_time, '%d/%m/%Y')"), 
                    date('Y-m-d', strtotime($this->date_end))
                ]);
            }
        }

        if ($this->status !== null) {
            $statuses = json_decode($this->status, true); // Decode JSON and set `true` for associative array
        
            if (is_array($statuses)) {
                $orConditions = ['or'];
                foreach ($statuses as $_status) {
                    $orConditions[] = ['like', 'order_status', $_status];
                }
                $query->andFilterWhere($orConditions);
            } else {
                $query->andFilterWhere(['like', 'order_status', $this->status]);
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
                ['like', 'order_id', $searchValue],
                ['like', 'order_status', $searchValue],
                // Add more fields that you want to include in the search
            ]);
        }

        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'id_file_source' => $this->id_file_source,
        //     'quantity' => $this->quantity,
        //     'sku_unit_original_price' => $this->sku_unit_original_price,
        //     'sku_subtotal_before_discount' => $this->sku_subtotal_before_discount,
        //     'sku_platform_discount' => $this->sku_platform_discount,
        //     'sku_seller_discount' => $this->sku_seller_discount,
        //     'sku_subtotal_after_discount' => $this->sku_subtotal_after_discount,
        //     'shipping_fee_after_discount' => $this->shipping_fee_after_discount,
        //     'original_shipping_fee' => $this->original_shipping_fee,
        //     'shipping_fee_platform_discount' => $this->shipping_fee_platform_discount,
        //     'payment_platform_discount' => $this->payment_platform_discount,
        //     'buyer_service_fee' => $this->buyer_service_fee,
        //     'taxes' => $this->taxes,
        //     'order_amount' => $this->order_amount,
        //     'order_refund_amount' => $this->order_refund_amount,
        // ]);

        // $query->andFilterWhere(['like', 'order_id', $this->order_id])
        //     ->andFilterWhere(['like', 'order_status', $this->order_status])
        //     ->andFilterWhere(['like', 'order_substatus', $this->order_substatus])
        //     ->andFilterWhere(['like', 'cancelation_return_type', $this->cancelation_return_type])
        //     ->andFilterWhere(['like', 'normal_or_pre_order', $this->normal_or_pre_order])
        //     ->andFilterWhere(['like', 'sku_id', $this->sku_id])
        //     ->andFilterWhere(['like', 'seller_sku', $this->seller_sku])
        //     ->andFilterWhere(['like', 'product_name', $this->product_name])
        //     ->andFilterWhere(['like', 'variation', $this->variation])
        //     ->andFilterWhere(['like', 'sku_quantity_of_return', $this->sku_quantity_of_return])
        //     ->andFilterWhere(['like', 'shipping_fee_seller_discount', $this->shipping_fee_seller_discount])
        //     ->andFilterWhere(['like', 'created_time', $this->created_time])
        //     ->andFilterWhere(['like', 'paid_time', $this->paid_time])
        //     ->andFilterWhere(['like', 'rts_time', $this->rts_time])
        //     ->andFilterWhere(['like', 'shipped_time', $this->shipped_time])
        //     ->andFilterWhere(['like', 'delivered_time', $this->delivered_time])
        //     ->andFilterWhere(['like', 'cancelled_time', $this->cancelled_time])
        //     ->andFilterWhere(['like', 'cancel_by', $this->cancel_by])
        //     ->andFilterWhere(['like', 'cancel_reason', $this->cancel_reason])
        //     ->andFilterWhere(['like', 'fulfillment_type', $this->fulfillment_type])
        //     ->andFilterWhere(['like', 'warehouse_name', $this->warehouse_name])
        //     ->andFilterWhere(['like', 'tracking_id', $this->tracking_id])
        //     ->andFilterWhere(['like', 'delivery_option', $this->delivery_option])
        //     ->andFilterWhere(['like', 'shipping_provider_name', $this->shipping_provider_name])
        //     ->andFilterWhere(['like', 'buyer_message', $this->buyer_message])
        //     ->andFilterWhere(['like', 'buyer_username', $this->buyer_username])
        //     ->andFilterWhere(['like', 'recipient', $this->recipient])
        //     ->andFilterWhere(['like', 'phone', $this->phone])
        //     ->andFilterWhere(['like', 'zipcode', $this->zipcode])
        //     ->andFilterWhere(['like', 'country', $this->country])
        //     ->andFilterWhere(['like', 'province', $this->province])
        //     ->andFilterWhere(['like', 'regency_and_city', $this->regency_and_city])
        //     ->andFilterWhere(['like', 'districts', $this->districts])
        //     ->andFilterWhere(['like', 'villages', $this->villages])
        //     ->andFilterWhere(['like', 'detail_address', $this->detail_address])
        //     ->andFilterWhere(['like', 'additional_address_information', $this->additional_address_information])
        //     ->andFilterWhere(['like', 'payment_method', $this->payment_method])
        //     ->andFilterWhere(['like', 'weight_kg', $this->weight_kg])
        //     ->andFilterWhere(['like', 'product_category', $this->product_category])
        //     ->andFilterWhere(['like', 'package_id', $this->package_id])
        //     ->andFilterWhere(['like', 'seller_note', $this->seller_note])
        //     ->andFilterWhere(['like', 'checked_status', $this->checked_status])
        //     ->andFilterWhere(['like', 'checked_marked_by', $this->checked_marked_by]);

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
