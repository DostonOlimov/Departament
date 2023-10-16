<?php

namespace frontend\controllers\identification;

use common\models\actselection\SelectedProduct;
use common\models\actselection\SelectedProductSearch;
use common\models\govcontrol\Order;
use common\models\identification\LaboratoryConclusion;
use common\models\identification\LaboratoryConclusionSearch;
use common\models\Model;
use Exception;
use Throwable;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LaboratoryConclusionController implements the CRUD actions for LaboratoryConclusion model.
 */
class LaboratoryConclusionController extends Controller
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
     * Lists all LaboratoryConclusion models.
     *
     * @return string
     */
    public function actionIndex($selected_product_id = null)
    {
        $searchModel = new LaboratoryConclusionSearch();
        $searchModel->selected_product_id = $selected_product_id;
        $dataProvider = $searchModel->search($this->request->queryParams);
        $selected_product = SelectedProduct::findOne(['id' => $selected_product_id]);

        return $this->render('index', compact('searchModel', 'dataProvider', 'selected_product'));

    }

    /**
     * Displays a single LaboratoryConclusion model.
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
     * Creates a new LaboratoryConclusion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new LaboratoryConclusion();

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

    public function actionCreateMultiple($selected_product_id = null)
    {   
        $selected_product = SelectedProduct::findOne(['id' => $selected_product_id]);
        // debug($selected_product); 
        $models = [new LaboratoryConclusion];
        $models = Model::createMultiple(LaboratoryConclusion::class);
        Model::loadMultiple($models, Yii::$app->request->post());

        if ($this->request->isPost) {
            // validate all models
            $valid = Model::validateMultiple($models);
            
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                // debug($transaction);
                try {
                    foreach ($models as $model) {
                                $model->selected_product_id = $selected_product->id;
                                $model->requirement_range = $model->getRequirementRange($model->condition1, $model->condition2);
                                $model->save(false);
                            }
                    $transaction->commit();
                    return $this->redirect(['index', 'selected_product_id' =>  $selected_product->id]);
                    }

                    catch (Throwable $e) {
                            $transaction->rollBack();
                            throw $e;
                    }
            }
        } 
                return $this->render('create-multiple', [
                    'models' => (empty($models)) ? [new LaboratoryConclusion()] : $models,
                    'selected_product' => $selected_product
                ]);
            }

    /**
     * Updates an existing LaboratoryConclusion model.
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
     * Deletes an existing LaboratoryConclusion model.
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
     * Finds the LaboratoryConclusion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return LaboratoryConclusion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LaboratoryConclusion::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findOrder($id)
    {
        if (($model = Order::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
