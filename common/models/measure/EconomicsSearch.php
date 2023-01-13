<?php

namespace common\models\measure;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\measure\Economics;

/**
 * EconomicsSearch represents the model behind the search form of `common\models\measure\Economics`.
 */
class EconomicsSearch extends Economics
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'control_instruction_id', 'first_warn_date', 'number_passport', 'warn_number', 'eco_date', 'eco_number', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['eco_quantity', 'eco_amount'], 'safe'],
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
        $query = Economics::find();

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
            'first_warn_date' => $this->first_warn_date,
            'number_passport' => $this->number_passport,
            'warn_number' => $this->warn_number,
            'eco_date' => $this->eco_date,
            'eco_number' => $this->eco_number,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'eco_quantity', $this->eco_quantity])
            ->andFilterWhere(['like', 'eco_amount', $this->eco_amount]);

        return $dataProvider;
    }
}
