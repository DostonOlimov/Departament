<?php

namespace frontend\controllers;

use common\models\control\Caution;
use common\models\control\Company;
use common\models\control\Defect;
use common\models\control\Identification;
use common\models\control\Instruction;
use common\models\control\InstructionSearch;
use common\models\control\InstructionUser;
use common\models\control\Measure;
use common\models\control\PrimaryData;
use common\models\control\ProductType;
use common\models\control\PrimaryOv;
use common\models\control\PrimaryOvSearch;
use common\models\control\PrimaryProduct;
use common\models\control\Laboratory;
use common\models\control\PrimaryProductSearch;
use common\models\control\PrimaryProductNd;
use common\models\types\ProductGroup;
use common\models\types\ProductPosition;
use common\models\types\ProductSubposition;
use common\models\types\ProductClass;
use common\models\Model;
use Exception;
use Yii;
use yii\helpers\Json;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

/**
 * Site controller
 */
class ControlController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'except' => ['login'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ]
        ];
    }

    public function actionIndex()
    {

        $searchModel = new InstructionSearch(Yii::$app->user->id);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionInstruction()
    {
        $model = new Instruction();
        if ($model->load($this->request->post()) && $model->validate()) {

            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->save(false);
                if ($model->employers) {
                    foreach ($model->employers as $employer) {
                        $insUser = new InstructionUser();
                        $insUser->instruction_id = $model->id;
                        $insUser->user_id = $employer;
                        $insUser->save(false);
                    }
                }
                $transaction->commit();
                return $this->redirect(['company', 'instruction_id' => $model->id]);
            } catch (Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
        } else{

        }

        return $this->render('instruction', [
            'model' => $model,
        ]);
    }

    public function actionInstructionView($id)
    {
        return $this->render('instruction-view', [
            'model' => $this->getModel(Instruction::className(), $id)
        ]);
    }

    public function actionCompany($instruction_id)
    {
        $model = new Company();
        $model->control_instruction_id = $instruction_id;

        if ($model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['primary-data', 'company_id' => $model->id]);
        }

        return $this->render('company', [
            'model' => $model,
        ]);
    }

    public function actionCompanyView($id)
    {
        return $this->render('company-view', [
            'model' => $this->getModel(Company::className(), $id)
        ]);
    }

    public function actionPrimaryData($company_id)
    {

        $model = new PrimaryData();

        $model->control_company_id = $company_id;
        $products = [new PrimaryProduct];
        $ovs = [new PrimaryOv];


          $pro_primary[0] = [new PrimaryProductNd];
          $pro_primary[1] = [new PrimaryProductNd];

        $post = $this->request->post();
        if ($model->load($post)) {
         //   VarDumper::dump($model,12,true);die;

           unset($products[1]);
           unset($pro_primary[1]);


            $products = Model::createMultiple(PrimaryProduct::classname());
            Model::loadMultiple($products, $this->request->post());
            $ovs = Model::createMultiple(PrimaryOv::classname());
            Model::loadMultiple($ovs, Yii::$app->request->post());

            $valid = $model->validate() && Model::validateMultiple($products) && Model::validateMultiple($ovs);
if(Model::validateMultiple($products)){
    echo 'something';
}
            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $model->save(false);

                    foreach ($ovs as $key => $ov) {

                            $ov1 = new PrimaryOv();
                            $ov1->control_primary_data_id = $model->id;
                            $ov1->type = $ov->type;
                            $ov1->measurement = $ov->measurement;
                            $ov1->compared = $ov->compared;
                            $ov1->invalid = $ov->invalid;
                            $ov1->save(false);
                        }
                foreach ($products as $key => $product)
                {

                                $prod = new PrimaryProduct();
                                $prod->control_primary_data_id = $model->id;
                                $prod->product_type_id = $product->subposition;
                                $prod->product_name = $product->product_name;
                               // $prod->nd = $product->nd ? implode(',', $product->nd) : null;
                                $prod->residue_quantity = $product->residue_quantity;
                                $prod->residue_amount = $product->residue_amount;
                                $prod->year_quantity = $product->year_quantity;
                                $prod->year_amount = $product->year_amount;
                                $prod->potency = $product->potency;
                                $prod->made_country = $product->made_country;
                                $prod->product_measure = $product->product_measure;
                                $prod->number_reestr = $product->number_reestr;
                                $prod->number_blank = $product->number_reestr;
                                $prod->date_from = $product->date_from;
                                $prod->date_to = $product->date_to;
                                $prod->select_of_exsamle_purpose = $product->select_of_exsamle_purpose;

                                $prod->save(false);
                                foreach ($post['PrimaryProductNd'][$key] as $proData) {
                                    $pro = new PrimaryProductNd();
                                    $pro->control_primary_product_id = $prod->id;
                                    $pro->name = $proData['name'];
                                    $pro->type_id = $proData['type_id'];

                                   $pro->save(false);
                                }
                            }
            $transaction->commit();
                    return $this->redirect(['identification', 'company_id' => $company_id]);
                } catch (Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }
            }
        }

        return $this->render('primary-data', [
            'model' => $model,
           'pro_primary' => $pro_primary,
            'product' => $products,
            'ov' =>$ovs,


        ]);
    }

    public function actionGroup():array {
        $out = [];
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $post = $this->request->post();
        if ($parents = ArrayHelper::getValue($post, 'depdrop_parents', false)) {
            $cat_id = $parents[0];
            $out = ProductGroup::find()
                ->where(['sector_id' => $cat_id])
                ->select(['kode as id','name'])
                ->orderBy('name', 'ASC')
                ->asArray()
                ->all();
            return ['output'=>$out, 'selected'=>''];
        }
        return  ['output'=>'', 'selected'=>''];
    }


    public function actionClass():array {
        $out = [];
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $post = $this->request->post();
        if ($parents = ArrayHelper::getValue($post, 'depdrop_parents', false)) {
                $cat_id = $parents[0].'%';
                $out = ProductClass::find()
                    ->where(['like', 'kode', $cat_id, false])
                    ->select(['kode as id','name'])
                    ->orderBy('name', 'ASC')
                    ->asArray()
                    ->all();
                return ['output'=>$out, 'selected'=>''];
        }
       return  ['output'=>'', 'selected'=>''];
    }


    public function actionPosition() :array {
        $out = [];
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $post = $this->request->post();
        if ($parents = ArrayHelper::getValue($post, 'depdrop_parents', false)) {
            $cat_id = $parents[0].'%';
            $out = ProductPosition::find()
                ->where(['like', 'kode', $cat_id, false])
                ->select(['kode as id','name'])
                ->orderBy('name', 'ASC')
                ->asArray()
                ->all();
            return ['output'=>$out, 'selected'=>''];
        }
        return  ['output'=>'', 'selected'=>''];
    }

    public function actionSubposition():array {
        $out = [];
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $post = $this->request->post();
        if ($parents = ArrayHelper::getValue($post, 'depdrop_parents', false)) {
            $cat_id = $parents[0].'%';
            $out = ProductSubposition::find()
                ->where(['like', 'kode', $cat_id, false])
                ->select(['kode as id','name'])
                ->orderBy('name', 'ASC')
                ->asArray()
                ->all();
            return ['output'=>$out, 'selected'=>''];
        }
        return  ['output'=>'', 'selected'=>''];
    }



    public function actionPrimaryDataView($id)
    {
        $searchOv = new PrimaryOvSearch($id);
        $dataOv = $searchOv->search($this->request->queryParams);

        $searchProduct = new PrimaryProductSearch($id);
        $dataProduct = $searchProduct->search($this->request->queryParams);

        return $this->render('primary-data-view', [
            'model' => $this->getModel(PrimaryData::className(), $id),
            'searchOv' => $searchOv,
            'dataOv' => $dataOv,
            'searchProduct' => $searchProduct,
            'dataProduct' => $dataProduct,
        ]);
    }

    public function actionIdentification($company_id)
    {
        $model = [new Identification];

        if (Yii::$app->request->post()) {

            $model = Model::createMultiple(Identification::classname(), $model);
            Model::loadMultiple($model, $this->request->post());

            foreach ($model as $index => $modelOptionValue) {
                $modelOptionValue->img = \yii\web\UploadedFile::getInstance($modelOptionValue, "[{$index}]file");
                if ($modelOptionValue->img) {
                    $modelOptionValue->file = $modelOptionValue->img->name;
                }
            }

            if (Model::validateMultiple($model)) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    foreach ($model as $key => $product) {

//                        if ($product->file) {
                        $product->control_company_id = $company_id;
                        $product->save(false);
//                        }
                    }
                    $transaction->commit();
                    return $this->redirect(['laboratory', 'company_id' => $company_id]);
                } catch (Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }
            }
        }

        return $this->render('identification', [
            'model' => $model,
            'company_id' => $company_id,
        ]);
    }

    public function actionIdentificationView($id)
    {
        return $this->render('identification-view', [
            'model' => Identification::find()->where(['control_company_id' => $id])->all(),
            'id' => $id
        ]);
    }

    public function actionLaboratory($company_id)
    {
        $model = new Laboratory();
        $model->control_company_id = $company_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['defect', 'company_id' => $company_id]);
        }

        return $this->render('laboratory', [
            'model' => $model,
        ]);
    }

    public function actionUpdateLab($id, $attribute)
    {
        $model = Laboratory::findOne($id);
        $model->$attribute = $_FILES[$attribute]['name'];
        $model->validate();
        $model->save();
        return $this->redirect(['laboratory-view', 'id' => $id]);

    }

    public function actionLaboratoryView($id)
    {
        return $this->render('laboratory-view', [
            'model' => $this->getModel(Laboratory::className(), $id)
        ]);
    }

    public function actionDefect($company_id)
    {
        $model = new Defect();
        $model->control_company_id = $company_id;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $typeRes = '';
            foreach ($model->type as $type) {
                $typeRes .= '.' . $type;
            }
            $model->type = $typeRes;
            if ($model->type == '.4') {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $model->save(false);
                    $ins = Instruction::findOne($model->controlCompany->control_instruction_id);
                    $ins->checkup_finish_date = Yii::$app->formatter->asDate(time(), 'M/dd/yyyy');
                    $ins->general_status = Instruction::GENERAL_STATUS_SEND;
                    $ins->save(false);
                    $transaction->commit();
                    return $this->redirect(['defect-view', 'id' => $model->id]);
                } catch (Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }
            }
            if ($model->save()) {
                return $this->redirect(['caution', 'company_id' => $company_id]);
            }
        }
        return $this->render('defect', [
            'model' => $model,
        ]);
    }

    public function actionDefectView($id)
    {
        return $this->render('defect-view', [
            'model' => $this->getModel(Defect::className(), $id)
        ]);
    }

    public function actionCaution($company_id)
    {
        $model = [new Caution];

        if (Yii::$app->request->post()) {

            $model = Model::createMultiple(Caution::classname(), $model);
            Model::loadMultiple($model, $this->request->post());

            foreach ($model as $index => $modelOptionValue) {
                $modelOptionValue->s_file = \yii\web\UploadedFile::getInstance($modelOptionValue, "[{$index}]file");
                if ($modelOptionValue->s_file) {
                    $modelOptionValue->file = $modelOptionValue->s_file->name;
                }
            }

            if (Model::validateMultiple($model)) {
//                VarDumper::dump($model,12,true);die;
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    foreach ($model as $key => $product) {
                        $product->control_company_id = $company_id;
                        $product->save(false);
                    }
                    $transaction->commit();
                    return $this->redirect(['measure', 'company_id' => $company_id]);
                } catch (Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }
            }
        }

        return $this->render('caution', [
            'model' => $model,
            'company_id' => $company_id
        ]);
    }

    public function actionCautionView($id)
    {
        return $this->render('caution-view', [
            'model' => Caution::find()->where(['control_company_id' => $id])->all(),
            'id' => $id,
        ]);
    }

    public function actionMeasure($company_id)
    {
        $model = new Measure();
        $model->control_company_id = $company_id;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->type) {
                $model->type = implode(",", $model->type);
            }
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->save(false);
                $ins = Instruction::findOne($model->controlCompany->control_instruction_id);
                $ins->checkup_finish_date = Yii::$app->formatter->asDate(time(), 'M/dd/yyyy');
                $ins->general_status = Instruction::GENERAL_STATUS_SEND;
                $ins->save(false);
                $transaction->commit();
                return $this->redirect(['/control/measure-view', 'id' => $model->id]);
            } catch (Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
        }
        return $this->render('measure', [
            'model' => $model,
        ]);
    }

    public function actionMeasureView($id)
    {
        return $this->render('measure-view', [
            'model' => $this->getModel(Measure::className(), $id)
        ]);
    }

    private function getModel($className, $id, $attribute = 'id')
    {
        if (!$model = $className::findOne([$attribute => $id])) {
            throw new \yii\db\Exception('Ma`lumot topilmadi');
        }
        return $model;
    }
}
