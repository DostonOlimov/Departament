<?php

namespace frontend\controllers\govcontrol;

use common\models\actselection\SelectedProductSearch;
use common\models\Company;
use common\models\govcontrol\Order;
use common\models\govcontrol\OrderSearch;
use common\models\govcontrol\Program;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GovControlController implements the CRUD actions for Order model.
 */
class GovControlController extends Controller
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
    public function actionIdentification($id)
    {
        $orderModel = $this->findModel($id);
        $searchModel = new SelectedProductSearch();
        $searchModel->gov_control_order_id = $id;
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('identification', compact('searchModel', 'dataProvider', 'orderModel'));

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
        $company = $this->findCompany($id);
        // debug($program);
        // debug($company);
        return $this->render('view', compact('model','company'));
    }
    public function actionViewCompany($id)
    {
        $model = $this->findModel($id);
        $company = $this->findCompany($id);
        // debug($program);
        // debug($company);
        return $this->render('view-company', compact('model','company'));
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
            $model->gov_control_program_id = $gov_control_program_id;
        }

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
     * Updates an existing Order model.
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
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function findCompany($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            if (($program = Program::findOne($model->gov_control_program_id)) !== null) {
                if (($company = Company::findOne($program->company_id)) !== null) {
                    return $company;
                }
            }
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
