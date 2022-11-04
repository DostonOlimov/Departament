<?php

namespace common\models\control;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\control\PrimaryProduct;

/**
 * PrimaryProductSearch represents the model behind the search form of `common\models\control\PrimaryProduct`.
 */
class PrimaryProductSearch extends PrimaryProduct
{
    public $primaryDataId;

    public function __construct($primaryDataId, $config = [])
    {
        $this->primaryDataId = $primaryDataId;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['id', 'control_primary_data_id', 'made_country','product_measure','select_of_exsamle_purpose'], 'integer'],
            [['product_type_id', 'product_name', 'residue_quantity', 'residue_amount', 'year_quantity','year_amount','potency'], 'safe'],
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
        $query = PrimaryProduct::find()->where(['control_primary_data_id' => $this->primaryDataId]);

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
            'control_primary_data_id' => $this->control_primary_data_id,
            'made_country' => $this->made_country,
            'product_measure' => $this->product_measure,
        ]);

        $query->andFilterWhere(['like', 'product_type_id', $this->product_type_id])
            ->andFilterWhere(['like', 'year_amount', $this->year_amount])
            ->andFilterWhere(['like', 'year_quantity', $this->year_quantity])
            ->andFilterWhere(['like', 'potency', $this->potency])
            ->andFilterWhere(['like', 'residue_amount', $this->residue_amount])
            ->andFilterWhere(['like', 'residue_quantity', $this->residue_quantity]);

        return $dataProvider;
    }
}
