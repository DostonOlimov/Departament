<?php

namespace common\models\control;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\control\InstructionFile;
use common\models\User;

/**
 * InstructionFileSearch represents the model behind the search form of `common\models\control\InstructionFile`.
 */
class InstructionFileSearch extends InstructionFile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'instructions_id', 'created_by', 'updated_by'], 'integer'],
            [['basis_file', 'program_file', 'order_file'], 'safe'],
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
        $query = InstructionFile::find()->joinWith('instruction')->joinWith('user');

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
            //'instructions_id' => $this->instructions_id,
           // 'created_by' => $this->created_by,
           // 'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'basis_file', $this->basis_file])
            ->andFilterWhere(['like', 'program_file', $this->program_file])
            ->andFilterWhere(['like', 'order_file', $this->order_file])
            ->andFilterWhere(['like', 'control_instructions.command_number', $this->instructions_id])
            ->andFilterWhere(['like', 'user.name', $this->created_by])
            ->andFilterWhere(['like', 'user.name', $this->updated_by]);

        return $dataProvider;
    }
    
}
