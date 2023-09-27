<?php

namespace common\models\govcontrol;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\govcontrol\Order;
use Yii;

/**
 * OrderSearch represents the model behind the search form of `common\models\govcontrol\Order`.
 */
class OrderSearch extends Order
{
    public $executor_id;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'gov_control_program_id', 'control_period_from', 'control_period_to', 'control_date_from', 'control_date_to', 'ombudsman_code_date', 'status'], 'integer'],
            [['ombudsman_code_number'], 'safe'],
            [['executor_id'], 'safe'],

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
            
        $query = Order::find()->joinWith('attachedExecutors');

        // add conditions that should always apply here
        // debug($this->status);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        // debug($query);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'gov_control_program_id' => $this->gov_control_program_id,
            'control_period_from' => $this->control_period_from,
            'control_period_to' => $this->control_period_to,
            'control_date_from' => $this->control_date_from,
            'control_date_to' => $this->control_date_to,
            'ombudsman_code_date' => $this->ombudsman_code_date,
            'control_days_number' => $this->ombudsman_code_date,
            'attached_executor.user_id' => $this->executor_id,
            'gov_control_order.status' => $this->status,
            // 'created_at' => Yii::$app->user->id,
            // 'updated_at' => Yii::$app->user->id,
            
        ]);

        $query->andFilterWhere(['like', 'ombudsman_code_number', $this->ombudsman_code_number]);
        // debug($query);
        return $dataProvider;
    }
}
