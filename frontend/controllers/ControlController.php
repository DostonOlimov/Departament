<?php

namespace frontend\controllers;

use common\models\control\Caution;
use common\models\control\Company;
use common\models\control\Defect;
use common\models\control\ControlProductCertification;
use common\models\control\ControlProductLabaratoryChecking;
use common\models\control\Instruction;
use common\models\control\InstructionSearch;
use common\models\control\InstructionUser;
use common\models\control\Measure;
use common\models\control\PrimaryData;
use common\models\control\PrimaryOv;
use common\models\control\PrimaryOvSearch;
use common\models\control\PrimaryProduct;
use common\models\control\Laboratory;
use common\models\control\PrimaryProductSearch;
use common\models\control\DocumentAnalysisSearch;
use common\models\control\PrimaryProductNd;
use common\models\control\ControlPrimaryOvNd;
use common\models\types\ProductGroup;
use common\models\types\ProductPosition;
use common\models\types\ProductSubposition;
use common\models\types\ProductClass;
use common\models\Model;
use common\models\Codetnved;
use common\models\control\ControlProductMeasures;
use common\models\control\DocumentAnalysis;
use frontend\models\PrimaryIdentification;
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
        
        if ($model->load($this->request->post()) ) {
            
            if($model->validate())
            {
               
            $typeRes = '';
            $subject = $model->checkup_subject;
            foreach ( $subject as $key => $type) {
                $typeRes .= $type.'.';
            }
            $model->checkup_subject = $typeRes;
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->save(false);
                if ($model->employers) {
                    foreach ($model->employers as $employer) {
                        $insUser = new InstructionUser();
                        $insUser->instruction_id = $model->id;
                        $insUser->user_id = $employer;
                        $start_type = '';
                        $insUser->save(false);
                    }
                }
                $transaction->commit();
                return $this->redirect(['company', 'instruction_id' => $model->id]);
            } catch (Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
        } 
       
    }
        return $this->render('instruction', [
            'model' => $model,
        ]);
    }

    public function actionFirstStep($id)
    {
        $model = Instruction::findOne(['id' => $id]);
        
        if ($model->load($this->request->post()) ) {
            $model->real_checkup_date = $model->first_date;
            $model->checkup_finish_date = '';
            $model->employers = 1;
            if($model->validate() && $model->save(false))
            {
                
            $company = Company::findOne(['control_instruction_id' => $model->id]);
            return $this->redirect(['primary-data', 'company_id' => $company->id]);;
        } 
       
    }
        return $this->render('first-step', [
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

        $model = PrimaryData::findOne(['control_company_id' => $company_id]);
        $t = false;
        if(!$model){
            $model = new PrimaryData();
            $model->control_company_id = $company_id;
            $products = [new PrimaryProduct];
            $ovs = [new PrimaryOv];
            $documents = [new DocumentAnalysis];

          $pro_primary[0] = [new PrimaryProductNd];
          $pro_primary[1] = [new PrimaryProductNd];

          $pro_ovs[0] = [new ControlPrimaryOvNd];
          $pro_ovs[1] = [new ControlPrimaryOvNd];

          $pro_cer[0] = [new ControlProductCertification];
          $pro_cer[1] = [new ControlProductCertification];
        }
        else
        {
            $t = true;
            $model->control_company_id = $company_id;
            $products = [new PrimaryProduct];
            $ovs = [new PrimaryOv];
            $documents = [new DocumentAnalysis];

          $pro_primary[0] = [new PrimaryProductNd];
          $pro_primary[1] = [new PrimaryProductNd];

          $pro_ovs[0] = [new ControlPrimaryOvNd];
          $pro_ovs[1] = [new ControlPrimaryOvNd];

          $pro_cer[0] = [new ControlProductCertification];
          $pro_cer[1] = [new ControlProductCertification];
        }
        $post = $this->request->post();
        if ($model->load($post)) {
      //    VarDumper::dump($model,12,true);die;

           unset($products[1]);
           unset($pro_primary[1]);
           unset($pro_cer[1]);
           unset($pro_ovs[1]);

            $products = Model::createMultiple(PrimaryProduct::classname());
            Model::loadMultiple($products, $this->request->post());
            $ovs = Model::createMultiple(PrimaryOv::classname());
            Model::loadMultiple($ovs, Yii::$app->request->post());
            $documents = Model::createMultiple(DocumentAnalysis::classname());
            Model::loadMultiple($documents, Yii::$app->request->post());
            
            $valid = $model->validate() && Model::validateMultiple($ovs) && Model::validateMultiple($products) && Model::validateMultiple($documents);
           
            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
               $arrayImage = [];
                try {
                    $model->save(false);
                    if($ovs[0]->ov_type == 0)
                    {
                    foreach ($ovs as $key_ov1 => $ov) {
                            if($t)
                            {
                            PrimaryOv::deleteAll(['control_primary_data_id' => $model->id]);
                            ControlPrimaryOvNd::deleteAll(['ov_id' => $ov->id]);
                            }
                            $ov1 = new PrimaryOv();
                            $ov1->control_primary_data_id = $model->id;
                            $ov1->type = $ov->type;
                            $ov1->measurement = $ov->measurement;
                            $ov1->compared = $ov->compared;
                            $ov1->invalid = $ov->invalid;
                            $ov1->uncompared = $ov->uncompared;
                            $ov1->expired = $ov->expired;
                            $ov1->unworked = $ov->unworked;
                            $ov1->save(false);
                            foreach ($post['ControlPrimaryOvNd'] as $k2 => $proOv) 
                            {
                               foreach($proOv as $k3 => $v1)
                               {
                                
                                $ov_nd = new ControlPrimaryOvNd();
                                $ov_nd->ov_id = $ov1->id;
                                $ov_nd->name = $v1['name'];
                                $ov_nd->type_id = $v1['type_id'];
                                if($ov_nd->validate()){
                                    $ov_nd->save(false);
                                }
                               }
                            }
                        } 
                $id = [];
                }
            if($products[0]->product_type == 0)
                {
                foreach ($products as $key_p1 => $product)
                {
                  if($t)
                    { 
                        $old_pro = PrimaryProduct::findAll(['control_primary_data_id' => $model->id]);        
                        foreach ($old_pro as $key_p2 => $old)
                        {   
                            PrimaryProductNd::deleteAll(['control_primary_product_id' => $old->id]);
                            if(ControlProductCertification::findAll(['product_id' => $old->id]))
                            { 
                                ControlProductCertification::deleteAll(['product_id' => $old->id]);
                            }        
                            $old->delete();
                        }       
                    }
                                $prod = new PrimaryProduct();
                                $prod->control_primary_data_id = $model->id;
                                $prod->product_type_id = $product->subposition;
                                $prod->product_name = $product->product_name;
                                $prod->residue_quantity = $product->residue_quantity;
                                $prod->residue_amount = $product->residue_amount;
                                $prod->year_quantity = $product->year_quantity;
                                $prod->year_amount = $product->year_amount;
                                $prod->potency = $product->potency;
                                $prod->made_country = $product->made_country;
                                $prod->product_measure = $product->product_measure;
                                $prod->labaratory_checking = $product->labaratory_checking;
                                $prod->certification = $product->certification;
                                $prod->codetnved = $product->codetnved;
                                $prod->exsist_certificate = $product->exsist_certificate;
                                $prod->img = \yii\web\UploadedFile::getInstance($prod, "[{$key_p1}]photo");
                                if ($prod->img) {
                                    $prod->photo = $prod->img->name;
                                }
                                $prod->save(false);
                                $id[$key_p1] = $prod->id; 
                }      
               // VarDumper::dump($prod,12,true);;die();
                        foreach ($post['PrimaryProductNd'] as $k1 => $proData) 
                            {
                               foreach($proData as $k2 => $v)
                               {
                               
                              $pro = new PrimaryProductNd();
                                $pro->control_primary_product_id = $id[$k1];
                                $pro->name = $v['name'];
                                $pro->type_id = $v['type_id'];
                                if($pro->validate()){
                                    $pro->save(false);
                                }
                               }
                            }
                        if($post['ControlProductCertification'])
                            {
                            foreach ($post['ControlProductCertification'] as  $key_c1 => $proCer) 
                             {
                               foreach($proCer as $key_c2 => $v)
                               {
                                $pro1 = new ControlProductCertification();
                                $pro1->product_id = $id[$key_c1];
                                $pro1->number_reestr = $v['number_reestr'];
                                $pro1->date_to = $v['date_to'];
                                $pro1->date_from = $v['date_from'];
                                if($pro1->validate()){
                                $pro1->save(false);
                                }
                               }
                            }
                        }
                }
               
                if($documents[0]->document_type == 0)
                {
                foreach ($documents as $key_doc1 => $doc) {
                        
                        $doc1 = new DocumentAnalysis();
                        $doc1->primary_data_id = $model->id;
                        $doc1->reestr_number = $doc->reestr_number;
                        $doc1->defect = $doc->defect;
                        $doc1->given_date = $doc->given_date;
                       
                        $doc1->save(false);
                    }
                }
            $transaction->commit();
                    return $this->redirect(['identification','company_id' => $company_id]);
                } catch (Exception $e) 
                {
                    $transaction->rollBack();
                    throw $e;
                }
            }
        }

        return $this->render('primary-data', [
            'model' => $model,
            'pro_primary' => $pro_primary,
            'pro_cer' => $pro_cer,
            'product' => $products,
            'ov' =>$ovs,
            'document' => $documents,
            'company_id' => $company_id,
            'pro_ov' => $pro_ovs,
        ]);
    }
  
    public function actionCodeTnVed($term)
	{
    
		$kodtnved = Codetnved::find()->select(['kod as id', 'concat(kod, " - ", name) as text'])->where('kod like "%'.$term.'%" or name like "%'.$term.'%"')->asArray()->all();
		return json_encode($kodtnved);
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

        $searchDocument = new DocumentAnalysisSearch($id);
        $dataDoc = $searchDocument->search($this->request->queryParams);

        return $this->render('primary-data-view', [
            'model' => $this->getModel(PrimaryData::className(), $id),
            'searchOv' => $searchOv,
            'dataOv' => $dataOv,
            'dataDoc' => $dataDoc,
            'searchProduct' => $searchProduct,
            'dataProduct' => $dataProduct,
        ]);
    }

    public function actionIdentification($company_id)
    {
       $id = PrimaryData::find()
            ->where(['control_company_id' => $company_id])
            ->one();
        $products = PrimaryProduct::find()
            ->where(['control_primary_data_id' => $id->id])
            ->all();
        if($products)
        {
        foreach($products as $key => $value) 
            {   
                $model[$key] = new PrimaryIdentification();
                $model[$key]['product_id'] = $value['id'];
                $model[$key]['product_name'] = $value['product_name'];
                $model[$key]['certification'] = $value['certification'];
            }
            
        $labs = [];
        $products_lab = PrimaryProduct::find()
            ->where(['control_primary_data_id' => $id->id])
            ->andWhere(['labaratory_checking'=>1])
            ->all();
        foreach($products_lab as $key => $value) 
            {   
                $labs[$key] = new ControlProductLabaratoryChecking;
                $labs[$key]['product_id'] = $value['id'];
                $labs[$key]['product_name'] = $value['product_name'];
                        
            }

        $certificates = [];
        $products_certificate = PrimaryProduct::find()
            ->where(['control_primary_data_id' => $id->id])
            ->andWhere(['>=', 'certification', 1])
            ->all();
        foreach($products_certificate as $key => $value) 
        { 
            $certificates[$key]['product_id'] = $value['id'];
            $certificates[$key]['product_name'] = $value['product_name'];
            $certificates[$key]['certificate'] = $value['certification']; 
            for($i = 0; $i < $value['certification']; $i++)
            {
                $certificates[$key][$i] = new ControlProductCertification;
            }           
        }
        
        if (Yii::$app->request->post()) {
           
             $model = Model::createMultiple(PrimaryIdentification::classname());
             Model::loadMultiple($model, $this->request->post());

             $labs = Model::createMultiple(ControlProductLabaratoryChecking::classname());
             Model::loadMultiple($labs, $this->request->post());
             
            $valid = Model::validateMultiple($model) && Model::validateMultiple($labs);
            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    
                    foreach ($model as $key => $value) 
                    {
                      $pro_pr = PrimaryProduct::find()
                        ->where(['id' => $value->product_id])
                        ->one();
                     $typeRes = '0.';//if defect type not exist
                     if($value->defect_type)
                       {
                        $subject = $value->defect_type;
                        foreach ( $subject as $key => $type) {
                            $typeRes .= $type.'.';
                        }
                       }
                       $pro_pr->description = $value->description;
                       $pro_pr->quality = $value->quality;
                       $pro_pr->exsist_certificate = 1;
                       $pro_pr->defect_type = $typeRes;
                       if($value->quantity || $value->amount)
                       {
                        $pro_pr->cer_quantity = $value->quantity;
                        $pro_pr->cer_amount = $value->amount;
                       }
                       if($pro_pr->validate())
                       {
                        $pro_pr->save(false);
                       
                       }
                    }
                    foreach ($labs as $key => $value) 
                    {
                      $lab = new ControlProductLabaratoryChecking;
                      $lab->product_id = $value->product_id;
                      $lab->description = $value->description;
                      $lab->quality = $value->quality;
                      $lab->save();
                    }

                if(Yii::$app->request->post('ControlProductCertification'))
                   {
                   foreach (Yii::$app->request->post('ControlProductCertification') as $key => $value) 
                    {
                        
                      $productt = PrimaryProduct::find()
                         ->where(['id' => $value['product_id']])
                         ->one();
                    
                       $productt->cer_amount = $value['amount'];
                       $productt->cer_quantity = $value['quantity'];
                       $productt->save();
                       for($i=0 ; $i < $value['certificate']; $i++)
                       {
                        

                        $cer = new ControlProductCertification;
                        $cer->product_id  = $value[$i]['product_id'];
                        $cer->number_reestr = $value[$i]['number_reestr'];
                        $cer->date_to = $value[$i]['date_to'];
                        $cer->date_from = $value[$i]['date_from']; 
                        if($cer->validate()){
                         $cer->save();
                        }
                    }
                 }
                }
                
                    $transaction->commit();
                    return $this->redirect(['laboratory', 'company_id' => $company_id,]);
                } catch (Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }
            }
        }

        return $this->render('identification', [
            'model' => $model,
            'certificates' => $certificates,
            'labs' => $labs,
            'company_id' => $company_id,
         ]);
        }
        else{
            return $this->redirect(['laboratory', 'company_id' => $company_id,]);
        }
    }

    public function actionIdentificationView($id)
    {
        $primaryDataId = PrimaryData::findOne(['control_company_id' => $id])->id;
        $products = PrimaryProduct::find()->where(['control_primary_data_id' => $primaryDataId])->all();

        return $this->render('identification-view', [
            'products' => $products,
            'id' => $id
        ]);
    }

    public function actionUpdateIdentification($id, $attribute)
    {
        $model = ControlProductLabaratoryChecking::findOne($id);
        $data = PrimaryProduct::findOne($model->product_id);
        $company = PrimaryData::findOne($data->control_primary_data_id);
        $model->$attribute = $_POST['quality'];
        $model->validate();
        $model->save();
        return $this->redirect(['identification-view', 'id' => $company->control_company_id]);

    }

    public function actionLaboratory($company_id)
    {
        
        $model = new Laboratory();
        $model->control_company_id = $company_id;
        if ($model->load(Yii::$app->request->post()) &&  $model->save()) {
                return $this->render('laboratory-view', [
                    'model' => $model,
                    
                ]);
            
           
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
            
            $typeds = $model->type;
            foreach ( $typeds as $key => $type) {
                $typeRes .= '.' . $type;
            }
            $model->type = $typeRes;
        
            if ($model->type == '.4') 
            {
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
            if ($model->save()) 
            {
                return $this->redirect(['measure', 'company_id' => $company_id]);
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
        $id = PrimaryData::find()
            ->where(['control_company_id' => $company_id])
            ->one();
        $products = PrimaryProduct::find()
            ->where(['control_primary_data_id' => $id->id])
            ->all();
        foreach($products as $key => $value) 
            {   
                $re_product[$key] = new ControlProductMeasures();
                $re_product[$key]['product_id'] = $value['id'];
                $re_product[$key]['product_name'] = $value['product_name'];
            }
           
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            print_r( $model->type);
            die();
            if ($model->type) {
               
                $model->type = implode(",", $model->type);
            }
            $transaction = Yii::$app->db->beginTransaction();
            try {
              

                $model->band_mjtk = ','.$model->m212.','.$model->m213.','.$model->m214;
                $model->save(false);
                //VarDumper::dump($model,12,true);die;
                $ins = Instruction::findOne($model->controlCompany->control_instruction_id);
                $ins->checkup_finish_date = $model->finish_date;
                $ins->general_status = Instruction::GENERAL_STATUS_SEND;
                $ins->save(false);
                if(Yii::$app->request->post('ControlProductMeasures'))
                {
                    foreach(Yii::$app->request->post('ControlProductMeasures') as $key => $value)
                    {
                        $vv = new ControlProductMeasures();
                        $vv->product_id = $value['product_id'];
                        $vv->amount = $value['amount'];
                        $vv->quantity = $value['quantity'];
                        $vv->save();
                    }
                }
               // VarDumper::dump($vv,12,true);die;
                $transaction->commit();
                return $this->redirect(['/control/measure-view', 'id' => $model->id]);
            } catch (Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
        }
       
        return $this->render('measure', [
            'model' => $model,
            'products' => $re_product,
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

    public function actionLastStep($id)
    {
        $model = Instruction::findOne(['id' => $id]);
        $company_id = Company::findOne(['control_instruction_id'=>$id])->id;
        if ($model->load($this->request->post()) ) {
            $model->checkup_finish_date = $model->finish_date;
            $model->employers = 1;
            $model->start_type = 2;
            $model->general_status = Instruction::GENERAL_STATUS_SEND;
            if($model->validate() && $model->save(false))
            {
            return $this->redirect(['index',]);
        } 
       
    }
        return $this->render('last-step', [
            'model' => $model,
            'id' => $id,
            'company_id' => $company_id,
        ]);
    }
}
