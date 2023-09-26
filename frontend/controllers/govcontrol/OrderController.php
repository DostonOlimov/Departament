<?php

namespace frontend\controllers\govcontrol;

use common\models\AttachedExecutor;
use common\models\govcontrol\Order;
use common\models\govcontrol\OrderSearch;
use common\models\govcontrol\Program;
use common\models\User;
use Exception;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
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
            // 'govcontrol' => $govcontrol,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        // $model->executors = function($model){
        //     foreach($model->attachedExecutors as $executor_id){
        //         debug($executor_id);
        //     }
        // };
        // debug($model);
        // debug($model->executors);
        $executors = array_column($model->attachedExecutors, 'user_id');
        $model->executors = $executors;
        // $model->executors = User::find()->where(['id' => $executors])->select(['name', 'surname'])->asArray()->all();
        // debug($model);
        return $this->render('view', compact('model'));
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($gov_control_program_id = null)
    {
        $model = new Order();
        if($gov_control_program_id){
            $program = Program::findone(['id' => $gov_control_program_id]);
            $model->gov_control_program_id = $program->id;
            $model->status = $model::DOCUMENT_STATUS_NEW;
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if($model->validate()){
                    $transaction = Yii::$app->db->beginTransaction();
                        try {
                            $model->save(false);
                            if ($model->executors) {
                                foreach ($model->executors as $executor_id) {  
                                            $attached_executor = new AttachedExecutor();
                                            $attached_executor->gov_control_order_id = $model->id;
                                            $attached_executor->user_id = $executor_id;
                                            $attached_executor->save(false);
                                    }
                                }
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

        return $this->render('create', compact('model', 'program'));
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $old_executers = array_column($model->attachedExecutors, 'user_id');
        $model->executors = $old_executers;
        $program = Program::findone(['id' => $model->gov_control_program_id]);
        $model->gov_control_program_id = $program->id;
        $model->status = $model::DOCUMENT_STATUS_NEW;
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if($model->validate()){
                    $transaction = Yii::$app->db->beginTransaction();
                        try {
                            $model->save(false);
                            if ($model->executors) {
                                $del_executers = array_diff($old_executers, $model->executors);
                                $add_executers = array_diff($model->executors, $old_executers);
                                if($del_executers){
                                    // debug($del_executers);
                                    foreach ($del_executers as $executor_id) {
                                        $attached_executor = AttachedExecutor::findOne(['gov_control_order_id' => $model->id, 'user_id' => $executor_id]);
                                        $attached_executor->delete();
                                    }
                                }
                                if($add_executers){
                                    foreach ($add_executers as $executor_id) {  
                                                $attached_executor = new AttachedExecutor();
                                                $attached_executor->gov_control_order_id = $model->id;
                                                $attached_executor->user_id = $executor_id;
                                                $attached_executor->save(false);
                                    }
                                }
                            }
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

        return $this->render('update', compact('model', 'program'));
    }

    /**
     * Deletes an existing Order model.
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

    public function actionChangeStatus($id, $status)
    {
        $model = $this->findModel($id);
        $model->status = $status;
        // $identification->selected_product_id = $identification->selected_product_id;
        $model->save();
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne(['id' => $id])) !== null) {
            // if (($model = Order::findOne(['id' => $id])) !== null) {
                return $model;
            // }
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
