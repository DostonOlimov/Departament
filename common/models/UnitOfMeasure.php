<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%unit_of_measure}}".
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $synonym
 * @property int|null $kind_of_quantity
 * @property string|null $concept_eng
 * @property string|null $dimension
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class UnitOfMeasure extends \common\models\LocalActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%unit_of_measure}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kind_of_quantity', 'status', 'created_by', 'updated_by'], 'integer'],
            [['code', 'synonym', 'concept_eng', 'dimension', 'created_at', 'updated_at'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */

    public function attributeLabels()
    {   $ParentAttrLbl = parent::AttributeLabels();
        $AttrLbl = [
            'code' => 'Code',
            'synonym' => 'Synonym',
            'kind_of_quantity' => 'Kind Of Quantity',
            'concept_eng' => 'Concept Eng',
            'dimension' => 'Dimension',
        ];

        return array_merge($ParentAttrLbl, $AttrLbl);
    }
}
