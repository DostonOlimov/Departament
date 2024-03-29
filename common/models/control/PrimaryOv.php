<?php

namespace common\models\control;

use Yii;

/**
 * This is the model class for table "control_primary_ovs".
 *
 * @property int $id
 * @property int $control_primary_data_id
 * @property int $type
 * @property string $measurement
 * @property string $compared
 * @property string $invalid
 *
 * @property PrimaryData $controlPrimaryData
 */
class PrimaryOv extends \yii\db\ActiveRecord
{

    const TYPE_ENER = 1;
    const TYPE_PRODUCT = 2;
    const TYPE_TEX = 3;
    const TYPE_NOT = 4;

    public static function tableName()
    {
        return 'control_primary_ovs';
    }

    public function rules()
    {
        return [
            [[ 'type', 'measurement', 'compared', 'invalid'], 'required',],   
            [['control_primary_data_id', 'type'], 'integer'],
            [['measurement', 'compared', 'invalid','uncompared','expired','unworked'], 'string', 'max' => 255],
            [['control_primary_data_id'], 'exist', 'skipOnError' => true, 'targetClass' => PrimaryData::className(), 'targetAttribute' => ['control_primary_data_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'control_primary_data_id' => 'Control Primary Data ID',
            'type' => 'O\'V turlari',
            'measurement' => 'O\'V soni',
            'compared' => 'Qiyoslangan O\'V soni',
            'invalid' => 'Yaroqsiz O\'V soni',
            'uncompared' => 'Qiyoslash muddati o\'tgan O\'V soni',
            'expired' => 'Qiyoslanmagan O\'V soni',
            'unworked' => 'Ish faoliyatida bo\'lmagan(yaroqsiz O\'Vni hisoblamaganda) O\'V soni',
        ];
    }

    public static function getType($type = null)
    {
        $arr = [
            self::TYPE_ENER => 'Energiya resurslarini hisoblovchi',
            self::TYPE_PRODUCT => 'Mahsulot sifatini nazorat qiluvchi',
            self::TYPE_TEX => 'Texnologik jarayonda ishlatiladigan',
            self::TYPE_NOT => 'O\'lchov vositasi mavjud emas',
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }

    /**
     * Gets query for [[ControlPrimaryData]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrimaryData()
    {
        return $this->hasOne(PrimaryData::className(), ['id' => 'control_primary_data_id']);
    }
}
