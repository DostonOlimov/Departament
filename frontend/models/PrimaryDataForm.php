<?php

namespace frontend\models;

use common\models\control\ProductType;
use common\models\ProgramType;
use Yii;
use yii\base\Model;
use common\models\Countries;
use yii\helpers\VarDumper;

class PrimaryDataForm extends Model
{
    const CATEGORY_OV = 1;
    const CATEGORY_PRODUCT = 2;

    public $id;
    public $category;

    public $type;
    public $measurement;
    public $compared;
    public $invalid;

    public $product_type_id;
    public $product_type_parent_id;
    public $product_purpose;
    public $made_country;
    public $product_measure;
    public $group_id;
    public $class_id;
    public $position_id;
    public $under_position_id;
    public $mandatory_certification_id;
    public $residue_amount;
    public $residue_quantity;
    public $year_quantity;
    public $year_amount;
    public $potency;
    public $nd;
    public $nd_type;
    public $number_blank;
    public $number_reestr;
    public $date_from;
    public $date_to;
    public $product_name;


    public function rules()
    {
        return [
//            [['type', 'measurement', 'compared', 'invalid'], 'required'],

            [['type', 'measurement', 'compared', 'invalid'], 'required', 'when' => function ($model) {
                return $model->category == self::CATEGORY_OV;
            }, 'whenClient' => "function (attribute, value) {
                return $('#category').val() == 1;
            }"],
            [['type', 'category','made_country','product_mesure','product_purpose'], 'integer'],
            [['nd'], 'safe'],
            [['measurement', 'compared', 'invalid', 'number_blank', 'number_reestr', 'date_from', 'date_to', 'product_name'], 'string'],
            [['made_country'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['made_country' => 'id']],

        ];
    }

    public static function categoryList()
    {
        return [
            self::CATEGORY_OV => 'O\'lchov vositalari',
            self::CATEGORY_PRODUCT => 'Mahsulot',
        ];
    }

    public function attributeLabels()
    {
        return [
            'category' => '',

            'type' => 'O\'lchov vositasi turi (O\'.V)',
            'measurement' => 'O\'.V soni',
            'compared' => 'Qiyoslangan O\'.V soni',
            'invalid' => 'Yaroqsiz O\'.V soni',

            'product_purpose' => 'Namuna tanlab olish maqsadi',
            'product_type_parent_id' => 'Mahsulot soha turi',
            'product_measure' => 'Mahsulot o\'lchov birligi',
            'made_country' => 'Mahsulot ishlab chiqarilgan mamlakat',
            'residue_amount' => 'Mahsulot qoldiq miqdori',
            'residue_quantity' => 'Qoldiq mahsulot summasi',
            'year_quantity' => 'Mahsulot yillik summasi',
            'year_amount' => 'Mahsulot yillik qoldiq miqdori',
            'mandatory_certification_id' => 'Majburiy sertifikatlashtirish mavjudligi',
            'potency' => 'Ishlab chiqarish quvvati',
            'group_id' => 'Mahsulot guruhi',
            'class_id' => 'Mahsulot sinfi',
            'position_id' => 'Mahsulot positsiyasi',
            'under_position_id' => 'Mahsulot positsiya osti',
            'number_blank' => 'Blank raqami',
            'number_reestr' => 'Reesstr raqami',
            'date_from' => 'Berilgan sana',
            'date_to' => 'Amal qilish muddati',
            'product_name' => 'Mahsulot nomi,brendi va hokazolar',
        ];
    }

    public static function getCity($parent_id) {
        $data=ProductType::find()
            ->where(['id'=>$parent_id])
            ->select(['id','name AS name'])->asArray()->all();

        return $data;
    }


}
