<?php

namespace common\models\types;

use Yii;

/**
 * This is the model class for table "product_group".
 *
 * @property int $id
 * @property string|null $kode
 * @property string $name
 * @property int $sector_id
 */
class ProductGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'sector_id'], 'required'],
            [['sector_id'], 'integer'],
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
            'sector_id' => 'Sector ID',
        ];
    }

    public function searchByName(string $code)
    {
        return ProductGroup::find()
            ->where(['kode' => $code])
            ->one();
    }
}
