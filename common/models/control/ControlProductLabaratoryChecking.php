<?php

namespace common\models\control;

use Yii;

/**
 * This is the model class for table "control_product_labaratory_checking".
 *
 * @property int $id
 * @property int $product_id
 * @property int|null $labaratory_checking
 * @property int|null $quality
 * @property string|null $descreption
 *
 * @property ControlPrimaryProduct $product
 */
class ControlProductLabaratoryChecking extends \yii\db\ActiveRecord
{
    public $labaratory_quality;
    public $labaratory_description;
    public $product_name;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'control_product_labaratory_checking';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['product_id', 'quality'], 'integer'],
            [['description'], 'string'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => PrimaryProduct::class, 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'product_name' => 'Mahsulot nomi',
            'quality' => 'Mahsulot yaroqliligi',
            'description' => 'Izoh',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(ControlPrimaryProduct::class, ['id' => 'product_id']);
    }
}
