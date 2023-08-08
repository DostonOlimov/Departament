<?php

namespace common\models\identification;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\identification\IdentificationContent;

/**
 * IdentificationContentSearch represents the model behind the search form of `common\models\identification\IdentificationContent`.
 */
class IdentificationContentSearch extends IdentificationContent
{
    public $selected_product_id;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'selected_normative_document_id', 'normative_document_content_id', 'conformity'], 'integer'],
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
        $query = IdentificationContent::find();
        if($this->selected_product_id!==null){
            $query
            ->joinWith('selectedNormativeDocument')
            ->joinWith('identification')
            ->joinWith('selectedProduct')
            ->joinWith('actSelection')
            ->joinWith('govControlOrder')
            ->joinWith('govControlProgram')
            ->joinWith('company')
            // ->joinWith('normativeDocumentContent')
            // ->joinWith('normativeDocumentSection')
            // ->joinWith('normativeDocument')
            // ->joinWith('normativeDocument')
            ->where(['identification.selected_product_id' => $this->selected_product_id])
            ;
            // debug($query);
        }
        // debug($query);

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
            'selected_normative_document_id' => $this->selected_normative_document_id,
            'normative_document_content_id' => $this->normative_document_content_id,
            'conformity' => $this->conformity,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
