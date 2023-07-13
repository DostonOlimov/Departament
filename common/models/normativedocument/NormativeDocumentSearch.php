<?php

namespace common\models\normativedocument;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\normativedocument\NormativeDocument;

/**
 * NormativeDocumentSearch represents the model behind the search form of `common\models\normativedocument\NormativeDocument`.
 */
class NormativeDocumentSearch extends NormativeDocument
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'activation_date', 'deactivation_date'], 'integer'],
            [['determination', 'name', 'activation_info', 'deactivation_info'], 'safe'],
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
        $query = NormativeDocument::find();

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
            'category_id' => $this->category_id,
            'activation_date' => $this->activation_date,
            'deactivation_date' => $this->deactivation_date,
        ]);

        $query->andFilterWhere(['like', 'determination', $this->determination])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'activation_info', $this->activation_info])
            ->andFilterWhere(['like', 'deactivation_info', $this->deactivation_info]);

        return $dataProvider;
    }
}
