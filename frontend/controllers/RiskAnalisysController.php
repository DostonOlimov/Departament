<?php

namespace frontend\controllers;

use common\models\Company;
use common\models\RiskAnalisys;
use common\models\RiskAnalisysCriteria;
use common\models\RiskAnalisysSearch;
use common\models\RisksCriteria;
use frontend\models\CompanySearch;
use common\models\Model;
use common\models\RisksCriteriaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\User;
use frontend\models\RiskAnalisysForm;
use Yii;

/**
 * RiskAnalisysController implements the CRUD actions for RiskAnalisys model.
 */
class RiskAnalisysController extends Controller
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
                            'roles' => ['@']
                        ],
                    ],
                ]
            ];
        }

    /**
     * Lists all RiskAnalisys models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RiskAnalisysSearch();
        $searchModel->created_by = Yii::$app->user->id;
        $searchModel->summary_user_id = Yii::$app->user->id;
        // debug($this->request->queryParams);  
        $dataProvider = $searchModel->search($this->request->queryParams);
        // debug($searchModel);
        // debug($dataProvider);
        $user = User::findOne(Yii::$app->user->id);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionExport()
    {
        $model = new RiskAnalisysForm();
        $user = User::findOne(Yii::$app->user->id);
        // debug($this->request->post());
        if ($model->load($this->request->post())) {
            // debug($model);
            $models = RiskAnalisys::find()
            ->andFilterWhere(['between', 'risk_analisys_date',strtotime($model->start_date),strtotime($model->end_date. ' +1 day -1 second')])
            ->andFilterWhere(['summary_user_id' => $user->id])
            ->all();
            // debug($model);
            // debug($models);
        
            return $this->render('application-one', compact('model', 'models', 'user'));
            
            // debug($searchModel);
        }

        return $this->render('export', compact('model'));
    }

    /**
     * Displays a single RiskAnalisys model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionDocument($id)
    {   $model = $this->findModel($id);
        $company = Company::findOne($model->company_id);
        $user = User::findOne(['id' => $model->created_by]);
        $risks_criteria = new RisksCriteria();
        $sumscore = $risks_criteria->getCriteriaBall($id);
        // echo $sumscore;die;
        $score = RisksCriteria::find()
        ->select('criteria_id')
        ->Where(['risk_analisys_id' => $id])
        ->asArray()
        ->all();
        $comment = RisksCriteria::find()
        ->select('comment')
        ->Where(['risk_analisys_id' => $id])
        ->asArray()
        ->all();


        return $this->render('document', 
        compact('model', 'company', 'user', 'score','sumscore', 'comment'));
    }

    /**
     * Creates a new RiskAnalisys model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($company_id)
    {   $company_id;
        $model = new RiskAnalisys();
        //$company = Company::findOne([$company_id]);
        $model->company_id = $company_id;
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'company_id' => $company_id,
        ]);
    }

    public function actionAddCriteria($id)
    {
        $criteria = RiskAnalisysCriteria::find()->All();
        foreach ($criteria as $key => $value)
            {
                $model[$key] = new RisksCriteria();
                $model[$key]['risk_analisys_id'] = $id;
                $model[$key]['name'] = $value->document_paragraph  . " . ". $value->criteria . " (" . $value->criteria_score . " ball)";
                $model[$key]['ball'] = $value->criteria_score;
                $model[$key]['criteria_id'] = $value->id;
            }
        if ($this->request->isPost) {

            $model = Model::createMultiple(RisksCriteria::class);
            Model::loadMultiple($model, $this->request->post());

           $valid = Model::validateMultiple($model);
           
            if ($valid) {
                foreach ($model as $key => $value) 
                    {
                     if($value->status == 1){
                        $lab = new RisksCriteria();
                        $lab->risk_analisys_id = $value->risk_analisys_id;
                        $lab->criteria_id = $value->criteria_id;
                        $lab->comment = $value->comment;
                        $lab->save();
                     }
                    }
                return $this->redirect(['index']);
            }
        } 

        return $this->render('add_criteria', [
            'model' => $model,
            'criteria' => $criteria
        ]);
    }

    /**
     * Updates an existing RiskAnalisys model.
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
     * Deletes an existing RiskAnalisys model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        

        return $this->redirect(['index']);
    }

     /**
     * Deletes an existing RiskAnalisys model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionSearch()
    {
        $company_search = new CompanySearch();

        if ($this->request->isPost) {
            if ($company_search->load($this->request->post()) ) {
               
                $company = Company::findOne(['stir' => $company_search->stir]);
                if($company){
                   // $model = new RiskAnalisys();
                    return $this->render('search', [
                    'company_search' => $company_search,
                    'company' => $company,
                    't' => 2
                ]);
                }
                else{
                    return $this->render('search', [
                        'company_search' => $company_search,
                        'company' => null,
                        't' => 0
                    ]);
                }
                
            }
        }
        return $this->render('search', [
            'company_search' => $company_search,
            'company' => null,
            't' => 1
        ]);
    }
    public function actionViewCompany($company_id = null, $id = null, $view_id = null)
    {
        return $this->render('view-company', compact('company_id', 'id'));

    }
    public function actionViewCriteria($id)
    {
        $searchModel = new RisksCriteriaSearch($id);
        $dataProvider = $searchModel->search($this->request->queryParams);
        $model = $this->findModel($id);

        return $this->render('view-criteria', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
      //  return $this->render('view-criteria', compact('criteria',));

    }

    public function actionView($id = null)
    {
        $searchModel = new RisksCriteriaSearch($id);
        $dataProvider = $searchModel->search($this->request->queryParams);
        $model = $this->findModel($id);
        $company = Company::findOne(['id' => $model->company_id]);
        // debug($model);
        return $this->render('view', compact('searchModel', 'dataProvider', 
        'model', 'company'));
    }
    public function actionCreateCompany()
    {   // $model = new RiskAnalisys();
        $company_search = new CompanySearch();
        $company = new Company();
        $model = new RiskAnalisys();
        

        if ($this->request->isPost) {
            if ($company_search->load($this->request->post()) ) {
                $company = Company::findOne(['stir' => $company_search->stir]);
            // -----if company found-----
                if($company){
                    $model = new RiskAnalisys();
                    $model->company_id = $company->id;
                    return $this->render('search', [
                    'company_search' => $company_search,
                    'company' => $company,
                    'model' => $model,
                    't' => 2
                ]);
                }

            // -----if company not found-----
                else{
                    return $this->render('search', [
                        'company_search' => $company_search,
                        'company' => null,
                        't' => 0
                    ]);
                }
                
            }
        }
    }
    public function actionCreateCriteria($id, $company_id)
    {
        $criteria = RiskAnalisysCriteria::find()->All();
        foreach ($criteria as $key => $value)
            {
                $model[$key] = new RisksCriteria();
                $model[$key]['risk_analisys_id'] = $id;
                // debug($value->id,false);
                // $model[$key]['name'] = $value->criteria;
                // $model[$key]['ball'] = $value->criteria_score;
                $model[$key]['criteria_id'] = $value->id;
            }
        if ($this->request->isPost) {

            $model = Model::createMultiple(RisksCriteria::class);
            Model::loadMultiple($model, $this->request->post());

            $valid = Model::validateMultiple($model);
            
            if ($valid) {
                foreach ($model as $key => $value) 
                    {
                        if($value->status == 1){
                        $lab = new RisksCriteria();
                        $lab->id = $value->id;
                        $lab->criteria_id = $value->criteria_id;
                        $lab->comment = $value->comment;
                        $lab->save();
                        }
                    }
                return $this->redirect(['index']);
            }
        } 

        return $this->render('criteria/add-create', [
            'model' => $model,
            'criteria' => $criteria
        ]);
    }

    /**
     * Finds the RiskAnalisys model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return RiskAnalisys the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RiskAnalisys::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findView($id)
    {
        if (RisksCriteria::findOne(['risk_analisys_id' => $id]) !== null) {
            return $id;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
