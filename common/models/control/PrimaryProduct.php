<?php

namespace common\models\control;

use common\models\Countries;
use common\models\control\PrimaryProductNd;
use common\models\Codetnved;
use common\models\control\PrimaryData;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yiidreamteam\upload\FileUploadBehavior;
use yiidreamteam\upload\ImageUploadBehavior;
use common\models\types\ProductSubposition;
use yii\helpers\Url;
use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "control_primary_product".
 *
 * @property int $id
 * @property int $control_primary_data_id
 * @property string|null $product_type_id
 * @property string|null $product_name
 * @property int|null $made_country
 * @property int $product_measure
 * @property string|null $residue_amount
 * @property string|null $residue_quantity
 * @property string|null $potency
 * @property string|null $year_amount
 * @property string|null $year_quantity
 * @property string|null $number_blank
 * @property string|null $number_reestr
 * @property int|null $date_from
 * @property int|null $date_to
 *
 * @property PrimaryData $controlPrimaryData
 * @property PrimaryProductNd[] $controlPrimaryProductNds
 * @property Countries $madeCountry
 */
class PrimaryProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const   MEASURE1 = 1;
    const   MEASURE2 = 2;
    const   MEASURE3 = 3;
    const   MEASURE4 = 4;
    const   MEASURE5 = 5;

    const  PURPOSE1 = 1;
    const  PURPOSE2 = 10;
    const  PURPOSE3 = 11;

    const DEFECT1 = 1;
    const DEFECT2 = 2;
    const DEFECT3 = 3;

    public $product_type;

    public $sector_id;
    public $group;
    public $subposition;
    public $class;
    public $position;
    public $exsist_certificate;

    public $img;
 
    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return 'control_primary_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'product_measure', 'made_country','labaratory_checking','certification','exsist_certificate'], 'required',
            'when' => function($model) { return $model->product_type == 0; }],
            [['product_type'],'required'],
            [['control_primary_data_id', 'made_country', 'product_measure','sector_id','labaratory_checking','certification','quality',], 'integer'],
            [['product_type_id', 'product_name', 'residue_amount','subposition','group','position','class', 'residue_quantity','photo', 'potency', 'year_amount','year_quantity','codetnved','defect_type','cer_amount','cer_quantity'], 'string', 'max' => 255],
            [['img',], 'file'],
            ['certification', 'compare', 'compareValue' => 0, 'operator' => '>=','message' => 'Sertifikatlar soni 0 yoki undan katta bo\'lishi kerak'],
            [['made_country'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::class, 'targetAttribute' => ['made_country' => 'id']],
            [['control_primary_data_id'], 'exist', 'skipOnError' => true, 'targetClass' => PrimaryData::class, 'targetAttribute' => ['control_primary_data_id' => 'id']],
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

    public static function getPurpose($type = null)
    {
        $arr = [

            self::PURPOSE1 => 'Tashqi ko\'rinish va markirovkasi bo\'yicha tekshiruv',
            self::PURPOSE2 => 'Sinov laboratoriyasida tekshirish',
            self::PURPOSE3 => 'Tashqi ko\'rinish va markirovkasi bo\'yicha tekshiruv va Sinov laboratoriyasida tekshirish',
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }

    public static function getDefect($type = null)
    {
        $arr = [

            self::DEFECT1 => 'Davlat tili bo\'yicha',
            self::DEFECT2 => 'Markirovkasi bo\'yicha',
            self::DEFECT3 => 'Saqlash sharoiti bo\'yicha',
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }

public function behaviors()
{
    return [
        TimestampBehavior::class,
        BlameableBehavior::class,
        [
            'class' => FileUploadBehavior::class,
                'attribute' => 'img',
                'filePath' => '@webroot/uploads/executions/sud_xati/[[pk]].[[extension]]',
                'fileUrl' => '/uploads/executions/sud_xati/[[pk]].[[extension]]',
        ],
      /*  [
            'class' => ImageUploadBehavior::class,
            'attribute' => 'img',
            'createThumbsOnRequest' => true,
            'filePath' => '@frontend/web/app-images/store/control-identification/[[attribute_id]]/[[filename]].[[extension]]',
            'fileUrl' => '@url/app-images/store/control-identification/[[attribute_id]]/[[filename]].[[extension]]',
            'thumbPath' => '@frontend/web/app-images/cache/control-identification/[[attribute_id]]/[[profile]]_[[filename]].[[extension]]',
            'thumbUrl' => '@url/app-images/cache/control-identification/[[attribute_id]]/[[profile]]_[[filename]].[[extension]]',
            'thumbs' => [
                'xs' => ['width' => 64, 'height' => 48],
                'sm' => ['width' => 120, 'height' => 67],
                'md' => ['width' => 240, 'height' => 135],
                'lg' => ['width' => 960, 'height' => 540],
            ],
        ],
        [
            'class' => ImageUploadBehavior::class,
            'attribute' => 'photo',
            'createThumbsOnRequest' => true,
            'filePath' => '@frontend/web/app-images/store/control-identification/[[attribute_id]]/[[filename]].[[extension]]',
            'fileUrl' => '@url/app-images/store/control-identification/[[attribute_id]]/[[filename]].[[extension]]',
            'thumbPath' => '@frontend/web/app-images/cache/control-identification/[[attribute_id]]/[[profile]]_[[filename]].[[extension]]',
            'thumbUrl' => '@url/app-images/cache/control-identification/[[attribute_id]]/[[profile]]_[[filename]].[[extension]]',
            'thumbs' => [
                'xs' => ['width' => 64, 'height' => 48],
                'sm' => ['width' => 120, 'height' => 67],
                'md' => ['width' => 240, 'height' => 135],
                'lg' => ['width' => 960, 'height' => 540],
            ],
        ],*/
    ];
}
    public function afterFind()
    {
       /* $this->date_from = $this->date_from ? Yii::$app->formatter->asDate($this->date_from, 'M/dd/yyyy') : $this->date_from;
        $this->date_to = $this->date_to ? Yii::$app->formatter->asDate($this->date_to, 'M/dd/yyyy') : $this->date_to;
        */
        parent::afterFind(); // TODO: Change the autogenerated stub
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'control_primary_data_id' => 'Control Primary Data ID',
            'product_type_id' => 'Mahsulot turi',
            'product_name' => 'Mahsulot nomi',
            'sector_id' => 'Mahsulot soha turi',
            'group' => 'Mahsulot guruhi',
            'class' => 'Mahsulot sinfi',
            'position' => 'Mahsulot pozitsiyasi',
            'subposition' => 'Mahsulot pozitsiya osti',
            'made_country' => 'Mahsulot ishlab chiqarilgan mamlakat',
            'product_measure' => 'Mahsulot o\'lchov birligi',
            'potency' => 'Ishlab chiqarish quvvati',
            'residue_quantity' => 'Mahsulot qoldiq summasi',
            'residue_amount' => 'Mahsulot qoldiq miqdori',
            'year_quantity' => 'Mahsulotning yillik summasi',
            'year_amount' => 'Mahsulotning yillik miqdori',
            'appearance_marking' => 'Tashqi ko’rinish va markirovkasi bo’yicha tekshirish',
            'labaratory_checking' => 'Sinov laboratoriyasiga berilganligi',
            'certification' => 'Mahsulotning majburiy sertifikatlashtirishga tushishi',
            'quality' => 'Mahsulot sifati',
            'description' => 'Izoh',
            'cer_amount' =>'Sertifikatsiz realizatsiya qilingan mahsulot qiymati',
            'cer_quantity' =>'Sertifikatsiz realizatsiya qilingan mahsulot summasi',
            'exsist_certificate' =>'Mahsulotning sertifikat(lar)i',
            'codetnved' => 'Mahsulotning TIF TN kodi',
            'photo' =>'Mahsulotning rasmi',
            'defect_type' =>'Mahsulotning kamchilikgi',
            'product_type' => 'Mahsulot qo\'shish'

        ];
    }


    /**
     * Gets query for [[ControlPrimaryData]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getControlPrimaryData()
    {
        return $this->hasOne(PrimaryData::class, ['id' => 'control_primary_data_id']);
    }

    /**
     * Gets query for [[ControlPrimaryProductNds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getControlPrimaryProductNds()
    {
        return $this->hasMany(PrimaryProductNd::class, ['control_primary_product_id' => 'id']);
    }

    /**
     * Gets query for [[MadeCountry]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMadeCountry()
    {
        return $this->hasOne(Countries::class, ['id' => 'made_country']);
    }
}
