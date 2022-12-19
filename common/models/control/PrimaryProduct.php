<?php

namespace common\models\control;

use common\models\Countries;
use common\models\control\PrimaryProductNd;
use common\models\Codetnved;
use common\models\control\PrimaryData;
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

    public $sector_id;
    public $group;
    public $subposition;
    public $class;
    public $position;
    public $exsist_certificate;

    public $Image;
 
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
            [[ 'product_measure', 'made_country','residue_quantity','year_quantity','year_amount','residue_amount','labaratory_checking','certification','exsist_certificate'], 'required'],
            [['control_primary_data_id', 'made_country', 'product_measure','sector_id','labaratory_checking','certification','quality'], 'integer'],
            [['product_type_id', 'product_name', 'residue_amount','subposition','group','position','class', 'residue_quantity', 'potency', 'year_amount', 'photo','year_quantity','codetnved'], 'string', 'max' => 255],
            ['certification', 'compare', 'compareValue' => 0, 'operator' => '>=','message' => 'Sertifikatlar soni 0 yoki undan katta bo\'lishi kerak'],
            [['Image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['made_country'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::class, 'targetAttribute' => ['made_country' => 'id']],
            [['control_primary_data_id'], 'exist', 'skipOnError' => true, 'targetClass' => PrimaryData::class, 'targetAttribute' => ['control_primary_data_id' => 'id']],
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
     /*  $this->date_to= preg_replace('/[^0-9]+/', '', $this->date_to);
       $this->date_from= preg_replace('/[^0-9]+/', '', $this->date_from);
       $this->date_from = strtotime($this->date_from);
       $this->date_to = strtotime($this->date_to);
        $this->checkup_finish_date = strtotime($this->checkup_finish_date);*/

        return true;
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

    public function upload(int $data_id,int $key) {

        if (true) {
           
           $path =  Url::to('@frontend/web/uploads/images/'). $data_id.$key.'_'.$this->Image->name;
        
            $this->Image->saveAs($path);
            $this->photo = $data_id.$key.'_'.$this->Image->name;
            return true;
        } else {
            return false;
        }		
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
            'year_quantity' => 'yillik summasi',
            'year_amount' => 'yillik miqdori',
            'appearance_marking' => 'Tashqi ko’rinish va markirovkasi bo’yicha tekshirish',
            'labaratory_checking' => 'Sinov labaratoriyasida tekshirish',
            'certification' => 'Mahsulotning majburiy sertifikatlashtirishga tushishi',
            'quality' => 'Mahsulot sifati',
            'description' => 'Izoh',
            'cer_amount' =>'Sertifikatsiz realizatsiya qilingan mahsulot qiymati',
            'cer_quantity' =>'Sertifikatsiz realizatsiya qilingan mahsulot summasi',
            'exsist_certificate' =>'Mahsulotning sertifikat(lar)i'

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
