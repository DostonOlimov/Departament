<?php

namespace common\models\normativedocument;

use Yii;

/**
 * This is the model class for table "{{%normative_document_content}}".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property int|null $document_section_id
 * @property string|null $content
 * @property int|null $position
 *
 * @property NormativeDocumentSection $documentSection
 * @property IdentificationContent[] $identificationContents
 * @property NormativeDocumentContent[] $normativeDocumentContents
 * @property NormativeDocumentContent $parent
 */
class NormativeDocumentContent extends NormativeDocumentSection
{
    public $parent_name;
    public $section;
    // public $parent_name;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%normative_document_content}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'document_section_id', 'position'], 'integer'],
            [['content'], 'string'],
            [['document_section_id'], 'exist', 'skipOnError' => true, 'targetClass' => NormativeDocumentSection::class, 'targetAttribute' => ['document_section_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => NormativeDocumentContent::class, 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Me\'yoriy hujjat tegishliligi',
            'parent_name' => 'Me\'yoriy hujjat tegishliligi',
            'document_section_id' => 'Bob nomi',
            'content' => 'Me\'yoriy hujjat talabi',
            'position' => 'Tartib raqami',
            // 'section' => 'paragraf nomi',
        ];
    }

    /**
     * Gets query for [[DocumentSection]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentSection()
    {
        return $this->hasOne(NormativeDocumentSection::class, ['id' => 'document_section_id'])->inverseOf('normativeDocumentContents');
    }

    /**
     * Gets query for [[IdentificationContents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdentificationContents()
    {
        return $this->hasMany(IdentificationContent::class, ['normative_document_content_id' => 'id'])->inverseOf('normativeDocumentContent');
    }

    /**
     * Gets query for [[NormativeDocumentContents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNormativeDocumentContents()
    {
        return $this->hasMany(NormativeDocumentContent::class, ['parent_id' => 'id'])->inverseOf('parent');
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(NormativeDocumentContent::class, ['id' => 'parent_id'])->inverseOf('normativeDocumentContents');
    }
}