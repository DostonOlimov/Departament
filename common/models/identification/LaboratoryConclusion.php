<?php

namespace common\models\identification;

use common\models\actselection\SelectedProduct;
use common\models\normativedocument\NormativeDocument;
use Yii;

/**
 * This is the model class for table "{{%laboratory_conclusion}}".
 *
 * @property int $id
 * @property int|null $selected_product_id
 * @property int|null $normative_document_id
 * @property string|null $indicator_name
 * @property string|null $requirement_link
 * @property int|null $requirement_range
 * @property float|null $requirement_min
 * @property float|null $requirement_max
 * @property int|null $status
 *
 * @property NormativeDocument $normativeDocument
 * @property SelectedProduct $selectedProduct
 */
class LaboratoryConclusion extends \common\models\LocalActiveRecord
{
    public $condition1;
    public $condition2;
    const LESS_MORE = 1;                    // a1 < x < a2
    const LESS_OR_EQUAL = 2;           // a1 <= x < a2
    const MORE_OR_EQUAL = 3;           // a1 < x <= a2
    const LESS_OR_EQUAL_MORE_OR_EQUAL = 4;  //a1 <= x <= a2

    public static function tableName()
    {
        return '{{%laboratory_conclusion}}';
    }

    public function rules()
    {
        return [    
            [['selected_product_id', 'normative_document_id', 'requirement_range', 'unit_om'], 'integer'],
            [['requirement_min', 'requirement_max', 'current_value'], 'number'],
            [['condition1', 'condition2'], 'safe'],
            [['indicator_name', 'requirement_link'], 'string', 'max' => 255],
            [['normative_document_id'], 'exist', 'skipOnError' => true, 'targetClass' => NormativeDocument::class, 'targetAttribute' => ['normative_document_id' => 'id']],
            [['selected_product_id'], 'exist', 'skipOnError' => true, 'targetClass' => SelectedProduct::class, 'targetAttribute' => ['selected_product_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {   $ParentAttrLbl = parent::AttributeLabels();
        $AttrLbl = [
            'indicator_name' => 'Ko\'rsatkich nomi',
            'requirement_link' => 'Talab belgilangan hujjat bandi',
            'requirement_range' => 'Talab oralig\'i',
            'requirement_min' => 'Talabning eng kam qiymati',
            'requirement_max' => 'Talabning eng yuqori qiymati',
            'current_value' => 'Amaldagi qiymat',
            'condition1' => '<=',
            'condition2' => '>='
        ];

        return array_merge($ParentAttrLbl, $AttrLbl);
    }

    public function getNormativeDocument()
    {
        return $this->hasOne(NormativeDocument::class, ['id' => 'normative_document_id']);
    }

    public function getSelectedProduct()
    {
        return $this->hasOne(SelectedProduct::class, ['id' => 'selected_product_id']);
    }

    public function getRequirementRange($condition1, $condition2){
        switch (true) {
            case ($condition1 && !$condition2):
                // code for when $condition1 is true and $condition2 is false
                return self::LESS_OR_EQUAL;
                break;
            case ($condition1 && $condition2):
                // code for when both $condition1 and $condition2 are true
                return self::LESS_OR_EQUAL_MORE_OR_EQUAL;
                break;
            case (!$condition1 && $condition2):
                // code for when $condition1 is false and $condition2 is true
                return self::MORE_OR_EQUAL;
                break;
            default:
                // code for when both $condition1 and $condition2 are false
                return self::LESS_MORE;
                break;
        }
    }
}
