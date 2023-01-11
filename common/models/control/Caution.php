<?php

namespace common\models\control;

use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yiidreamteam\upload\FileUploadBehavior;

/**
 * This is the model class for table "control_cautions".
 *
 * @property int $id
 * @property int|null $control_company_id
 * @property string|null $caution
 * @property int|null $caution_date
 * @property string|null $caution_number
 * @property string|null $file
 * @property string|null $description
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Company $controlCompany
 * @property User $createdBy
 * @property User $updatedBy
 */
class Caution extends \yii\db\ActiveRecord
{
    public $s_file;
    const BASE_GRAF = 0;
    const BASE_GIVEN = 1;
    const BASE_APPEAL = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'control_cautions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['control_company_id'], 'integer'],
            [['caution', 'caution_number', 'caution_date', 'file', 'description'], 'string', 'max' => 255],
            [['control_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['control_company_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'control_company_id' => 'Control Company ID',
            'caution' => 'Ko\'rsatmalar',
            'type' => 'Turi',
            'caution_date' => 'Ko\'rsatma sanasi',
            'caution_number' => 'Ko\'rsatma nomeri',
            'file' => 'Bartaraf qilingan kamchilik to\'g\'risida ma`lumot',
            'description' => 'Izoh',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $this->caution_date = strtotime($this->caution_date);

        return true;
    }

    public static function getType($type = null)
    {
        $arr = [
            self::BASE_GRAF => 'Kamchilikni bartaraf qilish',
            self::BASE_GIVEN => 'Realizatsiya va xizmatlarni taqiqlash',
            self::BASE_APPEAL => 'O\'v foydalanishni taqiqlash',
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }

    public function afterFind()
    {
        $this->caution_date = Yii::$app->formatter->asDate($this->caution_date, 'M/dd/yyy');
        parent::afterFind(); // TODO: Change the autogenerated stub
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
            [
                'class' => FileUploadBehavior::class,
                'attribute' => 'file',
                'filePath' => '@webroot/uploads/caution/[[pk]].[[extension]]',
                'fileUrl' => '/uploads/caution/[[pk]].[[extension]]',
            ],
           
        ];
    }

    public function getControlCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'control_company_id']);
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
