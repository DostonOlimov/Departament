<?php

namespace common\models\types;

use Yii;

/**
 * This is the model class for table "product_class".
 *
 * @property int $id
 * @property string|null $kode
 * @property string $name
 */
class ProductClass extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_class';
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
            'kode' => 'Kode',
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
