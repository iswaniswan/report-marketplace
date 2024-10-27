<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TokopediaKeuangan;

/**
 * TokopediaKeuanganSearch represents the model behind the search form of `app\models\TokopediaKeuangan`.
 */
class TokopediaKeuanganSearch extends TokopediaKeuangan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_file_source', 'nomor', 'jumlah_produk_dibeli', 'harga_jual_idr', 'jumlah_subsidi_tokopedia_idr', 'nilai_kupon_toko_terpakai_idr', 'jumlah_produk_yang_dikurangkan', 'total_pengurangan_idr', 'biaya_layanan_termasuk_ppn_dan_pph_idr', 'biaya_layanan_di_luar_ppn_dan_pph_idr', 'ppn_idr', 'pph_idr'], 'integer'],
            [['nomor_invoice', 'tanggal_pembayaran', 'status_terakhir', 'tanggal_pesanan_selesai', 'waktu_pesanan_selesai', 'tanggal_pesanan_dibatalkan', 'waktu_pesanan_dibatalkan', 'nama_produk', 'jenis_kupon_toko_terpakai', 'kode_kupon_toko_yang_digunakan', 'nama_biaya_layanan', 'persentase_biaya_layanan'], 'safe'],
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
        $query = TokopediaKeuangan::find();

        $this->load($params);

        // add conditions that should always apply here

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_file_source' => $this->id_file_source,
            'nomor' => $this->nomor,
            'jumlah_produk_dibeli' => $this->jumlah_produk_dibeli,
            'harga_jual_idr' => $this->harga_jual_idr,
            'jumlah_subsidi_tokopedia_idr' => $this->jumlah_subsidi_tokopedia_idr,
            'nilai_kupon_toko_terpakai_idr' => $this->nilai_kupon_toko_terpakai_idr,
            'jumlah_produk_yang_dikurangkan' => $this->jumlah_produk_yang_dikurangkan,
            'total_pengurangan_idr' => $this->total_pengurangan_idr,
            'biaya_layanan_termasuk_ppn_dan_pph_idr' => $this->biaya_layanan_termasuk_ppn_dan_pph_idr,
            'biaya_layanan_di_luar_ppn_dan_pph_idr' => $this->biaya_layanan_di_luar_ppn_dan_pph_idr,
            'ppn_idr' => $this->ppn_idr,
            'pph_idr' => $this->pph_idr,
        ]);

        $query->andFilterWhere(['like', 'nomor_invoice', $this->nomor_invoice])
            ->andFilterWhere(['like', 'tanggal_pembayaran', $this->tanggal_pembayaran])
            ->andFilterWhere(['like', 'status_terakhir', $this->status_terakhir])
            ->andFilterWhere(['like', 'tanggal_pesanan_selesai', $this->tanggal_pesanan_selesai])
            ->andFilterWhere(['like', 'waktu_pesanan_selesai', $this->waktu_pesanan_selesai])
            ->andFilterWhere(['like', 'tanggal_pesanan_dibatalkan', $this->tanggal_pesanan_dibatalkan])
            ->andFilterWhere(['like', 'waktu_pesanan_dibatalkan', $this->waktu_pesanan_dibatalkan])
            ->andFilterWhere(['like', 'nama_produk', $this->nama_produk])
            ->andFilterWhere(['like', 'jenis_kupon_toko_terpakai', $this->jenis_kupon_toko_terpakai])
            ->andFilterWhere(['like', 'kode_kupon_toko_yang_digunakan', $this->kode_kupon_toko_yang_digunakan])
            ->andFilterWhere(['like', 'nama_biaya_layanan', $this->nama_biaya_layanan])
            ->andFilterWhere(['like', 'persentase_biaya_layanan', $this->persentase_biaya_layanan]);

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
