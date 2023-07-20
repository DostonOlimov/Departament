<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RiskAnalisys;
use Yii;

/**
 * RiskAnalisysSearch represents the model behind the search form of `common\models\RiskAnalisys`.
 */
class RiskAnalisysSearch extends RiskAnalisys
{
    public $start_date;
    public $end_date;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start_date', 'end_date'], 'required'],
            [['id', 'company_id', 'risk_analisys_number', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['risk_analisys_date'], 'string'],

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
        $query = RiskAnalisys::find();

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
            // 'stir' => $this->stir,
            'company_id' => $this->company_id,
            // 'risk_analisys_date' => $this->risk_analisys_date,
            'risk_analisys_number' => $this->risk_analisys_number,
            'summary_user_id' => $this->risk_analisys_number,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        if($this->start_date or $this->end_date){
            $query->andFilterWhere(['between', 'created_at', 
            strtotime($this->start_date), 
            strtotime($this->end_date. ' +1 day -1 second')]);
        }
        $query->andFilterWhere(['like', 'risk_analisys_date', $this->risk_analisys_date,]);
        // debug($query);

        return $dataProvider;
    }
}
