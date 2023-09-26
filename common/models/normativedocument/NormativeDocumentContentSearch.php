<?php

namespace common\models\normativedocument;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\normativedocument\NormativeDocumentContent;
use yii\db\ActiveQuery;

/**
 * NormativeDocumentContentSearch represents the model behind the search form of `common\models\normativedocument\NormativeDocumentContent`.
 */
class NormativeDocumentContentSearch extends NormativeDocumentContent
{
    public $selected_normative_document_id;
    // public $selectedNormativeDocument;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'document_section_id', 'position'], 'integer'],
            [['selected_normative_document_id'], 'integer'],
            [['content'], 'safe'],
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
        $query = NormativeDocumentContent::find();
        $query->joinWith(['documentSection', 'normativeDocument', 'identification', 'selectedProduct'], true, 'INNER JOIN');
        $query->orderBy(['content' => SORT_ASC]);
        $query->orderBy(['position' => SORT_ASC]);

        if($this->selected_normative_document_id){
            $query->joinWith('selectedNormativeDocument');
    }
        else{
            $query->where(['parent_id' => $this->parent_id]);
        }
        // debug($this->parent_id);

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
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'document_section_id' => $this->document_section_id,
            'position' => $this->position,
            // 'selectedNormativeDocument.id' => $this->selected_normative_document_id,
            'selected_normative_document.id' => $this->selected_normative_document_id,
            // 'selectedNormativeDocument.id'=> $this->selected_normative_document_id,
            // 'identification_content.selected_normative_document_id'=> $this->selected_normative_document_id,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
