<?php

namespace common\models\govcontrol;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\govcontrol\Program;

/**
 * ProgramSearch represents the model behind the search form of `common\models\govcontrol\Program`.
 */
class ProgramSearch extends Program
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'company_type_id', 'gov_control_type', 'status'], 'integer'],
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
        $query = Program::find();
        $query->joinWith('govControlOrders');

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
            'gov_control_program.id' => $this->id,
            'company_id' => $this->company_id,
            'company_type_id' => $this->company_type_id,
            'gov_control_type' => $this->gov_control_type,
            'gov_control_program.status' => $this->status,
        ]);

        return $dataProvider;
    }
}
