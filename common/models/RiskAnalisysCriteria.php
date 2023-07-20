<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use common\models\LocalActiveRecord;

/**
 * This is the model class for table "risk_analisys_criteria".
 *
 * @property int $id
 * @property string $document_paragraph
 * @property string $criteria_category
 * @property string $criteria
 * @property string $company_field_category
 * @property int $criteria_score
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 */


class RiskAnalisysCriteria extends LocalActiveRecord
{



    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'risk_analisys_criteria';
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['document_paragraph', 'criteria_category', 'criteria', 'company_field_category', 'criteria_score'], 'required'],
            [['criteria_score', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['document_paragraph', 'criteria_category', 'criteria', 'company_field_category'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {   $ParentAttrLbl = parent::AttributeLabels();
        $AttrLbl = [
        // 'id' => 'ID',
        // 'document_paragraph' => 'Hujjat bandi raqami',
        // 'criteria_category' => 'Mezon kategoriyasi',
        // 'criteria' => 'Mezon',
        // 'company_field_category' => 'Qo\'llanilish sohasi',
        // 'criteria_score' => 'Ball',
        // 'created_by' => 'Yaratgan foydalanuvchi',
        // 'updated_by' => 'O\'zgartirgan foydalanuvchi',
        // 'created_at' => 'Yaratildi',
        // 'updated_at' => 'O\'zgartirildi',
        ];

        return array_merge($ParentAttrLbl, $AttrLbl);
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimesTampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),

            ],
            //TimestampBehavior::class,
            BlameableBehavior::class,
          
        ];
    }
    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }


    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }
    
}
