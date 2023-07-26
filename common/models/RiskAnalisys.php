<?php

namespace common\models;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

use Yii;

/**
 * This is the model class for table "{{%risk_analisys}}".
 *
 * @property int $id
 * @property int $company_id
 * @property int $user_id
 * @property int $risk_analisys_date
 * @property int $risk_analisys_number
 * @property string $criteria
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Company $company
 * @property User $user
 */
class RiskAnalisys extends LocalActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%risk_analisys}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'risk_analisys_date', 'risk_analisys_number','summary_user_id', ], 'required'],
            [['company_id',  'risk_analisys_number',], 'integer'],
            [['risk_analisys_date',], 'string', 'max' => 255],
            [['start_date', 'end_date'], 'safe'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['company_id' => 'id']],
            [['summary_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['summary_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {   $ParentAttrLbl = parent::AttributeLabels();
        $AttrLbl = [
            // 'id' => 'ID',
            // 'company_id' => 'Company ID',
            // 'risk_analisys_date' => 'Risk Analisys Date',
            // 'risk_analisys_number' => 'Risk Analisys Number',
            // 'criteria' => 'Criteria',
            // 'created_by' => 'Created By',
            // 'updated_by' => 'Updated By',
            // 'created_at' => 'Created At',
            // 'updated_at' => 'Updated At',
        ];

        return array_merge($ParentAttrLbl, $AttrLbl);
    }
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
        ];
    }
    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::class, ['id' => 'company_id']);
    }

}
