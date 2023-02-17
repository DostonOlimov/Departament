<?php

namespace backend\controllers\shopping;

use common\models\shopping\Product;
use common\models\shopping\Company;
use common\models\shopping\ProductSearch;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /*public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Product();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }*/
    public function actionUpdate($shopping_company_id)
    {
        $company = Company::findOne($shopping_company_id);
        $products = Product::find()->where(['shopping_company_id'=>$shopping_company_id])->all();
        
       

    if ($company->load(Yii::$app->request->post())) { 
        // echo '<pre>';
        // var_dump(Yii::$app->request->post());die();
        // echo '<pre>';   
    $t = true;
    foreach(Yii::$app->request->post('Product') as $key=>$value)
        {
            $product = Product::findOne($value['id']);           
            $product->name = $value['name'];
            $product->quantity = $value['quantity'];
            $product->sum = $value['sum'];
            $product->purchase_date = $value['purchase_date'];
            $product->production_date = $value['production_date'];
            $product->product_lot = $value['product_lot'];
            $product->s_photo = UploadedFile::getInstance($product, "[{$key}]photo");                
            if($product->s_photo)  {
                 $product->photo = $product->s_photo->name;
            }   
        $product->s_photo_check = UploadedFile::getInstance($product, "[{$key}]photo_chek");                
            if($product->s_photo_check)  {
                $product->photo_chek = $product->s_photo_check->name;
            }

            if($product->validate()){
                $product->save();
            }
            else{
                $t = false;
            }
        }
            $company->phone = strval($company->phone);     
            if( $company->validate() && $t && $company->save())
            {
                return $this->redirect(['laboratory-view', 'shopping_company_id' => $company->id]);
            }  
  
        }

        return $this->render('update', [
            'company' => $company,
            'products' =>  $products,
        ]);
    }
    
    /*public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }*/

    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
