<?php

namespace common\models\control;

use common\models\User;
use common\models\control\PrimaryProduct;
use common\models\control\PrimaryData;
use common\models\control\ControlProductLabaratoryChecking;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yiidreamteam\upload\FileUploadBehavior;

/**
 * This is the model class for table "laboratories".
 *
 * @property int $id
 * @property int $control_company_id
 * @property string|null $dalolatnoma
 * @property string|null $bayonnoma
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property Company $controlCompany
 */
class Laboratory extends \yii\db\ActiveRecord
{
    private $quality = [] ;
    public $finish_date;
    public $start_date;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'laboratories';
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['control_company_id','dalolatnoma','out_bayonnoma'], 'required'],
            [['control_company_id'], 'integer'],
            [['comment','finish_date','start_date'], 'string'],
           /* ['finish_dalolatnoma', 'required', 'when' => function ($model) {
                return $model->getQuality($this->control_company_id) === false;
            },'message'=>'{attribute} ni kiritib bo\'lmaydi.'],
            ['finish_dalolatnoma', 'required', 'when' => function ($model) {
                return $model->out_dalolatnoma == '';
            }, 'whenClient' => "function (attribute, value) {
                return $('#out_dalolatnoma').val() == '';
            }"],
            ['out_dalolatnoma', 'required', 'when' => function ($model) {
                return $model->finish_dalolatnoma == '';
            }, 'whenClient' => "function (attribute, value) {
                return $('#finish_dalolatnoma').val() == '';
            }"],*/
            [['dalolatnoma', 'bayonnoma', 'finish_dalolatnoma', 'out_bayonnoma', 'out_dalolatnoma'], 'file'],
        ];
    }
  
    public function getQuality($company_id)
    {
        $data = PrimaryData::FindOne(['control_company_id' => $company_id]);
        $products = PrimaryProduct::FindAll(['control_primary_data_id' => $data->id]);
        foreach($products as $product)
        {
            $lab = ControlProductLabaratoryChecking::FindOne(['product_id' => $product->id]);
            if($lab->quality == 2)
            {
                $this->quality[] = $lab->quality;
            }
            
        }
        return $this->quality;
    }
   
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dalolatnoma' => 'Na`muna olish dalolatnomasi',
            'bayonnoma' => 'Sinov bayonnomasi',
            'out_bayonnoma' => 'Tashqi ko\'rinish bayonnomasi',
            'out_dalolatnoma' => 'Oraliq dalolatnoma',
            'finish_dalolatnoma' => 'Yakuniy dalolatnoma',
            'comment' => 'Izoh',
            'start_date' => 'Tekshiruv haqiqatda boshlangan sana',
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
                'attribute' => 'dalolatnoma',
                'filePath' => '@webroot/uploads/dalolatnoma/[[pk]].[[extension]]',
                'fileUrl' => '/uploads/dalolatnoma/[[pk]].[[extension]]',
            ],
            [
                'class' => FileUploadBehavior::class,
                'attribute' => 'bayonnoma',
                'filePath' => '@webroot/uploads/bayonnoma/[[pk]].[[extension]]',
                'fileUrl' => '/uploads/bayonnoma/[[pk]].[[extension]]',
            ],
            [
                'class' => FileUploadBehavior::class,
                'attribute' => 'out_bayonnoma',
                'filePath' => '@webroot/uploads/out_bayonnoma/[[pk]].[[extension]]',
                'fileUrl' => '/uploads/out_bayonnoma/[[pk]].[[extension]]',
            ],
            [
                'class' => FileUploadBehavior::class,
                'attribute' => 'out_dalolatnoma',
                'filePath' => '@webroot/uploads/out_dalolatnoma/[[pk]].[[extension]]',
                'fileUrl' => '/uploads/out_dalolatnoma/[[pk]].[[extension]]',
            ],
            [
                'class' => FileUploadBehavior::class,
                'attribute' => 'finish_dalolatnoma',
                'filePath' => '@webroot/uploads/finish_dalolatnoma/[[pk]].[[extension]]',
                'fileUrl' => '/uploads/finish_dalolatnoma/[[pk]].[[extension]]',
            ],
        ];
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    public function getControlCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'control_company_id']);
    }
}
