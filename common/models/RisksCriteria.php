<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "risks_criteria".
 *
 * @property int $id
 * @property int $risk_analisys_id
 * @property int $criteria_id
 * @property int $comment
 *
 * @property RiskAnalisysCriteria $criteria
 * @property RiskAnalisys $riskAnalisys
 */
class RisksCriteria extends LocalActiveRecord
{
    public $name;
    public $ball;
    public $status;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'risks_criteria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['risk_analisys_id', 'criteria_id', ], 'required'],
            [['risk_analisys_id', 'criteria_id','status'], 'integer'],
            [['comment'],'string','max' =>255],
            [['criteria_id'], 'exist', 'skipOnError' => true, 'targetClass' => RiskAnalisysCriteria::class, 'targetAttribute' => ['criteria_id' => 'id']],
            [['risk_analisys_id'], 'exist', 'skipOnError' => true, 'targetClass' => RiskAnalisys::class, 'targetAttribute' => ['risk_analisys_id' => 'id']],
        ];
    }
    public function getCriteriaBall($risk_analisys_id)
    
    {
        $criteria = $this::find()
        ->where(['risk_analisys_id' => $risk_analisys_id])
        ->select('criteria_id')
        ->asArray()
        ->all();
        // debug($criteria);
        $ball =0;
        foreach($criteria as $cr){
            $ball += RiskAnalisysCriteria::find($cr)->one()->criteria_score ?? 0;

        }
        return $ball;
        // return $risk_analisys_id;
    }
    public function getCriterion($criteria_id)
    { 
        // return "1";
        $criteria = RiskAnalisysCriteria::findOne(['id' => $criteria_id]);
        // debug($criteria);
        return $criteria->document_paragraph  . " . ". 
        $criteria->criteria . " (" . $criteria->criteria_score . " ball)";
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {   $ParentAttrLbl = parent::AttributeLabels();
        $AttrLbl = [
            // 'id' => 'ID',
            // 'risk_analisys_id' => 'Risk Analisys ID',
            // 'criteria_id' => 'Criteria ID',
            // 'comment' => 'Comment',
        ];

        return array_merge($ParentAttrLbl, $AttrLbl);
    }

    /**
     * Gets query for [[Criteria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCriteria()
    {
        return $this->hasOne(RiskAnalisysCriteria::class, ['id' => 'criteria_id']);
    }

    /**
     * Gets query for [[RiskAnalisys]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRiskAnalisys()
    {
        return $this->hasOne(RiskAnalisys::class, ['id' => 'risk_analisys_id']);
    }
}
