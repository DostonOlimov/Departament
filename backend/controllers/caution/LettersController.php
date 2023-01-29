<?php

namespace backend\controllers\caution;

use common\models\caution\CautionLetters;
use common\models\caution\CautionLettersSearch;
use yii\web\Controller;
use common\models\control\Company;
use common\models\User;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * LettersController implements the CRUD actions for CautionLetters model.
 */
class LettersController extends Controller
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
     * Lists all CautionLetters models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CautionLettersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CautionLetters model.
     * @param int $id №
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
     * Creates a new CautionLetters model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */

    /**
     * Updates an existing CautionLetters model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id №
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
    public function actionUploads($id){
        $model = $this->findModel($id);
            
            if ($this->request->isPost) {
                if ($model->load($this->request->post()) ) {
                 if(!empty($_FILES['CautionLetters']['name']['file'])){
                     $file = UploadedFile::getInstance($model,'file');
                     $berkas = md5($model->company->name).md5('-letters').'.'.$file->getExtension();
                     $model->file = $berkas;
                     $path= Yii::getAlias('@frontend').'/web/uploads/caution_letter/';
                     if(!file_exists($path)){
                         FileHelper::createDirectory($path);
                     }
                   
                   $file->saveAs($path.$berkas);
                 }                 
               if($model->save()){
                    \Yii::$app->session->setFlash('success','Bazaga yuklandi');
                   }                     
                 return $this->redirect(['view', 'id' => $model->id]);
                 
                  
                }
            }
                return $this->render('uploads', [
            'model' => $model,
                ]);
       
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Deletes an existing CautionLetters model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id №
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
   

    /**
     * Finds the CautionLetters model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id №
     * @return CautionLetters the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CautionLetters::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
