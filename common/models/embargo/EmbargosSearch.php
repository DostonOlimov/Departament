<?php

namespace common\models\embargo;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\control\Company;
use common\models\control\Instruction;
use common\models\embargo\Embargo;
use common\models\embargo\EmbargoSearch;

/**
 * EmbargoSearch represents the model behind the search form of `common\models\embargo\Embargo`.
 */
class EmbargosSearch extends EmbargoSearch
{

   
    public function search($params)
    {
        $query = Embargo::find()->where(['instructions_id'=>$params]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        return $dataProvider;
    }
}
