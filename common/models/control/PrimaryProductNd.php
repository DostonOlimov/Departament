<?php

namespace common\models\control;

use Yii;
use common\models\control\PrimaryProduct;
use common\models\NdType;

/**
 * This is the model class for table "control_primary_product_nd".
 *
 * @property int $id
 * @property int|null $control_primary_product_id
 * @property string|null $name
 * @property int|null $type_id
 *
 * @property PrimaryProduct $controlPrimaryProduct
 * @property NdType $controlPrimaryProduct0
 */
class PrimaryProductNd extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'control_primary_product_nd';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['control_primary_product_id', 'type_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['control_primary_product_id'], 'exist', 'skipOnError' => true, 'targetClass' => PrimaryProduct::class, 'targetAttribute' => ['control_primary_product_id' => 'id']],
            [['control_primary_product_id'], 'exist', 'skipOnError' => true, 'targetClass' => NdType::class, 'targetAttribute' => ['control_primary_product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'control_primary_product_id' => 'Control Primary Product ID',
            'name' => 'Hujjat nomi',
            'type_id' => 'Hujjat turi',
        ];
    }

    /**
     * Gets query for [[ControlPrimaryProduct]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getControlPrimaryProduct()
    {
        return $this->hasOne(PrimaryProduct::class, ['id' => 'control_primary_product_id']);
    }

    /**
     * Gets query for [[ControlPrimaryProduct0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getControlPrimaryProduct0()
    {
        return $this->hasOne(NdType::class, ['id' => 'control_primary_product_id']);
    }
}
