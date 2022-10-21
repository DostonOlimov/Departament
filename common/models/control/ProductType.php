<?php

namespace common\models\control;

use Yii;

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
            [['parent_id','group_id','class_id','position_id','under_position_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }
    //search by name
    public function searchByName($name)
    {
        $query = ProductType::find()
            ->where(['name' => trim($name)])
            ->one();
        return $query;
    }
    // insert product types
    Public function readData()
    {
        $inputFileName = realpath(Yii::$app->basePath ).DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.'excel'.DIRECTORY_SEPARATOR.'tessst.xlsx';

        try {

            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();


            $spreadsheet = $reader->load($inputFileName);

            $data = $spreadsheet->getSheet(0)->toArray();
            $data1 = array_unique($data,SORT_REGULAR);
            $parent_category=[];
            foreach ($data1 as $key => $value)
            {
           $parent_category[] = $value[0];
            }
            $parent_category_unique = array_unique($parent_category);
            foreach ($parent_category_unique as $item)
            {
                if ($item and !$this->searchByName($item))
                {
                   $obj = new ProductType();
                    $obj->name = $item;
                    $obj->save();
                }
            }
            foreach ($data1 as $item)
                {
                    if($item[1] and  $this->searchByName($item[0]) and  !$this->searchByName($item[1]))
                    {

                       $obj = new ProductType();
                       $obj->name = $item[1];
                       $obj->parent_id = $this->searchByName($item[0])->id;
                       $obj->save();
                    }

                }
            foreach ($data1 as $item)
            {
                if($item[2] and  $this->searchByName($item[1]) and  !$this->searchByName($item[2]))
                {

                    $obj = new ProductType();
                    $obj->name = $item[2];
                    $obj->parent_id = $this->searchByName($item[1])->parent_id;
                    $obj->group_id = $this->searchByName($item[1])->id;
                    $obj->save();
                }

            }
            foreach ($data1 as $item)
            {
                if($item[3] and  $this->searchByName($item[2]) and  !$this->searchByName($item[3]))
                {

                    $obj = new ProductType();
                    $obj->name = $item[3];
                    $obj->parent_id = $this->searchByName($item[2])->parent_id;
                    $obj->group_id = $this->searchByName($item[2])->group_id;
                    $obj->class_id = $this->searchByName($item[2])->id;
                    $obj->save();
                }

            }
            foreach ($data1 as $item)
            {
                if($item[4] and  $this->searchByName($item[3]) and  !$this->searchByName($item[4]))
                {

                    $obj = new ProductType();
                    $obj->name = $item[4];
                    $obj->parent_id = $this->searchByName($item[3])->parent_id;
                    $obj->group_id = $this->searchByName($item[3])->group_id;
                    $obj->class_id = $this->searchByName($item[3])->class_id;
                    $obj->position_id = $this->searchByName($item[3])->id;
                    $obj->save();
                }

            }
            foreach ($data1 as $item)
            {
                if($item[5] and  $this->searchByName($item[4]) and  !$this->searchByName($item[5]))
                {

                    $obj = new ProductType();
                    $obj->name = $item[5];
                    $obj->parent_id = $this->searchByName($item[4])->parent_id;
                    $obj->group_id = $this->searchByName($item[4])->group_id;
                    $obj->class_id = $this->searchByName($item[4])->class_id;
                    $obj->position_id = $this->searchByName($item[4])->position_id;
                    $obj->under_position_id = $this->searchByName($item[4])->id;
                    $obj->save();
                }

            }
          //  print_r($searchName);
         } catch (\Exception $exception) {
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
