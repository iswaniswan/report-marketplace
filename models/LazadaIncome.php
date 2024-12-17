<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lazada_income".
 *
 * @property int $id
 * @property int|null $id_file_source
 * @property string|null $statement_period
 * @property string|null $statement_number
 * @property string|null $transaction_date
 * @property string|null $fee_name
 * @property int|null $amount_include_tax
 * @property int|null $vat_amount
 * @property string|null $release_status
 * @property string|null $release_date
 * @property string|null $comment
 * @property string|null $order_creation_date
 * @property string|null $order_number
 * @property string|null $order_line_id
 * @property string|null $seller_sku
 * @property string|null $lazada_sku
 * @property int|null $wht_amount
 * @property string|null $wht_included_in_amount
 * @property string|null $order_status
 * @property string|null $product_name
 */
class LazadaIncome extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lazada_income';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_file_source', 'amount_include_tax', 'vat_amount', 'wht_amount'], 'integer'],
            [['statement_period', 'statement_number', 'transaction_date', 'fee_name', 'release_status', 'release_date', 'comment', 'order_creation_date', 'order_number', 'order_line_id', 'seller_sku', 'lazada_sku', 'wht_included_in_amount', 'order_status', 'product_name'], 'string', 'max' => 255],
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
            'statement_period' => 'Statement Period',
            'statement_number' => 'Statement Number',
            'transaction_date' => 'Transaction Date',
            'fee_name' => 'Fee Name',
            'amount_include_tax' => 'Amount Include Tax',
            'vat_amount' => 'Vat Amount',
            'release_status' => 'Release Status',
            'release_date' => 'Release Date',
            'comment' => 'Comment',
            'order_creation_date' => 'Order Creation Date',
            'order_number' => 'Order Number',
            'order_line_id' => 'Order Line ID',
            'seller_sku' => 'Seller Sku',
            'lazada_sku' => 'Lazada Sku',
            'wht_amount' => 'Wht Amount',
            'wht_included_in_amount' => 'Wht Included In Amount',
            'order_status' => 'Order Status',
            'product_name' => 'Product Name',
        ];
    }

    public static function getListStatus()
    {
        return static::find()
            ->select('order_status')
            ->groupBy('order_status')
            ->column();
    }

    public static function getExportAll($date_start, $date_end, $status)
    {
        $query = static::find();
        $query->andFilterWhere(['between', 
                new \yii\db\Expression("STR_TO_DATE(order_creation_date, '%d %b %Y')"), 
                $date_start, 
                $date_end
            ]);

        if ($status !== null) {
            $statuses = json_decode($status, true); // Decode JSON and set `true` for associative array
        
            if (is_array($statuses)) {
                $orConditions = ['or'];
                foreach ($statuses as $_status) {
                    $orConditions[] = ['like', 'order_status', $_status];
                }
                $query->andFilterWhere($orConditions);
            } else {
                $query->andFilterWhere(['like', 'order_status', $status]);
            }
        }

        return $query;        
    }

}
