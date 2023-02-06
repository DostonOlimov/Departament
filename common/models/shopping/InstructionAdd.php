<?php

namespace common\models\shopping;

use yii\base\Model;
use common\models\shopping\ShoppingNotice;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

/**
 * ShoppingInstructionSearch represents the model behind the search form of `common\models\ShoppingInstruction`.
 */
class InstructionAdd extends InstructionSearch
{
    public function search($params)
    {
        $query = Instruction::find()->where(['notice_id'=>$params]);
        

        if ($this->userId) {
            $query->where(['shopping_instructions.created_by' => $this->userId]);
        }
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
    return $dataProvider;
    }
    }
