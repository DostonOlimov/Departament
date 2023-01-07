<?php

namespace common\models\caution;
use common\models\control\Company;

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
            [['company_id', 'letter_date', 'letter_number'], 'required'],
            [['company_id'], 'integer'],
            [['file'],'file','extensions'=> 'pdf,doc,docx'],
            [['letter_date'], 'safe'],
            [['letter_number', 'inpector_name'], 'string', 'max' => 255],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'letter_date' => 'Letter Date',
            'letter_number' => 'Letter Number',
            'file' => 'Files',
            'inpector_name' => 'Inpector Name',
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Companies::class, ['id' => 'company_id']);
    }
}
