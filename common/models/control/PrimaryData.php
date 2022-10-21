<?php

namespace common\models\control;

use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "control_primary_data".
 *
 * @property int $id
 * @property int $control_company_id
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Company $controlCompany
 * @property PrimaryProduct[] $controlPrimaryProducts
 * @property User $createdBy
 * @property User $updatedBy
 */
class PrimaryData extends \yii\db\ActiveRecord
{
    const LABORATORY_HAVE = 1;
    const LABORATORY_CONTRACT = 2;
    const LABORATORY_NOT = 3;

    public static function tableName()
    {
        return 'control_primary_data';
    }

    public function rules()
    {
        return [
            [['control_company_id', 'laboratory'], 'required'],
            [['control_company_id', 'laboratory', 'smt'], 'integer'],
            [['control_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['control_company_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'control_company_id' => 'Control Company ID',
//            'count' => 'O\'lchov vositasi soni',
//            'compared_count' => 'Qiyoslangan o\'lchov vositasi soni',
//            'invalid_count' => 'Yaroqsiz o\'lchov vositasi soni',
//            'certificate' => 'Muvofiq sertifikati (talab etilgan hollarda)',
  //          'residue_quantity' => 'Tashkilotdagi mahsulotlarning qoldiq miqdori',
   //         'residue_amount' => 'Tashkilotdagi mahsulotlarning qoldiq summasi(so\'m)',
   //         'potency' => 'Ishlab chiqarish quvvati',
  //          'year_quantity' => 'Ishlab chiqarilgan miqdori(12 oy mobaynida )',
//            'year_amount' => 'Summasi(12 oy mobaynida)(so\'m)',
            'laboratory' => 'Sinov laboratoriyasining mavjudligi',
            'smt' => 'SMT joriy etilganligi',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
        ];
    }

    public static function getLab($lab = null)
    {
        $arr = [
            self::LABORATORY_HAVE => 'Sinov laboratoriyasi mavjud',
            self::LABORATORY_CONTRACT => 'Shartnoma asosida',
            self::LABORATORY_NOT => 'Sinov laboratoriyasi mavjud emas',
        ];

        if ($lab === null) {
            return $arr;
        }

        return $arr[$lab];
    }

    public function getControlCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'control_company_id']);
    }

    public function getControlPrimaryProducts()
    {
        return $this->hasMany(PrimaryProduct::className(), ['control_primary_data_id' => 'id']);
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
