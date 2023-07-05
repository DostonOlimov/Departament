<?php

namespace common\models\govcontrol;

use Yii;

/**
 * This is the model class for table "{{%gov_control_order}}".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property int|null $gov_control_program_id
 * @property int|null $control_period_from
 * @property int|null $control_period_to
 * @property int|null $control_date_from
 * @property int|null $control_date_to
 * @property int|null $ombudsman_code_date
 * @property string|null $ombudsman_code_number
 *
 * @property ActSelection[] $actSelections
 * @property AttachedExecutor[] $attachedExecutors
 * @property DocumentStatus[] $documentStatuses
 * @property GovControlPrimaryData[] $govControlPrimaryDatas
 * @property GovControlProgram $govControlProgram
 * @property Order[] $orders
 * @property Order $parent
 */
class Order extends \common\models\LocalActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%gov_control_order}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'gov_control_program_id'], 'integer'],
            [['control_days_number'], 'integer', 'max' => 10],
            [['ombudsman_code_number', 'control_period_from', 'control_period_to', 'control_date_from', 'control_date_to', 'ombudsman_code_date'], 'string', 'max' => 255],
            [['gov_control_program_id'], 'exist', 'skipOnError' => true, 'targetClass' => Program::class, 'targetAttribute' => ['gov_control_program_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::class, 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Buyruq turi',
            'gov_control_program_id' => 'Tekshiruv dasturi ID',
            'control_period_from' => 'Tekshiruv davri boshi',
            'control_period_to' => 'Tekshiruv davri oxiri',
            'control_date_from' => 'Tekshiruv sanasi boshi',
            'control_date_to' => 'Tekshiruv sanasi ohiri',
            'ombudsman_code_number' => 'Biznes Ombudsman kodi',
            'ombudsman_code_date' => 'Kod olingan sana',
            'control_days_number' => 'Tekshiruv kuni',
        ];
    }

    /**
     * Gets query for [[ActSelections]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getActSelections()
    {
        return $this->hasMany(ActSelection::class, ['gov_control_order_id' => 'id'])->inverseOf('govControlOrder');
    }

    /**
     * Gets query for [[AttachedExecutors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttachedExecutors()
    {
        return $this->hasMany(AttachedExecutor::class, ['gov_control_order_id' => 'id'])->inverseOf('govControlOrder');
    }

    /**
     * Gets query for [[DocumentStatuses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentStatuses()
    {
        return $this->hasMany(DocumentStatus::class, ['gov_control_order_id' => 'id'])->inverseOf('govControlOrder');
    }

    /**
     * Gets query for [[GovControlPrimaryDatas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGovControlPrimaryDatas()
    {
        return $this->hasMany(GovControlPrimaryData::class, ['gov_control_order_id' => 'id'])->inverseOf('govControlOrder');
    }

    /**
     * Gets query for [[GovControlProgram]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGovControlProgram()
    {
        return $this->hasOne(GovControlProgram::class, ['id' => 'gov_control_program_id'])->inverseOf('orders');
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['parent_id' => 'id'])->inverseOf('parent');
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Order::class, ['id' => 'parent_id'])->inverseOf('orders');
    }
}
