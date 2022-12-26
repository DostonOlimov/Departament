<?php

namespace common\models\control;

use Yii;
use common\models\types\ProductGroup;
use common\models\types\ProductClass;
use common\models\types\ProductPosition;
use common\models\types\ProductSubposition;
/**
 * This is the model class for table "product_types".
 *
 * @property int $id
 * @property string $name
 *
 * @property PrimaryProduct[] $controlPrimaryProducts
 */
class ProductType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['code','position','class','group','sector'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }
    //search by name
    public function searchByName(string $name):array
    {
        return ProductType::find()
            ->where(['name' => trim($name)])
            ->one();

    }
    // insert product types
    Public function readData()
    {
        $inputFileName = realpath(Yii::$app->basePath) . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'excel' . DIRECTORY_SEPARATOR . 'type91.xlsx';

        try {

            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();


            $spreadsheet = $reader->load($inputFileName);

            $data = $spreadsheet->getSheet(0)->toArray();
            $data1 = array_unique($data, SORT_REGULAR);
 
            foreach ($data1 as $key => $value) {
                $code_group[] =  substr($value[0], 0,3);
                $group[] =  substr($value[0], 4,);
                $code_class[] = substr($value[1], 0,5);
                $class[] = substr($value[1], 6,);
                $code_position[] = substr($value[2], 0,8);
                $position[] = substr($value[2], 9,);
                $code_sub[] = substr($value[3], 0,11);
                $subposition[] = substr($value[3], 12,);

            }
           
            $gr = new ProductGroup();
            foreach (array_unique($group) as $key => $item) {
                if ($item and !($gr->searchbyName($code_group[$key]))) {
                    $gr1 = new ProductGroup();
                    $gr1->name = $item;
                    $gr1->kode =$code_group[$key];
                    $gr1->sector_id =5;
                   $gr1->save();

                }
            }
                $gr = new ProductClass();
                foreach (array_unique($class) as $key => $item) {
                    if ($item and !($gr->searchbyName($code_class[$key])))  {
                        $gr1 = new ProductClass();
                        $gr1->name = $item;
                        $gr1->kode = $code_class[$key];
                        $gr1->save();
                    }

                }

                $gr = new ProductPosition();
                foreach (array_unique($position) as $key => $item) {
                    if ($item and !($gr->searchbyName($code_position[$key]))) {
                        $gr1 = new ProductPosition();
                        $gr1->name = $item;
                        $gr1->kode =$code_position[$key];
                        $gr1->save();
                    }

                }

                $gr = new ProductSubposition();
                foreach (array_unique($subposition) as $key => $item) {
                    if ($item and !($gr->searchbyName($code_sub[$key]))) {
                        $gr1 = new ProductSubposition();
                        $gr1->name = $item;
                        $gr1->kode = $code_sub[$key];
                         $gr1->save();
                    }

                }


            }
        catch
            (\Exception $exception) {
                print_r($exception->getMessage() . $exception->getFile());
                exit();
            }

    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nomi',
            'parent_id' => 'Parent Id',
        ];
    }

    /**
     * Gets query for [[ControlPrimaryProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getControlPrimaryProducts()
    {
        return $this->hasMany(PrimaryProduct::className(), ['product_type_id' => 'id']);
    }
}
