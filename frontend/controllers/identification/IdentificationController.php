<?php

namespace frontend\controllers\identification;

use common\models\actselection\ActSelection;
use common\models\actselection\SelectedProduct;
use common\models\identification\Identification;
use common\models\identification\IdentificationContentSearch;
use common\models\identification\IdentificationSearch;
use common\models\normativedocument\SelectedNormativeDocument;
use common\models\User;
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
                    'class' => VerbFilter::class,
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
    public function actionIndex($gov_control_order_id = null, $identification_id = null)
    {
        $searchModel = new IdentificationSearch();
        $searchModel->gov_control_order_id = $gov_control_order_id;
        $dataProvider = $searchModel->search($this->request->queryParams);
        // debug($dataProvider->getModels()[0]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'gov_control_order_id' => $gov_control_order_id,
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
    public function actionIdentificationView($id)
    {
        $searchModel = new IdentificationContentSearch();
        $searchModel->identification_id = $id;
        // debug($searchModel);
        $dataProvider = $searchModel->search($this->request->queryParams);
        // debug($dataProvider);

        return $this->render('identification-view', compact(
            'searchModel', 
            'dataProvider', 
            // 'orderModel',
            // 'act_selection',
            // 'company',
            // 'product',
        ));
    }
    public function actionIdentificationDocument($id)
    {   
        // debug('test');
        $user = User::findOne(Yii::$app->user->id);
        $searchModel = new IdentificationContentSearch();
        $searchModel->identification_id = $id;
        // debug($searchModel);
        $dataProvider = $searchModel->search($this->request->queryParams);
        // debug($dataProvider->getModels());

        return $this->render('identification-document', compact(
            'searchModel', 
            'dataProvider', 
            'user',
        ));

        // $model = $this->findModel($id);
        // $company = Company::findOne($model->company_id);
        // $user = User::findOne(['id' => $model->created_by]);
        // $risks_criteria = new RisksCriteria();
        // $sumscore = $risks_criteria->getCriteriaBall($id);
        // // echo $sumscore;die;
        // $score = RisksCriteria::find()
        // ->select('criteria_id')
        // ->Where(['risk_analisys_id' => $id])
        // ->asArray()
        // ->all();
        // $comment = RisksCriteria::find()
        // ->select('comment')
        // ->Where(['risk_analisys_id' => $id])
        // ->asArray()
        // ->all();


        // return $this->render('document', 
        // compact('model', 'company', 'user', 'score','sumscore', 'comment'));
    }

    /**
     * Creates a new Identification model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($selected_product_id)
    {

        $model = new Identification();
        $model->selected_product_id = $selected_product_id;
        $model->status = $model::DOCUMENT_STATUS_NEW;
        $act_selection = ActSelection::findOne(['id' => SelectedProduct::findOne(['id' => $selected_product_id])->act_selection_id ]);
        $act_selection->status = $model::DOCUMENT_STATUS_INPROGRESS;
        if ($model->load($this->request->post()) ) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($model->selected_normative_documents) {
                        $model->save(false);
                        foreach ($model->selected_normative_documents as $selected_nd) {
                            $model_nd = new SelectedNormativeDocument();
                            $model_nd->identification_id = $model->id;
                            $model_nd->status = $model::DOCUMENT_STATUS_NEW;
                            $model_nd->normative_document_id = $selected_nd;
                            $model_nd->save(false);
                            $act_selection->save(false);
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
