<?php

namespace common\models\shopping;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\shopping\ShoppingLaboratory;

/**
 * ShoppingLaboratorySearch represents the model behind the search form of `common\models\shopping\ShoppingLaboratory`.
 */
class ShoppingLaboratorySearch extends ShoppingLaboratory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'shopping_company_id', 'shopping_product_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['conclusion', 'comment'], 'safe'],
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
        $query = ShoppingLaboratory::find();

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
            'shopping_company_id' => $this->shopping_company_id,
            'shopping_product_id' => $this->shopping_product_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'conclusion', $this->conclusion])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
