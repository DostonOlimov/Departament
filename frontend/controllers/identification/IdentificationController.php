<?php

namespace frontend\controllers\identification;

use common\models\identification\Identification;
use common\models\identification\IdentificationSearch;
use common\models\normativedocument\SelectedNormativeDocument;
use Exception;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * IdentificationController implements the CRUD actions for Identification model.
 */
class IdentificationController extends Controller
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
     * Lists all Identification models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new IdentificationSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Identification model.
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
     * Creates a new Identification model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($selected_product_id)
    {
        // $model = new Identification();

        // if ($this->request->isPost) {
        //     if ($model->load($this->request->post()) && $model->save()) {
        //         return $this->redirect(['view', 'id' => $model->id]);
        //     }
        // } else {
        //     $model->loadDefaultValues();
        // }

        // return $this->render('create', [
        //     'model' => $model,
        // ]);


        //

        $model = new Identification();
        $model->selected_product_id = $selected_product_id;
        // debug($model);
        if ($model->load($this->request->post()) ) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($model->selected_normative_documents) {
                        $model->save(false);
                        foreach ($model->selected_normative_documents as $selected_nd) {
                            $model_nd = new SelectedNormativeDocument();
                            $model_nd->identification_id = $model->id;
                            $model_nd->normative_document_id = $selected_nd;
                            $model_nd->save(false);
                    }
                }
                $transaction->commit();
                return $this->redirect(Url::to(['actselection/selected-product/view', 'id' => $model->selected_product_id]));
            } 
            catch (Exception $e) 
            {
                $transaction->rollBack();
                throw $e;
            }
       
    }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Identification model.
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
     * Deletes an existing Identification model.
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
     * Finds the Identification model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Identification the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Identification::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
