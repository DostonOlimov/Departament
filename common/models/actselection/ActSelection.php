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
            [['gov_control_order_id'], 'integer'],
            [['gov_control_order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::class, 'targetAttribute' => ['gov_control_order_id' => 'id']],
        ];
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
        return $this->hasOne(Order::class, ['id' => 'gov_control_order_id'])->inverseOf('actSelections');
    }

    /**
     * Gets query for [[SelectedProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSelectedProducts()
    {
        return $this->hasMany(SelectedProduct::class, ['act_selection_id' => 'id'])->inverseOf('actSelection');
    }
}
