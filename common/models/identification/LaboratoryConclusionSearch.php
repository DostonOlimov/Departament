<?php

namespace common\models\identification;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\identification\LaboratoryConclusion;

/**
 * LaboratoryConclusionSearch represents the model behind the search form of `common\models\identification\LaboratoryConclusion`.
 */
class LaboratoryConclusionSearch extends LaboratoryConclusion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'selected_product_id', 'normative_document_id', 'requirement_range', 'unit_om'], 'integer'],
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
        $query = LaboratoryConclusion::find();

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
            'normative_document_id' => $this->normative_document_id,
            'requirement_range' => $this->requirement_range,
            'requirement_min' => $this->requirement_min,
            'requirement_max' => $this->requirement_max,
            'current_value' => $this->current_value,
        ]);

        $query->andFilterWhere(['like', 'indicator_name', $this->indicator_name])
            ->andFilterWhere(['like', 'requirement_link', $this->requirement_link]);

        return $dataProvider;
    }
}
