<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RisksCriteria;

/**
 * RisksCriteriaSearch represents the model behind the search form of `common\models\RisksCriteria`.
 */
class RisksCriteriaSearch extends RisksCriteria
{
    public $risk_analisys_id;

    public function __construct($risk_analisys_id, $config = [])
    {
        $this->risk_analisys_id = $risk_analisys_id;
        parent::__construct($config);
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'risk_analisys_id', 'criteria_id'], 'integer'],
            [['comment'], 'safe'],
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
        $query = RisksCriteria::find();

        // add conditions that should always apply here
        if ($this->risk_analisys_id) {
            $query->where(['risk_analisys_id' => $this->risk_analisys_id]);
            
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
            'risk_analisys_id' => $this->risk_analisys_id,
            'criteria_id' => $this->criteria_id,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
