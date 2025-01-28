<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lazada".
 *
 * @property int $id
 * @property int|null $id_file_source
 * @property string|null $order_item_id
 * @property string|null $order_type
 * @property string|null $guarantee
 * @property string|null $delivery_type
 * @property string|null $lazada_id
 * @property string|null $seller_sku
 * @property string|null $lazada_sku
 * @property string|null $ware_house
 * @property string|null $create_time
 * @property string|null $update_time
 * @property string|null $rts_sla
 * @property string|null $tts_sla
 * @property string|null $order_number
 * @property string|null $invoice_required
 * @property string|null $invoice_number
 * @property string|null $delivered_date
 * @property string|null $customer_name
 * @property string|null $customer_email
 * @property string|null $national_registration_number
 * @property string|null $shipping_name
 * @property string|null $shipping_address
 * @property string|null $shipping_address2
 * @property string|null $shipping_address3
 * @property string|null $shipping_address4
 * @property string|null $shipping_address5
 * @property string|null $shipping_phone
 * @property string|null $shipping_phone2
 * @property string|null $shipping_city
 * @property string|null $shipping_post_code
 * @property string|null $shipping_country
 * @property string|null $shipping_region
 * @property string|null $billing_name
 * @property string|null $billing_addr
 * @property string|null $billing_addr2
 * @property string|null $billing_addr3
 * @property string|null $billing_addr4
 * @property string|null $billing_addr5
 * @property string|null $billing_phone
 * @property string|null $billing_phone2
 * @property string|null $billing_city
 * @property string|null $billing_post_code
 * @property string|null $billing_country
 * @property string|null $tax_code
 * @property string|null $branch_number
 * @property string|null $tax_invoice_requested
 * @property string|null $pay_method
 * @property int|null $paid_price
 * @property int|null $unit_price
 * @property int|null $seller_discount_total
 * @property int|null $shipping_fee
 * @property int|null $wallet_credit
 * @property string|null $item_name
 * @property string|null $variation
 * @property string|null $cd_shipping_provider
 * @property string|null $shipping_provider
 * @property string|null $shipment_type_name
 * @property string|null $shipping_provider_type
 * @property string|null $cd_tracking_code
 * @property string|null $tracking_code
 * @property string|null $tracking_url
 * @property string|null $shipping_provider_fm
 * @property string|null $tracking_code_fm
 * @property string|null $tracking_url_fm
 * @property string|null $promised_shipping_time
 * @property string|null $premium
 * @property string|null $status
 * @property string|null $buyer_failed_delivery_return_initiator
 * @property string|null $buyer_failed_delivery_reason
 * @property string|null $buyer_failed_delivery_detail
 */
class Lazada extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lazada';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_file_source', 'paid_price', 'unit_price', 'seller_discount_total', 'shipping_fee', 'wallet_credit'], 'integer'],
            [['order_item_id', 'order_type', 'guarantee', 'delivery_type', 'lazada_id', 'seller_sku', 'lazada_sku', 'ware_house', 'create_time', 'update_time', 'rts_sla', 'tts_sla', 'order_number', 'invoice_required', 'invoice_number', 'delivered_date', 'customer_name', 'customer_email', 'national_registration_number', 'shipping_name', 'shipping_address', 'shipping_address2', 'shipping_address3', 'shipping_address4', 'shipping_address5', 'shipping_phone', 'shipping_phone2', 'shipping_city', 'shipping_post_code', 'shipping_country', 'shipping_region', 'billing_name', 'billing_addr', 'billing_addr2', 'billing_addr3', 'billing_addr4', 'billing_addr5', 'billing_phone', 'billing_phone2', 'billing_city', 'billing_post_code', 'billing_country', 'tax_code', 'branch_number', 'tax_invoice_requested', 'pay_method', 'item_name', 'variation', 'cd_shipping_provider', 'shipping_provider', 'shipment_type_name', 'shipping_provider_type', 'cd_tracking_code', 'tracking_code', 'tracking_url', 'shipping_provider_fm', 'tracking_code_fm', 'tracking_url_fm', 'promised_shipping_time', 'premium', 'status', 'buyer_failed_delivery_return_initiator', 'buyer_failed_delivery_reason', 'buyer_failed_delivery_detail'], 'string', 'max' => 255],
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
            'order_item_id' => 'Order Item ID',
            'order_type' => 'Order Type',
            'guarantee' => 'Guarantee',
            'delivery_type' => 'Delivery Type',
            'lazada_id' => 'Lazada ID',
            'seller_sku' => 'Seller Sku',
            'lazada_sku' => 'Lazada Sku',
            'ware_house' => 'Ware House',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'rts_sla' => 'Rts Sla',
            'tts_sla' => 'Tts Sla',
            'order_number' => 'Order Number',
            'invoice_required' => 'Invoice Required',
            'invoice_number' => 'Invoice Number',
            'delivered_date' => 'Delivered Date',
            'customer_name' => 'Customer Name',
            'customer_email' => 'Customer Email',
            'national_registration_number' => 'National Registration Number',
            'shipping_name' => 'Shipping Name',
            'shipping_address' => 'Shipping Address',
            'shipping_address2' => 'Shipping Address2',
            'shipping_address3' => 'Shipping Address3',
            'shipping_address4' => 'Shipping Address4',
            'shipping_address5' => 'Shipping Address5',
            'shipping_phone' => 'Shipping Phone',
            'shipping_phone2' => 'Shipping Phone2',
            'shipping_city' => 'Shipping City',
            'shipping_post_code' => 'Shipping Post Code',
            'shipping_country' => 'Shipping Country',
            'shipping_region' => 'Shipping Region',
            'billing_name' => 'Billing Name',
            'billing_addr' => 'Billing Addr',
            'billing_addr2' => 'Billing Addr2',
            'billing_addr3' => 'Billing Addr3',
            'billing_addr4' => 'Billing Addr4',
            'billing_addr5' => 'Billing Addr5',
            'billing_phone' => 'Billing Phone',
            'billing_phone2' => 'Billing Phone2',
            'billing_city' => 'Billing City',
            'billing_post_code' => 'Billing Post Code',
            'billing_country' => 'Billing Country',
            'tax_code' => 'Tax Code',
            'branch_number' => 'Branch Number',
            'tax_invoice_requested' => 'Tax Invoice Requested',
            'pay_method' => 'Pay Method',
            'paid_price' => 'Paid Price',
            'unit_price' => 'Unit Price',
            'seller_discount_total' => 'Seller Discount Total',
            'shipping_fee' => 'Shipping Fee',
            'wallet_credit' => 'Wallet Credit',
            'item_name' => 'Item Name',
            'variation' => 'Variation',
            'cd_shipping_provider' => 'Cd Shipping Provider',
            'shipping_provider' => 'Shipping Provider',
            'shipment_type_name' => 'Shipment Type Name',
            'shipping_provider_type' => 'Shipping Provider Type',
            'cd_tracking_code' => 'Cd Tracking Code',
            'tracking_code' => 'Tracking Code',
            'tracking_url' => 'Tracking Url',
            'shipping_provider_fm' => 'Shipping Provider Fm',
            'tracking_code_fm' => 'Tracking Code Fm',
            'tracking_url_fm' => 'Tracking Url Fm',
            'promised_shipping_time' => 'Promised Shipping Time',
            'premium' => 'Premium',
            'status' => 'Status',
            'buyer_failed_delivery_return_initiator' => 'Buyer Failed Delivery Return Initiator',
            'buyer_failed_delivery_reason' => 'Buyer Failed Delivery Reason',
            'buyer_failed_delivery_detail' => 'Buyer Failed Delivery Detail',
        ];
    }

    public static function getListStatus()
    {
        return static::find()
            ->select('status')
            ->groupBy('status')
            ->column();
    }

    public static function getSummaryByDateRange($date_start, $date_end, $is_total=false, $is_yearly=false)
    {
        // $sql = <<<SQL
        //     WITH CTE AS (
        //                 SELECT 
        //                     create_time, jumlah_transaksi, jumlah, unit_price, seller_discount_total, (unit_price + seller_discount_total) AS amount_hjp, 
        //                     payment_fee,
        //                     item_price_credit,
        //                     commission,
        //                     promotional_charges_vouchers,
        //                     free_shipping_max_fee,
        //                     campaign_fee,
        //                     lazcoins_discount_promotion_fee,
        //                     (
        //                         payment_fee + commission + promotional_charges_vouchers + free_shipping_max_fee + campaign_fee + lazcoins_discount_promotion_fee
        //                     ) AS fee_marketplace,
        //                     (unit_price + seller_discount_total) + 
        //                     (
        //                         payment_fee + commission + promotional_charges_vouchers + free_shipping_max_fee + campaign_fee + lazcoins_discount_promotion_fee
        //                     ) AS amount_net
        //                 FROM (
        //                     SELECT 
        //                         STR_TO_DATE(create_time, '%d %M %Y') create_time, 
        //                         order_number, 
        //                         count(DISTINCT order_number) AS jumlah_transaksi,
        //                         count(order_number) AS jumlah,
        //                         sum(unit_price) unit_price, sum(seller_discount_total) seller_discount_total  
        //                     FROM lazada
        //                     WHERE status = 'confirmed'
        //                         AND STR_TO_DATE(create_time, '%d %b %Y') BETWEEN '$date_start' AND '$date_end'
        //                     GROUP BY 1
        //                 ) a
        //                 INNER JOIN (
        //                     SELECT
        //                         order_number,
        //                         SUM(CASE WHEN fee_name = 'Payment Fee' THEN CAST(amount_include_tax AS SIGNED) ELSE 0 END) AS payment_fee,
        //                         SUM(CASE WHEN fee_name = 'Item Price Credit' THEN CAST(amount_include_tax AS SIGNED) ELSE 0 END) AS item_price_credit,
        //                         SUM(CASE WHEN fee_name = 'Commission' THEN CAST(amount_include_tax AS SIGNED) ELSE 0 END) AS commission,
        //                         SUM(CASE WHEN fee_name = 'Promotional Charges Vouchers' THEN CAST(amount_include_tax AS SIGNED) ELSE 0 END) AS promotional_charges_vouchers,
        //                         SUM(CASE WHEN fee_name = 'Free Shipping Max Fee' THEN CAST(amount_include_tax AS SIGNED) ELSE 0 END) AS free_shipping_max_fee,
        //                         SUM(CASE WHEN fee_name = 'Campaign Fee' THEN CAST(amount_include_tax AS SIGNED) ELSE 0 END) AS campaign_fee,
        //                         SUM(CASE WHEN fee_name = 'LazCoins Discount Promotion Fee' THEN CAST(amount_include_tax AS SIGNED) ELSE 0 END) AS lazcoins_discount_promotion_fee
        //                     FROM lazada_income
        //                     WHERE STR_TO_DATE(order_creation_date, '%d %b %Y') BETWEEN '$date_start' AND '$date_end'
        //                     GROUP BY 1
        //                     ORDER BY 1
        //                 ) b ON b.order_number = a.order_number
        //                 ORDER BY 1
        //         ) 
        //         SELECT 
        //             create_time tanggal, 
        //             sum(jumlah_transaksi) jumlah_transaksi, 
        //             sum(jumlah) quantity, 
        //             sum(amount_hjp) amount_hjp, 
        //             sum(fee_marketplace) fee_marketplace, 
        //             sum(amount_net) amount_net
        //         FROM CTE a
        //         GROUP BY 1
        //         ORDER BY 1 ASC
        // SQL;

        // if ($is_total) {
        //     $sql = <<<SQL
        //         WITH CTE AS (
        //                 SELECT 
        //                     create_time, jumlah_transaksi, jumlah, unit_price, seller_discount_total, (unit_price + seller_discount_total) AS amount_hjp, 
        //                     payment_fee,
        //                     item_price_credit,
        //                     commission,
        //                     promotional_charges_vouchers,
        //                     free_shipping_max_fee,
        //                     campaign_fee,
        //                     lazcoins_discount_promotion_fee,
        //                     (
        //                         payment_fee + commission + promotional_charges_vouchers + free_shipping_max_fee + campaign_fee + lazcoins_discount_promotion_fee
        //                     ) AS fee_marketplace,
        //                     (unit_price + seller_discount_total) + 
        //                     (
        //                         payment_fee + commission + promotional_charges_vouchers + free_shipping_max_fee + campaign_fee + lazcoins_discount_promotion_fee
        //                     ) AS amount_net
        //                 FROM (
        //                     SELECT 
        //                         STR_TO_DATE(create_time, '%d %M %Y') create_time, 
        //                         order_number, 
        //                         count(DISTINCT order_number) AS jumlah_transaksi,
        //                         count(order_number) AS jumlah,
        //                         sum(unit_price) unit_price, sum(seller_discount_total) seller_discount_total  
        //                     FROM lazada
        //                     WHERE status = 'confirmed'
        //                         AND STR_TO_DATE(create_time, '%d %b %Y') BETWEEN '$date_start' AND '$date_end'
        //                     GROUP BY 1
        //                 ) a
        //                 INNER JOIN (
        //                     SELECT
        //                         order_number,
        //                         SUM(CASE WHEN fee_name = 'Payment Fee' THEN CAST(amount_include_tax AS SIGNED) ELSE 0 END) AS payment_fee,
        //                         SUM(CASE WHEN fee_name = 'Item Price Credit' THEN CAST(amount_include_tax AS SIGNED) ELSE 0 END) AS item_price_credit,
        //                         SUM(CASE WHEN fee_name = 'Commission' THEN CAST(amount_include_tax AS SIGNED) ELSE 0 END) AS commission,
        //                         SUM(CASE WHEN fee_name = 'Promotional Charges Vouchers' THEN CAST(amount_include_tax AS SIGNED) ELSE 0 END) AS promotional_charges_vouchers,
        //                         SUM(CASE WHEN fee_name = 'Free Shipping Max Fee' THEN CAST(amount_include_tax AS SIGNED) ELSE 0 END) AS free_shipping_max_fee,
        //                         SUM(CASE WHEN fee_name = 'Campaign Fee' THEN CAST(amount_include_tax AS SIGNED) ELSE 0 END) AS campaign_fee,
        //                         SUM(CASE WHEN fee_name = 'LazCoins Discount Promotion Fee' THEN CAST(amount_include_tax AS SIGNED) ELSE 0 END) AS lazcoins_discount_promotion_fee
        //                     FROM lazada_income
        //                     WHERE STR_TO_DATE(order_creation_date, '%d %b %Y') BETWEEN '$date_start' AND '$date_end'
        //                     GROUP BY 1
        //                     ORDER BY 1
        //                 ) b ON b.order_number = a.order_number
        //                 ORDER BY 1
        //         ) 
        //         SELECT 
        //             sum(jumlah_transaksi) jumlah_transaksi, 
        //             sum(jumlah) quantity, 
        //             sum(amount_hjp) amount_hjp, 
        //             abs(sum(fee_marketplace)) fee_marketplace, 
        //             sum(amount_net) amount_net
        //         FROM CTE a
        //     SQL;
        // }

        /** versi 2 */
        $cte = <<<SQL
                    WITH CTE AS (
                                SELECT 
                                    create_time, jumlah_transaksi, jumlah, unit_price, seller_discount_total, (unit_price + promotional_charges_vouchers) AS amount_hjp, 
                                    payment_fee,
                                    item_price_credit,
                                    commission,
                                    promotional_charges_vouchers,
                                    free_shipping_max_fee,
                                    campaign_fee,
                                    lazcoins_discount_promotion_fee,
                                    (
                                        payment_fee + item_price_credit + commission + promotional_charges_vouchers + free_shipping_max_fee + campaign_fee + lazcoins_discount_promotion_fee
                                    ) AS amount_net,
                                    amount_net_2
                                FROM (
                                        SELECT
                                            STR_TO_DATE(create_time, '%d %b %Y') create_time, 
                                            order_number,
                                            status,
                                            count(DISTINCT order_number) AS jumlah_transaksi,
                                            count(order_number) AS jumlah,
                                            sum(unit_price) unit_price, sum(seller_discount_total) seller_discount_total
                                        FROM lazada
                                        WHERE (status = 'confirmed' OR lower(status) = 'dikonfirmasi')
                                            AND STR_TO_DATE(create_time, '%d %b %Y') BETWEEN '$date_start' AND '$date_end'
                                        GROUP BY 1, 2, 3
                                ) a
                                INNER JOIN (
                                        SELECT
                                            order_number,
                                            SUM(
                                                CASE 
                                                    WHEN trim(fee_name)= 'Payment Fee' OR REPLACE(REPLACE(fee_name, CHAR(13), ''), CHAR(10), '') = 'Biaya Transaksi'
                                                        THEN CAST(amount_include_tax AS SIGNED) 
                                                    ELSE 0 
                                                END
                                            ) AS payment_fee,
                                            SUM(
                                                CASE 
                                                    WHEN fee_name = 'Item Price Credit' OR trim(fee_name) = 'Omset Penjualan'
                                                        THEN CAST(amount_include_tax AS SIGNED) 
                                                    ELSE 0 
                                                END
                                            ) AS item_price_credit,
                                            SUM(
                                                CASE 
                                                    WHEN fee_name = 'Commission' OR fee_name = 'Komisi' 
                                                        THEN CAST(amount_include_tax AS SIGNED) 
                                                    ELSE 0 
                                                END
                                            ) AS commission,
                                            SUM(
                                                CASE 
                                                    WHEN fee_name = 'Promotional Charges Vouchers' OR trim(fee_name) = 'Biaya Promosi Voucher' 
                                                        THEN CAST(amount_include_tax AS SIGNED) 
                                                    ELSE 0 
                                                END
                                            ) AS promotional_charges_vouchers,
                                            SUM(
                                                CASE 
                                                    WHEN fee_name = 'Free Shipping Max Fee' 
                                                        THEN CAST(amount_include_tax AS SIGNED) 
                                                    ELSE 0 
                                                END
                                            ) AS free_shipping_max_fee,
                                            SUM(
                                                CASE
                                                    WHEN fee_name = 'Campaign Fee' 
                                                        THEN CAST(amount_include_tax AS SIGNED) 
                                                    ELSE 0 
                                                END
                                            ) AS campaign_fee,
                                            SUM(
                                                CASE 
                                                    WHEN fee_name = 'LazCoins Discount Promotion Fee' OR trim(fee_name) = 'Biaya Promosi Diskon LazKoin'
                                                        THEN CAST(amount_include_tax AS SIGNED) 
                                                    ELSE 0 
                                                END
                                            ) AS lazcoins_discount_promotion_fee
                                        FROM lazada_income
                                        WHERE STR_TO_DATE(order_creation_date, '%d %b %Y') BETWEEN '$date_start' AND '$date_end'
                                            GROUP BY 1
                                            ORDER BY 1
                                    ) b ON b.order_number = a.order_number
                                    INNER JOIN (
                                        SELECT order_number, sum(amount_include_tax) AS amount_net_2
                                        FROM lazada_income
                                        WHERE STR_TO_DATE(order_creation_date, '%d %b %Y') BETWEEN '$date_start' AND '$date_end'
                                        GROUP BY 1
                                    ) c ON c.order_number = a.order_number
                                    ORDER BY 1
                            ) 
        SQL;

        $sql = <<<SQL
                    $cte
                    SELECT 
                        create_time tanggal, 
                        sum(jumlah_transaksi) jumlah_transaksi, 
                        sum(jumlah) quantity, 
                        sum(amount_hjp) amount_hjp,  
                        sum(amount_net_2) amount_net,
                        (sum(amount_hjp) - sum(amount_net)) AS fee_marketplace
                    FROM CTE a
                    GROUP BY 1
                    ORDER BY 1 ASC
        SQL;

        if ($is_yearly) {
            $sql = <<<SQL
                    $cte
                    SELECT 
                        DATE_FORMAT(STR_TO_DATE(CONCAT(create_time, '-01'), '%Y-%m-%d'), '%m') AS tanggal,
                        sum(jumlah_transaksi) jumlah_transaksi, 
                        sum(jumlah) quantity, 
                        sum(amount_hjp) amount_hjp,  
                        sum(amount_net_2) amount_net,
                        (sum(amount_hjp) - sum(amount_net)) AS fee_marketplace
                    FROM CTE a
                    GROUP BY 1
                    ORDER BY 1 ASC
            SQL;
        }

        if ($is_total) {
            $sql = <<<SQL
                        $cte
                        SELECT 
                            sum(jumlah_transaksi) jumlah_transaksi, 
                            sum(jumlah) quantity, 
                            sum(amount_hjp) amount_hjp,  
                            sum(amount_net_2) amount_net,
                            (sum(amount_hjp) - sum(amount_net_2)) AS fee_marketplace
                        FROM CTE a
            SQL;
        }

        $command = Yii::$app->db->createCommand($sql);
        return $command->queryAll();
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
            WITH CTE AS (
                SELECT 
                    CASE
                        WHEN LOWER(status) NOT LIKE '%confirmed%' AND LOWER(status) NOT LIKE '%delivered%' AND LOWER(status) NOT LIKE '%shipped%' THEN 'canceled'
                        ELSE status
                    END AS status,
                    sum(a.unit_price + a.seller_discount_total) amount_hjp,
                    count(a.status) AS jumlah
                FROM lazada a
                WHERE STR_TO_DATE(a.create_time, '%d %b %Y') BETWEEN '$date_start' AND '$date_end'
                GROUP BY 1
            )
            SELECT 
                CASE
                    WHEN LOWER(status) LIKE '%delivered%' THEN 'Sedang Dikirim'
                    WHEN LOWER(status) LIKE '%shipped%' THEN 'Sedang Dikirim'
                    ELSE status
                END AS status, sum(amount_hjp) AS amount_hjp, sum(jumlah) AS jumlah
            FROM CTE a
            GROUP BY 1
        SQL;

        $command = Yii::$app->db->createCommand($sql);
        return $command->queryAll();
    }

    public static function getExportAll($date_start, $date_end, $status)
    {
        $query = static::find();
        $query->andFilterWhere(['between', 
                new \yii\db\Expression("STR_TO_DATE(create_time, '%d %b %Y')"), 
                $date_start, 
                $date_end
            ]);

        if ($status !== null) {
            $statuses = json_decode($status, true); // Decode JSON and set `true` for associative array
        
            if (is_array($statuses)) {
                $orConditions = ['or'];
                foreach ($statuses as $_status) {
                    $orConditions[] = ['like', 'status', $_status];
                }
                $query->andFilterWhere($orConditions);
            } else {
                $query->andFilterWhere(['like', 'status', $status]);
            }
        }

        return $query;        
    }

}
