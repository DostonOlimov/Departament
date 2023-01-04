<?php

namespace backend\controllers\caution;

use common\models\prevention\Prevention;
use common\models\prevention\PreventionSearch;
use common\models\control\Company;
use common\models\control\Instruction;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;

/**
 * PreventionController implements the CRUD actions for Prevention model.
 */
class PreventionController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::classname(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Prevention models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PreventionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        // $dataProvider = new ActiveDataProvider([
        //     'query' => Prevention::find()->joinWith('company')->joinWith('instruction'),
            
        //     'pagination' => [
        //         'pageSize' => 10
        //     ],
        //     'sort' => [
        //         'defaultOrder' => [
        //             'id' => SORT_DESC,
        //         ]
        //     ],
            
        // ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Prevention model.
     * @param int $id Yozma ko'rsatma raqami
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
     * Creates a new Prevention model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Prevention();

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
     * Updates an existing Prevention model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id Yozma ko'rsatma raqami
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
     * Deletes an existing Prevention model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id Yozma ko'rsatma raqami
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Prevention model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id Yozma ko'rsatma raqami
     * @return Prevention the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Prevention::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
