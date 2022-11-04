<?php

namespace common\models\types;

use Yii;

/**
 * This is the model class for table "product_position".
 *
 * @property int $id
 * @property string|null $kode
 * @property string $name
 */
class ProductPosition extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_position';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['kode', 'name'], 'string', 'max' => 255],
            [['kode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => 'Kod',
            'name' => 'Name',
        ];
    }

    public function searchByName(string $code)
    {
        return ProductGroup::find()
            ->where(['kode' => $code])
            ->one();
    }
}
