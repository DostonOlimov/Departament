<?php

namespace frontend\controllers\identification;

use common\models\actselection\SelectedProduct;
use common\models\identification\Identification;
use common\models\identification\IdentificationContent;
use common\models\identification\IdentificationContentSearch;
use common\models\LocalActiveRecord;
use common\models\Model;
use common\models\normativedocument\NormativeDocument;
use common\models\normativedocument\NormativeDocumentContent;
use common\models\normativedocument\NormativeDocumentContentSearch;
use common\models\normativedocument\NormativeDocumentSection;
use common\models\normativedocument\NormativeDocumentSectionSearch;
use common\models\normativedocument\SelectedNormativeDocument;
use common\models\normativedocument\SelectedNormativeDocumentSearch;
use common\models\User;
use kartik\grid\EditableColumn;
use Yii;
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
    public function actionIndex($id = null, $identification_id = null)
    {
        // debug($identification_id);
        $selected_nd = SelectedNormativeDocument::findOne($id);
        if($identification_id){
            $identification = Identification::findOne($identification_id);
        }
        else{
            $identification = Identification::findOne($selected_nd->identification_id);
        }

        $searchModel = new IdentificationContentSearch();
        if($id){
            $searchModel->selected_normative_document_id = $id;
        }
        if($identification_id){
            $searchModel->identification_id = $identification_id;
        }
        $dataProvider = $searchModel->search($this->request->queryParams);
        // debug($dataProvider->getModels()[0]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'identification' => $identification,
        ]);
    }
    public function actionDocument($id)
    {   
        $user = User::findOne(Yii::$app->user->id);

        $searchModel = new IdentificationContentSearch();
        $searchModel->identification_id = $id;
        
        $dataProvider = $searchModel->search($this->request->queryParams);

        // debug($dataProvider->getModels());
        return $this->render('document', compact(
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
    {   
        $searchModel = new SelectedNormativeDocumentSearch();
        $searchModel->id = $id;
        $dataProvider = $searchModel->search($this->request->queryParams);

        $identification = Identification::findOne($dataProvider->getModels()[0]->identification->id);
        $identification->status = LocalActiveRecord::DOCUMENT_STATUS_INPROGRESS;

        $selected_nd = SelectedNormativeDocument::findOne($dataProvider->getModels()[0]->id);
        $selected_nd->status = LocalActiveRecord::DOCUMENT_STATUS_INPROGRESS;

        foreach ($dataProvider->models[0]->normativeDocumentContents as $key => $criterion)
            {
                $ndSection = NormativeDocumentSection::findOne(['id' => $criterion->document_section_id]);
                    $model[$key] = new IdentificationContent();
                    $model[$key]['section_name'] = $ndSection->section_number.' '.$ndSection->section_name;
                    $model[$key]['selected_normative_document_id'] = $dataProvider->models[0]->id;
                    $model[$key]['normative_document_content_id'] = $criterion->id;
                    $model[$key]['name'] = $criterion->content;
            }

        if ($this->request->isPost) {

            $model = Model::createMultiple(IdentificationContent::class);
            Model::loadMultiple($model, $this->request->post());
            $valid = Model::validateMultiple($model);
            if ($valid) {
                $identification->save(false);
                $selected_nd->save(false);
                foreach ($model as $value)
                    {
                        if($value->status == 1){
                            $identification_content = new IdentificationContent();
                            $identification_content->selected_normative_document_id = $value->selected_normative_document_id;
                            $identification_content->normative_document_content_id = $value->normative_document_content_id;
                            $identification_content->comment = $value->comment;
                            $identification_content->conformity = $value->conformity;
                            $identification_content->save();
                        }
                    }
                return $this->redirect(['index', 'identification_id' => $identification->id]);
            }
        } 
        return $this->render('create',compact('model', 'dataProvider'));
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
            return $this->redirect(['identification/identification-content/index', 'id' => $model->selected_normative_document_id]);
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
