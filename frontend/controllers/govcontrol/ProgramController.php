<?php

namespace frontend\controllers\govcontrol;

use backend\models\CompanySearch;
use common\models\Company;
use common\models\govcontrol\Program;
use common\models\govcontrol\ProgramData;
use common\models\govcontrol\ProgramDataSearch;
use common\models\govcontrol\ProgramProperty;
use common\models\govcontrol\ProgramPropertySearch;
use common\models\govcontrol\ProgramSearch;
use common\models\User;
use Exception;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProgramController implements the CRUD actions for Program model.
 */
class ProgramController extends Controller
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
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Program models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProgramSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCompanySearch()
    {
        $company_search = new CompanySearch();

        if ($this->request->isPost) {
            if ($company_search->load($this->request->post()) ) {
               
                $company = Company::findOne(['stir' => $company_search->stir]);
                if($company){
                    return $this->render('company-search', [
                    'company_search' => $company_search,
                    'company' => $company,
                    't' => 2
                ]);
                }
                else{
                    return $this->render('company-search', [
                        'company_search' => $company_search,
                        'company' => null,
                        't' => 0
                    ]);
                }
                
            }
        }
        return $this->render('company-search', [
            'company_search' => $company_search,
            'company' => null,
            't' => 1
        ]);
    }

    /**
     * Displays a single Program model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $status = null)
    {
        $model = $this->findModel($id);
        
        // // debug($_POST);
        // if ($model->load(Yii::$app->request->post())) {
        //     debug($_POST);
        //     if (isset($_POST['name'])) {
        //     }
        // }

        if($status){
            $model->status = $status;
            $model->save();
            return $this->redirect(['view', 'id' => $id]);
        }
        $company = Company::findOne($model->company_id);
        $searchModel = new ProgramPropertySearch();
        $searchModel->gov_control_program_id = $model->id;
        $dataProviders = [];
        foreach(ProgramData::getCategory() as $key => $value){
            // debug($key);
            $searchModel->category_id = $key;
            // debug($searchModel);
            $dataProviders[$key] = $searchModel->search($this->request->queryParams);
            // $test = ProgramProperty::findAll();
            // debug(
            //     $dataProvider->getModels()
            // );
        }    
        // $properties = ProgramProperty::find()
        // ->where(['gov_control_program_id' => $model->id])
        // ->joinWith('programData')
        // ->all();
        // debug($model);
        // debug($dataProviders);
        
        
        return $this->render('view', compact('model', 'company', 'searchModel','dataProviders'
    ));
    }
    public function actionDocument($id)
    {
        $model = $this->findModel($id);
        $company = Company::findOne($model->company_id);
        $user = User::findOne(Yii::$app->user->id);
        $searchModel = new ProgramPropertySearch();
        $searchModel->gov_control_program_id = $model->id;
        $dataProviders = [];
        foreach(ProgramData::getCategory() as $key => $value){
            // debug($key);
            $searchModel->category_id = $key;
            $dataProviders[$key] = $searchModel->search($this->request->queryParams);
            

        }   
        // debug($dataProviders[1]->getModels()); 
        return $this->render('document', compact('model', 'company', 'user', 'searchModel','dataProviders'
    ));
    }

    /**
     * Creates a new Program model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($company_id = null)
    {
        $model = new Program();
        $model->scenario = 'create';
        $model->company_id = $company_id;
        $model->status = $model::DOCUMENT_STATUS_NEW;

        if ($this->request->isPost) {
            
            if ($model->load($this->request->post())) {
                // debug($_POST);
                if($model->validate())
                    
                    $transaction = Yii::$app->db->beginTransaction();
                        try {
                            // $model->company_id = $company_id;
                            // debug($model);
                            $model->save(false);
                            if ($model->property) {
                                // debug($model->property);
                                foreach ($model->property as $properties) {
                                    if($properties){
                                        foreach ($properties as $property) {    
                                            $program_property = new ProgramProperty();
                                            $program_property->gov_control_program_id = $model->id;
                                            $program_property->program_data_id = $property;
                                            $program_property->save(false);
                                        }
                                    }
                                }
                            }
                            $transaction->commit();
                            // debug($transaction);
                            return $this->redirect(['view', 'id' => $model->id]);
                        } 
                   
                        catch (Exception $e) {
                        $transaction->rollBack();
                        throw $e;
                        }

                        return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }
        $company = Company::findOne($model->company_id);
        return $this->render('create', [
            'model' => $model,
            'company' => $company,
        ]);
    }

    /**
     * Updates an existing Program model.
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

    /**
     * Deletes an existing Program model.
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

    public function actionChangeStatus($id, $status)
    {
        $model = $this->findModel($id);
        $model->status = $status;
        $model->save();
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Finds the Program model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Program the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Program::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
