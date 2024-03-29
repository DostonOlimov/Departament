<?php

namespace common\models\measure;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\measure\CourtDecision;

/**
 * CourtDecisionSearch represents the model behind the search form of `common\models\measure\CourtDecision`.
 */
class CourtDecisionSearch extends CourtDecision
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'execution_id', 'court_id', 'decision_date', 'fine_amount', 'paid_amount', 'paid_date', 'discont', 'paid_acount', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['decision_file', 'comment'], 'safe'],
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
        $query = CourtDecision::find();

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
            'execution_id' => $this->execution_id,
            'court_id' => $this->court_id,
            'decision_date' => $this->decision_date,
            'fine_amount' => $this->fine_amount,
            'paid_amount' => $this->paid_amount,
            'paid_date' => $this->paid_date,
            'discont' => $this->discont,
            'paid_acount' => $this->paid_acount,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'decision_file', $this->decision_file])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
