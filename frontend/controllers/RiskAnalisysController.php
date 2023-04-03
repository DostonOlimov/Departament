<?php

namespace frontend\controllers;

use common\models\Company;
use common\models\RiskAnalisys;
use common\models\RiskAnalisysCriteria;
use common\models\RiskAnalisysSearch;
use common\models\RisksCriteria;
use frontend\models\CompanySearch;
use common\models\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

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

    /**
     * Lists all RiskAnalisys models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RiskAnalisysSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RiskAnalisys model.
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
     * Creates a new RiskAnalisys model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id)
    {
        $model = new RiskAnalisys();
        $company_id = Company::findOne([$id]);
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
        ]);
    }

    public function actionAddCriteria($id)
    {
        $criteria = RiskAnalisysCriteria::find()->All();
        foreach ($criteria as $key => $value)
            {
                $model[$key] = new RisksCriteria();
                $model[$key]['risk_analisys_id'] = $id;
                $model[$key]['name'] = $value->criteria;
                $model[$key]['ball'] = $value->criteria_score;
                $model[$key]['criteria_id'] = $value->id;
            }
        if ($this->request->isPost) {

            $model = Model::createMultiple(RisksCriteria::classname());
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
        $model = new CompanySearch();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) ) {
               
                $company = Company::findOne(['stir' => $model->stir]);
                if($company){
                   // $model = new RiskAnalisys();
                    return $this->render('search', [
                    'model' => $model,
                    'company' => $company,
                    't' => 1
                ]);
                }
                else{
                    return $this->render('search', [
                        'model' => $model,
                        'company' => null,
                        't' => 0
                    ]);
                }
                
            }
        }
        return $this->render('search', [
            'model' => $model,
            'company' => null,
            't' => 2
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
}
