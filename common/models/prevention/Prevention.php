<?php
namespace common\models\prevention;
use common\models\control\Company;
use common\models\control\Instruction;
use common\models\User;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yiidreamteam\upload\FileUploadBehavior;
use yii\behaviors\BlameableBehavior;
use Yii;

class Prevention extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'caution_prevention';
    }
    public $s_file;

    public function behaviors(){
        return [
            [
                'class' => TimesTampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),

            ],
            BlameableBehavior::class,           
            [
                'class' => FileUploadBehavior::class,
                'attribute' => 's_file',
                'filePath' => '@webroot/uploads/caution_prevention/[[filename]].[[extension]]',
                'fileUrl' => '/uploads/caution_prevention/[[filename]].[[extension]]',
            ], 
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {    
            return [
                [['instructions_id','created_by', 'updated_by','comment'], 'required'],
                [['instructions_id', 'created_by','updated_by'], 'integer'],
                [['comment'], 'string'],
                [['created_at','updated_at'],'safe'],
                
                
            ];        
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Yozma ko\'rsatma raqami',
            'instructions_id' => 'Tekshiruv buyrug\'i',
            'message_num' => 'Yozma ko\'rsatma raqami',
            'comment' => 'Izoh',
            'created_by' => 'Inspektor F.I.SH',
            'updated_by' => 'Nazoratchi F.I.SH',
            'created_at' => 'Ko\'rsatma sanasi',
            'updated_at' => 'Ko\'rsatma sanasi',
        ];
    }

    /**
     * Gets query for [[Companies]].
     *
     * @return \yii\db\ActiveQuery
     */
    
    public function getInstruction()
    {
        return $this->hasOne(Instruction::className(), ['id' => 'instructions_id']);
    }
    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}
