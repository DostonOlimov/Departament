<?php

namespace backend\controllers\measure;

use common\models\measure\Executions;
use common\models\measure\ExecutionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ExecutionController implements the CRUD actions for Executions model.
 */
class ExecutionController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Executions models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ExecutionsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Executions model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Executions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Executions();

        if ($this->request->isPost) {
            
            if ($model->load($this->request->post())) {
                $model->s_claim = \yii\web\UploadedFile::getInstance($model, "claim");
                $model->s_explanation_letter = \yii\web\UploadedFile::getInstance($model, "explanation_letter");
                $model->s_court_letter = \yii\web\UploadedFile::getInstance($model, "court_letter");
                if ($model->s_explanation_letter) {
                    $model->explanation_letter = $model->s_explanation_letter->name;
                }
                if($model->s_claim)  {
                    $model->claim = $model->s_claim->name;
                }   
                if($model->s_court_letter){    
                    $model->court_letter = $model->s_court_letter->name;
                
                }
                $model->band_mjtk = ','.$model->m212.','.$model->m213.','.$model->m214;
                die();
                if($model->save(false)){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
                
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Executions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->band_mjtk = explode(',', substr($model->band_mjtk, 1));
        // \yii\helpers\VarDumper::dump($model->band_mjtk);die;
        if($model->band_mjtk[0]){$model->m212 = $model->band_mjtk[0];}
        if($model->band_mjtk[1]){$model->m213 = $model->band_mjtk[1];}
        if($model->band_mjtk[2]){$model->m214 = $model->band_mjtk[2];}
       
        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->s_claim = \yii\web\UploadedFile::getInstance($model, "claim");
                $model->s_explanation_letter = \yii\web\UploadedFile::getInstance($model, "explanation_letter");
                $model->s_court_letter = \yii\web\UploadedFile::getInstance($model, "court_letter");
                if ($model->s_explanation_letter) {
                    $model->explanation_letter = $model->s_explanation_letter->name;
                }
                if($model->s_claim)  {
                    $model->claim = $model->s_claim->name;
                }   
                if($model->s_court_letter){    
                    $model->court_letter = $model->s_court_letter->name;
                
                }
                $model->band_mjtk = ','.$model->m212.','.$model->m213.','.$model->m214;
               
                if($model->save(false)){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Executions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Executions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Executions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Executions::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
