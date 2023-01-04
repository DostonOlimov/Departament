<?php

namespace common\models\prevention;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\caution\Company;
use common\models\prevention\Prevention;

/**
 * PreventionSearch represents the model behind the search form of `common\models\prevention\Prevention`.
 */
class PreventionSearch extends Prevention
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['message_num', 'instructions_id', 'companies_id','message_date', 'comment'], 'safe'],
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
        $query = Prevention::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith('company')->joinWith('instruction')->joinWith('user');

        // grid filtering conditions
        $query->andFilterWhere([
          //  'id' => $this->id,
           // 'instructions_id' => $this->instructions_id,
           // 'companies_id' => $this->companies_id,
        ]);

        $query->andFilterWhere(['like', 'message_date', $this->message_date])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'control_companies.name', $this->companies_id])
            ->andFilterWhere(['like', 'control_instructions.command_number', $this->instructions_id])
            ->andFilterWhere(['like', 'caution_prevention.id', $this->id])
            ->andFilterWhere(['like', 'user.name', $this->created_by]);

        return $dataProvider;
    }
}
