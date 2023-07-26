<?php

namespace common\models\normativedocument;

use Yii;

/**
 * This is the model class for table "{{%normative_document_section}}".
 *
 * @property int $id
 * @property int|null $normative_document_id
 * @property string|null $section_category_id
 * @property string|null $section_number
 * @property int|null $section_name
 *
 * @property NormativeDocument $normativeDocument
 * @property NormativeDocumentContent[] $normativeDocumentContents
 */
class NormativeDocumentSection extends NormativeDocument
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%normative_document_section}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['section_category_id','normative_document_id',  'parent_id', 'position'], 'integer'],
            [[ 'section_number', 'section_name'], 'string', 'max' => 255],
            [['normative_document_id'], 'exist', 'skipOnError' => true, 'targetClass' => NormativeDocument::class, 'targetAttribute' => ['normative_document_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => NormativeDocumentSection::class, 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Tegishliligi',
            'normative_document_id' => 'Me\'yoriy hujjat nomi',
            'section_category_id' => 'Bob turi',
            'section_number' => 'Bob raqami',
            'section_name' => 'Bob nomi',
            'position' => 'Tartib raqami',

        ];
    }

    /**
     * Gets query for [[NormativeDocument]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNormativeDocument()
    {
        return $this->hasOne(NormativeDocument::class, ['id' => 'normative_document_id'])->inverseOf('normativeDocumentSections');
    }

    /**
     * Gets query for [[NormativeDocumentContents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNormativeDocumentContents()
    {
        return $this->hasMany(NormativeDocumentContent::class, ['document_section_id' => 'id'])->inverseOf('documentSection');
    }
}
