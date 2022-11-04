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

    /**
     * {@inheritdoc}
     */
    const   MEASURE1 = 1;
    const   MEASURE2 = 2;
    const   MEASURE3 = 3;
    const   MEASURE4 = 4;
    const   MEASURE5 = 5;

    const  PURPOSE1 = 1;
    const  PURPOSE2 = 2;
    const  PURPOSE3 = 3;



    public $id;
    public $category;

    public $type;
    public $measurement;
    public $compared;
    public $invalid;

    public $product_type_id;
    public $product_name;
    public $made_country;
    public $product_measure;
    public $select_of_exsamle_purpose;
    public $residue_amount;
    public $residue_quantity;
    public $year_quantity;
    public $year_amount;
    public $potency;

    public $sector_id;
    public $group;
    public $subposition;
    public $class;
    public $position;

    public $nd_type;
    public $nd_name;

    public $number_blank;
    public $number_reestr;
    public $date_from;
    public $date_to;



    public function rules()
    {
        return [
          [['type', 'measurement', 'compared', 'invalid',], 'required'],

           [['type', 'measurement', 'compared', 'invalid'],
                'required','when' => function ($model) {
                return $model->category == self::CATEGORY_OV;
              }, 'whenClient' => "function (attribute, value) {
                return $('#category').val() == 1;
            }"],
            [['type', 'category','made_country','product_measure','select_of_exsamle_purpose','subposition','sector_id','group','class','position',], 'integer'],
            [['nd'], 'safe'],
            [['measurement', 'compared', 'invalid', 'product_name','number_blank','number_blank'], 'string'],

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

            'select_of_exsamle_purpose' => 'Namuna tanlab olish maqsadi',
            'sector_id' => 'Mahsulot soha turi',
            'product_type_id' => 'Mahsulotning turi',
            'product_measure' => 'Mahsulot o\'lchov birligi',
            'made_country' => 'Mahsulot ishlab chiqarilgan mamlakat',
            'residue_amount' => 'Mahsulot qoldiq miqdori',
            'residue_quantity' => 'Qoldiq mahsulot summasi',
            'year_quantity' => 'Mahsulot yillik summasi',
            'year_amount' => 'Mahsulot yillik qoldiq miqdori',
            'mandatory_certification_id' => 'Majburiy sertifikatlashtirish mavjudligi',
            'potency' => 'Ishlab chiqarish quvvati',
            'group' => 'Mahsulot guruhi',
            'class' => 'Mahsulot sinfi',
            'subposition' => 'Mahsulot pozitsiya osti',
            'position' => 'Mahsulot positsiyasi',
            'type_name' => 'Mahsulot turi',
            'product_name' => 'Mahsulot nomi,brendi va hokazolar',
        ];
    }
    public static function getMeasure($type = null)
    {
        $arr = [

            self::MEASURE3 => 'Uzunlik(m)',
            self::MEASURE2 => 'Og\'irlik(kg)',
            self::MEASURE1 => 'Dona',
            self::MEASURE4 => 'Yuza(m2)',
            self::MEASURE5 => 'Hajm(m3)',
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }

    public static function getPurpose($type = null)
    {
        $arr = [

            self::PURPOSE1 => 'Tashqi ko\'rinish va markirovkasi bo\'yicha tekshiruv',
            self::PURPOSE2 => 'Sinov laboratoriyasida tekshirish',
            self::PURPOSE3 => 'Hujjat tahlili',
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }
    /**
     * @param int $parent_id
     * @return array
     */
    public static function getCity(int $parent_id): array
    {
        return ProductType::find()
            ->where(['id' => $parent_id])
            ->select(['id', 'name AS name'])
            ->asArray()
            ->all();
    }


}
