<?php

namespace frontend\controllers\govcontrol;

use common\models\govcontrol\PrimaryData;
use common\models\govcontrol\PrimaryDataSearch;
use frontend\controllers\govcontrol\GovControlController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PrimaryDataController implements the CRUD actions for PrimaryData model.
 */
class PrimaryDataController extends GovControlController
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
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all PrimaryData models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PrimaryDataSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PrimaryData model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id = null, $gov_control_order_id = null)
    {
        $model = ($gov_control_order_id) ? 
        PrimaryData::findOne(['gov_control_order_id' => $gov_control_order_id]):
        $this->findModel($id);
        // debug($model);
        
        // $order = Parent::findModel($model->gov_control_order_id);
        
        return $this->render('view', compact('model'));
    }

    /**
     * Creates a new PrimaryData model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($gov_control_order_id = null)
    {
        $model = new PrimaryData();
        $model->gov_control_order_id = $gov_control_order_id;
        // $order = Parent::findModel($gov_control_order_id);

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create',compact('model'));
    }

    /**
     * Updates an existing PrimaryData model.
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
     * Deletes an existing PrimaryData model.
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
     * Finds the PrimaryData model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return PrimaryData the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PrimaryData::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
