<?php

namespace common\models\identification;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\identification\Identification;

/**
 * IdentificationSearch represents the model behind the search form of `common\models\identification\Identification`.
 */
class IdentificationSearch extends Identification
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'selected_product_id'], 'integer'],
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
        $query = Identification::find();

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
            'selected_product_id' => $this->selected_product_id,
        ]);

        return $dataProvider;
    }
}
