<?php

namespace common\models\normativedocument;

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
            [['identification_id', 'normative_document_id'], 'integer'],
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
        return $this->hasOne(Identification::class, ['id' => 'identification_id'])->inverseOf('selectedNormativeDocuments');
    }

    /**
     * Gets query for [[IdentificationContents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdentificationContents()
    {
        return $this->hasMany(IdentificationContent::class, ['selected_normative_document_id' => 'id'])->inverseOf('selectedNormativeDocument');
    }

    /**
     * Gets query for [[NormativeDocument]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNormativeDocument()
    {
        return $this->hasOne(NormativeDocument::class, ['id' => 'normative_document_id'])->inverseOf('selectedNormativeDocuments');
    }
}
