<?php

namespace common\models\control;

use Yii;

/**
 * This is the model class for table "mandatory_certification".
 *
 * @property int $id
 * @property int|null $control_primary_product_id
 * @property string|null $number_blank
 * @property string|null $number_reestr
 * @property int|null $date_from
 * @property int|null $date_to
 *
 * @property ControlPrimaryProduct $controlPrimaryProduct
 */
class MandatoryCertification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mandatory_certification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['control_primary_product_id', 'date_from', 'date_to'], 'integer'],
            [['number_blank', 'number_reestr'], 'string', 'max' => 255],
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
            'number_blank' => 'Number Blank',
            'number_reestr' => 'Number Reestr',
            'date_from' => 'Date From',
            'date_to' => 'Date To',
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
