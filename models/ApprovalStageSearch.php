<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ApprovalStage;

/**
 * ApprovalStageSearch represents the model behind the search form of `app\models\ApprovalStage`.
 */
class ApprovalStageSearch extends ApprovalStage
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_model', 'n_order'], 'integer'],
            [['model'], 'safe'],
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
        $query = ApprovalStage::find();

        $this->load($params);

        // add conditions that should always apply here

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_model' => $this->id_model,
            'n_order' => $this->n_order,
        ]);

        $query->andFilterWhere(['like', 'model', $this->model]);

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
