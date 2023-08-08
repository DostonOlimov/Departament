<?php

namespace common\models\identification;

use Yii;

/**
 * This is the model class for table "{{%identification}}".
 *
 * @property int $id
 * @property int|null $selected_product_id
 *
 * @property SelectedNormativeDocument[] $selectedNormativeDocuments
 * @property SelectedProduct $selectedProduct
 */
class Identification extends \common\models\LocalActiveRecord
{
    public $selected_normative_documents;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%identification}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['selected_product_id'], 'integer'],
            [['selected_normative_documents'], 'safe'],

            [['selected_product_id'], 'exist', 'skipOnError' => true, 'targetClass' => SelectedProduct::class, 'targetAttribute' => ['selected_product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'selected_product_id' => 'Selected Product ID',
        ];
    }

    /**
     * Gets query for [[SelectedNormativeDocuments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSelectedNormativeDocuments()
    {
        return $this->hasMany(SelectedNormativeDocument::class, ['identification_id' => 'id']);
    }

    public function getSelectedIdentificationContents()
    {
        return $this->hasMany(IdentificationContent::class, ['selected_normative_document_id' => 'normative_document_id'])->via('SelectedNormativeDocuments');
    }

    /**
     * Gets query for [[SelectedProduct]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSelectedProduct()
    {
        return $this->hasOne(SelectedProduct::class, ['id' => 'selected_product_id']);
    }
}
