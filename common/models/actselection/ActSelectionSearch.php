<?php

namespace common\models\actselection;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\actselection\ActSelection;

/**
 * ActSelectionSearch represents the model behind the search form of `common\models\actselection\ActSelection`.
 */
class ActSelectionSearch extends ActSelection
{
    public $act_selection_id;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'gov_control_order_id'], 'integer'],
            [['act_selection_id'], 'safe'],
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
        $query = ActSelection::find();
        $query->joinWith('selectedProducts');
        if($this->act_selection_id){
            $query->where(['selected_product.act_selection_id' => $this->act_selection_id]);
        }
        if($this->gov_control_order_id){
            $query->where(['gov_control_order_id' => $this->gov_control_order_id]);
        }
        // debug($query);

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
            'gov_control_order_id' => $this->gov_control_order_id,
        ]);

        return $dataProvider;
    }
}
