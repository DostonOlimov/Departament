<?php

namespace common\models\normativedocument;

use Yii;

/**
 * This is the model class for table "{{%normative_document}}".
 *
 * @property int $id
 * @property int|null $category_id
 * @property string|null $determination
 * @property string|null $name
 * @property int|null $activation_date
 * @property string|null $activation_info
 * @property int|null $deactivation_date
 * @property string|null $deactivation_info
 *
 * @property NormativeDocumentSection[] $normativeDocumentSections
 * @property SelectedNormativeDocument[] $selectedNormativeDocuments
 */
class NormativeDocument extends \common\models\LocalActiveRecord
{
const TYPE_STANDARD = 0;
const TYPE_TECHREG = 1;

const SECTION_STORAGE = 0;
const SECTION_LABELING = 1;
const SECTION_PACKING = 2;
const SECTION_TRANSPORTING = 3;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%normative_document}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id'], 'integer'],
            [['name', 'activation_info', 'deactivation_info', 'activation_date', 'deactivation_date'], 'string'],
            [['determination'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Kategoriyasi',
            'determination' => 'Belgilanishi',
            'name' => 'Hujjat nomi',
            'activation_date' => 'Amalga kirish sanasi',
            'activation_info' => 'Asos bo\'luvchi hujjat',
            'deactivation_date' => 'Amaldan chiqish sanasi',
            'deactivation_info' => 'Asos bo\'luvchi hujjat',
        ];
    }

    /**
     * Gets query for [[NormativeDocumentSections]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNormativeDocumentSections()
    {
        return $this->hasMany(NormativeDocumentSection::class, ['normative_document_id' => 'id'])->inverseOf('normativeDocument');
    }

    /**
     * Gets query for [[SelectedNormativeDocuments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSelectedNormativeDocuments()
    {
        return $this->hasMany(SelectedNormativeDocument::class, ['normative_document_id' => 'id'])->inverseOf('normativeDocument');
    }
    public static function getNormativeDocumentType($type = null)
    {
        $arr = [
            self::TYPE_STANDARD => 'Standart',
            self::TYPE_TECHREG => 'Texnik reglament',
        ];

        if ($type === null) {
            return $arr;
        }
        
        return $arr[$type];
    }
    public static function getSectionType($type = null)
    {
        $arr = [
            self::SECTION_STORAGE => 'Saqlash',
            self::SECTION_LABELING => 'Tamg\'alash',
            self::SECTION_PACKING => 'Qadoqlash',
            self::SECTION_TRANSPORTING => 'Tashish',
        ];

        if ($type === null) {
            return $arr;
        }
        
        return $arr[$type];
    }

    public static function getSectionDropDown($keysToDelete = [])
    {
        // $keysToDelete = [0,2];
        $arr = [
            self::SECTION_STORAGE => 'Saqlash',
            self::SECTION_LABELING => 'Tamg\'alash',
            self::SECTION_PACKING => 'Qadoqlash',
            self::SECTION_TRANSPORTING => 'Tashish',
        ];
            foreach ($keysToDelete as $key) {
                unset($arr[$key]);
            }
            // debug($arr);
            return $arr;
    }
    public static function getNormativeDocumentNames($nd_unset = null)
    {

        // debug($nd_unset);
        $nd_unset = SelectedNormativeDocument::findAll(['identification_id' => $nd_unset]);
        // debug($nd_unset);
        $result = [];
        $nd = NormativeDocument::find()->all();
        foreach ($nd as $one_nd){
            $result[$one_nd->id] = $one_nd->determination;
        }
        // debug($result);

        foreach ($nd_unset as $nd) {
            // debug($nd->id);
            unset($result[$nd->normative_document_id]);
        }

        // debug($result);
        return $result;
    }
    public static function getNormativeDocumentIndicators($id)
    {
        $result = '';
        foreach (NormativeDocumentContent::find(['parent_id' => $id])->all() as $nd){
            $result.= $nd->determination;
        }
        return $result;
    }
}
