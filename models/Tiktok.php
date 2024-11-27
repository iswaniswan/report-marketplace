<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tiktok".
 *
 * @property int $id
 * @property int|null $id_file_source
 * @property string|null $order_id
 * @property string|null $order_status
 * @property string|null $order_substatus
 * @property string|null $cancelation_return_type
 * @property string|null $normal_or_pre_order
 * @property string|null $sku_id
 * @property string|null $seller_sku
 * @property string|null $product_name
 * @property string|null $variation
 * @property int|null $quantity
 * @property string|null $sku_quantity_of_return
 * @property int|null $sku_unit_original_price
 * @property int|null $sku_subtotal_before_discount
 * @property int|null $sku_platform_discount
 * @property int|null $sku_seller_discount
 * @property int|null $sku_subtotal_after_discount
 * @property int|null $shipping_fee_after_discount
 * @property int|null $original_shipping_fee
 * @property string|null $shipping_fee_seller_discount
 * @property int|null $shipping_fee_platform_discount
 * @property int|null $payment_platform_discount
 * @property int|null $buyer_service_fee
 * @property int|null $taxes
 * @property int|null $order_amount
 * @property int|null $order_refund_amount
 * @property string|null $created_time
 * @property string|null $paid_time
 * @property string|null $rts_time
 * @property string|null $shipped_time
 * @property string|null $delivered_time
 * @property string|null $cancelled_time
 * @property string|null $cancel_by
 * @property string|null $cancel_reason
 * @property string|null $fulfillment_type
 * @property string|null $warehouse_name
 * @property string|null $tracking_id
 * @property string|null $delivery_option
 * @property string|null $shipping_provider_name
 * @property string|null $buyer_message
 * @property string|null $buyer_username
 * @property string|null $recipient
 * @property string|null $phone
 * @property string|null $zipcode
 * @property string|null $country
 * @property string|null $province
 * @property string|null $regency_and_city
 * @property string|null $districts
 * @property string|null $villages
 * @property string|null $detail_address
 * @property string|null $additional_address_information
 * @property string|null $payment_method
 * @property string|null $weight_kg
 * @property string|null $product_category
 * @property string|null $package_id
 * @property string|null $seller_note
 * @property string|null $checked_status
 * @property string|null $checked_marked_by
 */
class Tiktok extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tiktok';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_file_source', 'quantity', 'sku_unit_original_price', 'sku_subtotal_before_discount', 'sku_platform_discount', 'sku_seller_discount', 'sku_subtotal_after_discount', 'shipping_fee_after_discount', 'original_shipping_fee', 'shipping_fee_platform_discount', 'payment_platform_discount', 'buyer_service_fee', 'taxes', 'order_amount', 'order_refund_amount'], 'integer'],
            [['order_status', 'order_substatus', 'cancelation_return_type', 'normal_or_pre_order', 'product_name', 'variation', 'sku_quantity_of_return', 'shipping_fee_seller_discount', 'created_time', 'paid_time', 'rts_time', 'shipped_time', 'delivered_time', 'cancelled_time', 'cancel_by', 'cancel_reason', 'fulfillment_type', 'warehouse_name', 'delivery_option', 'shipping_provider_name', 'buyer_message', 'buyer_username', 'recipient', 'phone', 'zipcode', 'country', 'province', 'regency_and_city', 'districts', 'villages', 'detail_address', 'additional_address_information', 'payment_method', 'weight_kg', 'product_category', 'seller_note', 'checked_status', 'checked_marked_by'], 'string'],
            [['order_id', 'sku_id', 'seller_sku', 'tracking_id', 'package_id'], 'string', 'max' => 255],
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
            'order_id' => 'Order ID',
            'order_status' => 'Order Status',
            'order_substatus' => 'Order Substatus',
            'cancelation_return_type' => 'Cancelation Return Type',
            'normal_or_pre_order' => 'Normal Or Pre Order',
            'sku_id' => 'Sku ID',
            'seller_sku' => 'Seller Sku',
            'product_name' => 'Product Name',
            'variation' => 'Variation',
            'quantity' => 'Quantity',
            'sku_quantity_of_return' => 'Sku Quantity Of Return',
            'sku_unit_original_price' => 'Sku Unit Original Price',
            'sku_subtotal_before_discount' => 'Sku Subtotal Before Discount',
            'sku_platform_discount' => 'Sku Platform Discount',
            'sku_seller_discount' => 'Sku Seller Discount',
            'sku_subtotal_after_discount' => 'Sku Subtotal After Discount',
            'shipping_fee_after_discount' => 'Shipping Fee After Discount',
            'original_shipping_fee' => 'Original Shipping Fee',
            'shipping_fee_seller_discount' => 'Shipping Fee Seller Discount',
            'shipping_fee_platform_discount' => 'Shipping Fee Platform Discount',
            'payment_platform_discount' => 'Payment Platform Discount',
            'buyer_service_fee' => 'Buyer Service Fee',
            'taxes' => 'Taxes',
            'order_amount' => 'Order Amount',
            'order_refund_amount' => 'Order Refund Amount',
            'created_time' => 'Created Time',
            'paid_time' => 'Paid Time',
            'rts_time' => 'Rts Time',
            'shipped_time' => 'Shipped Time',
            'delivered_time' => 'Delivered Time',
            'cancelled_time' => 'Cancelled Time',
            'cancel_by' => 'Cancel By',
            'cancel_reason' => 'Cancel Reason',
            'fulfillment_type' => 'Fulfillment Type',
            'warehouse_name' => 'Warehouse Name',
            'tracking_id' => 'Tracking ID',
            'delivery_option' => 'Delivery Option',
            'shipping_provider_name' => 'Shipping Provider Name',
            'buyer_message' => 'Buyer Message',
            'buyer_username' => 'Buyer Username',
            'recipient' => 'Recipient',
            'phone' => 'Phone',
            'zipcode' => 'Zipcode',
            'country' => 'Country',
            'province' => 'Province',
            'regency_and_city' => 'Regency And City',
            'districts' => 'Districts',
            'villages' => 'Villages',
            'detail_address' => 'Detail Address',
            'additional_address_information' => 'Additional Address Information',
            'payment_method' => 'Payment Method',
            'weight_kg' => 'Weight Kg',
            'product_category' => 'Product Category',
            'package_id' => 'Package ID',
            'seller_note' => 'Seller Note',
            'checked_status' => 'Checked Status',
            'checked_marked_by' => 'Checked Marked By',
        ];
    }

    public static function getListStatus()
    {
        return static::find()
            ->select('order_status')
            ->groupBy('order_status')
            ->column();
    }

    public static function getSummaryByDateRange($date_start, $date_end, $is_total=false)
    {
        $sql = <<<SQL
                SELECT created_time AS tanggal, 
                        sum(jumlah_transaksi) AS jumlah_transaksi, 
                        sum(quantity) AS quantity, 
                        sum(amount_hjp) AS amount_hjp,
                        sum(total_settlement_amount) AS total_settlement_amount,
                        (
                            sum(amount_hjp)-sum(total_settlement_amount)
                        ) AS fee_marketplace
                FROM (
                        SELECT STR_TO_DATE(a.created_time, '%d/%m/%Y') AS created_time,
                            count(DISTINCT a.order_id) AS jumlah_transaksi,
                            sum(a.quantity) AS quantity,
                            (
                                sum(a.sku_subtotal_before_discount)
                                - sum(a.sku_seller_discount)
                            ) AS amount_hjp,
                            0 AS total_settlement_amount 
                        FROM tiktok a 
                        WHERE sku_quantity_of_return = 0
                            AND STR_TO_DATE(a.created_time, '%d/%m/%Y') BETWEEN '$date_start' AND '$date_end'
                        GROUP BY 1
                        UNION ALL
                        SELECT a.created_time, 0 AS jumlah_transaksi, 0 AS quantity, 0 AS amount_hjp, sum(a.total_settlement_amount) AS total_settlement_amount
                            FROM (
                                SELECT DISTINCT a.order_id, STR_TO_DATE(a.created_time, '%d/%m/%Y') AS created_time, 
                                    b.total_settlement_amount
                                FROM tiktok a 
                                LEFT JOIN tiktok_income b ON b.order_adjustment_id = a.order_id
                                WHERE sku_quantity_of_return = 0
                                    AND STR_TO_DATE(a.created_time, '%d/%m/%Y') BETWEEN '$date_start' AND '$date_end'
                        ) a
                        GROUP BY 1, 2
                ) a
                GROUP BY 1
                ORDER BY 1 ASC
        SQL;

        if ($is_total) {
            $sql = <<<SQL
                        SELECT 
                                sum(jumlah_transaksi) AS jumlah_transaksi, 
                                sum(quantity) AS quantity, 
                                sum(amount_hjp) AS amount_hjp,
                                sum(total_settlement_amount) AS total_settlement_amount,
                                (
                                    sum(amount_hjp)-sum(total_settlement_amount)
                                ) AS fee_marketplace
                        FROM (
                                SELECT STR_TO_DATE(a.created_time, '%d/%m/%Y') AS tanggal,
                                    count(DISTINCT a.order_id) AS jumlah_transaksi,
                                    sum(a.quantity) AS quantity,
                                    (
                                        sum(a.sku_subtotal_before_discount)
                                        - sum(a.sku_seller_discount)
                                    ) AS amount_hjp,
                                    0 AS total_settlement_amount 
                                FROM tiktok a 
                                WHERE sku_quantity_of_return = 0 
                                    AND  STR_TO_DATE(a.created_time, '%d/%m/%Y') BETWEEN '$date_start' AND '$date_end'
                                GROUP BY 1
                                UNION ALL
                                SELECT a.created_time, 0 AS jumlah_transaksi, 0 AS quantity, 0 AS amount_hjp, sum(a.total_settlement_amount) AS total_settlement_amount
                                    FROM (
                                        SELECT DISTINCT a.order_id, STR_TO_DATE(a.created_time, '%d/%m/%Y') AS created_time, 
                                            b.total_settlement_amount
                                        FROM tiktok a 
                                        LEFT JOIN tiktok_income b ON b.order_adjustment_id = a.order_id
                                        WHERE sku_quantity_of_return = 0
                                            AND STR_TO_DATE(a.created_time, '%d/%m/%Y') BETWEEN '$date_start' AND '$date_end'
                                ) a                                
                                GROUP BY 1, 2
                        ) a
            SQL;
        }
    
        return Yii::$app->db->createCommand($sql)
            ->queryAll(\PDO::FETCH_OBJ);
    }    


    public static function getCountStatusPesanan($date_start=null, $date_end=null)
    {
        if ($date_start == null) {
            $date_start = date('Y-m-d');
        }

        if ($date_end == null) {
            $date_end = date('Y-m-d');
        }

        $sql = <<<SQL
            SELECT order_status, sum(amount_hjp) AS amount_hjp, count(order_status) AS jumlah
            FROM (
                    SELECT order_id, (
                                    sum(a.sku_subtotal_before_discount) - sum(a.sku_seller_discount)
                                    ) AS amount_hjp, order_status
                    FROM tiktok a
                    WHERE STR_TO_DATE(a.created_time, '%d/%m/%Y') BETWEEN '$date_start' AND '$date_end'
                    GROUP BY 1	
            ) a
            GROUP BY 1
        SQL;

        $command = Yii::$app->db->createCommand($sql);
        return $command->queryAll();
    }


}
