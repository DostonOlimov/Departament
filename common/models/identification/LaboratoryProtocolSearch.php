<?php

namespace common\models\identification;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\identification\LaboratoryProtocol;

/**
 * LaboratoryProtocolSearch represents the model behind the search form of `common\models\identification\LaboratoryProtocol`.
 */
class LaboratoryProtocolSearch extends LaboratoryProtocol
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'selected_product_id', 'laboratory_id', 'delivery_date', 'protocol_date', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['protocol_number'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = LaboratoryProtocol::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'selected_product_id' => $this->selected_product_id,
            'laboratory_id' => $this->laboratory_id,
            'delivery_date' => $this->delivery_date,
            'protocol_date' => $this->protocol_date,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'protocol_number', $this->protocol_number]);

        return $dataProvider;
    }
}
