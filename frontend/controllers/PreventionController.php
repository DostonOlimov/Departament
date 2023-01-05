<?php

namespace frontend\controllers;

use common\models\prevention\Prevention;
use common\models\prevention\PreventionSearch;
use common\models\control\Company;
use common\models\control\Instruction;
use common\models\prevention\CautionInstruction;
use common\models\prevention\ControlCompanies;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;
/**
 * PreventionController implements the CRUD actions for Prevention model.
 */
class PreventionController extends Controller
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
                        'roles' => ['inspector'],
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
     * Lists all Prevention models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PreventionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $companies = Company::find()->asArray()->all();
        $instructions = Instruction::find()->asArray()->all(); 
        // echo "<pre>";
        // var_dump($instructions);
        // die;
        // echo "</pre>";
        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Prevention model.
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
     * Creates a new Prevention model.
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
         $codes = Instruction::find()->where(['like', 'letter_number', $q])->all();
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
         
         $model = new Prevention;
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
     * Updates an existing Prevention model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
        /** Join Search  */
    
      

    /**
     * Deletes an existing Prevention model.
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
     * Finds the Prevention model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Prevention the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Prevention::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
