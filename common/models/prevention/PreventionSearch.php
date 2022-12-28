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
            [['id', 'instructions_id', 'companies_id'], 'integer'],
            [['message_num', 'message_date', 'comment', 'inspector_name'], 'safe'],
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
            'instructions_id' => $this->instructions_id,
            'companies_id' => $this->companies_id,
        ]);

        $query->andFilterWhere(['like', 'message_num', $this->message_num])
            ->andFilterWhere(['like', 'message_date', $this->message_date])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'inspector_name', $this->inspector_name])
            ->andFilterWhere(['like', 'inspectors', $this->inspectors]);

        return $dataProvider;
    }
}
