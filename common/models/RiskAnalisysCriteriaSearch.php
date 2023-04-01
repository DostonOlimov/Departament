<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RiskAnalisysCriteria;

/**
 * RiskAnalisysCriteriaSearch represents the model behind the search form of `common\models\RiskAnalisysCriteria`.
 */
class RiskAnalisysCriteriaSearch extends RiskAnalisysCriteria
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'criteria_score', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['document_paragraph', 'criteria_category', 'criteria', 'company_field_category'], 'safe'],
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
        $query = RiskAnalisysCriteria::find();

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
            'criteria_score' => $this->criteria_score,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'document_paragraph', $this->document_paragraph])
            ->andFilterWhere(['like', 'criteria_category', $this->criteria_category])
            ->andFilterWhere(['like', 'criteria', $this->criteria])
            ->andFilterWhere(['like', 'company_field_category', $this->company_field_category]);

        return $dataProvider;
    }
}