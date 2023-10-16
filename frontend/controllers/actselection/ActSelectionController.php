<?php

namespace frontend\controllers\actselection;

use common\models\actselection\ActSelection;
use common\models\actselection\ActSelectionSearch;
use common\models\actselection\SelectedProduct;
use common\models\actselection\SelectedProductSearch;
use common\models\govcontrol\Order;
use common\models\Model;
use Exception;
use frontend\controllers\govcontrol\OrderController;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * ActSelectionController implements the CRUD actions for ActSelection model.
 */
class ActSelectionController extends OrderController
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
     * Lists all ActSelection models.
     *
     * @return string
     */
    public function actionIndex($gov_control_order_id = null)
    {
        $order = Parent::findModel($gov_control_order_id);
        // debug($order);
        $searchModel = new ActSelectionSearch();
        $searchModel->gov_control_order_id = $gov_control_order_id;
        $dataProvider = $searchModel->search($this->request->queryParams);


        return $this->render('index', compact('searchModel', 'dataProvider', 'order'));
    }

    /**
     * Displays a single ActSelection model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {   
        $model = $this->findModel($id);
        // debug($model);
        $searchModel = new SelectedProductSearch();
        $searchModel->act_selection_id = $id;
        // debug($searchModel);
        $dataProvider = $searchModel->search($this->request->queryParams);
        // debug($dataProvider->getKeys());
        // debug($dataProvider->getModels());

        return $this->render('view', compact(
            'model',
            'searchModel',
            'dataProvider'

        ));
    }

    /**
     * Creates a new ActSelection model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($gov_control_order_id = null)
    {
        $model = new ActSelection();
        $model->gov_control_order_id = $gov_control_order_id;
        $model->status = $model::DOCUMENT_STATUS_NEW;
        // debug($model);
        $models = [new SelectedProduct];
        if ($model->load(Yii::$app->request->post())) {
            // $model->save(false);
            // debug($model);
            
            $models = Model::createMultiple(SelectedProduct::class);
            Model::loadMultiple($models, Yii::$app->request->post());
            // debug($models);

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($models) && $valid;
            // debug($valid);
            
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        // debug('$flag');
                        foreach ($models as $modelProduct) {
                            $modelProduct->act_selection_id = $model->id;
                            // debug($modelProduct);
                            if (! ($flag = $modelProduct->save(false))) {
                                // debug($modelProduct);
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'models' => (empty($models)) ? [new SelectedProduct()] : $models
        ]);
    }

    /**
     * Updates an existing ActSelection model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index', 'gov_control_order_id' => $model->gov_control_order_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ActSelection model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['index', 'gov_control_order_id' => $model->gov_control_order_id]);
    }

    public function actionChangeStatus($id, $status)
    {
        $model = ActSelection::findOne(['id' => $id]);
        $model->status = $status;
        // $identification->selected_product_id = $identification->selected_product_id;
        $model->save();
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Finds the ActSelection model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ActSelection the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActSelection::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
