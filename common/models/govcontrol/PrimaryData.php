<?php

namespace common\models\govcontrol;

use Yii;

/**
 * This is the model class for table "{{%gov_control_primary_data}}".
 *
 * @property int $id
 * @property string|null $company_type_id
 * @property int|null $gov_control_order_id
 * @property int|null $real_control_date_from
 * @property int|null $real_control_date_to
 * @property int|null $quality_management_system
 * @property int|null $product_exists
 * @property int|null $laboratory_exists
 * @property int|null $last_gov_control_date
 * @property string|null $last_gov_control_number
 * @property string|null $comment
 *
 * @property DocumentStatus[] $documentStatuses
 * @property GovControlOrder $govControlOrder
 */
class PrimaryData extends \common\models\LocalActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const NO_LABORATORY = 0;
    const LABORATORY_EXISTS = 1;
    const LABORATORY_CONTRACTED = 2;
    public $company_type_ids;

    public static function tableName()
    {
        return '{{%gov_control_primary_data}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gov_control_order_id', 'quality_management_system', 'product_exists', 'laboratory_exists', 'measuring_and_testing_tools_exists', 'created_by', 'updated_by', 'status'], 'integer'],
            [['comment', 'real_control_date_from', 'real_control_date_to', 'last_gov_control_date', 'created_at', 'updated_at', 'last_gov_control_number'], 'string', 'max' => 255],
            [['last_gov_control_number'], 'string'],
            [['gov_control_order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::class, 'targetAttribute' => ['gov_control_order_id' => 'id']],
            [['company_type_id', 'company_type_ids'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {   $ParentAttrLbl = parent::AttributeLabels();
        $AttrLbl = [
            'quality_management_system' => 'Sifat menejment tizimi',
            'product_exists' => 'Mahsulot mavjudligi',
            'laboratory_exists' => 'Sinov laboratoriyasi',
            'last_gov_control_date' => 'Avval o\'tkazilgan tekshiruv sanasi',
            'last_gov_control_number' => 'Avval o\'tkazilgan tekshiruv raqami',
            'measuring_and_testing_tools_exists' => 'O\'lchov va sinov vositalari mavjudligi',
        ];

        return array_merge($ParentAttrLbl, $AttrLbl);
    }

    /**
     * Gets query for [[DocumentStatuses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentStatuses()
    {
        return $this->hasMany(DocumentStatus::class, ['gov_control_primary_data_id' => 'id']);
    }

    /**
     * Gets query for [[GovControlOrder]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGovControlOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'gov_control_order_id']);
    }

    public static function getObjectQMS($type = null)
    {
        $arr = [
            self::OBJECT_DOESNT_EXIST => 'Joriy etilmagan',
            self::OBJECT_EXISTS => 'Joriy etilgan',
        ];

        if ($type === null) {
            return $arr;
        }
        
        return $arr[$type];
    }
    public static function getObjectLaboratory($type = null)
    {
        $arr = [
            self::OBJECT_DOESNT_EXIST => 'Mavjud emas',
            self::OBJECT_EXISTS => 'Mavjud',
            self::OBJECT_WITH_CONTRACT => 'Shartnoma asosida',
        ];

        if ($type === null) {
            return $arr;
        }
        
        return $arr[$type];
    }
    public static function getObjectProduct($type = null)
    {
        $arr = [
            self::OBJECT_DOESNT_EXIST => 'Mavjud emas',
            self::OBJECT_EXISTS => 'Mavjud',
        ];

        if ($type === null) {
            return $arr;
        }
        
        return $arr[$type];
    }
    public static function getObjectMeasure($type = null)
    {
        $arr = [
            self::OBJECT_DOESNT_EXIST => 'Mavjud emas',
            self::OBJECT_EXISTS => 'Mavjud',
        ];

        if ($type === null) {
            return $arr;
        }
        
        return $arr[$type];
    }
}
