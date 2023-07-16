<?php

namespace common\models\actselection;

use Yii;

/**
 * This is the model class for table "{{%selected_product}}".
 *
 * @property int $id
 * @property int|null $act_selection_id
 * @property string|null $name
 * @property string|null $batch_number
 * @property int|null $ctry_ogn_code
 * @property string|null $mfr_name
 * @property int|null $mfr_id
 * @property int|null $mfrd_date
 * @property int|null $exptr_ctry_code
 * @property string|null $imptr_name
 * @property int|null $imptr_id
 * @property float|null $prod_netto
 * @property float|null $xtra_value
 * @property int|null $xtra_unit_om
 * @property string|null $cnfea_code
 * @property string|null $bar_code
 *
 * @property ActSelection $actSelection
 * @property Identification[] $identifications
 */
class SelectedProduct extends \common\models\LocalActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%selected_product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['act_selection_id', 'ctry_ogn_code', 'mfr_id', 'exptr_ctry_code', 'imptr_id', 'xtra_unit_om'], 'integer'],
            [['prod_netto', 'xtra_value'], 'number'],
            [['name', 'batch_number', 'mfr_name', 'imptr_name', 'mfrd_date', 'cnfea_code', 'bar_code'], 'string', 'max' => 255],
            [['act_selection_id'], 'exist', 'skipOnError' => true, 'targetClass' => ActSelection::class, 'targetAttribute' => ['act_selection_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {   $ParentAttrLbl = parent::AttributeLabels();
        $AttrLbl = [
            'id' => 'ID',
            // 'act_selection_id' => 'Act Selection ID',
            'name' => 'Mahsulot nomi',
            'batch_number' => 'To\'p raqami',
            'ctry_ogn_code' => 'Ishlab chiqaruvchi davlat nomi',
            'mfr_name' => 'Ishlab chiqaruchi nomi',
            'mfr_id' => 'Ishlab chiqaruvchi STIRi',
            'mfrd_date' => 'Ishlab chiqarilgan sana',
            'exptr_ctry_code' => 'Eksportyor davlat nomi',
            'imptr_name' => 'Importyor nomi',
            'imptr_id' => 'Importyor STIRi',
            'prod_netto' => 'Mahsulot netto og\'irligi',
            'xtra_value' => 'Qo\'shimcha o\'lchov birligidagi qiymat',
            'xtra_unit_om' => 'O\'lchov birligi',
            'cnfea_code' => 'TIF TN kodi',
            'bar_code' => 'Shtrix kodi',
        ];

        return array_merge($ParentAttrLbl, $AttrLbl);
    }

    /**
     * Gets query for [[ActSelection]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getActSelection()
    {
        return $this->hasOne(ActSelection::class, ['id' => 'act_selection_id'])->inverseOf('selectedProducts');
    }

    /**
     * Gets query for [[Identifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdentifications()
    {
        return $this->hasMany(Identification::class, ['selected_product_id' => 'id'])->inverseOf('selectedProduct');
    }

}
