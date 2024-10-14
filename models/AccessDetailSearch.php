<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AccessDetail;

/**
 * AccessDetailSearch represents the model behind the search form of `app\models\AccessDetail`.
 */
class AccessDetailSearch extends AccessDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_menu', 'id_access', 'is_create', 'is_read', 'is_update', 'is_delete', 'is_approve', 'is_print', 'is_download'], 'integer'],
            [['date_created', 'date_updated'], 'safe'],
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
        $query = AccessDetail::find();

        $this->load($params);

        // add conditions that should always apply here

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_menu' => $this->id_menu,
            'id_access' => $this->id_access,
            'is_create' => $this->is_create,
            'is_read' => $this->is_read,
            'is_update' => $this->is_update,
            'is_delete' => $this->is_delete,
            'is_approve' => $this->is_approve,
            'is_print' => $this->is_print,
            'is_download' => $this->is_download,
            'date_created' => $this->date_created,
            'date_updated' => $this->date_updated,
        ]);

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
