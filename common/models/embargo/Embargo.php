<?php

namespace common\models\embargo;
use common\models\control\Company;
use common\models\control\Instruction;

use Yii;

/**
 * This is the model class for table "caution_embargo".
 *
 * @property int $id
 * @property int $instructions_id
 * @property int $companies_id
 * @property string|null $comment
 * @property int|null $message_number
 * @property int|null $status
 * @property string|null $message_date
 * @property string|null $inspector_name
 * @property string|null $inspectors
 *
 * @property ControlCompanies $companies
 * @property ControlInstructions $instructions
 */
class Embargo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'caution_embargo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['instructions_id', 'companies_id', 'comment','message_date', 'inspector_name'], 'required'],
            [['instructions_id',  'companies_id', 'status'], 'integer'],
            [['comment'], 'string'],
           // [['message_number'], 'unique'],
            [['message_date', 'inspector_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            //'id' => 'Ko\'rsatma ',
            'message_number' => 'Ko\'rsatma raqami',
            'instructions_id' => 'Tekshiruv kodi',
            'companies_id' => 'Korxona nomi',
            'comment' => 'Izoh',
            'status' => 'Holati',
            'message_date' => 'Ko\'rsatma sanasi',
            'inspector_name' => 'Ijrochi F.I.SH',
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
}
