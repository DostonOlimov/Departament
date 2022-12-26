<?php

namespace common\models\control;

use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yiidreamteam\upload\FileUploadBehavior;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "control_measures".
 *
 * @property int $id
 * @property int $control_company_id
 * @property string|null $type
 * @property string|null $ov_name
 * @property int|null $ov_date
 * @property int|null $ov_quantity
 * @property int|null $realization_date
 * @property int|null $realization_number
 * @property string|null $person
 * @property string|null $number_passport
 * @property int|null $fine_amount
 * @property string|null $band_mjtk
 * @property string|null $explanation_letter
 * @property string|null $claim
 * @property string|null $court_letter
 * @property int|null $first_warn_date
 * @property int|null $warn_number
 * @property int|null $eco_date
 * @property int|null $eco_number
 * @property string|null $eco_quantity
 * @property string|null $eco_amount
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property ControlCompanies $controlCompany
 * @property User $createdBy
 * @property User $updatedBy
 */
class Measure extends \yii\db\ActiveRecord
{
    public $typeChange;
    public $finish_date;

    const TYPE_INSTRUMENT = 1;
    const TYPE_REALIZATION = 2;
    const TYPE_ADMINISTRATIVE = 3;
    const TYPE_ECONOMIC = 4;
  //  const TYPE_RELEASE = 5;

    public $m212;
    public $m213;
    public $m214;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'control_measures';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['control_company_id', ], 'required'],
            [['m212','m213','m214','control_company_id', 'ov_quantity',  'realization_number', 'fine_amount',  'warn_number', 'eco_number', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [[ 'realization_date', 'ov_date','first_warn_date','ov_name', 'person', 'number_passport', 'band_mjtk','eco_date',  'eco_quantity', 'eco_amount','finish_date'], 'string', 'max' => 255],
            [['claim', 'court_letter', 'explanation_letter',],'file'],
            [['type'],'safe'],
            [['control_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['control_company_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
          /*[['amount', 'date', 'quantity'], 'required', 'when' => function($model) {
                return $model->type != self::TYPE_ADMINISTRATIVE;
            },'whenClient' => "function (attribute, value) {
                    return $('#type').val() != 3;
            }"],
            [['person', 'number_passport', 'fine_amount'], 'required', 'when' => function($model) {
                return $model->type == self::TYPE_ADMINISTRATIVE;
            },'whenClient' => "function (attribute, value) {
                    return $('#type').val() == 3;
            }"],*/
        ];
    }
    public static function typeList($type = null)
    {
        $arr = [
            self::TYPE_INSTRUMENT => 'O\'lchov vositalarini taqiqlash',
            self::TYPE_REALIZATION => 'Realizatsiyani taqiqlash',
            self::TYPE_ADMINISTRATIVE => 'Ma`muriy jarima',
            self::TYPE_ECONOMIC => 'Iqtisodiy jarima',
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'control_company_id' => 'Control Company ID',
            'type' => 'Ko\'rilgan ta`sir choralar',
            'ov_date' => 'O\'lchov vositasini taqiqlash sanasi',
            'ov_quantity' => 'O\'lchov vositalarini taqiqlash miqdori',
            'ov_name' => 'O\'lchov vositalarini taqiqlash nomi',
            'person' => 'Jarimaga tortilgan shaxs F.I.O',
            'number_passport' => 'Passport seriya',
            'fine_amount' => 'Jarima summasi',
            'realization_date' => 'Realizatsiyasni taqiqlash sanasi',
            'realization_number' => 'Realizatsiyasni taqiqlash raqami',
            'band_mjtk' => 'MJtK moddalari',
            'explanation_letter' => 'Tushuntirish xati',
            'claim' => 'Talabnoma',
            'court_letter' => 'Sud xati',
            'first_warn_date' => 'Eng birinchi ogohlantirish berilgan sana',
            'warn_number' => 'Ogohlantirish ko’rsatmasi raqami',
            'eco_date' => 'Iqtisodiy jarima sanasi',
            'eco_number' => 'Iqtisodiy jarima raqami',
            'eco_quantity' => 'Iqtisodiy jarimada ko’rsatilgan mahsulotlar miqdori',
            'eco_amount' => 'Iqtisodiy jarimada ko’rsatilgan mahsulotlar summasi',
            'm212' =>'212-modda',
            'm213' =>'213-modda',
            'm214' =>'214-modda',
            'finish_date' => 'Tekshiruv haqiqatda yakunlangan sana',
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
                [
                    'class' => FileUploadBehavior::class,
                    'attribute' => 'explanation_letter',
                    'filePath' => '@webroot/uploads/tushuntirish_xati/[[pk]].[[extension]]',
                    'fileUrl' => '/uploads/tushuntirish_xati/[[pk]].[[extension]]',
                ],
                [
                    'class' => FileUploadBehavior::class,
                    'attribute' => 'claim',
                    'filePath' => '@webroot/uploads/talabnoma/[[pk]].[[extension]]',
                    'fileUrl' => '/uploads/talabnoma/[[pk]].[[extension]]',
                ],
                [
                    'class' => FileUploadBehavior::class,
                    'attribute' => 'court_letter',
                    'filePath' => '@webroot/uploads/sud_xati/[[pk]].[[extension]]',
                    'fileUrl' => '/uploads/sud_xati/[[pk]].[[extension]]',
                ],
            ];
        
    }

    public function beforeSave($insert)
    {
        $this->realization_date = strtotime($this->realization_date);
        $this->ov_date = strtotime($this->ov_date);
        $this->first_warn_date = strtotime($this->first_warn_date);
        $this->eco_date = strtotime($this->eco_date);
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function afterFind()
    {
        $this->realization_date = $this->realization_date ? Yii::$app->formatter->asDate($this->realization_date, 'M/dd/yyyy') : $this->realization_date;
        $this->ov_date = $this->ov_date ? Yii::$app->formatter->asDate($this->ov_date, 'M/dd/yyyy') : $this->ov_date;
        $this->first_warn_date = $this->first_warn_date ? Yii::$app->formatter->asDate($this->first_warn_date, 'M/dd/yyyy') : $this->first_warn_date;
        $this->eco_date = $this->eco_date ? Yii::$app->formatter->asDate($this->eco_date, 'M/dd/yyyy') : $this->eco_date;
        parent::afterFind(); // TODO: Change the autogenerated stub
    }
    /**
     * Gets query for [[ControlCompany]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getControlCompany()
    {
        return $this->hasOne(Company::class, ['id' => 'control_company_id']);
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
