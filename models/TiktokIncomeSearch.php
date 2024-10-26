<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TiktokIncome;

/**
 * TiktokIncomeSearch represents the model behind the search form of `app\models\TiktokIncome`.
 */
class TiktokIncomeSearch extends TiktokIncome
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
            [['id', 'id_file_source', 'total_settlement_amount', 'total_revenue', 'subtotal_after_seller_discounts', 'subtotal_before_discounts', 'seller_discounts', 'refund_subtotal_after_seller_discounts', 'refund_subtotal_before_seller_discounts', 'refund_of_seller_discounts', 'total_fees', 'flat_fee', 'sales_fee', 'mall_service_fee', 'payment_fee', 'shipping_cost', 'shipping_costs_passed_on_to_the_logistics_provider', 'shipping_cost_borne_by_the_platform', 'shipping_cost_paid_by_the_customer', 'refunded_shipping_cost_paid_by_the_customer', 'return_shipping_costs_passed_on_to_the_customer', 'shipping_cost_subsidy', 'affiliate_commission', 'affiliate_partner_commission', 'affiliate_shop_ads_commission', 'sfp_service_fee', 'live_specials_service_fee', 'bonus_cashback_service_fee', 'ajustment_amount', 'customer_payment', 'customer_refund', 'seller_co_funded_voucher_discount', 'refund_of_seller_co_funded_voucher_discount', 'platform_discounts', 'refund_of_platform_discounts', 'platform_co_funded_voucher_discounts', 'refund_of_platform_co_funded_voucher_discounts', 'seller_shipping_cost_discount', 'estimated_package_weight_g', 'actual_package_weight_g'], 'integer'],
            [['order_adjustment_id', 'type', 'order_created_time_utc', 'order_settled_time_utc', 'currency', 'tiktok_shop_commission_fee', 'related_order_id', '_', 'shopping_center_items'], 'safe'],
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
        $query = TiktokIncome::find();

        $this->load($params);

        if ($this->date_start != null && $this->date_end != null) {
            // Adding the BETWEEN clause to filter by date range
            $query->andFilterWhere(['between', 
                new \yii\db\Expression("STR_TO_DATE(order_created_time_utc, '%Y/%m/%d')"), 
                $this->date_start, 
                $this->date_end
            ]);
        } else {

            if ($this->date_start != null) {
                $query->andFilterWhere(['>=', 
                    new \yii\db\Expression("STR_TO_DATE(order_created_time_utc, '%Y/%m/%d')"), 
                    date('Y-m-d', strtotime($this->date_start))
                ]);
            }

            if ($this->date_end != null) {
                $query->andFilterWhere(['<=', 
                    new \yii\db\Expression("STR_TO_DATE(order_created_time_utc, '%Y/%m/%d')"), 
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
            'id_file_source' => $this->id_file_source,
        ]);

        if (!empty($params['search']['value'])) {
            $searchValue = $params['search']['value'];
            $query->andFilterWhere(['or',
                ['like', 'order_adjustment_id', $searchValue],
                // Add more fields that you want to include in the search
            ]);
        }

        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'id_file_source' => $this->id_file_source,
        //     'total_settlement_amount' => $this->total_settlement_amount,
        //     'total_revenue' => $this->total_revenue,
        //     'subtotal_after_seller_discounts' => $this->subtotal_after_seller_discounts,
        //     'subtotal_before_discounts' => $this->subtotal_before_discounts,
        //     'seller_discounts' => $this->seller_discounts,
        //     'refund_subtotal_after_seller_discounts' => $this->refund_subtotal_after_seller_discounts,
        //     'refund_subtotal_before_seller_discounts' => $this->refund_subtotal_before_seller_discounts,
        //     'refund_of_seller_discounts' => $this->refund_of_seller_discounts,
        //     'total_fees' => $this->total_fees,
        //     'flat_fee' => $this->flat_fee,
        //     'sales_fee' => $this->sales_fee,
        //     'mall_service_fee' => $this->mall_service_fee,
        //     'payment_fee' => $this->payment_fee,
        //     'shipping_cost' => $this->shipping_cost,
        //     'shipping_costs_passed_on_to_the_logistics_provider' => $this->shipping_costs_passed_on_to_the_logistics_provider,
        //     'shipping_cost_borne_by_the_platform' => $this->shipping_cost_borne_by_the_platform,
        //     'shipping_cost_paid_by_the_customer' => $this->shipping_cost_paid_by_the_customer,
        //     'refunded_shipping_cost_paid_by_the_customer' => $this->refunded_shipping_cost_paid_by_the_customer,
        //     'return_shipping_costs_passed_on_to_the_customer' => $this->return_shipping_costs_passed_on_to_the_customer,
        //     'shipping_cost_subsidy' => $this->shipping_cost_subsidy,
        //     'affiliate_commission' => $this->affiliate_commission,
        //     'affiliate_partner_commission' => $this->affiliate_partner_commission,
        //     'affiliate_shop_ads_commission' => $this->affiliate_shop_ads_commission,
        //     'sfp_service_fee' => $this->sfp_service_fee,
        //     'live_specials_service_fee' => $this->live_specials_service_fee,
        //     'bonus_cashback_service_fee' => $this->bonus_cashback_service_fee,
        //     'ajustment_amount' => $this->ajustment_amount,
        //     'customer_payment' => $this->customer_payment,
        //     'customer_refund' => $this->customer_refund,
        //     'seller_co_funded_voucher_discount' => $this->seller_co_funded_voucher_discount,
        //     'refund_of_seller_co_funded_voucher_discount' => $this->refund_of_seller_co_funded_voucher_discount,
        //     'platform_discounts' => $this->platform_discounts,
        //     'refund_of_platform_discounts' => $this->refund_of_platform_discounts,
        //     'platform_co_funded_voucher_discounts' => $this->platform_co_funded_voucher_discounts,
        //     'refund_of_platform_co_funded_voucher_discounts' => $this->refund_of_platform_co_funded_voucher_discounts,
        //     'seller_shipping_cost_discount' => $this->seller_shipping_cost_discount,
        //     'estimated_package_weight_g' => $this->estimated_package_weight_g,
        //     'actual_package_weight_g' => $this->actual_package_weight_g,
        // ]);

        // $query->andFilterWhere(['like', 'order_adjustment_id', $this->order_adjustment_id])
        //     ->andFilterWhere(['like', 'type', $this->type])
        //     ->andFilterWhere(['like', 'order_created_time_utc', $this->order_created_time_utc])
        //     ->andFilterWhere(['like', 'order_settled_time_utc', $this->order_settled_time_utc])
        //     ->andFilterWhere(['like', 'currency', $this->currency])
        //     ->andFilterWhere(['like', 'tiktok_shop_commission_fee', $this->tiktok_shop_commission_fee])
        //     ->andFilterWhere(['like', 'related_order_id', $this->related_order_id])
        //     ->andFilterWhere(['like', '_', $this->_])
        //     ->andFilterWhere(['like', 'shopping_center_items', $this->shopping_center_items]);

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
