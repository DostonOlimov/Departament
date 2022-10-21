<?php

namespace common\models\control;

use Yii;

/**
 * This is the model class for table "control_primary_product_nd".
 *
 * @property int $id
 * @property int|null $control_primary_product_id
 * @property string|null $name
 * @property int|null $type_id
 *
 * @property ControlPrimaryProduct $controlPrimaryProduct
 */
class ControlPrimaryProductNd extends \yii\db\ActiveRecord
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
            [['control_primary_product_id'], 'exist', 'skipOnError' => true, 'targetClass' => ControlPrimaryProduct::class, 'targetAttribute' => ['control_primary_product_id' => 'id']],
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
            'type_id' => 'Mahsulotga oid reglament yoki meyoriy hujjat turi',
        ];
    }

    /**
     * Gets query for [[ControlPrimaryProduct]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getControlPrimaryProduct()
    {
        return $this->hasOne(ControlPrimaryProduct::class, ['id' => 'control_primary_product_id']);
    }
}
