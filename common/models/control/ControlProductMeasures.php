<?php

namespace common\models\control;

use Yii;

/**
 * This is the model class for table "control_product_measures".
 *
 * @property int $id
 * @property int $product_id
 * @property int|null $amount
 * @property int|null $quantity
 *
 * @property ControlPrimaryProduct $product
 */
class ControlProductMeasures extends \yii\db\ActiveRecord
{
    public $product_name;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'control_product_measures';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['product_id', 'amount', 'quantity'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => PrimaryProduct::class, 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'amount' => 'Summasi',
            'quantity' => 'Miqdori',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(PrimaryProduct::class, ['id' => 'product_id']);
    }
}
