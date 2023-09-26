<?php

namespace common\models\govcontrol;

use common\models\Company;
use Yii;

/**
 * This is the model class for table "{{%gov_control_program}}".
 *
 * @property int $id
 * @property int $company_id
 * @property int|null $company_type_id
 * @property int|null $gov_control_type
 *
 * @property Company $company
 * @property DocumentStatus[] $documentStatuses
 * @property GovControlOrder[] $govControlOrders
 */
class Program extends \common\models\LocalActiveRecord
{
    public $company_name;
    public $property;
    const DT  = 0;
    const DN  = 1;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%gov_control_program}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        // debug(parent::scenarios());
        return [
            [['company_id', 'gov_control_type', 'property', 'company_type_id'], 'required', 'on' => 'create'],


            [['company_id', 'gov_control_type', 'company_type_id'], 'integer'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['company_id' => 'id']],
            // [['property'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {   $ParentAttrLbl = parent::AttributeLabels();
        $AttrLbl = [
            'company_id' => 'Tashkilot nomi',
            'company_name' => 'Tashkilot nomi',
            'company_type_id' => 'Faoliyat turi',
            'gov_control_type' => 'Tekshiruv turi',
            'property' => 'Dastur ma\'lumotlari',
        ];

        return array_merge($ParentAttrLbl, $AttrLbl);
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::class, ['id' => 'company_id'])->inverseOf('programs');
    }

    /**
     * Gets query for [[DocumentStatuses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentStatuses()
    {
        return $this->hasMany(DocumentStatus::class, ['gov_control_program_id' => 'id'])->inverseOf('govControlProgram');
    }

    /**
     * Gets query for [[GovControlOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGovControlOrders()
    {
        return $this->hasMany(Order::class, ['gov_control_program_id' => 'id']);
    }

    public static function getGovcontrolType($type = null)
    {
        $arr = [
            self::DT => 'Ombudsman vakolatida bo\'lmagan',
            self::DN => 'Ombudsman vakolatidagi',
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }


    
}
