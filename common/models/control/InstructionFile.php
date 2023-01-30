<?php

namespace common\models\control;
use common\models\control\Instruction;
use common\models\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yiidreamteam\upload\FileUploadBehavior;

use Yii;

/**
 * This is the model class for table "instruction_file".
 *
 * @property int $id
 * @property int $instructions_id
 * @property string|null $basis_file
 * @property string|null $program_file
 * @property string|null $order_file
 * @property int $created_by
 * @property int $updated_by
 *
 * @property User $createdBy
 * @property ControlInstructions $instructions
 * @property User $updatedBy
 */
class InstructionFile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'instruction_file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['instructions_id', 'created_by', 'updated_by'], 'required'],
            [['instructions_id', 'created_by', 'updated_by'], 'integer'],
            [['basis_file', 'program_file', 'order_file'], 'file'],
            [['instructions_id'], 'exist', 'skipOnError' => true, 'targetClass' => ControlInstructions::class, 'targetAttribute' => ['instructions_id' => 'id']],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'instructions_id' => 'Instructions ID',
            'basis_file' => 'Basis File',
            'program_file' => 'Program File',
            'order_file' => 'Order File',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
    public function behaviors()
    {
        return [
            // TimestampBehavior::class,
            BlameableBehavior::class,
            [
                'class' => FileUploadBehavior::class,
                'attribute' => 'basis_file',
                'filePath' => '@webroot/uploads/asos-xati/[[pk]].[[extension]]',
                'fileUrl' => '/uploads/asos-xati/[[pk]].[[extension]]',
            ],
            [
                'class' => FileUploadBehavior::class,
                'attribute' => 'program_file',
                'filePath' => '@webroot/uploads/dastur-xati/[[pk]].[[extension]]',
                'fileUrl' => '/uploads/dastur-xati/[[pk]].[[extension]]',
            ],
            [
                'class' => FileUploadBehavior::class,
                'attribute' => 'order_file',
                'filePath' => '@webroot/uploads/bayonnoma/[[pk]].[[extension]]',
                'fileUrl' => '/uploads/bayonnoma/[[pk]].[[extension]]',
            ],
            
        ];
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

   
    public function getInstruction()
    {
        return $this->hasOne(Instruction::class, ['id' => 'instructions_id']);
    }

    
}
