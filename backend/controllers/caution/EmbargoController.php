<?php

namespace backend\controllers\caution;

use common\models\embargo\Embargo;
use common\models\embargo\EmbargoSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use common\models\User;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use Yii;

/**
 * EmbargoController implements the CRUD actions for Embargo model.
 */
class EmbargoController extends Controller
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
     * Lists all Embargo models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EmbargoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Embargo model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

   
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if($model->status == 0){
            if($model->status = 1){
                $num = Embargo::find()->sum('status');
                $nums = Embargo::find()->where(['status'=>2])->all();
                $sum = count($nums);
                $model->message_number = ($num + 1) - $sum *2;
                $model->message_date = $model->updated_at;
            }
                elseif($model->status = 2){
                    $model->message->number = 0;
                }
        

            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $this->findModel($id)]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    public function actionUploads($id){
        $model = $this->findModel($id);
        if($model->status == 1){
            if(empty($model->file)){
            if ($this->request->isPost) {
                if ($model->load($this->request->post()) ) {
                 if(!empty($_FILES['Embargo']['name']['file'])){
                     $file = UploadedFile::getInstance($model,'file');
                     $berkas = md5($model->instruction->command_number).md5('-embargo').'.'.$file->getExtension();
                     $model->file = $berkas;
                     $path = '@frontend/web/uploads/caution_embargo/';
                    //  if(!file_exists($path)){
                    //      FileHelper::createDirectory($path);
                    //  }
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
            } else {
                $model->loadDefaultValues();
            }

        return $this->render('uploads', [
            'model' => $model,
        ]);
    }
    protected function findModel($id)
    {
        if (($model = Embargo::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
