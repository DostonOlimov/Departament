<?php

namespace frontend\controllers\control;

use common\models\control\PrimaryProduct;
use common\models\Model;
use common\models\control\PrimaryProductSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\control\ControlProductCertification;
use common\models\control\PrimaryProductNd;
use common\models\types\ProductGroup;
use common\models\types\ProductPosition;
use common\models\types\ProductSubposition;
use common\models\types\ProductClass;
use common\models\control\DocumentAnalysis;
use common\models\control\ControlProductLabaratoryChecking;
use common\models\control\ControlProductMeasures;
use yii\helpers\ArrayHelper;
use Yii;
use Exception;
use yii\helpers\VarDumper;

/**
 * PrimaryProductController implements the CRUD actions for PrimaryProduct model.
 */
class PrimaryProductsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'except' => ['login'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ]
        ];
    }

    public function actionIndex($primary_data_id)
    {
        $searchModel = new PrimaryProductSearch($primary_data_id);
        $dataProvider = $searchModel->search($this->request->queryParams);

        $modelCreate = new PrimaryProduct();
        $modelCreate->control_primary_data_id = $primary_data_id;

        if ($modelCreate->load($this->request->post()) && $modelCreate->save()) {
            $model = new PrimaryProduct();
            return $this->render('index', [
                'modelCreate' => $model,
                'primary_data_id' => $primary_data_id,
                'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            ]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelCreate' => $modelCreate,
            'primary_data_id' => $primary_data_id,
        ]);
    }

    public function actionView($id,$primary_data_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'primary_data_id' => $primary_data_id
        ]);
    }

    public function actionCreate($primary_data_id)
    {
        $searchModel = new PrimaryProductSearch($primary_data_id);
        $dataProvider = $searchModel->search($this->request->queryParams);
        $model = new PrimaryProduct();
        $model->control_primary_data_id = $primary_data_id;
        $nds = [new PrimaryProductNd];
        $cers = [new ControlProductCertification];
        $post = $this->request->post();
        $model->product_type = 0;

        if ($model->load($post)) {
          
            $nds = Model::createMultiple(PrimaryProductNd::classname());
            Model::loadMultiple($nds, $this->request->post());
            $cers = Model::createMultiple(ControlProductCertification::classname());
            Model::loadMultiple($cers, Yii::$app->request->post());
           
            $valid = $model->validate() && Model::validateMultiple($nds) && Model::validateMultiple($cers) ;

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
               $arrayImage = [];
                try {
                    $model->product_type_id = $model->subposition;
                    $model->img = \yii\web\UploadedFile::getInstance($model, "photo");
                    if ($model->img) {
                        $model->photo = $model->img->name;
                    }
                    $model->save(false);
                    foreach ($nds as $key => $nd) {
                            $nd1 = new PrimaryProductNd();
                            $nd1->control_primary_product_id = $model->id;
                            $nd1->name = $nd->name;
                            $nd1->type_id = $nd->type_id;
                            $nd1->save(false);
                        }
                if($model->exsist_certificate == 1){
                    foreach ($cers as $key2 => $cer) {
                            $cer1 = new ControlProductCertification();
                            $cer1->product_id = $model->id;
                            $cer1->number_reestr = $cer->number_reestr;
                            $cer1->date_to = $cer->date_to;
                            $cer1->date_from = $cer->date_from;
                            $cer1->save(false);
                        }
                    }
             //  VarDumper::dump( ,12,true);;die();
            $transaction->commit();
                 return $this->redirect(['view', 'id' => $model->id,'primary_data_id'=>$primary_data_id]);
                } catch (Exception $e) 
                {
                    $transaction->rollBack();
                    throw $e;
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
            'primary_data_id' => $primary_data_id,
            'nds' => $nds,
            'cers' => $cers,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing PrimaryProduct model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id,$primary_data_id)
    {
        $searchModel = new PrimaryProductSearch($primary_data_id);
        $dataProvider = $searchModel->search($this->request->queryParams);
        $model = $this->findModel($id);
        $nds = PrimaryProductNd::findAll(['control_primary_product_id'=>$id]);
        $cers = ControlProductCertification::findAll(['product_id'=>$id]);

        $model->product_type = 0;
        $model->exsist_certificate = 1;
        if($model->product_type_id){
            $model->group = substr($model->product_type_id,0,3);
            $model->sector_id = ProductGroup::findOne(['kode' => $model->group])->sector_id;
            $model->class = substr($model->product_type_id,0,5);
            $model->position = substr($model->product_type_id,0,8);
            $model->subposition = substr($model->product_type_id,0,11);
        }
        $t = true; $k = true;
        if ($this->request->isPost && $model->load($this->request->post())  && $model->validate()) {
            $model->product_type_id = $model->subposition;
           // VarDumper::dump($this->request->post('PrimaryProductNd'),12,true);die();
            foreach($this->request->post('PrimaryProductNd') as $key=>$value)
            {
                $nd = PrimaryProductNd::findOne($value['id']);
                $nd->name = $value['name'];
                $nd->type_id = $value['type_id'];
                if($nd->validate()){
                    $nd->save();
                }
                else{
                    $t = false;
                }
            }
            if($this->request->post('ControlProductCertification')){
                foreach($this->request->post('ControlProductCertification') as $key=>$value)
                {
                    $cer = ControlProductCertification::findOne($value['id']);
                    $cer->number_reestr = $value['number_reestr'];
                    $cer->date_to = $value['date_to'];
                    $cer->date_from = $value['date_from'];
                    if($cer->validate()){
                        $cer->save();
                    }
                    else{
                        $k = false;
                    }
                }  
            }
            if($model->save() && $t && $k) {
                return $this->redirect(['index', 'primary_data_id' => $model->control_primary_data_id,  'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,]);
            }
           
        }
        return $this->render('update', [
            'model' => $model,
            'nds' => $nds,
            'cers' => $cers,
            'primary_data_id' =>$primary_data_id,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing PrimaryProduct model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $primary_data_id = $this->findModel($id)->control_primary_data_id;
        PrimaryProductNd::deleteAll(['control_primary_product_id' => $id]);
        ControlProductCertification::deleteAll((['product_id' => $id]));
        ControlProductLabaratoryChecking::deleteAll((['product_id' => $id]));
        ControlProductMeasures::deleteAll((['product_id' => $id]));
        $this->findModel($id)->delete();

        return $this->redirect(['index', 'primary_data_id' => $primary_data_id]);
    }

    /**
     * Finds the PrimaryProduct model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return PrimaryProduct the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = \common\models\control\PrimaryProduct::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGroup():array {
        $out = [];
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $post = $this->request->post();
        if ($parents = ArrayHelper::getValue($post, 'depdrop_parents', false)) {
            $cat_id = $parents[0];
            $out = ProductGroup::find()
                ->where(['sector_id' => $cat_id])
                ->select(['kode as id','name'])
                ->orderBy('name', 'ASC')
                ->asArray()
                ->all();
            return ['output'=>$out, 'selected'=>''];
        }
        return  ['output'=>'', 'selected'=>''];
    }


    public function actionClass():array {
        $out = [];
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $post = $this->request->post();
        if ($parents = ArrayHelper::getValue($post, 'depdrop_parents', false)) {
                $cat_id = $parents[0].'%';
                $out = ProductClass::find()
                    ->where(['like', 'kode', $cat_id, false])
                    ->select(['kode as id','name'])
                    ->orderBy('name', 'ASC')
                    ->asArray()
                    ->all();
                return ['output'=>$out, 'selected'=>''];
        }
       return  ['output'=>'', 'selected'=>''];
    }


    public function actionPosition() :array {
        $out = [];
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $post = $this->request->post();
        if ($parents = ArrayHelper::getValue($post, 'depdrop_parents', false)) {
            $cat_id = $parents[0].'%';
            $out = ProductPosition::find()
                ->where(['like', 'kode', $cat_id, false])
                ->select(['kode as id','name'])
                ->orderBy('name', 'ASC')
                ->asArray()
                ->all();
            return ['output'=>$out, 'selected'=>''];
        }
        return  ['output'=>'', 'selected'=>''];
    }

    public function actionSubposition():array {
        $out = [];
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $post = $this->request->post();
        if ($parents = ArrayHelper::getValue($post, 'depdrop_parents', false)) {
            $cat_id = $parents[0].'%';
            $out = ProductSubposition::find()
                ->where(['like', 'kode', $cat_id, false])
                ->select(['kode as id','name'])
                ->orderBy('name', 'ASC')
                ->asArray()
                ->all();
            return ['output'=>$out, 'selected'=>''];
        }
        return  ['output'=>'', 'selected'=>''];
    }
}
