<?php

namespace common\models\identification;

use common\models\normativedocument\NormativeDocumentContent;
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
            [['name' , 'status'], 'safe'],
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
    public function getNormativeDocumentContent()
    {
        return $this->hasOne(NormativeDocumentContent::class, ['id' => 'normative_document_content_id'])->inverseOf('identificationContents');
    }

    /**
     * Gets query for [[SelectedNormativeDocument]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSelectedNormativeDocument()
    {
        return $this->hasOne(SelectedNormativeDocument::class, ['id' => 'selected_normative_document_id'])->inverseOf('identificationContents');
    }
    public function getConformity($type = null)
    {
        $arr = [self::CONFORM => 'Muvofiq',self::NONCONFORM => 'Nomuvofiq'];
        if ($type === null) {return $arr;}
        return $arr[$type];
    }
}
