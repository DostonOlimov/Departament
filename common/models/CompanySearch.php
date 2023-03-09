<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Company;

/**
 * CompanySearch represents the model behind the search form of `common\models\Company`.
 */
class CompanySearch extends Company
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'stir', 'registration_date', 'region_id', 'thsht', 'ifut', 'phone', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['company_name', 'address', 'ownername'], 'safe'],
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
        $query = Company::find();

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
            'stir' => $this->stir,
            'registration_date' => $this->registration_date,
            'region_id' => $this->region_id,
            'thsht' => $this->thsht,
            'ifut' => $this->ifut,
            'phone' => $this->phone,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'ownername', $this->ownername]);

        return $dataProvider;
    }
}
