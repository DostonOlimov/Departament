<?php

namespace backend\controllers\govcontrol;

use common\models\govcontrol\Order;
use common\models\govcontrol\OrderSearch;
use common\models\govcontrol\Program;
use Exception;
use frontend\controllers\govcontrol\OrderController as GovcontrolOrderController;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends GovcontrolOrderController
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
     * Lists all Order models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionView($id)
    // {
    //     return $this->render('view', [
    //         'model' => $this->findModel($id),
    //     ]);
    // }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    // public function actionCreate($gov_control_program_id = null)
    // {
    //     $model = new Order();
    //     if($gov_control_program_id){
    //         $model->gov_control_program_id = $gov_control_program_id;
    //     }

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
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionConfirm($id)
    {
        $model = $this->findModel($id);
        $program = Program::findOne(['id' => $model->gov_control_program_id]);
        $model->order_prefix = 
        ($program->gov_control_type === $program::getGovcontrolType($program::DN)) ?
        $model::DN : $model::DT;
        $model->status = $model::DOCUMENT_STATUS_CONFIRMED;
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if($model->validate()){
                    $transaction = Yii::$app->db->beginTransaction();
                    try {
                        $model->save(false);
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                        }
                   
                        catch (Exception $e) {
                            $transaction->rollBack();
                            throw $e;
                        }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } 
        else {
            $model->loadDefaultValues();
        }

        return $this->render('confirm', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionDelete($id)
    // {
    //     $this->findModel($id)->delete();

    //     return $this->redirect(['index']);
    // }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    // protected function findModel($id)
    // {
    //     if (($model = Order::findOne(['id' => $id])) !== null) {
    //         return $model;
    //     }

    //     throw new NotFoundHttpException('The requested page does not exist.');
    // }
}
