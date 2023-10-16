<?php

namespace common\models\identification;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\identification\LaboratoryProtocolContent;

/**
 * LaboratoryProtocolContentSearch represents the model behind the search form of `common\models\identification\LaboratoryProtocolContent`.
 */
class LaboratoryProtocolContentSearch extends LaboratoryProtocolContent
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'laboratory_protocol_id', 'normative_document_id', 'requirement_range', 'unit_om'], 'integer'],
            [['indicator_name', 'requirement_link'], 'safe'],
            [['requirement_min', 'requirement_max', 'current_value'], 'number'],
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
        $query = LaboratoryProtocolContent::find();

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
            'laboratory_protocol_id' => $this->laboratory_protocol_id,
            'normative_document_id' => $this->normative_document_id,
            'requirement_range' => $this->requirement_range,
            'requirement_min' => $this->requirement_min,
            'requirement_max' => $this->requirement_max,
            'current_value' => $this->current_value,
            'unit_om' => $this->unit_om,
        ]);

        $query->andFilterWhere(['like', 'indicator_name', $this->indicator_name])
            ->andFilterWhere(['like', 'requirement_link', $this->requirement_link]);

        return $dataProvider;
    }
}
