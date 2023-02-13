<?php

namespace frontend\controllers\control;

use common\models\control\PrimaryProduct;
use backend\models\control\PrimaryProduct as PrimaryProduct2;
use common\models\control\PrimaryProductSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\types\ProductGroup;
use common\models\types\ProductPosition;
use common\models\types\ProductSubposition;
use common\models\types\ProductClass;
use yii\helpers\ArrayHelper;

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

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate($primary_data_id)
    {
        $model = new PrimaryProduct();
        $model->control_primary_data_id = $primary_data_id;
        echo 'something';
        die();
        if ($model->load($this->request->post()) && $model->save()) {
            $model = new PrimaryProduct();
            return $this->render('index', [
                'modelCreate' => $model,
                'primary_data_id' => $primary_data_id
            ]);
        }

        return $this->render('index', [
            'model' => $model,
            'primary_data_id' => $primary_data_id
        ]);
    }

    /**
     * Updates an existing PrimaryProduct model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->exsist_certificate = 1;
        if ($this->request->isPost && $model->load($this->request->post())  && $model->validate()) {
            $model->product_type_id = $model->subposition;
            if($model->save()) {
                return $this->redirect(['index', 'primary_data_id' => $model->control_primary_data_id]);
            }
           
        }

        return $this->render('update', [
            'model' => $model,
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
}
