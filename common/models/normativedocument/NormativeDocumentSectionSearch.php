<?php

namespace common\models\normativedocument;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\normativedocument\NormativeDocumentSection;

/**
 * NormativeDocumentSectionSearch represents the model behind the search form of `common\models\normativedocument\NormativeDocumentSection`.
 */
class NormativeDocumentSectionSearch extends NormativeDocumentSection
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'normative_document_id', 'section_name'], 'integer'],
            [['section_category_id', 'section_number'], 'safe'],
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
        $query = NormativeDocumentSection::find();
        $query->orderBy(['section_number' => SORT_ASC]);

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
            'normative_document_id' => $this->normative_document_id,
            'section_name' => $this->section_name,
        ]);

        $query->andFilterWhere(['like', 'section_category_id', $this->section_category_id])
            ->andFilterWhere(['like', 'section_number', $this->section_number]);

        return $dataProvider;
    }
}
