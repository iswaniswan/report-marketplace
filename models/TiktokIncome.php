<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tiktok_income".
 *
 * @property int $id
 * @property int|null $id_file_source
 * @property string|null $order_adjustment_id
 * @property string|null $type
 * @property string|null $order_created_time_utc
 * @property string|null $order_settled_time_utc
 * @property string|null $currency
 * @property int|null $total_settlement_amount
 * @property int|null $total_revenue
 * @property int|null $subtotal_after_seller_discounts
 * @property int|null $subtotal_before_discounts
 * @property int|null $seller_discounts
 * @property int|null $refund_subtotal_after_seller_discounts
 * @property int|null $refund_subtotal_before_seller_discounts
 * @property int|null $refund_of_seller_discounts
 * @property int|null $total_fees
 * @property string|null $tiktok_shop_commission_fee
 * @property int|null $flat_fee
 * @property int|null $sales_fee
 * @property int|null $mall_service_fee
 * @property int|null $payment_fee
 * @property int|null $shipping_cost
 * @property int|null $shipping_costs_passed_on_to_the_logistics_provider
 * @property int|null $shipping_cost_borne_by_the_platform
 * @property int|null $shipping_cost_paid_by_the_customer
 * @property int|null $refunded_shipping_cost_paid_by_the_customer
 * @property int|null $return_shipping_costs_passed_on_to_the_customer
 * @property int|null $shipping_cost_subsidy
 * @property int|null $affiliate_commission
 * @property int|null $affiliate_partner_commission
 * @property int|null $affiliate_shop_ads_commission
 * @property int|null $sfp_service_fee
 * @property int|null $live_specials_service_fee
 * @property int|null $bonus_cashback_service_fee
 * @property int|null $ajustment_amount
 * @property string|null $related_order_id
 * @property string|null $_
 * @property int|null $customer_payment
 * @property int|null $customer_refund
 * @property int|null $seller_co_funded_voucher_discount
 * @property int|null $refund_of_seller_co_funded_voucher_discount
 * @property int|null $platform_discounts
 * @property int|null $refund_of_platform_discounts
 * @property int|null $platform_co_funded_voucher_discounts
 * @property int|null $refund_of_platform_co_funded_voucher_discounts
 * @property int|null $seller_shipping_cost_discount
 * @property int|null $estimated_package_weight_g
 * @property int|null $actual_package_weight_g
 * @property string|null $shopping_center_items
 */
class TiktokIncome extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tiktok_income';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_file_source', 'total_settlement_amount', 'total_revenue', 'subtotal_after_seller_discounts', 'subtotal_before_discounts', 'seller_discounts', 'refund_subtotal_after_seller_discounts', 'refund_subtotal_before_seller_discounts', 'refund_of_seller_discounts', 'total_fees', 'flat_fee', 'sales_fee', 'mall_service_fee', 'payment_fee', 'shipping_cost', 'shipping_costs_passed_on_to_the_logistics_provider', 'shipping_cost_borne_by_the_platform', 'shipping_cost_paid_by_the_customer', 'refunded_shipping_cost_paid_by_the_customer', 'return_shipping_costs_passed_on_to_the_customer', 'shipping_cost_subsidy', 'affiliate_commission', 'affiliate_partner_commission', 'affiliate_shop_ads_commission', 'sfp_service_fee', 'live_specials_service_fee', 'bonus_cashback_service_fee', 'ajustment_amount', 'customer_payment', 'customer_refund', 'seller_co_funded_voucher_discount', 'refund_of_seller_co_funded_voucher_discount', 'platform_discounts', 'refund_of_platform_discounts', 'platform_co_funded_voucher_discounts', 'refund_of_platform_co_funded_voucher_discounts', 'seller_shipping_cost_discount', 'estimated_package_weight_g', 'actual_package_weight_g'], 'integer'],
            [['order_created_time_utc', 'order_settled_time_utc', 'tiktok_shop_commission_fee', '_'], 'string'],
            [['order_adjustment_id', 'type', 'currency', 'related_order_id', 'shopping_center_items'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_file_source' => 'Id File Source',
            'order_adjustment_id' => 'Order Adjustment ID',
            'type' => 'Type',
            'order_created_time_utc' => 'Order Created Time Utc',
            'order_settled_time_utc' => 'Order Settled Time Utc',
            'currency' => 'Currency',
            'total_settlement_amount' => 'Total Settlement Amount',
            'total_revenue' => 'Total Revenue',
            'subtotal_after_seller_discounts' => 'Subtotal After Seller Discounts',
            'subtotal_before_discounts' => 'Subtotal Before Discounts',
            'seller_discounts' => 'Seller Discounts',
            'refund_subtotal_after_seller_discounts' => 'Refund Subtotal After Seller Discounts',
            'refund_subtotal_before_seller_discounts' => 'Refund Subtotal Before Seller Discounts',
            'refund_of_seller_discounts' => 'Refund Of Seller Discounts',
            'total_fees' => 'Total Fees',
            'tiktok_shop_commission_fee' => 'Tiktok Shop Commission Fee',
            'flat_fee' => 'Flat Fee',
            'sales_fee' => 'Sales Fee',
            'mall_service_fee' => 'Mall Service Fee',
            'payment_fee' => 'Payment Fee',
            'shipping_cost' => 'Shipping Cost',
            'shipping_costs_passed_on_to_the_logistics_provider' => 'Shipping Costs Passed On To The Logistics Provider',
            'shipping_cost_borne_by_the_platform' => 'Shipping Cost Borne By The Platform',
            'shipping_cost_paid_by_the_customer' => 'Shipping Cost Paid By The Customer',
            'refunded_shipping_cost_paid_by_the_customer' => 'Refunded Shipping Cost Paid By The Customer',
            'return_shipping_costs_passed_on_to_the_customer' => 'Return Shipping Costs Passed On To The Customer',
            'shipping_cost_subsidy' => 'Shipping Cost Subsidy',
            'affiliate_commission' => 'Affiliate Commission',
            'affiliate_partner_commission' => 'Affiliate Partner Commission',
            'affiliate_shop_ads_commission' => 'Affiliate Shop Ads Commission',
            'sfp_service_fee' => 'Sfp Service Fee',
            'live_specials_service_fee' => 'Live Specials Service Fee',
            'bonus_cashback_service_fee' => 'Bonus Cashback Service Fee',
            'ajustment_amount' => 'Ajustment Amount',
            'related_order_id' => 'Related Order ID',
            '_' => '',
            'customer_payment' => 'Customer Payment',
            'customer_refund' => 'Customer Refund',
            'seller_co_funded_voucher_discount' => 'Seller Co Funded Voucher Discount',
            'refund_of_seller_co_funded_voucher_discount' => 'Refund Of Seller Co Funded Voucher Discount',
            'platform_discounts' => 'Platform Discounts',
            'refund_of_platform_discounts' => 'Refund Of Platform Discounts',
            'platform_co_funded_voucher_discounts' => 'Platform Co Funded Voucher Discounts',
            'refund_of_platform_co_funded_voucher_discounts' => 'Refund Of Platform Co Funded Voucher Discounts',
            'seller_shipping_cost_discount' => 'Seller Shipping Cost Discount',
            'estimated_package_weight_g' => 'Estimated Package Weight G',
            'actual_package_weight_g' => 'Actual Package Weight G',
            'shopping_center_items' => 'Shopping Center Items',
        ];
    }
}
