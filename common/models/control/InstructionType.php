<?php

namespace common\models\control;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "instruction_type".
 *
 * @property int $id
 * @property int $instruction_id
 * @property int|null $product
 * @property int|null $ov
 * @property int|null $document
 * @property int|null $canceled
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property ControlInstructions $instruction
 * @property User $updatedBy
 */
class InstructionType extends \yii\db\ActiveRecord
{

    const TYPE_PRODUCT = 1;
    const TYPE_OV = 2;
    const TYPE_DOCUMENT = 3;
    const TYPE_CANCEL = 4;

    public $date;
    public $type;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'instruction_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type','date'], 'required'],
            [['instruction_id', 'product', 'ov', 'document', 'canceled', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['instruction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Instruction::class, 'targetAttribute' => ['instruction_id' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }
    public static function typeList($type = null)
    {
        $arr = [
            self::TYPE_PRODUCT => 'Mahsulotlari',
            self::TYPE_OV => 'O\'lchov vositalari ',
            self::TYPE_DOCUMENT => 'Hujjat tahlili',
            self::TYPE_CANCEL => 'Tekshiruv o\'tkazilmadi',
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'instruction_id' => 'Instruction ID',
            'product' => 'Product',
            'ov' => 'Ov',
            'document' => 'Document',
            'canceled' => 'Canceled',
            'date' => 'Tekshiruvning haqiqatda boshlanish sanasi',
            'type' => 'Tekshiruv davomida quyidagilar o\'rganildi',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[Instruction]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInstruction()
    {
        return $this->hasOne(Instruction::class, ['id' => 'instruction_id']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }
}
