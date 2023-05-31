<?php

namespace backend\controllers;

use common\models\Company;
use common\models\RiskAnalisys;
use common\models\RiskAnalisysCriteria;
use common\models\RiskAnalisysSearch;
use common\models\RisksCriteria;
use common\models\RisksCriteriaSearch;
use common\models\RisksCriteriaFullSearch;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
    {   $searchModel = new RisksCriteriaSearch($id);
        $dataProvider = $searchModel->search($this->request->queryParams);
        $model = $this->findModel($id);
        $company = Company::findOne(['id' => $model->company_id]);
        $criteria = RisksCriteria::findOne(['risk_analisys_id' => $model->id]);
        $risk_analisys_criteria = RiskAnalisysCriteria::findone(['id' => $model->id]);

        return $this->render('view', compact('searchModel', 'dataProvider', 
        'model', 'company', 'criteria', 'risk_analisys_criteria'));
    }
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
    // public function actionCreate()
    // {
    //     $model = new RiskAnalisys();

    //     if ($this->request->isPost) {
    //         if ($model->load($this->request->post()) && $model->save()) {
    //             return $this->redirect(['view', 'id' => $model->id]);
    //         }
    //     } else {
    //         $model->loadDefaultValues();
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }

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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
