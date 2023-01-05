<?php
namespace common\models\prevention;
use common\models\control\Company;
use common\models\control\Instruction;
use common\models\User;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
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

    public function behaviors(){
        return [
            [
                'class' => TimesTampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),

            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {    
            return [
                [['companies_id', 'instructions_id','created_by', 'updated_by','comment'], 'required'],
                [['companies_id', 'instructions_id', 'created_by','updated_by'], 'integer'],
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
            'companies_id' => 'Korxona nomi',
            'instructions_id' => 'Tekshiruv kodi',
            'message_num' => 'Yozma ko\'rsatma raqami',
            'comment' => 'Izoh',
            'created_by' => 'Inspektor F.I.SH',
            'updated_by' => 'Nazoratchi F.I.SH',
            'created_at' => 'Ko\'rsatma sanasi',
            'updated_at' => 'Yangilangan sanasi',
        ];
    }

    /**
     * Gets query for [[Companies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany(){
        return $this->hasOne(Company::className(), ['id' => 'companies_id']);
    }
    public function getInstruction()
    {
        return $this->hasOne(Instruction::className(), ['id' => 'instructions_id']);
    }
    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}
