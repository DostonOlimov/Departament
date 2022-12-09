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
 *
 *  @property int $type
 *  @property int $code
 *  @property int $checkup_duration
 *  @property int $real_checkup_date
 *  @property int $checkup_duration_start_date
 *  @property int $checkup_duration_finish_date
 *  @property int $checkup_subject
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

    const TYPE_AWARE = 0;
    const TYPE_AGREEMENT = 1;

    const SUBJECT1 = 1;
    const SUBJECT2 = 2;
    const SUBJECT3 = 3;
    const SUBJECT4 = 4;
    const SUBJECT5 = 5;
    const SUBJECT6 = 6;
    const SUBJECT7 = 7;

    const DURATION1 = 1;
    const DURATION2 = 2;
    const DURATION3 = 3;
    const DURATION4 = 4;
    const DURATION5 = 5;
    const DURATION6 = 6;
    const DURATION7 = 7;
    const DURATION8 = 8;
    const DURATION9 = 9;
    const DURATION10 = 10;

    public $employers;
    public $admin;


    public static function tableName()
    {
        return 'control_instructions';
    }

    public function rules()
    {
        return [
            [['base', 'type','checkup_subject','checkup_duration','general_status',], 'integer'],
            [['general_status'], 'default', 'value' => self::GENERAL_STATUS_IN_PROCESS],
            [['employers'], 'safe'],
            [['base', 'type', 'code', 'letter_date', 'command_date','checkup_subject', 'letter_number', 'command_number','checkup_begin_date', 'checkup_finish_date',
                'checkup_duration_finish_date','checkup_duration_start_date','real_checkup_date','checkup_duration'], 'required'],
            [['letter_number', 'command_number',  'letter_date', 'command_date', 'checkup_begin_date', 'checkup_finish_date',
                'checkup_duration_finish_date','code','checkup_duration_start_date','real_checkup_date','who_send_letter'], 'string', 'max' => 255],
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
        $this->checkup_duration_finish_date = strtotime($this->checkup_duration_finish_date);
        $this->checkup_duration_start_date = strtotime($this->checkup_duration_start_date);
        $this->real_checkup_date= strtotime($this->real_checkup_date);
        $this->code= preg_replace('/[^0-9]+/', '', $this->code);
       // $this->checkup_finish_date = strtotime($this->checkup_finish_date);

        return true;
    }

    public static function getBase($base = null)
    {
        $arr = [
            self::BASE_GRAF => 'Reja grafik',
            self::BASE_GIVEN => 'Berilgan ko\'rsatma',
            self::BASE_APPEAL => 'Kelib tushgan murojaat',
            self::BASE_SMM_APPEAL => 'Ijtimoiy tarmoqlardan kelib tushgan murojaatlar',
            self::BASE_ASSIGNMENT => 'Xukumat topshiriqlari',
        ];

        if ($base === null) {
            return $arr;
        }

        return $arr[$base];
    }
    public static function getType($type = null)
    {
        $arr = [

            self::TYPE_AWARE => 'Xabardor',
            self::TYPE_AGREEMENT => 'Kelishuv',
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

    public static function getSubject($status = null)
    {
        $arr = [
            self::SUBJECT1 => 'Ishlab chiqarish va savdoda mahsulotlarning qadoqlanishi,tamg\'alanishi talablariga rioya qilinishini o\'rganish.',
            self::SUBJECT2 => 'Ishlab chiqarish va savdo jarayonida mahsulotlarning tashish hamda saqlash sharoitlariga rioya qilinishini o‘rganish',
            self::SUBJECT3 => 'Ishlab chiqarish va xizmat ko‘rsatish jarayonlariga oid texnik reglamentlar, standartlar va qonunchilikda belgilangan talablarga rioya qilinishini o‘rganish',
            self::SUBJECT4 => 'Ishlab chiqarish, xizmat ko‘rsatish va savdoda mahsulotlar sifatini muvofiqligini tasdiqlovchi hujjatlarning (xalqaro standartlar, muvofiqlik sertifikati, sifat tizimi joriy qilinganligi, sinov bayonnomalari va boshqalar) mavjudligini o‘rganish',
            self::SUBJECT5 => 'Ishlab chiqarish, xizmat ko‘rsatish va savdoda mahsulotlar hamda xizmatlarga oid texnik reglamentlar, standartlar va qonunchilikda belgilangan talablarga rioya qilinishi va muvofiqligini o‘rganish.',
            self::SUBJECT6 => 'Ishlab chiqarish, xizmat ko‘rsatish va savdo jarayonida o‘lchash vositalari, etalonlar, standart namunalar, axborot o‘lchash tizimlari yoki o‘lchash uskunalari bilan ta’minlanganligi va qiyoslash ko‘rigidan o‘tganligini o‘rganish',
            self::SUBJECT7 => 'Ishlab chiqarish, hizmat ko‘rsatish va savdo jarayonida realizatsiya qilingan mahsulotlar to‘g‘risida ma’lumotlarni o‘rganish.; Sertifikatlashtirish talablariga tayyorlovchilar (tadbirkorlar, sotuvchilar, ijrochilar) tomonidan rioya etilishini o‘rganish',

        ];

        if ($status === null) {
            return $arr;
        }

        return $arr[$status];
    }

    public static function getDuration($duration = null)
    {
        $arr = [
            self::DURATION10 => '10 KUN',
            self::DURATION1 => '1 KUN',
            self::DURATION2 => '2 KUN',
            self::DURATION3 => '3 KUN',
            self::DURATION4 => '4 KUN',
            self::DURATION5 => '5 KUN',
            self::DURATION6 => '6 KUN',
            self::DURATION7 => '7 KUN',
            self::DURATION8 => '8 KUN',
            self::DURATION9 => '9 KUN',

        ];

        if ($duration === null) {
            return $arr;
        }

        return $arr[$duration];
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
            'base' => 'Tekshiruv uchun asos',
            'type' => 'Tekshiruv turi',
            'code' => 'Tekshiruv kodi',
            'employers' => 'Inspektorlar',
            'letter_date' => 'Asos bo\'luvchi hujjat sanasi',
            'letter_number' => 'Asos bo\'luvchi hujjat nomeri',
            'command_date' => 'Buyruq sanasi',
            'command_number' => 'Buyruq nomeri',
            'checkup_begin_date' => 'Tekshiruv boshlangan sana',
            'checkup_finish_date' => 'Tekshiruv tugatilgan sana',
            'checkup_duration' => 'Tekshiruv muddati',
            'real_checkup_date' => 'Haqiqiy tekshiruv boshlanish sanasi',
            'checkup_duration_start_date' => 'Tekshiruv davri boshlanish sanasi',
            'checkup_duration_finish_date' => 'Tekshiruv davri tugatilish sanasi',
            'might_be_breakdown_letter' => 'Buzilishi mumkin bo\'lgan normativ hujjat',
            'checkup_subject' => 'Tekshiruv predmeti',
            'who_send_letter' => 'Tekshirish uchun asos bo’luvchi hujjat jo’natgan tashkilot nomi yoki shaxs FISH',
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
        $this->real_checkup_date = $this->real_checkup_date ? Yii::$app->formatter->asDate($this->real_checkup_date, 'M/dd/yyyy') : $this->real_checkup_date;
        $this->checkup_duration_start_date = $this->checkup_duration_start_date ? Yii::$app->formatter->asDate($this->checkup_duration_start_date, 'M/dd/yyyy') : $this->checkup_duration_start_date;
        $this->checkup_duration_finish_date = $this->checkup_duration_finish_date ? Yii::$app->formatter->asDate($this->checkup_duration_finish_date, 'M/dd/yyyy') : $this->checkup_duration_finish_date;
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
