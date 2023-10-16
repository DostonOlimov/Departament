<?php

namespace common\models\actselection;

use common\models\govcontrol\Order;
use Yii;

/**
 * This is the model class for table "{{%act_selection}}".
 *
 * @property int $id
 * @property int|null $gov_control_order_id
 *
 * @property GovControlOrder $govControlOrder
 * @property SelectedProduct[] $selectedProducts
 */
class ActSelection extends \common\models\LocalActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%act_selection}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['warehouse_name', 'warehouse_address',], 'required'],
            [['gov_control_order_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['warehouse_name', 'warehouse_address', 'created_at', 'updated_at'],'string'],
            [['gov_control_order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::class, 'targetAttribute' => ['gov_control_order_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {   
        return array_merge(
            parent::AttributeLabels(), 
            [
                'warehouse_name' => 'Ombor nomi',
                'warehouse_address' => 'Ombor manzili',
            ]);
    }

    /**
     * {@inheritdoc}
     */

    /**
     * Gets query for [[GovControlOrder]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGovControlOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'gov_control_order_id']);
    }

    /**
     * Gets query for [[SelectedProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSelectedProducts()
    {
        return $this->hasMany(SelectedProduct::class, ['act_selection_id' => 'id']);
    }
}
