<?php

namespace common\models\prevention;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\caution\Company;
use common\models\prevention\Prevention;
use common\models\prevention\PreventionSearch;

/**
 * PreventionSearch represents the model behind the search form of `common\models\prevention\Prevention`.
 */
class PreventionsSearch extends PreventionSearch
{
   
    public function search($params)
    {
        $query = Prevention::find()->where(['instructions_id'=>$params]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);        
       
        return $dataProvider;
    }
}
