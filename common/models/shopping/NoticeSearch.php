<?php

namespace common\models\shopping;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

/**
 * ShoppingNoticeSearch represents the model behind the search form of `common\models\shopping\ShoppingNotice`.
 */
class NoticeSearch extends ShoppingNotice
{
   
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by', 'attachment_user_id'], 'integer'],
            [['notice_number', 'notice_sum', 'status'], 'safe'],
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
        $query = ShoppingNotice::find();
        

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
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'attachment_user_id' => $this->attachment_user_id,
        ]);

        $query->andFilterWhere(['like', 'notice_number', $this->notice_number])
            ->andFilterWhere(['like', 'notice_sum', $this->notice_sum])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
