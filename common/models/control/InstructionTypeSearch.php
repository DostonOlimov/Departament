<?php

namespace common\models\control;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\control\InstructionType;

/**
 * InstructionTypeSearch represents the model behind the search form of `common\models\control\InstructionType`.
 */
class InstructionTypeSearch extends InstructionType
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'instruction_id', 'product', 'ov', 'document', 'canceled', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
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
        $query = InstructionType::find();

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
            'instruction_id' => $this->instruction_id,
            'product' => $this->product,
            'ov' => $this->ov,
            'document' => $this->document,
            'canceled' => $this->canceled,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
