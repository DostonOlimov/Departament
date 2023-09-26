<?php

namespace common\models\normativedocument;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\normativedocument\SelectedNormativeDocument;

/**
 * SelectedNormativeDocumentSearch represents the model behind the search form of `common\models\normativedocument\SelectedNormativeDocument`.
 */
class SelectedNormativeDocumentSearch extends SelectedNormativeDocument
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'identification_id', 'normative_document_id'], 'integer'],
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
        $query = SelectedNormativeDocument::find();
        $query->joinWith(
            [
                'identification', 
                'selectedProduct', 
                'actSelection', 
                'govControlOrder', 
                'govControlProgram', 
                'company'
            ]);
        $query->joinWith(
            [
                'normativeDocument', 
                'normativeDocumentSections', 
                'normativeDocumentContents'
            ]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,

        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'selected_normative_document.id' => $this->id,
            'identification_id' => $this->identification_id,
            'normative_document_id' => $this->normative_document_id,
            // 'normative_document_id' => $this->normative_document_id,
            // 'selected_normative_document_id' => $this->selected_normative_document_id,
        ]);

        return $dataProvider;
    }
}
