<?php

namespace common\models\actselection;

use common\models\identification\Identification;
use common\models\identification\LaboratoryProtocol;
use common\models\identification\LaboratoryProtocolContent;
use common\models\normativedocument\SelectedNormativeDocument;
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
    public $normative_documents;
    public $indicators;
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
            [['name', 'xtra_value_identification', 'xtra_value_laboratory', 'xtra_unit_om'], 'required'],
            [['act_selection_id', 'ctry_ogn_code', 'mfr_id', 'exptr_ctry_code', 'imptr_id', 'xtra_unit_om'], 'integer'],
            [['prod_netto', 'xtra_value', 'xtra_value_identification', 'xtra_value_laboratory'], 'number'],
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
            'xtra_value_identification' => 'Sezgi a’zolari orqali (tashqi ko‘rinishini) tekshirish uchun',
            'xtra_value_laboratory' => 'Sinash uchun',
            'xtra_unit_om' => 'O\'lchov birligi',
            'cnfea_code' => 'TIF TN kodi',
            'bar_code' => 'Shtrix kodi',
            'normative_documents' => 'Me\'yoriy hujjatlar',
            'indicators' => 'Ko\'rsatkichlar',
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
        return $this->hasOne(ActSelection::class, ['id' => 'act_selection_id']);
    }

    /**
     * Gets query for [[Identifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdentification()
    {
        return $this->hasOne(Identification::class, ['selected_product_id' => 'id']);
    }
    public function getSelectedNormativeDocuments()
    {
        return $this->hasMany(SelectedNormativeDocument::class, ['identification_id' => 'id'])->via('identification');
    }

    public function getLaboratoryProtocol()
    {
        return $this->hasOne(LaboratoryProtocol::class, ['selected_product_id' => 'id']);
    }

    public function getLaboratoryProtocolContents()
    {
        return $this->hasMany(LaboratoryProtocolContent::class, ['laboratory_protocol_id' => 'id'])->via('laboratoryProtocol');
    }

}
