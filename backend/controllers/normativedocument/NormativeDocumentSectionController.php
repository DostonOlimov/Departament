<?php

namespace backend\controllers\normativedocument;

use common\models\normativedocument\NormativeDocument;
use common\models\normativedocument\NormativeDocumentContentSearch;
use common\models\normativedocument\NormativeDocumentSearch;
use common\models\normativedocument\NormativeDocumentSection;
use common\models\normativedocument\NormativeDocumentSectionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NormativeDocumentSectionController implements the CRUD actions for NormativeDocumentSection model.
 */
class NormativeDocumentSectionController extends Controller
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
     * Lists all NormativeDocumentSection models.
     *
     * @return string
     */
    public function actionIndex($normative_document_id = null)
    {
        $searchModel = new NormativeDocumentSectionSearch();
        $searchModel-> normative_document_id = $normative_document_id;
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NormativeDocumentSection model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $searchModel = new NormativeDocumentContentSearch();
        $searchModel->document_section_id = $id;
        $dataProvider = $searchModel->search($this->request->queryParams);


        return $this->render('view', compact('model', 'searchModel', 'dataProvider'));

    }

    /**
     * Creates a new NormativeDocumentSection model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id)
    {
        $model = new NormativeDocumentSection();
        $model->normative_document_id = $id;


        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['normativedocument/normative-document/view', 'id' => $model->normative_document_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreateLowerSection($parent_id)
    {   $old_model = $this->findModel($parent_id);
        $model = new NormativeDocumentSection();
        $model->parent_id = $old_model->id;
        $model->normative_document_id = $old_model->normative_document_id;
        $model->section_category_id = $old_model->section_category_id;
        

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['normativedocument/normative-document/view', 'id' => $model->normative_document_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionDown($id)
    {
        $model = $this->findModel($id);
        $model->position += 1;
        $model->save();
        // debug($model->errors);
        // $model = $this->findModel($id);
        
        // debug($model);
        if($model->parent_id){
            return $this->redirect(['normativedocument/normative-document-section/view', 'id' => $model->parent_id]);
        }
        return $this->redirect(['normativedocument/normative-document/view', 'id' => $model->normative_document_id]);
    }

    /**
     * Updates an existing NormativeDocumentSection model.
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
     * Deletes an existing NormativeDocumentSection model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        return $this->redirect(['normativedocument/normative-document/view', 'id' => $model->normative_document_id]);
    }

    /**
     * Finds the NormativeDocumentSection model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return NormativeDocumentSection the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NormativeDocumentSection::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
