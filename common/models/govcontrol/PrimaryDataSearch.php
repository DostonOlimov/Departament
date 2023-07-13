<?php

namespace common\models\govcontrol;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\govcontrol\PrimaryData;

/**
 * PrimaryDataSearch represents the model behind the search form of `common\models\govcontrol\PrimaryData`.
 */
class PrimaryDataSearch extends PrimaryData
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'company_type_id', 'gov_control_order_id', 'real_control_date_from', 'real_control_date_to', 'quality_management_system', 'product_exists', 'laboratory_exists', 'last_gov_control_date'], 'integer'],
            [['last_gov_control_number', 'comment'], 'safe'],
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
        $query = PrimaryData::find();

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
            'company_type_id' => $this->company_type_id,
            'gov_control_order_id' => $this->gov_control_order_id,
            'real_control_date_from' => $this->real_control_date_from,
            'real_control_date_to' => $this->real_control_date_to,
            'quality_management_system' => $this->quality_management_system,
            'product_exists' => $this->product_exists,
            'laboratory_exists' => $this->laboratory_exists,
            'last_gov_control_date' => $this->last_gov_control_date,
        ]);

        $query->andFilterWhere(['like', 'last_gov_control_number', $this->last_gov_control_number])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
