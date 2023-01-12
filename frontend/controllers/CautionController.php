<?php

namespace frontend\controllers;
use common\models\embargo\Embargo;
use common\models\embargo\EmbargosSearch;
use common\models\prevention\Prevention;
use common\models\prevention\PreventionsSearch;
use common\models\caution\Execution;
use common\models\caution\CautionLetters;
use common\models\caution\CautionLetterSearch;
use common\models\User;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use common\models\control\Company;
use common\models\control\Instruction;
use common\models\control\InstructionSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;

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
        $searchModel = new InstructionSearch(\Yii::$app->user->id);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('embargo', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionEmbargoAdd(){
        $searchModel = new EmbargosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('embargo-add', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionEmbargoView($id){
        return $this->render('embargo-view', [
            'model' => $this->getModel(Embargo::className(), $id)
        ]);
    }

    public function actionEmbargoCreate(){
        $id = Yii::$app->request->get('id');
        $company = Company::findOne(['control_instruction_id' => $id]);
        $model = new Embargo;
       if ($this->request->isPost) {
           if ($model->load($this->request->post()) ) {
            $model->updated_by = $model->created_by;
            // echo '<pre>';
            //   var_dump($this->request->post()); die();
            //   echo '</pre>';
              if($model->save()){
               \Yii::$app->session->setFlash('success','Bazaga yuklandi');
              }                     
            return $this->redirect(['embargo-view', 'id' => $model->id]);
            
             
           }
       } else {
           $model->loadDefaultValues();
       }

       return $this->render('embargo-create', [
           'company' => $company,
           'model' => $model,
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
        $searchModel = new InstructionSearch(\Yii::$app->user->id);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('prevention', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPreventionAdd(){
        $searchModel = new PreventionsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('prevention-add', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPreventionView($id){
        return $this->render('prevention-view', [
            'model' => $this->getModel(Prevention::className(), $id)
        ]);
    }
   
    
    public function actionPreventionCreate(){
        $id = Yii::$app->request->get('id');
        $company = Company::findOne(['control_instruction_id' => $id]);
        $model = new Prevention;
       if ($this->request->isPost) {
           if ($model->load($this->request->post()) ) {
            $model->updated_by = $model->created_by;
            //   var_dump($this->request->post());
              if($model->save()){
               \Yii::$app->session->setFlash('success','Bazaga yuklandi');
              }                     
            return $this->redirect(['prevention-view', 'id' => $model->id]);
            
             
           }
       } else {
           $model->loadDefaultValues();
       }

       return $this->render('prevention-create', [
           'company' => $company,
           'model' => $model,
       ]); 
       
    }
    public function actionReestr(){
        return $this->render('reestr.php');
    }
    public function actionLetters(){
        $searchModel = new InstructionSearch(\Yii::$app->user->id);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('letters', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionLettersAdd(){
        $searchModel = new CautionLetterSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('letters-add', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLettersCreate(){
        $id = Yii::$app->request->get('id');
        $company = Company::findOne(['control_instruction_id' => $id]);
        $model = new CautionLetters;
       if ($this->request->isPost) {
           if ($model->load($this->request->post()) ) {
            echo '<pre>';
            var_dump($this->request->post());die();
            echo '</pre>';
            $model->updated_by = $model->created_by;
            if(!empty($_FILES['CautionLetters']['name']['file'])){
                $file = UploadedFile::getInstance($model,'file');
                $berkas = md5($model->company_id).'-.'.$file->getExtension();
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
            return $this->redirect(['letters-view', 'id' => $model->id]);
            
             
           }
       } else {
           $model->loadDefaultValues();
       }

       return $this->render('letters-create', [
           'company' => $company,
           'model' => $model,
       ]); 
    }

    public function actionLettersView($id){
        return $this->render('letters-view', [
            'model' => $this->getModel(CautionLetters::className(), $id)
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
