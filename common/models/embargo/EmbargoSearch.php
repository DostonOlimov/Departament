<?php

namespace common\models\embargo;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\control\Company;
use common\models\control\Instruction;
use common\models\embargo\Embargo;

/**
 * EmbargoSearch represents the model behind the search form of `common\models\embargo\Embargo`.
 */
class EmbargoSearch extends Embargo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'message_number', 'status'], 'integer'],
            [['comment','instructions_id', 'companies_id', 'message_date', 'inspector_name', 'inspectors'], 'safe'],
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
        $query = Embargo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'message_number' => SORT_DESC,
                ]
            ],

        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
       // $query->joinWith('company');
        $query->joinWith('company')->joinWith('instruction');
       


        // grid filtering conditions
        $query->andFilterWhere([
         //   'id' => $this->id,
          //  'instructions_id' => $this->instructions_id,
           // 'companies_id' => $this->companies_id,
            'message_number' => $this->message_number,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'message_date', $this->message_date])
            ->andFilterWhere(['like', 'inspector_name', $this->inspector_name])
            ->andFilterWhere(['like', 'inspectors', $this->inspectors])
            ->andFilterWhere(['like', 'control_companies.name', $this->companies_id])
            ->andFilterWhere(['like', 'control_companies.name', $this->companies_id])
            ->andFilterWhere(['like', 'control_instructions.command_number', $this->instructions_id]);

        return $dataProvider;
    }
}
