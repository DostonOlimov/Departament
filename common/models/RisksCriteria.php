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
class RisksCriteria extends \yii\db\ActiveRecord
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

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'risk_analisys_id' => 'Risk Analisys ID',
            'criteria_id' => 'Criteria ID',
            'comment' => 'Comment',
        ];
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
