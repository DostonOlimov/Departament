<?php

namespace common\models\govcontrol;

use Yii;

/**
 * This is the model class for table "{{%gov_control_primary_data}}".
 *
 * @property int $id
 * @property int|null $company_type_id
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
            [['company_type_id', 'gov_control_order_id', 'quality_management_system', 'product_exists', 'laboratory_exists'], 'integer'],
            [['comment', 'real_control_date_from', 'real_control_date_to', 'last_gov_control_date'], 'string'],
            [['last_gov_control_number'], 'string', 'max' => 255],
            [['gov_control_order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::class, 'targetAttribute' => ['gov_control_order_id' => 'id']],
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
            'laboratory_exists' => 'Sinov lanoratoriyasi',
            'last_gov_control_date' => 'Avval o\'tkazilgan tekshruv sanasi',
            'last_gov_control_number' => 'Avval o\'tkazilgan tekshruv raqami',
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
        return $this->hasMany(DocumentStatus::class, ['gov_control_primary_data_id' => 'id'])->inverseOf('govControlPrimaryData');
    }

    /**
     * Gets query for [[GovControlOrder]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGovControlOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'gov_control_order_id'])->inverseOf('primaryDatas');
    }
}
