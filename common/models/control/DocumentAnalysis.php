<?php

namespace common\models\control;

use Yii;
use common\models\control\Instructions;

/**
 * This is the model class for table "document_analysis".
 *
 * @property int $id
 * @property int $control_instruction_id
 * @property string|null $reestr_number
 * @property int|null $given_date
 * @property string|null $defect
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property ControlInstructions $controlInstruction
 * @property User $createdBy
 * @property User $updatedBy
 */
class DocumentAnalysis extends \yii\db\ActiveRecord
{

    const TYPE_OV = 1;
    const TYPE_PRODUCT = 10;
    const TYPE_DOC = 100;
    const TYPE_NO_INSTRUCTION = 1000;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'document_analysis';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['control_instruction_id'], 'required'],
            [['control_instruction_id', 'given_date', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['reestr_number', 'defect'], 'string', 'max' => 255],
            [['control_instruction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Instructions::class, 'targetAttribute' => ['control_instruction_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'control_instruction_id' => 'Control Instruction ID',
            'reestr_number' => 'Reestr Number',
            'given_date' => 'Given Date',
            'defect' => 'Defect',
            'type' => 'Type',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    public static function typeList($type = null)
    {
        $arr = [
            self::TYPE_OV => 'O\'lchov vositasi',
            self::TYPE_PRODUCT => 'Mahsulot ',
            self::TYPE_DOC => 'Hujjat tahlili',
            self::TYPE_NO_INSTRUCTION => 'Tekshiruvga qo\'yilmadi',
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
     * Gets query for [[ControlInstruction]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getControlInstruction()
    {
        return $this->hasOne(Instructions::class, ['id' => 'control_instruction_id']);
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
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }
}
