<?php

namespace frontend\models;

use yii\base\Model;

class RiskAnalisysForm extends Model
{
    public $start_date;
    public $end_date;


    public function rules()
    {
        return [
            [['start_date', 'end_date'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {   $ParentAttrLbl = parent::AttributeLabels();
        $AttrLbl = [
            'start_date' => 'Boshlanish',
            'end_date' => 'Updated At',
        ];

        return array_merge($ParentAttrLbl, $AttrLbl);
    }

}

