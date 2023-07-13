<?php

namespace common\models\actselection;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\actselection\SelectedProduct;

/**
 * SelectedProductSearch represents the model behind the search form of `common\models\actselection\SelectedProduct`.
 */
class SelectedProductSearch extends SelectedProduct
{
    public $gov_control_order_id;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'act_selection_id', 'ctry_ogn_code', 'mfr_id', 'mfrd_date', 'exptr_ctry_code', 'imptr_id', 'xtra_unit_om'], 'integer'],
            [['name', 'batch_number', 'mfr_name', 'imptr_name', 'cnfea_code', 'bar_code', 'gov_control_order_id'], 'safe'],
            [['prod_netto', 'xtra_value'], 'number'],
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
        $query = SelectedProduct::find();

        // add conditions that should always apply here
        if($this->gov_control_order_id){
            $query->joinWith('actSelection');
            $query->where(['act_selection.gov_control_order_id' => $this->gov_control_order_id]);
        }

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
            'act_selection_id' => $this->act_selection_id,
            'ctry_ogn_code' => $this->ctry_ogn_code,
            'mfr_id' => $this->mfr_id,
            'mfrd_date' => $this->mfrd_date,
            'exptr_ctry_code' => $this->exptr_ctry_code,
            'imptr_id' => $this->imptr_id,
            'prod_netto' => $this->prod_netto,
            'xtra_value' => $this->xtra_value,
            'xtra_unit_om' => $this->xtra_unit_om,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'batch_number', $this->batch_number])
            ->andFilterWhere(['like', 'mfr_name', $this->mfr_name])
            ->andFilterWhere(['like', 'imptr_name', $this->imptr_name])
            ->andFilterWhere(['like', 'cnfea_code', $this->cnfea_code])
            ->andFilterWhere(['like', 'bar_code', $this->bar_code]);

        return $dataProvider;
    }
}
