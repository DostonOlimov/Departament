<?php
namespace common\models\prevention;
use common\models\control\Company;
use common\models\control\Instruction;
use Yii;

/**
 * This is the model class for table "caution_prevention".
 *
 * @property int $id
 * @property int $instructions_id
 * @property int $companies_id
 * @property string|null $message_num
 * @property string|null $message_date
 * @property string|null $comment
 * @property string|null $inspector_name
 * @property string|null $inspectors
 *
 * @property ControlCompanies $companies
 * @property ControlInstructions $instructions
 */
class Prevention extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'caution_prevention';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {    
            return [
                [['companies_id', 'instructions_id','inspector_name', 'message_date','comment'], 'required'],
                [['companies_id', 'instructions_id'], 'integer'],
                [['message_date'], 'safe'],
                [['comment'], 'string'],
                [['message_num'], 'string', 'max' => 255],
                [['inspector_name'], 'string', 'max' => 255],
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
            'message_date' => 'Yozma ko\'rsatma sanasi',
            'comment' => 'Izoh',
            'inspector_name' => 'Ijrochi F.I.SH',
            'inspectors' => 'Inspectorlar',
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
