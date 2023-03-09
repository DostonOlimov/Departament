<?php

namespace common\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use common\models\User;
use common\models\Region;

use Yii;

/**
 * This is the model class for table "{{%company}}".
 *
 * @property int $id
 * @property int $stir
 * @property string $company_name
 * @property int $registration_date
 * @property int $region_id
 * @property string $address
 * @property int $thsht
 * @property int $ifut
 * @property string $ownername
 * @property int $phone
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property Regions $region
 * @property User $updatedBy
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%company}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stir', 'company_name', 'registration_date', 'region_id', 'address', 'thsht', 'ifut', 'ownername', 'phone', 'status'], 'required'],
            [['stir', 'registration_date', 'region_id', 'thsht', 'ifut', 'phone', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['company_name', 'address', 'ownername'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::class, 'targetAttribute' => ['region_id' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'stir' => 'Stir',
            'company_name' => 'Tashkilot nomi',
            'registration_date' => 'Ro\'yxatdan o\'tgan sana',
            'region_id' => 'Hudud nomi',
            'address' => 'Manzili',
            'thsht' => 'THSHT',
            'ifut' => 'IFUT',
            'ownername' => 'Rahbar',
            'phone' => 'Tel. raqami',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function afterFind()
    {
        $this->created_at = $this->created_at ? Yii::$app->formatter->asDate($this->created_at, 'dd.MM.yyyy') : $this->created_at;
        $this->updated_at = $this->updated_at ? Yii::$app->formatter->asDate($this->updated_at, 'dd.MM.yyyy') : $this->updated_at;
        parent::afterFind(); // TODO: Change the autogenerated stub
    }
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
        ];
    }
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
    /**
     * Gets query for [[Region]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::class, ['id' => 'region_id']);
    }
    
}
