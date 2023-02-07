<?php

namespace frontend\controllers;
use common\models\embargo\Embargo;
use common\models\embargo\EmbargosSearch;
use common\models\prevention\Prevention;
use common\models\prevention\PreventionsSearch;
use common\models\caution\CautionLetters;
use common\models\caution\CautionLetterSearch;
use common\models\control\InstructionFile;
use common\models\control\InstructionFileSearch;
use common\models\control\Laboratory;
use common\models\User;
use common\models\Model;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use common\models\control\Company;
use common\models\control\Instruction;
use common\models\control\InstructionSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use Exception;
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

    public function actionEmbargo(){
        $searchModel = new InstructionSearch(\Yii::$app->user->id);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('embargo', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionEmbargoAdd($id){
        $searchModel = new EmbargosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        // echo '<pre>';
        // var_dump($dataProvider);die();
        // echo '</pre>';
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

    public function actionEmbargoCreate($id)
    {
        $id = Yii::$app->request->get('id');
        $company = Instruction::findOne(['id' => $id]);
        $modelsPrevent = [new Embargo];
        if (Yii::$app->request->post()) {
            $modelsPrevent = Model::createMultiple(Embargo::classname(),$modelsPrevent);
            Model::loadMultiple($modelsPrevent, $this->request->post());
            foreach($modelsPrevent as $key=>$product) {
                $product->updated_by = $product->created_by;
            }    
            //$valid = Model::validateMultiple($modelsPrevent);
            if (Model::validateMultiple($modelsPrevent)) {
                $transaction = \Yii::$app->db->beginTransaction();
                
                try {
                        foreach ($modelsPrevent as $key=>$product) {
                           $product->instructions_id = $id;                                                    
                           $product->save(false);
                        }
                        $transaction->commit();
                       return $this->redirect(['embargo-add', 'instructions_id' => $id]);
                    // }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }
            }
        
        }
        return $this->render('embargo-create', [            
            'modelsPrevent' => $modelsPrevent,
            'company' => $company,
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

    public function actionPreventionCreate($id)
    {
        $id = Yii::$app->request->get('id');
        $company = Instruction::findOne(['id' => $id]);
        $modelsPrevent = [new Prevention];
        if (Yii::$app->request->post()) {
            $modelsPrevent = Model::createMultiple(Prevention::classname(),$modelsPrevent);
            Model::loadMultiple($modelsPrevent, $this->request->post());
            foreach($modelsPrevent as $key=>$product) {
                $product->updated_by = $product->created_by;
            }    
            //$valid = Model::validateMultiple($modelsPrevent);
            if (Model::validateMultiple($modelsPrevent)) {
                $transaction = \Yii::$app->db->beginTransaction();
                
                try {
                        foreach ($modelsPrevent as $key=>$product) {
                           $product->instructions_id = $id;                                                    
                           $product->save(false);
                        }
                        $transaction->commit();
                       return $this->redirect(['prevention-add', 'instructions_id' => $id]);
                    // }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }
            }
        
        }
        return $this->render('prevention-create', [            
            'modelsPrevent' => $modelsPrevent,
            'company' => $company,
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

    public function actionLettersCreate($id)
    {
        $id = Yii::$app->request->get('id');
        $company = Company::findOne(['control_instruction_id' => $id]);
        $modelsPrevent = [new CautionLetters];

        if (Yii::$app->request->post()) {

            $modelsPrevent = Model::createMultiple(CautionLetters::classname(),  $modelsPrevent);
            Model::loadMultiple($modelsPrevent, $this->request->post());

            foreach ($modelsPrevent as $index => $modelOptionValue) {
                $modelOptionValue->updated_by = $modelOptionValue->created_by;
                $modelOptionValue->s_file = UploadedFile::getInstance($modelOptionValue, "[{$index}]file");                
                if($modelOptionValue->s_file)  {
                    $modelOptionValue->file = $modelOptionValue->s_file->name;
                }   
                
            }
            if (Model::validateMultiple($modelsPrevent)) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    foreach ($modelsPrevent as $key => $product) {                        
                        $product->instructions_id = $id;
                        $product->save(false);
                    }
                    $transaction->commit();
                    return $this->redirect(['letters-add','instructions_id'=> $id]);
                } catch (Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }
            }
        }

        return $this->render('letters-create', [
            'modelsPrevent' =>  $modelsPrevent,
            'company' => $company,
        ]);
    }

   

    public function actionLettersView($id){
        return $this->render('letters-view', [
            'model' => $this->getModel(CautionLetters::className(), $id)
        ]);
    }
    public function actionInstructionFile(){
        $searchModel = new InstructionSearch(\Yii::$app->user->id);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('instruction-file', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionFileCreate($instructions_id)
    {
        $files = InstructionFile::find()->where(['instructions_id'=>$instructions_id])->all();
        if(empty($files)){
            $model = new InstructionFile();
            $model->instructions_id = $instructions_id;
            if ($model->load(Yii::$app->request->post()) &&  $model->save()) {
                    return $this->render('instruction-files', [
                        'model' => $model,
                        
                    ]);
            }

            return $this->render('file-create', [
                'model' => $model,
                ]); }
            return 'Mumkin emas';      
    }
    public function actionUpdateLab($id, $attribute)
    {
       
        $model = InstructionFile::findOne($id);
        $model->$attribute = $_FILES[$attribute]['name'];
        $model->validate();
        $model->save();
        return $this->redirect(['instruction-files', 'instructions_id' => $model->instructions_id]);
    }
    
    public function actionInstructionFiles($instructions_id)
    {      
        $files = InstructionFile::find()->where(['instructions_id'=>$instructions_id])->all(); 
        if(!empty($files)){
         $ins = InstructionFile::findOne(['instructions_id'=> $instructions_id]);
            return $this->render('instruction-files', [
                'model' => $this->getModel(InstructionFile::className(),$ins['id'])
            ]);
        } return 'Mumkin emas';
    }
    

    


    private function getModel($className, $id, $attribute = 'id')
    {
        if (!$model = $className::findOne([$attribute => $id])) {
            throw new \yii\db\Exception('Ma`lumot topilmadi');
        }
        return $model;
    }


}
