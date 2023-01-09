<?php

namespace common\models\caution;
use common\models\control\Company;
use common\models\User;

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
    /**
     * {@inheritdoc}
     */
    //public $file;
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
            [['company_id', 'letter_date', 'letter_number','created_by','updated_by','comment'], 'required'],
            [['company_id','created_by','updated_by'], 'integer'],
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
            'company_id' => 'Korxona nomi',
            'letter_date' => 'Ogohlantirish sanasi',
            'letter_number' => 'Ogohlantirish raqami',
            'file' => 'Files',
            'created_by' => 'Inspektor F.I.SH',
            'updated_by' => 'Nazoratchi F.I.SH',
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::class, ['id' => 'company_id']);
    }
    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}
