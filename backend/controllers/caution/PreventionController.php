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
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
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
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionUploads($id){
        $model = $this->findModel($id);
            if(empty($model->file)){
            if ($this->request->isPost) {
                if ($model->load($this->request->post()) ) {
                 if(!empty($_FILES['Prevention']['name']['file'])){
                     $file = UploadedFile::getInstance($model,'file');
                     $berkas = $model->instruction->command_number.'-prevention'.'.'.$file->getExtension();
                     $model->file = $berkas;
                     $path = 'uploads/caution_prevention/';
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
            }else{
                return '';
            }
            

        return $this->render('uploads', [
            'model' => $model,
        ]);
       
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Prevention::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
