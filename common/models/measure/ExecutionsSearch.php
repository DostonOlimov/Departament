<?php

namespace common\models\measure;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\measure\Executions;

/**
 * ExecutionsSearch represents the model behind the search form of `common\models\measure\Executions`.
 */
class ExecutionsSearch extends Executions
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'control_instruction_id', 'first_date', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['person', 'number_passport', 'band_mjtk', 'explanation_letter', 'claim', 'court_letter', 'person_position', 'caution_number'], 'safe'],
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
        $query = Executions::find();

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
            'control_instruction_id' => $this->control_instruction_id,
            'first_date' => $this->first_date,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'person', $this->person])
            ->andFilterWhere(['like', 'number_passport', $this->number_passport])
            ->andFilterWhere(['like', 'band_mjtk', $this->band_mjtk])
            ->andFilterWhere(['like', 'explanation_letter', $this->explanation_letter])
            ->andFilterWhere(['like', 'claim', $this->claim])
            ->andFilterWhere(['like', 'court_letter', $this->court_letter])
            ->andFilterWhere(['like', 'person_position', $this->person_position])
            ->andFilterWhere(['like', 'caution_number', $this->caution_number]);

        return $dataProvider;
    }
}
