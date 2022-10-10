<?php

namespace common\models\control;

use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "control_instruction".
 *
 * @property int $id
 * @property int|null $base
 * @property string|null $letter_date
 * @property string|null $letter_number
 * @property string|null $command_date
 * @property string|null $checkup_finish_date
 * @property string|null $checkup_begin_date
 * @property string|null $command_number
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property Company $controlCompany
 */
class Instruction extends \yii\db\ActiveRecord
{
//    const GENERAL_STATUS_CREATED = 10;
    const GENERAL_STATUS_IN_PROCESS = 11;
    const GENERAL_STATUS_SEND = 20;
    const GENERAL_STATUS_DONE = 21;

    const BASE_GRAF = 0;
    const BASE_GIVEN = 1;
    const BASE_APPEAL = 2;
    const BASE_SMM_APPEAL = 3;
    const BASE_ASSIGNMENT = 4;

    public $employers;
    public $admin;


    public static function tableName()
    {
        return 'control_instructions';
    }

    public function rules()
    {
        return [
            [['base', 'general_status'], 'integer'],
            [['general_status'], 'default', 'value' => self::GENERAL_STATUS_IN_PROCESS],
            [['employers'], 'safe'],
            [['base', 'letter_date', 'command_date', 'letter_number', 'command_number'], 'required'],
            [['letter_number', 'command_number',  'letter_date', 'command_date', 'checkup_begin_date', 'checkup_finish_date', 'admin'], 'string', 'max' => 255],
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $this->letter_date = strtotime($this->letter_date);
        $this->command_date = strtotime($this->command_date);
        $this->checkup_begin_date = strtotime($this->checkup_begin_date);
        $this->checkup_finish_date = strtotime($this->checkup_finish_date);

        return true;
    }

    public static function getType($type = null)
    {
        $arr = [
            self::BASE_GRAF => 'Reja grafik',
            self::BASE_GIVEN => 'Berilgan ko\'rsatma',
            self::BASE_APPEAL => 'Kelib tushgan murojaat',
            self::BASE_SMM_APPEAL => 'Ijtimoiy tarmoqlardan kelib tushgan murojaatlar',
            self::BASE_ASSIGNMENT => 'Xukumat topshiriqlari',
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }

    public static function getStatus($status = null)
    {
        $arr = [
            self::GENERAL_STATUS_IN_PROCESS => 'Bajarilmoqda',
            self::GENERAL_STATUS_SEND => 'Nazoratchiga yuborildi',
            self::GENERAL_STATUS_DONE => 'Bajarildi',
        ];

        if ($status === null) {
            return $arr;
        }

        return $arr[$status];
    }

    public static function getUsers()
    {
        $result = [];
        foreach (User::find()->where(['role' => 'inspector', 'status' => User::STATUS_ACTIVE])->all() as $user){
            $result[$user->id] = $user->name . ' ' . $user->surname;
        }
        return $result;
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'base' => 'Asos',
            'employers' => 'Inspektorlar',
            'letter_date' => 'Asos bo\'luvchi hujjat sanasi',
            'letter_number' => 'Asos bo\'luvchi hujjat nomeri',
            'command_date' => 'Buyruq sanasi',
            'command_number' => 'Buyruq nomeri',
            'checkup_begin_date' => 'Tekshiruv boshlangan sana',
            'checkup_finish_date' => 'Tekshiruv tugatilgan sana',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function afterFind()
    {
        $this->letter_date = $this->letter_date ? Yii::$app->formatter->asDate($this->letter_date, 'M/dd/yyyy') : $this->letter_date;
        $this->command_date = $this->command_date ? Yii::$app->formatter->asDate($this->command_date, 'M/dd/yyyy') : $this->command_date;
        $this->checkup_finish_date = $this->checkup_finish_date ? Yii::$app->formatter->asDate($this->checkup_finish_date, 'M/dd/yyyy') : $this->checkup_finish_date;
        $this->checkup_begin_date = $this->checkup_begin_date ? Yii::$app->formatter->asDate($this->checkup_begin_date, 'M/dd/yyyy') : $this->checkup_begin_date;
        parent::afterFind(); // TODO: Change the autogenerated stub
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
        ];
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getControlCompany()
    {
        return $this->hasOne(Company::className(), ['control_instruction_id' => 'id']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
