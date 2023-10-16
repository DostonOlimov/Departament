<?php

namespace common\models\identification;

use common\models\actselection\SelectedProduct;
use Yii;

/**
 * This is the model class for table "{{%laboratory_protocol}}".
 *
 * @property int $id
 * @property int|null $selected_product_id
 * @property int|null $laboratory_id
 * @property int|null $delivery_date
 * @property string|null $protocol_number
 * @property int|null $protocol_date
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property LaboratoryProtocolContent[] $laboratoryProtocolContents
 * @property SelectedProduct $selectedProduct
 */
class LaboratoryProtocol extends \common\models\LocalActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%laboratory_protocol}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['selected_product_id', 'laboratory_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['protocol_number', 'created_at', 'updated_at', 'delivery_date', 'protocol_date'], 'string', 'max' => 255],
            [['selected_product_id'], 'exist', 'skipOnError' => true, 'targetClass' => SelectedProduct::class, 'targetAttribute' => ['selected_product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {   $ParentAttrLbl = parent::AttributeLabels();
        $AttrLbl = [
            'laboratory_id' => 'Sinov laboratoriyasi',
            'delivery_date' => 'Yetkazib berish sanasi',
            'protocol_number' => 'Bayonnoma raqami',
            'protocol_date' => 'Bayonnoma sanasi',
        ];

        return array_merge($ParentAttrLbl, $AttrLbl);
    }

    /**
     * Gets query for [[LaboratoryProtocolContents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLaboratoryProtocolContents()
    {
        return $this->hasMany(LaboratoryProtocolContent::class, ['laboratory_protocol_id' => 'id']);
    }

    /**
     * Gets query for [[SelectedProduct]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSelectedProduct()
    {
        return $this->hasOne(SelectedProduct::class, ['id' => 'selected_product_id']);
    }
}
