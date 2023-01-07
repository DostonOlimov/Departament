<?php

namespace frontend\controllers;
use common\models\embargo\Embargo;
use common\models\embargo\EmbargoSearch;
use common\models\prevention\Prevention;
use common\models\prevention\PreventionSearch;
use common\models\caution\Execution;
use common\models\caution\CautionLetters;
use common\models\caution\CautionLettersSearch;
use common\models\User;
//use common\models\caution\Company;
//use common\models\caution\Instruction;
use common\models\control\Company;
use common\models\control\Instruction;
use common\models\caution\InstructionSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * cautions controller
 */
class CautionController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ],
            ]
        ];
    }
    public function actionIndex()
    {
        $searchModel = new InstructionSearch(\Yii::$app->user->id);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionInstruction()
    {
        $model = new Instruction();

        if ($model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['company', 'instruction_id' => $model->id]);
        }

        return $this->render('instruction', [
            'model' => $model
        ]);
    }

    public function actionInstructionView($id)
    {
        return $this->render('instruction-view', [
            'model' => $this->getModel(Instruction::className(), $id)
        ]);
    }

    public function actionCompany($instruction_id)
    {
        $model = new Company();
        $model->caution_instruction_id = $instruction_id;

        if ($model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['execution', 'company_id' => $model->id]);
        }

        return $this->render('company', [
            'model' => $model,
        ]);
    }

    public function actionCompanyView($id)
    {
        return $this->render('company-view', [
            'model' => $this->getModel(Company::className(), $id)
        ]);
    }

    public function actionExecution($company_id)
    {
        $model = new Execution();
        $model->caution_company_id = $company_id;

        if ($model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['/caution/index']);
        }
        return $this->render('execution', [
            'model' => $model
        ]);
    }

    public function actionExecutionView($id)
    {
        return $this->render('execution-view', [
            'model' => $this->getModel(Execution::className(), $id)
        ]);
    }
    public function actionEmbargo(){
        $searchModel = new EmbargoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('embargo', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionEmbargoView($id){
        return $this->render('embargo-view', [
            'model' => $this->getModel(Embargo::className(), $id)
        ]);
    }
    public function actionEmbargoSearch(){
        $q = trim(\Yii::$app->request->get('q'));
        $codes = Instruction::find()->where(['like', 'command_number', $q])->all(); 
        

       $model = new Instruction();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['embargo-create', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('embargo-search', [
            'model' => $model,
            'codes' => $codes,
            'q' => $q,
        ]);
    }

    public function actionEmbargoCreate(){
        $q = trim(\Yii::$app->request->get('q'));
        $codes = Instruction::find()->where(['like', 'command_number', $q])->all();
        if(empty($q)){
           return $this->render('embargo-search');
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
            $model->updated_by = $model->created_by;
             //  var_dump($this->request->post());
              if($model->save()){
               \Yii::$app->session->setFlash('success','Bazaga yuklandi');
              }                     
            return $this->redirect(['embargo-search', 'id' => $model->id]);
            
             
           }
       } else {
           $model->loadDefaultValues();
       }

       return $this->render('embargo-create', [
           'companies' => $companies,
           'model' => $model,
           'codes' => $codes,
           'q' => $q,
       ]); 
    }

    public function actionEmbargoUpdate($id){
       // $model = $this->findModel($id); 
       $model = Embargo::findOne($id); 
        if($model->status == 0){      
       

            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['embargo-view', 'id' => $model->id]);
            }

            return $this->render('embargo-update', [
                'model' => $model,
            ]);
        }else{
        return $this->render('embargo-view', [
            'model' => $this->findModel($id),
        ]);
        }
    }

    public function actionPrevention(){
        $searchModel = new PreventionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('prevention', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPreventionView($id){
        return $this->render('prevention-view', [
            'model' => $this->getModel(Prevention::className(), $id)
        ]);
    }
    public function actionPreventionSearch(){
        $q = trim(\Yii::$app->request->get('q'));
        $codes = Instruction::find()->where(['like', 'command_number', $q])->all(); 
        

       $model = new Instruction();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['prevention-create', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('prevention-search', [
            'model' => $model,
            'codes' => $codes,
            'q' => $q,
        ]);
    }

    public function actionPreventionCreate(){
        $q = trim(\Yii::$app->request->get('q'));
        $codes = Instruction::find()->where(['like', 'command_number', $q])->all();
        if(empty($q)){
           return $this->render('prevention-search');
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
            $model->updated_by = $model->created_by;
             //  var_dump($this->request->post());
              if($model->save()){
               \Yii::$app->session->setFlash('success','Bazaga yuklandi');
              }                     
            return $this->redirect(['prevention-search', 'id' => $model->id]);
            
             
           }
       } else {
           $model->loadDefaultValues();
       }

       return $this->render('prevention-create', [
           'companies' => $companies,
           'model' => $model,
           'codes' => $codes,
           'q' => $q,
       ]); 
    }

    public function actionReestr(){
        return $this->render('reestr.php');
    }
    public function actionLetters(){
        $searchModel = new CautionLettersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('letters', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionLettersSearch(){
        $q = trim(\Yii::$app->request->get('q'));
        $codes = Company::find()->where(['like', 'inn', $q])->all(); 
        

       $model = new Company();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['letters-create', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('letters-search', [
            'model' => $model,
            'codes' => $codes,
            'q' => $q,
        ]);
    }

    public function actionLettersCreate(){
        $q = trim(\Yii::$app->request->get('q'));
        $codes = Company::find()->where(['like', 'inn', $q])->all();
        if(empty($q)){
           return $this->render('letters-search');
        }
        if(!empty($codes)):
         foreach($codes as $code){
           $companies = Company::findOne($code['id']);
         } 
           else:
               $companies = null;
       endif;
        
        $model = new CautionLetters;
       if ($this->request->isPost) {
           if ($model->load($this->request->post()) ) {
            if(!empty($_FILES['CautionLetters']['name']['file'])){
                $file = UploadedFile::getInstance($model,'file');
                $berkas = $model->company_id.'-.'.$file->getExtension();
                $model->file = $berkas;
                $path = 'uploads/caution_letter/';
                if(!file_exists($path)){
                    FileHelper::createDirectory($path);
                }
                $file->saveAs($path.$berkas);
            }
            
          if($model->save()){
               \Yii::$app->session->setFlash('success','Bazaga yuklandi');
              }                     
            return $this->redirect(['letters-search', 'id' => $model->id]);
            
             
           }
       } else {
           $model->loadDefaultValues();
       }

       return $this->render('letters-create', [
           'companies' => $companies,
           'model' => $model,
           'codes' => $codes,
           'q' => $q,
       ]); 
    }

    


    private function getModel($className, $id, $attribute = 'id')
    {
        if (!$model = $className::findOne([$attribute => $id])) {
            throw new \yii\db\Exception('Ma`lumot topilmadi');
        }
        return $model;
    }


}
