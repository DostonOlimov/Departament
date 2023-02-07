<?php

namespace common\models\control;

use Yii;
use common\models\control\PrimaryOv;

/**
 * This is the model class for table "control_primary_ov_nd".
 *
 * @property int $id
 * @property int|null $ov_id
 * @property string|null $name
 * @property int|null $type_id
 *
 * @property ControlPrimaryOvs $ov
 */
class ControlPrimaryOvNd extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'control_primary_ov_nd';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ov_id', 'type_id'], 'integer'],
            [['name'],'required'],
            [['name'], 'string', 'max' => 255],
            [['ov_id'], 'exist', 'skipOnError' => true, 'targetClass' => PrimaryOv::class, 'targetAttribute' => ['ov_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ov_id' => 'Ov ID',
            'name' => 'Hujjat nomi',
            'type_id' => 'Hujjat turi',
        ];
    }

    /**
     * Gets query for [[Ov]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOv()
    {
        return $this->hasOne(PrimaryOv::class, ['id' => 'ov_id']);
    }
}
