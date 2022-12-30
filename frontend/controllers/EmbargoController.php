<?php

namespace frontend\controllers;

use common\models\embargo\Embargo;
use common\models\embargo\myCounter;
use common\models\embargo\EmbargoSearch;
use common\models\control\Instruction;
use common\models\control\Company;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;

/**
 * EmbargoController implements the CRUD actions for Embargo model.
 */
class EmbargoController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::classname(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Embargo models.
     *
     * @return string
     */
    public function actionIndex()
    {
       
        $searchModel = new EmbargoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            
        ]);
    }

    /**
     * Displays a single Embargo model.
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
     * Creates a new Embargo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionSearch(){
        $q = trim(\Yii::$app->request->get('q'));
        $codes = Instruction::find()->where(['like', 'command_number', $q])->all(); 
        

       $model = new Instruction();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['create', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('search', [
            'model' => $model,
            'codes' => $codes,
            'q' => $q,
        ]);
    }
    public function actionCreate()
    {
       
        $q = trim(\Yii::$app->request->get('q'));
         $codes = Instruction::find()->where(['like', 'command_number', $q])->all();
         if(empty($q)){
            return $this->render('search');
         }
         if(!empty($codes)):
          foreach($codes as $code){
            $companies = Company::findOne($code['id']);
          } 
            else:
                $companies = null;
        endif;
        
         $model = new Embargo;
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) ) {
              //  var_dump($this->request->post());
               if($model->save()){
                \Yii::$app->session->setFlash('success','Bazaga yuklandi');
               }                     
             return $this->redirect(['search', 'id' => $model->id]);
             
              
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'companies' => $companies,
            'model' => $model,
            'codes' => $codes,
            'q' => $q,
        ]);
    }
    /**
     * Updates an existing Embargo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        
        $model = $this->findModel($id); 
        if($model->status == 0){      
       

            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }else{
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
        }
    }

    // public function actionUpdatenum($id)
    // {
    //     $model = $this->findModel($id);
    //     $num = Embargo::find()->sum('status');
    //     $model->message_number = $num +1;
    //     if($model->save())
    //     {
    //         return $this->render('index', [
    //             'model' => $model,]);   
    //     }
       
    // }

    /**
     * Deletes an existing Embargo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    

    /**
     * Finds the Embargo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Embargo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Embargo::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
