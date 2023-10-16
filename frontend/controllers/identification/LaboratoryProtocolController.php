<?php

namespace frontend\controllers\identification;

use common\models\actselection\ActSelection;
use common\models\actselection\SelectedProduct;
use common\models\identification\LaboratoryProtocol;
use common\models\identification\LaboratoryProtocolContent;
use common\models\identification\LaboratoryProtocolContentSearch;
use common\models\identification\LaboratoryProtocolSearch;
use common\models\Model;
use Throwable;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LaboratoryProtocolController implements the CRUD actions for LaboratoryProtocol model.
 */
class LaboratoryProtocolController extends Controller
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
     * Lists all LaboratoryProtocol models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new LaboratoryProtocolSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LaboratoryProtocol model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $searchModel = new LaboratoryProtocolContentSearch();
        $searchModel->laboratory_protocol_id = $model->id;
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('view', compact('model', 'dataProvider', 'searchModel'));
    }

    /**
     * Creates a new LaboratoryProtocol model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($selected_product_id = null)
    {
        $selected_product = SelectedProduct::findOne(['id' => $selected_product_id]);
        $model = new LaboratoryProtocol();
        $model->status = $model::DOCUMENT_STATUS_INPROGRESS;
        $model->selected_product_id = $selected_product->id;
        $act_selection = $this->findActSelection($selected_product->act_selection_id);

        $models = [new LaboratoryProtocolContent];
        $models = Model::createMultiple(LaboratoryProtocolContent::class);
        Model::loadMultiple($models, Yii::$app->request->post());

        // debug($model);
        if ($this->request->isPost && $model->load($this->request->post())) {
            // validate all models
            $valid = Model::validateMultiple($models);
            
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    // debug($model->errors);
                    $model->save(false);
                    foreach ($models as $one_model) {
                                $one_model->laboratory_protocol_id = $model->id;
                                $one_model->requirement_range = $one_model->getRequirementRange($one_model->condition1, $one_model->condition2);
                                $one_model->save();
                            }
                    $transaction->commit();
                    return $this->redirect(['/govcontrol/gov-control/laboratory-protocol', 'gov_control_order_id' =>  $act_selection->gov_control_order_id]);
                    }

                    catch (Throwable $e) {
                            $transaction->rollBack();
                            throw $e;
                    }
            }
        } 
                return $this->render('create', [
                    'model' => $model,
                    'models' => (empty($models)) ? [new LaboratoryProtocolContent()] : $models,
                    'selected_product' => $selected_product
                ]);
    }

    /**
     * Updates an existing LaboratoryProtocol model.
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
     * Deletes an existing LaboratoryProtocol model.
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
     * Finds the LaboratoryProtocol model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return LaboratoryProtocol the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LaboratoryProtocol::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function findActSelection($act_selection_id)
    {
        if (($model = ActSelection::findOne($act_selection_id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
