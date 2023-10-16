<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UnitOfMeasure;

/**
 * UnitOfMeasureSearch represents the model behind the search form of `common\models\UnitOfMeasure`.
 */
class UnitOfMeasureSearch extends UnitOfMeasure
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'kind_of_quantity', 'status', 'created_by', 'updated_by'], 'integer'],
            [['code', 'synonym', 'concept_eng', 'dimension', 'created_at', 'updated_at'], 'safe'],
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
        $query = UnitOfMeasure::find();

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
            'kind_of_quantity' => $this->kind_of_quantity,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'synonym', $this->synonym])
            ->andFilterWhere(['like', 'concept_eng', $this->concept_eng])
            ->andFilterWhere(['like', 'dimension', $this->dimension]);

        return $dataProvider;
    }
}
