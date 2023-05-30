<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_position}}".
 *
 * @property int $id
 * @property string $position
 * @property string $alias
 * @property int|null $status
 */
class UserPosition extends LocalActiveRecord
{
    /**
     * {@inheritdoc}
     */

     const STATUS_ACTIVE = 1;
     const STATUS_PASSIVE = 0;  

    public static function tableName()
    {
        return '{{%user_position}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['position', 'alias'], 'required'],
            [['status'], 'integer'],
            [['position', 'alias'], 'string', 'max' => 255],
            [['position'], 'unique'],
            // [['alias'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {   $ParentAttrLbl = parent::AttributeLabels();
        $AttrLbl = [
            // 'id' => 'ID',
            // 'position' => 'Position',
            // 'alias' => 'Alias',
            // 'status' => 'Status',
        ];

        return array_merge($ParentAttrLbl, $AttrLbl);
    }

    public static function getStatus($type = null)
    {
        $arr = [

            self::STATUS_ACTIVE => 'Aktiv',
            self::STATUS_PASSIVE => 'Passiv',
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }


}
