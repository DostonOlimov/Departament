<?php

namespace common\models\caution;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\caution\CautionLetters;

/**
 * CautionLettersSearch represents the model behind the search form of `common\models\caution\CautionLetters`.
 */
class CautionLettersSearch extends CautionLetters
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'company_id'], 'integer'],
            [['letter_date', 'letter_number', 'inpector_name'], 'safe'],
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
        $query = CautionLetters::find();

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
            'company_id' => $this->company_id,
            'letter_date' => $this->letter_date,
        ]);

        $query->andFilterWhere(['like', 'letter_number', $this->letter_number])
            ->andFilterWhere(['like', 'inpector_name', $this->inpector_name]);

        return $dataProvider;
    }
}
