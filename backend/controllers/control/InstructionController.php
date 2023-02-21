<?php

namespace backend\controllers\control;

use common\models\control\Caution;
use common\models\control\Company;
use common\models\control\Defect;
use common\models\control\Identification;
use common\models\control\Instruction;
use common\models\control\InstructionSearch;
use common\models\control\InstructionUser;
use common\models\control\Laboratory;
use common\models\control\Measure;
use common\models\control\PrimaryData;
use common\models\control\PrimaryOv;
use common\models\control\PrimaryProduct;
use common\models\control\PrimaryProductNd;
use common\models\control\ControlProductCertification;
use common\models\control\ControlProductLabaratoryChecking;
use common\models\control\ControlProductMeasures;
use common\models\control\ControlPrimaryOvNd;
use common\models\measure\Executions;
use common\models\caution\CautionLetters;
use common\models\prevention\Prevention;
use common\models\embargo\Embargo;
use common\models\control\InstructionFile;
use common\models\measure\Economics;
use common\models\control\InstructionType;
use Exception;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InstructionController implements the CRUD actions for Instruction model.
 */
class InstructionController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['update', 'delete'],
                        'roles' => ['admin','supervisor'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load($this->request->post()) ) {
            $model->checkup_finish_date = '';
            $model->real_checkup_date = '';
            $model->employers =1;
            $typeRes = '';
            $subject = $model->checkup_subject;
            foreach ( $subject as $key => $type) {
                $typeRes .= $type.'.';
            }
            $model->checkup_subject = $typeRes;
            if($model->validate() && $model->save()) {
                return $this->redirect(['/control/control/view', 'id' => $model->id]);
            }
        }
        

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $company = Company::findOne(['control_instruction_id' => $id]);

        if ($company) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $primaryData = PrimaryData::findOne(['control_company_id' => $company->id]);
                if ($primaryData) {
                    if ($products = PrimaryProduct::findAll(['control_primary_data_id' => $primaryData->id])) {
			//\yii\helpers\VarDumper::dump($nd,12,true);die;
			//\yii\helpers\VarDumper::dump(PrimaryProductNd::deleteAll(['control_primary_product_id' => $nd->id]),12,true);
                 foreach($products as  $nd){
                    PrimaryProductNd::deleteAll(['control_primary_product_id' => $nd->id]);
                    ControlProductCertification::deleteAll((['product_id' => $nd->id]));
                    ControlProductLabaratoryChecking::deleteAll((['product_id' => $nd->id]));
                    ControlProductMeasures::deleteAll((['product_id' => $nd->id]));
                     }
                }
                if ($ovs = PrimaryOv::findAll(['control_primary_data_id' => $primaryData->id])) {
                         foreach($ovs as  $ov){
                            ControlPrimaryOvNd::deleteAll(['ov_id' => $ov->id]);
                             }
                        }
		            PrimaryProduct::deleteAll(['control_primary_data_id' => $primaryData->id]);    
                    PrimaryOv::deleteAll(['control_primary_data_id' => $primaryData->id]);
                    PrimaryData::deleteAll(['control_company_id' => $company->id]);
                }
                Identification::deleteAll(['control_company_id' => $company->id]);
                Laboratory::deleteAll(['control_company_id' => $company->id]);
                Defect::deleteAll(['control_company_id' => $company->id]);
                Caution::deleteAll(['control_company_id' => $company->id]);
		        Measure::deleteAll(['control_company_id' => $company->id]);
                $company->delete();
                InstructionType::deleteAll(['instruction_id' => $id]);
                InstructionUser::deleteAll(['instruction_id' => $id]);
                Executions::deleteAll(['control_instruction_id' => $id]);
                Economics::deleteAll(['control_instruction_id' => $id]);
                InstructionFile::deleteAll(['instructions_id' => $id]);
                Prevention::deleteAll(['instructions_id' => $id]);
                CautionLetters::deleteAll(['instructions_id' => $id]);
                Embargo::deleteAll(['instructions_id' => $id]);
                $this->findModel($id)->delete();
                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
        } else {
            InstructionUser::deleteAll(['instruction_id' => $id]);
            $this->findModel($id)->delete();
        }

        return $this->redirect(['/control/control/index']);
    }

    protected function findModel($id)
    {
        if (($model = Instruction::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
