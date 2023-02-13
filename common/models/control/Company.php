<?php

namespace common\models\control;

use common\models\Region;
use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "control_companies".
 *
 * @property int $id
 * @property int $control_instruction_id
 * @property int|null $region_id
 * @property string|null $name
 * @property int|null $inn
 * @property int|null $soogu
 * @property string|null $type
 * @property int|null $phone
 * @property string|null $link
 * @property string|null $address
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Instruction $controlInstruction
 * @property User $createdBy
 * @property Region $region
 * @property User $updatedBy
 * @property PrimaryData $primaryData
 * @property Identification $identification
 * @property Laboratory $laboratory
 * @property Defect $defect
 * @property Caution $caution
 * @property Measure $measure
 * @property $phoneNumber
 */

class Company extends \yii\db\ActiveRecord
{
    const TYPE1 = 1;
    const TYPE2 = 2;
    const TYPE3 = 3;
    const TYPE4 = 4;
   
    const PRETYPE1 = 1;
    const PRETYPE2 = 2;
    const PRETYPE3 = 3;
    const PRETYPE4 = 4;

    public static function tableName()
    {
        return 'control_companies';
    }

    public function rules()
    {
        return [
            [['control_instruction_id', 'region_id', 'inn',  'phone', 'name', 'type','ownername', 'address'], 'required'],
            [['control_instruction_id', 'region_id', 'inn','type','pre_type' ], 'integer'],
            [['name',  'link', 'address', 'phone','soogu','thsht','ownername','mhobt','ifut'], 'string', 'max' => 255],
            [['control_instruction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Instruction::className(), 'targetAttribute' => ['control_instruction_id' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'control_instruction_id' => 'Control Instruction ID',
            'region_id' => 'Hudud',
            'name' => 'Xo\'jalik yurituvchi subyekt nomi (XYUS)',
            'inn' => 'Korxona STIRi(Soliq to’lovchining identifikatsion raqami)',
            'soogu' => 'DBIBT(Davlat boshqaruvi idoralarini belgilash tizimi)',
            'thsht' =>'THSHT(Tashkiliy-huquqiy shakllar tasniflagichi)',
            'ifut' => 'IFUT(Iqtisodiy faoliyat turlari umumdavlat tasniflagichi)',
            'mhobt' =>'MHOBT(Ma\'muriy-hududiy ob‘yektlarni belgilash tizimi)',
            'ownername' => 'Tashkilot rahbari FISH',
            'type' => 'Korxona faoliyat turi',
            'phone' => 'Korxona telefon raqami',
            'link' => 'Korxona manziliga havola',
            'address' => 'Korxona yuridik manzil',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function getType($type = null)
    {
        $arr = [

            self::TYPE1 => 'Ishlab chiqaruvchi',
            self::TYPE2 => 'Importiyor',
            self::TYPE3 => 'Savdo',
            self::TYPE4 => 'Xizmat ko\'rsatish'
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }

    public static function getPreType($type = null)
    {
        $arr = [

            self::PRETYPE1 => 'Sertifikatsiya organi',
            self::PRETYPE2 => 'Tibbiyot',
            self::PRETYPE3 => 'Suv xo\'jaligi',
            self::PRETYPE4 => 'Qurilish korxonasi'
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }
    
    public function getPhoneNumber()
    {
        return '(' . substr($this->phone,0, 2) . ')-' . substr($this->phone,2,3) . '-' .
            substr($this->phone,5,2) . '-' . substr($this->phone,7,2);
    }

    public function trimPhoneNumber()
    {
        $this->phone = substr(preg_replace('#[^0-9]#', '', $this->phone),-9);
    }

    public function beforeSave($insert)
    {
        if ($this->phone) {
            $this->trimPhoneNumber();
        }

        return parent::beforeSave($insert);
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
        ];
    }

    public function getControlInstruction()
    {
        return $this->hasOne(Instruction::className(), ['id' => 'control_instruction_id']);
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    public function getPrimaryData()
    {
        return $this->hasOne(PrimaryData::className(), ['control_company_id' => 'id']);
    }

    public function getCaution()
    {
        return $this->hasOne(Caution::className(), ['control_company_id' => 'id']);
    }

    public function getIdentification()
    {
      return  $this->hasOne(PrimaryData::className(), ['control_company_id' => 'id']);
    }

    public function getLaboratory()
    {
        return $this->hasOne(Laboratory::className(), ['control_company_id' => 'id']);
    }

    public function getDefect()
    {
        return $this->hasOne(Defect::className(), ['control_company_id' => 'id']);
    }

    public function getMeasure()
    {
        return $this->hasOne(Measure::className(), ['control_company_id' => 'id']);
    }
}
