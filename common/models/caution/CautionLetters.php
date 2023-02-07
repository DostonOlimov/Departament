<?php

namespace common\models\caution;
use common\models\control\Company;
use common\models\control\Instruction;
use common\models\User;
use yiidreamteam\upload\FileUploadBehavior;
use yii\behaviors\BlameableBehavior;


use Yii;

/**
 * This is the model class for table "caution_letters".
 *
 * @property int $id
 * @property int $company_id
 * @property string $letter_date
 * @property string $letter_number
 * @property string $upload_file
 * @property string $inpector_name
 *
 * @property ControlCompanies $company
 */
class CautionLetters extends \yii\db\ActiveRecord
{
    public $s_file;
    public static function tableName()
    {
        return 'caution_letters';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['letter_date', 'letter_number','created_by','instructions_id','updated_by','comment'], 'required'],
            [['created_by','updated_by','instructions_id'], 'integer'],
            [['file'],'file','extensions'=> 'pdf,doc,docx'],
            [['letter_date','comment'], 'safe'],
            [['letter_number'], 'string', 'max' => 255],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'letter_date' => 'Ogohlantirish sanasi',
            'letter_number' => 'Ogohlantirish raqami',
            'instructions_id' => 'Tekshiruv buyrug\'i',
            'file' => 'Files',
            'created_by' => 'Inspektor F.I.SH',
            'updated_by' => 'Nazoratchi F.I.SH',
        ];
    }
    public function behaviors()
    {
        return [
            BlameableBehavior::class,           
            [
                'class' => FileUploadBehavior::class,
                'attribute' => 's_file',
                'filePath' => '@webroot/uploads/letters/ogohlantirish/[[filename]].[[extension]]',
                'fileUrl' => '/uploads/letters/ogohlantirish/[[filename]].[[extension]]',
            ],           
        ];
    }

    

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
   
    public function getInstruction()
    {
        return $this->hasOne(Instruction::class, ['id' => 'instructions_id']);
    }
    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}
