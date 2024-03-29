<?php

namespace backend\controllers\govcontrol;

use backend\models\CompanySearch;
use common\models\Company;
use common\models\govcontrol\Program;
use common\models\govcontrol\ProgramSearch;
use frontend\controllers\govcontrol\ProgramController as GovcontrolProgramController;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProgramController implements the CRUD actions for Program model.
 */
class ProgramController extends GovcontrolProgramController
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
    // public function actionView($id, $status = null)
    // {
    //     $model = $this->findModel($id);
    //     if($status){
    //         $model->status = $status;
    //         $model->save();
    //     }
    //     return $this->render('view', compact('model'));
    // }

    /**
     * Creates a new Program model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($company_id = null)
    {
        $model = new Program();
        if($company_id){$model->company_id = $company_id;}

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
