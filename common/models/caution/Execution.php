<?php

namespace common\models\caution;

use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "caution_executions".
 *
 * @property int $id
 * @property int $caution_company_id
 * @property int|null $date
 * @property int|null $number
 * @property bool|null $deficiency
 * @property string|null $description
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Company $cautionCompany
 * @property User $createdBy
 * @property User $updatedBy
 */
class Execution extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'caution_executions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['caution_company_id'], 'required'],
            [['caution_company_id', 'number'], 'integer'],
            [['deficiency'], 'boolean'],
            [['description', 'date'], 'string'],
            [['caution_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['caution_company_id' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
        ];
    }

    public function afterFind()
    {
        $this->date = Yii::$app->formatter->asDate($this->date, 'm/d/Y');
        parent::afterFind(); // TODO: Change the autogenerated stub
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'caution_company_id' => 'Caution Company ID',
            'date' => 'Ko\'rsatma sanasi',
            'number' => 'Xat nomeri',
            'deficiency' => 'Kamchiliklar bartaraf etilmagan bo\'lsa davlat nazoratiga o\'tkazish',
            'description' => 'Bartaraf qilingan kamchiliklar to\'g\'risida ma`lumot',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getCautionCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'caution_company_id']);
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $this->date = Yii::$app->formatter->asTimestamp($this->date);

        return true;
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
