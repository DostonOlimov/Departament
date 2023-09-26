<?php

namespace common\models\identification;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\identification\IdentificationContent;
use yii\db\ActiveQuery;

/**
 * IdentificationContentSearch represents the model behind the search form of `common\models\identification\IdentificationContent`.
 */
class IdentificationContentSearch extends IdentificationContent
{
    public $selected_product_id;
    public $identification_id;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'selected_normative_document_id', 'normative_document_content_id', 'conformity'], 'integer'],
            [['comment'], 'string'],
            
            [['identification_id', 'selected_product_id'], 'integer'],
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
        $query = IdentificationContent::find();
        $query->joinWith([
            'selectedNormativeDocument', 
            'identification', 
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);

        $dataProvider->sort->attributes['identification_id'] = [
            'asc' => ['identification.id' => SORT_ASC],
            'desc' => ['identification.id' => SORT_DESC],
        ];
        // $dataProvider->sort->attributes['selected_normative_document_id'] = [
        //     'asc' => ['selectedNormativeDocument.id' => SORT_ASC],
        //     'desc' => ['selectedNormativeDocument.id' => SORT_DESC],
        // ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'selected_normative_document_id' => $this->selected_normative_document_id,
            'normative_document_content_id' => $this->normative_document_content_id,
            'identification.id' => $this->identification_id,
            'conformity' => $this->conformity,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
