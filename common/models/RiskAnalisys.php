<?php

namespace common\models;

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
class RiskAnalisys extends \yii\db\ActiveRecord
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
            [['company_id', 'user_id', 'risk_analisys_date', 'risk_analisys_number', 'criteria', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'required'],
            [['company_id', 'user_id', 'risk_analisys_date', 'risk_analisys_number', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['criteria'], 'string', 'max' => 255],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['company_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'user_id' => 'User ID',
            'risk_analisys_date' => 'Risk Analisys Date',
            'risk_analisys_number' => 'Risk Analisys Number',
            'criteria' => 'Criteria',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
