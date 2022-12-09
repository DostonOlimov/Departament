<?php

namespace frontend\models;

use common\models\control\ProductType;
use common\models\ProgramType;
use Yii;
use yii\base\Model;
use common\models\Countries;
use yii\helpers\VarDumper;

class PrimaryIdentification extends Model
{

    public $id;
    public $product_id;
    public $labaratory_checking;
    public $quality;
    public $description;
    public $product_name;
    public $name;

   /* public $labaratory_quality;
    public $labaratory_description;

    public $certificate_quality;
    public $number_reestr;
    public $date_from;
    public $date_to;
    public $position;
    public $amount;
    public $quantity;*/

    public function rules()
    {
        return [
            [[ 'quality',], 'required'],
            [['id', 'product_id','labaratory_checking','quality',], 'integer'],
            [['description', 'name', ], 'string'],

        ];
    }

   

    public function attributeLabels()
    {
        return [

            'name' => 'Mahsulot nome',
            'quality' => 'Mahsulotning yaroqliligi',
            'description' => 'Izoh',
            'labaratory_description' => 'Izoh',
            'number_reestr' => 'Sertifikat raqami',
            'date_to' => 'Berilgan sanasi',
            'date_from' => 'Amal qilish mudati',
            'amount' => 'Mahsulot qoldiq summasi',
            'quantity' => 'Mahsulot qoldiq miqdori',
          
        ];
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
