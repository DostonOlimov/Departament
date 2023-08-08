<?php

namespace frontend\controllers\identification;

use common\models\actselection\SelectedProduct;
use common\models\identification\Identification;
use common\models\identification\IdentificationContent;
use common\models\identification\IdentificationContentSearch;
use common\models\Model;
use common\models\normativedocument\NormativeDocument;
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
    public $model_key;
    

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
    {   $this->model_key;
        // $this->model_key = 0;
        // debug($id);
        $selected_nd = SelectedNormativeDocument::findOne($id);
        // debug($selected_nd);
        $nd = NormativeDocument::findOne($selected_nd->normative_document_id);
        // debug($nd);
        $identification = Identification::findOne($selected_nd->identification_id); 
        // debug($identification);
        $selected_product = SelectedProduct::findOne($identification->selected_product_id);
        // debug($selected_product);

        // $criteria = NormativeDocumentContent::find()
        // ->where(['normative_document_section.normative_document_id' => $selected_nd->normative_document_id])
        // ->orderBy(['position' => SORT_ASC, 'content' => SORT_ASC,])
        // ->joinWith('documentSection')
        // ->all();
        $criteria = NormativeDocumentSection::find()
        ->joinWith('normativeDocumentContents')
        // ->orderBy([
            
        //     // 'content' => SORT_ASC,
        //     ])
            ->orderBy([
                // 'normative_document_content.position' => SORT_DESC, 
                'position' => SORT_ASC, ])
        // ->select('section_number')
        // ->select('normativeDocumentContents')
        ->where(['normative_document_id' => $selected_nd->normative_document_id])
        // ->where(['id' => 1])
        ->all()
        ;
        // debug($criteria[1]);
        foreach ($criteria as $criterion)
            {

                // $criterion_contents = $criteria[1]->normativeDocumentContents;
                $criterion_contents = $criterion->normativeDocumentContents;
                // debug($criterion_contents);
                // debug($criterion->section_name);
                foreach ($criterion_contents as $criterion_content)
                {
                    // debug($criterion_content);
                    // debug($this->model_key);
                    // debug($criterion->section_name);
                    $model[$this->model_key] = new IdentificationContent();
                    $model[$this->model_key]['section_name'] = $criterion->section_number.' '.$criterion->section_name;
                    $model[$this->model_key]['selected_normative_document_id'] = $id;
                    $model[$this->model_key]['normative_document_content_id'] = $criterion_content->id;
                    $model[$this->model_key]['name'] = $criterion_content->content;
                    $this->model_key ++;
                }

            }
            // debug($model);
        if ($this->request->isPost) {

            $model = Model::createMultiple(IdentificationContent::class);
            Model::loadMultiple($model, $this->request->post());

            $valid = Model::validateMultiple($model);
            
            if ($valid) {
                foreach ($model as $value) 
                    {
                        if($value->status == 1){
                            $identification = new IdentificationContent();
                            $identification->selected_normative_document_id = $value->selected_normative_document_id;
                            $identification->normative_document_content_id = $value->normative_document_content_id;
                            $identification->comment = $value->comment;
                            $identification->conformity = $value->conformity;
                            
                            $identification->save();
                        }
                    }
                return $this->redirect(['index', 'id' => $selected_nd->id]);
            }
        } 

        return $this->render('create',compact('model', 'criteria','nd', 'selected_product'));
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
        // debug($model);
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['govcontrol/gov-control/identification-view', 'id' => $model->selected_normative_document_id]);
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
