<?php

namespace common\models\control;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\control\ControlPrimaryOvNd;

/**
 * ControlPrimaryOvNdSearch represents the model behind the search form of `common\models\control\ControlPrimaryOvNd`.
 */
class ControlPrimaryOvNdSearch extends ControlPrimaryOvNd
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ov_id', 'type_id'], 'integer'],
            [['name'], 'safe'],
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
        $query = ControlPrimaryOvNd::find();

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
            'ov_id' => $this->ov_id,
            'type_id' => $this->type_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
