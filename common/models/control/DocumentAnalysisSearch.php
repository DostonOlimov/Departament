<?php

namespace common\models\control;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\control\DocumentAnalysis;


/**
 * DocumentAnalysisSearch represents the model behind the search form of `common\models\control\DocumentAnalysis`.
 */
class DocumentAnalysisSearch extends DocumentAnalysis
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'control_instruction_id', 'given_date', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['reestr_number', 'defect'], 'safe'],
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
        $query = DocumentAnalysis::find();

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
            'given_date' => $this->given_date,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'reestr_number', $this->reestr_number])
            ->andFilterWhere(['like', 'defect', $this->defect]);

        return $dataProvider;
    }
}
