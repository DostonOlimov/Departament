<?php

namespace frontend\controllers;

use common\models\caution\Execution;
use common\models\User;
use common\models\control\Company;
use common\models\measure\Executions;
use common\models\control\InstructionSearch;
use common\models\measure\Economics;
use common\models\measure\ExecutionsSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Model;
use Yii;
use Exception;
use yii\helpers\VarDumper;

/**
 * cautions controller
 */
class MeasureController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ],
            ]
        ];
    }
    public function actionOvIndex()
    {
        $searchModel = new InstructionSearch(\Yii::$app->user->id);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('ov-index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionOv()
    {
        $searchModel = new InstructionSearch(\Yii::$app->user->id);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionOvView()
    {
        $searchModel = new InstructionSearch(\Yii::$app->user->id);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionRealizationIndex()
    {
        $searchModel = new InstructionSearch(\Yii::$app->user->id);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('realization-index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionRealization()
    {
        $searchModel = new InstructionSearch(\Yii::$app->user->id);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionRealizationView()
    {
        $searchModel = new InstructionSearch(\Yii::$app->user->id);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionEconomicIndex()
    {
        $searchModel = new InstructionSearch(\Yii::$app->user->id);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('economic-index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionEconomic($id)
    {
        $model = new Economics();
        $model->control_instruction_id = $id;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                try {
                    if ($model->save()) 
                    {
                        return $this->redirect(['economic-view', 'id' => $id]);
                    }
                } catch (Exception $e) {
                    throw $e;
                }
        }
        return $this->render('economic', [
            'model' => $model,
            'id' => $id,
        ]);
    }
    public function actionEconomicView($id)
    {
        return $this->render('economic-view', [
            'model' => Economics::find()->where(['control_instruction_id' => $id])->one(),
            'id' => $id,
        ]);
    }
    public function actionExecutionIndex()
    {
        $searchModel = new InstructionSearch(\Yii::$app->user->id);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('execution-index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionExecution($id)
    {
        $model = [new Executions];

        if (Yii::$app->request->post()) {

            $model = Model::createMultiple(Executions::classname(), $model);
            Model::loadMultiple($model, $this->request->post());

            foreach ($model as $index => $modelOptionValue) {
                $modelOptionValue->s_claim = \yii\web\UploadedFile::getInstance($modelOptionValue, "[{$index}]claim");
                $modelOptionValue->s_explanation_letter = \yii\web\UploadedFile::getInstance($modelOptionValue, "[{$index}]explanation_letter");
                $modelOptionValue->s_court_letter = \yii\web\UploadedFile::getInstance($modelOptionValue, "[{$index}]court_letter");
                if ($modelOptionValue->s_explanation_letter) {
                    $modelOptionValue->explanation_letter = $modelOptionValue->s_explanation_letter->name;
                }
                if($modelOptionValue->s_claim)  {
                    $modelOptionValue->claim = $modelOptionValue->s_claim->name;
                }   
                if($modelOptionValue->s_court_letter){    
                    $modelOptionValue->court_letter = $modelOptionValue->s_court_letter->name;
                
                }
            }
            if (Model::validateMultiple($model)) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    foreach ($model as $key => $product) {
                        $product->band_mjtk = ','.$product->m212.','.$product->m213.','.$product->m214;
                        $product->control_instruction_id = $id;
                        $product->save(false);
                    }
                    $transaction->commit();
                    return $this->redirect(['execution-view','id'=> $id]);
                } catch (Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }
            }
        }

        return $this->render('execution', [
            'model' => $model,
        ]);
    }
    public function actionExecutionView($id)
    { 
        return $this->render('execution-view', [
            'model' => Executions::find()->where(['control_instruction_id' => $id])->all(),
            'id' => $id,
        ]);
    }


}
