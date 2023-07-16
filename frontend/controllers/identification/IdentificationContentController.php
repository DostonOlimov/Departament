<?php

namespace frontend\controllers\identification;

use common\models\identification\Identification;
use common\models\identification\IdentificationContent;
use common\models\identification\IdentificationContentSearch;
use common\models\Model;
use common\models\normativedocument\NormativeDocumentContent;
use common\models\normativedocument\NormativeDocumentSection;
use common\models\normativedocument\SelectedNormativeDocument;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IdentificationContentController implements the CRUD actions for IdentificationContent model.
 */
class IdentificationContentController extends Controller
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
     * Lists all IdentificationContent models.
     *
     * @return string
     */
    public function actionIndex($id = null)
    {
        $searchModel = new IdentificationContentSearch();
        if($id){
            $searchModel->selected_normative_document_id = $id;
        }
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single IdentificationContent model.
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
     * Creates a new IdentificationContent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id)
    {   $selected_nd = SelectedNormativeDocument::findOne($id);
        // debug($selected_nd);
        // debug($id, false);
        $criteria = NormativeDocumentContent::find()
        ->where(['normative_document_section.normative_document_id' => $selected_nd->normative_document_id])
        // ->asArray()
        ->orderBy([
            'position' => SORT_ASC,
            'content' => SORT_ASC,
            ])
        ->joinWith('documentSection')
        // ->select(['content', 'position'])
        ->all()
        ;
        // debug($criteria);

        foreach ($criteria as $key => $value)
            {
                $model[$key] = new IdentificationContent();
                $model[$key]['selected_normative_document_id'] = $id;
                $model[$key]['normative_document_content_id'] = $value->id;
                $model[$key]['name'] = $value->content;
                // debug($model[$key]);
                // debug($value);

                // $model[$key]['criteria_id'] = $value->id;
            }
        if ($this->request->isPost) {

            $model = Model::createMultiple(IdentificationContent::class);
            Model::loadMultiple($model, $this->request->post());

            $valid = Model::validateMultiple($model);
            
            if ($valid) {
                foreach ($model as $key => $value) 
                    {
                        // debug($value);
                        if($value->status == 1){
                            $identification = new IdentificationContent();
                            // $identification->id = $value->id;
                            $identification->selected_normative_document_id = $value->selected_normative_document_id;
                            $identification->normative_document_content_id = $value->normative_document_content_id;
                            $identification->comment = $value->comment;
                            $identification->conformity = $value->conformity;
                            // debug($identification);
                            
                            $identification->save();
                        }
                    }
                return $this->redirect(['index']);
            }
        } 

        return $this->render('create', [
            'model' => $model,
            'criteria' => $criteria
        ]);
    }

    /**
     * Updates an existing IdentificationContent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing IdentificationContent model.
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
     * Finds the IdentificationContent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return IdentificationContent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = IdentificationContent::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
