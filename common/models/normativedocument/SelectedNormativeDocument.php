<?php

namespace common\models\normativedocument;

use common\models\actselection\ActSelection;
use common\models\actselection\SelectedProduct;
use common\models\Company;
use common\models\govcontrol\Order;
use common\models\govcontrol\Program;
use common\models\identification\Identification;
use Yii;

/**
 * This is the model class for table "{{%selected_normative_document}}".
 *
 * @property int $id
 * @property int|null $identification_id
 * @property int|null $normative_document_id
 *
 * @property Identification $identification
 * @property IdentificationContent[] $identificationContents
 * @property NormativeDocument $normativeDocument
 */
class SelectedNormativeDocument extends \common\models\LocalActiveRecord
{
    public $normative_document;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%selected_normative_document}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['identification_id', 'normative_document_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'string'],
            [['normative_document'], 'safe'],
            [['identification_id'], 'exist', 'skipOnError' => true, 'targetClass' => Identification::class, 'targetAttribute' => ['identification_id' => 'id']],
            [['normative_document_id'], 'exist', 'skipOnError' => true, 'targetClass' => NormativeDocument::class, 'targetAttribute' => ['normative_document_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'identification_id' => 'Identification ID',
            'normative_document_id' => 'Me\'yoriy hujjat nomi',
            'normative_document' => 'Me\'yoriy hujjatlar',

        ];
    }

    /**
     * Gets query for [[Identification]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdentification()
    {
        return $this->hasOne(Identification::class, ['id' => 'identification_id']);
    }

    public function getSelectedProduct()
    {
        return $this->hasOne(SelectedProduct::class, ['id' => 'selected_product_id'])->via('identification');
    }

    public function getActSelection()
    {
        return $this->hasOne(ActSelection::class, ['id' => 'act_selection_id'])->via('selectedProduct');
    }

    public function getGovControlOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'gov_control_order_id'])->via('actSelection');
    }

    public function getGovControlProgram()
    {
        return $this->hasOne(Program::class, ['id' => 'gov_control_program_id'])->via('govControlOrder');
    }

    public function getCompany()
    {
        return $this->hasOne(Company::class, ['id' => 'company_id'])->via('govControlProgram');
    }

    /**
     * Gets query for [[IdentificationContents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdentificationContents()
    {
        return $this->hasMany(IdentificationContent::class, ['selected_normative_document_id' => 'id']);
    }

    /**
     * Gets query for [[NormativeDocument]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNormativeDocument()
    {
        return $this->hasOne(NormativeDocument::class, ['id' => 'normative_document_id']);
    }

    public function getNormativeDocumentSections()
    {
        return $this->hasMany(NormativeDocumentSection::class, ['normative_document_id' => 'id'])->via('normativeDocument');
    }

    public function getNormativeDocumentContents()
    {
        return $this->hasMany(NormativeDocumentContent::class, ['document_section_id' => 'id'])->via('normativeDocumentSections');
    }
}
