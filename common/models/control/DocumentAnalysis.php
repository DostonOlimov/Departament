<?php

namespace common\models\control;

use Yii;
use common\models\control\Instructions;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

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
    public $document_type;


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
            'reestr_number' => 'Hujjat reestr raqami',
            'given_date' => 'Hujjat berilgan sana',
            'defect' => 'Kamchilik',
            'document_type' => 'Hujjat tahlili',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
