<?php

namespace common\models\shopping;

use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yiidreamteam\upload\ImageUploadBehavior;


/**
 * This is the model class for table "shopping_products".
 *
 * @property int $id
 * @property int $shopping_company_id
 * @property string|null $name
 * @property int|null $quantity
 * @property int|null $cost
 * @property string|null $photo
 * @property string|null $photo_chek
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property Company $shoppingCompany
 * @property User $updatedBy
 */
class Product extends \yii\db\ActiveRecord
{
    public $s_photo;
    public $s_photo_check;
    const   MEASURE1 = 'dona';
    const   MEASURE2 = '(kg)';
    const   MEASURE3 = '(m)';
    const   MEASURE4 = '(m2)';
    const   MEASURE5 = '(m3)';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shopping_products';
    }

    public function rules()
    {
        return [
            [['shopping_company_id'], 'required'],
            [['shopping_company_id', 'quantity', 'sum'], 'integer'],
            [['name','purchase_date','measure','production_date','product_lot','lab_conclusion'], 'string', 'max' => 255],
            [['photo', 'photo_chek'], 'image','extensions'=> 'jpg,png,pdf'],
            //[['shopping_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['shopping_company_id' => 'id']],
        ];
    }
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,         
                [
                    'class' => ImageUploadBehavior::class,
                    'attribute' => 's_photo',
                    'filePath' => '@webroot/uploads/nazorat-xaridi/mahsulotlar/[[pk]].[[extension]]',
                    'fileUrl' => '/uploads/nazorat-xaridi/mahsulotlar/[[pk]].[[extension]]',
                ],           
            
                [
                    'class' => ImageUploadBehavior::class,
                    'attribute' => 's_photo_check',
                    'filePath' => '@webroot/uploads/nazorat-xaridi/cheklar/[[pk]].[[extension]]',
                    'fileUrl' => '/uploads/nazorat-xaridi/cheklar/[[pk]].[[extension]]',
                ], 
            
            
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => '',
            'shopping_company_id' => 'Shopping Company ID',
            'name' => 'Maxsulot nomi',
            'quantity' => 'Mahsulot miqdori',
            'sum' => 'Mahsulot narxi',
            'photo' => 'Mahsulot rasmi',
            'photo_chek' => 'Chek rasmi',
            'production_date' => 'Mahsulot ishlab chiqarilgan sanasi',
            'purchase_date' => 'Xarid o\'tkazilgan sanasi',
            'product_lot' => 'Partiya raqami',
            'created_by' => 'Inspector',
            'updated_by' => 'Nazoratchi',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'lab_conclusion' => 'Laboratory xulosasi',
            'measure'=> 'Hajmi',
        ];
    }
    public static function getMeasure($type = null)
    {
        $arr = [

            self::MEASURE3 => '(m)',
            self::MEASURE2 => '(kg)',
            self::MEASURE1 => 'dona',
            self::MEASURE4 => '(m2)',
            self::MEASURE5 => '(m3)',
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getShoppingCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'shopping_company_id']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
