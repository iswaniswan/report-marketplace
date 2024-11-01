<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Offline;

/**
 * OfflineSearch represents the model behind the search form of `app\models\Offline`.
 */
class OfflineSearch extends Offline
{
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

        // add conditions that should always apply here

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'quantity' => $this->quantity,
            'harga_satuan' => $this->harga_satuan,
            'subtotal' => $this->subtotal,
            'adjustment' => $this->adjustment,
        ]);

        $query->andFilterWhere(['like', 'no_invoice', $this->no_invoice])
            ->andFilterWhere(['like', 'tanggal_invoice', $this->tanggal_invoice])
            ->andFilterWhere(['like', 'nama_customer', $this->nama_customer])
            ->andFilterWhere(['like', 'alamat_customer', $this->alamat_customer])
            ->andFilterWhere(['like', 'no_hp_customer', $this->no_hp_customer])
            ->andFilterWhere(['like', 'kode_sku', $this->kode_sku])
            ->andFilterWhere(['like', 'nama_barang', $this->nama_barang])
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

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}
