<?php

namespace common\models;

use Yii;
use common\models\Region;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "court".
 *
 * @property int $id
 * @property int|null $region_id
 * @property string|null $name
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Regions $region
 */
class Court extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'court';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_id',], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::class, 'targetAttribute' => ['region_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'region_id' => 'Hudud nomi',
            'name' => 'Name',
            'created_by' => 'Yaratgan foydalanuvchi',
            'updated_by' => 'O\'zgartirgan foydalanuvchi',
            'created_at' => 'Yaratilgan sana',
            'updated_at' => 'O\'zgartirilgan sana',
        ];
    }
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
        ];
    }
    /**
     * Gets query for [[Region]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Regions::class, ['id' => 'region_id']);
    }
}
