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
class Company extends LocalActiveRecord
{
    /**
     * {@inheritdoc}
     */
const STATUS_ACTIVE = 1;
const STATUS_PASSIVE = 0;



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
            [['stir', 'company_name',],'unique'],
            [['stir', 'company_name', 'registration_date', 'region_id', 'address', 'thsht', 'ifut', 'ownername', 'phone', 'status'], 'required'],
            [['stir', 'region_id', 'thsht', 'ifut', 'created_by', 'updated_by', 'status'], 'integer'],
            [['company_name', 'address', 'phone', 'ownername', 'registration_date', 'created_at', 'updated_at'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::class, 'targetAttribute' => ['region_id' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {   $ParentAttrLbl = parent::AttributeLabels();
        $AttrLbl = [
            //'id' => 'ID',
            // 'stir' => 'Stir',
            // 'company_name' => 'Tashkilot nomi',
            // 'registration_date' => 'Ro\'yxatdan o\'tgan sana',
            // 'region_id' => 'Hudud nomi',
            // 'address' => 'Manzili',
            // 'thsht' => 'THSHT',
            // 'ifut' => 'IFUT',
            // 'ownername' => 'Rahbar',
            // 'phone' => 'Tel. raqami',
            // 'status' => 'Status',
            // 'created_by' => 'Created By',
            // 'updated_by' => 'Updated By',
            // 'created_at' => 'Created At',
            // 'updated_at' => 'Updated At',
        ];

        return array_merge($ParentAttrLbl, $AttrLbl);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
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
    public static function getStatus($type = null)
    {
        $arr = [

            self::STATUS_ACTIVE => 'Faoliyat yuritayotgan',
            self::STATUS_PASSIVE => 'Faoliyati to\'xtatilgan',
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }
    public function getCompanyName()
    {
        return $this->hasOne(Company::class, ['id' => 'company_name']);
    }
    
    
}
