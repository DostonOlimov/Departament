<?php

namespace common\models\identification;

use common\models\actselection\ActSelection;
use common\models\actselection\SelectedProduct;
use common\models\Company;
use common\models\govcontrol\Order;
use common\models\govcontrol\Program;
use common\models\normativedocument\NormativeDocument;
use common\models\normativedocument\NormativeDocumentContent;
use common\models\normativedocument\NormativeDocumentSection;
use common\models\normativedocument\SelectedNormativeDocument;
use Yii;

/**
 * This is the model class for table "{{%identification_content}}".
 *
 * @property int $id
 * @property int|null $selected_normative_document_id
 * @property int|null $normative_document_content_id
 * @property string|null $comment
 * @property int|null $conformity
 *
 * @property NormativeDocumentContent $normativeDocumentContent
 * @property SelectedNormativeDocument $selectedNormativeDocument
 */
class IdentificationContent extends \common\models\LocalActiveRecord
{
    const CONFORM = 0;
    const NONCONFORM = 1;
    public $name;
    public $status;
    public $section_name;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%identification_content}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['selected_normative_document_id', 'normative_document_content_id', 'conformity'], 'integer'],
            [['comment'], 'string'],
            [['section_name', 'name', 'status'], 'safe'],
            [['normative_document_content_id'], 'exist', 'skipOnError' => true, 'targetClass' => NormativeDocumentContent::class, 'targetAttribute' => ['normative_document_content_id' => 'id']],
            [['selected_normative_document_id'], 'exist', 'skipOnError' => true, 'targetClass' => SelectedNormativeDocument::class, 'targetAttribute' => ['selected_normative_document_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'selected_normative_document_id' => 'Me\'yoriy hujjat nomi',
            'normative_document_content_id' => 'Me\'yoriy hujjat mazmuni',
            'comment' => 'Amaldagi holat',
            'conformity' => 'Muvofiqlik',
        ];
    }

    /**
     * Gets query for [[NormativeDocumentContent]].
     *
     * @return \yii\db\ActiveQuery
     */
    
    /**
     * Gets query for [[SelectedNormativeDocument]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConformity($type = null)
    {
        $arr = [self::CONFORM => 'Muvofiq',self::NONCONFORM => 'Nomuvofiq'];
        if ($type === null) {return $arr;}
        return $arr[$type];
    }



    public function getSelectedNormativeDocument()
    {
        return $this->hasOne(SelectedNormativeDocument::class, ['id' => 'selected_normative_document_id']);
    }
    public function getIdentification()
    {
        return $this->hasone(Identification::class, ['id' => 'identification_id'])->via('selectedNormativeDocument');
    }
    public function getSelectedProduct()
    {
        return $this->hasone(SelectedProduct::class, ['id' => 'selected_product_id'])->via('identification');
    }
    public function getActSelection()
    {
        return $this->hasone(ActSelection::class, ['id' => 'act_selection_id'])->via('selectedProduct');
    }
    public function getGovControlOrder()
    {
        return $this->hasone(Order::class, ['id' => 'gov_control_order_id'])->via('actSelection');
    }
    public function getGovControlProgram()
    {
        return $this->hasone(Program::class, ['id' => 'gov_control_program_id'])->via('govControlOrder');
    }
    public function getCompany()
    {
        return $this->hasone(Company::class, ['id' => 'company_id'])->via('govControlProgram');
    }
    
    public function getNormativeDocumentContent()
    {
        return $this->hasOne(NormativeDocumentContent::class, ['id' => 'normative_document_content_id']);
    }
    public function getNormativeDocumentSection()
    {
        return $this->hasOne(NormativeDocumentSection::class, ['id' => 'document_section_id'])->via('normativeDocumentContent');
    }
    public function getNormativeDocument()
    {
        return $this->hasOne(NormativeDocument::class, ['id' => 'normative_document_id'])->via('normativeDocumentSection');
    }
}
