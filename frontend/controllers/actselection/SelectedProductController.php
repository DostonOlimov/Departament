<?php

namespace frontend\controllers\actselection;

use common\models\actselection\SelectedProduct;
use common\models\actselection\SelectedProductSearch;
use common\models\identification\Identification;
use common\models\normativedocument\SelectedNormativeDocumentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SelectedProductController implements the CRUD actions for SelectedProduct model.
 */
class SelectedProductController extends Controller
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
     * Lists all SelectedProduct models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SelectedProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SelectedProduct model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {   
        $model = $this->findModel($id);
        $identificationModel = Identification::findOne(['selected_product_id' => $id]);
        if(empty($identificationModel)){
            $nd_status = false;
            return $this->render('view', compact('model', 'nd_status'));
        }
        else{
            $nd_status = true;
            $searchModel = new SelectedNormativeDocumentSearch();
            $searchModel->identification_id = $identificationModel->id;
            $dataProvider = $searchModel->search($this->request->queryParams);
            return $this->render('view', compact('model', 'identificationModel', 'searchModel', 'dataProvider', 'nd_status'));
        }
        
    }

    /**
     * Creates a new SelectedProduct model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($act_selection_id)
    {
        $model = new SelectedProduct();
        $model->act_selection_id = $act_selection_id;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['actselection/act-selection/view', 'id' => $model->act_selection_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SelectedProduct model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['actselection/act-selection/view', 'id' => $model->act_selection_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SelectedProduct model.
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
     * Finds the SelectedProduct model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return SelectedProduct the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SelectedProduct::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
