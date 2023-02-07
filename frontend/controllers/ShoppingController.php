<?php

namespace frontend\controllers;

use common\models\shopping\Company;
use common\models\Model;
use common\models\User;
use common\models\shopping\Instruction;
use common\models\shopping\InstructionSearch;
use common\models\shopping\InstructionAdd;
use common\models\shopping\ShoppingNotice;
use common\models\shopping\ShoppingNoticeSearch;
use common\models\shopping\Product;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\helpers\VarDumper;
use yii\web\Controller;
use Yii;

/**
 * Site controller
 */
class ShoppingController extends Controller
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

    public function actionNotice()
    {
        $model = new ShoppingNotice();
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
               $model->updated_by = $model->created_by;
            }
            if($model->save()){
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('notice', [
            'model' => $model,
        ]);
    }

    public function actionIndex()
    {
        $searchModel = new ShoppingNoticeSearch(\Yii::$app->user->id);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionInstructionAdd()
    {
        $searchModel = new InstructionAdd();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('instruction-add', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionInstruction($notice_id)
    {
        
        $model = new Instruction();

        if ($model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['company', 'instruction_id' => $model->id]);
        }

        return $this->render('instruction', [
            'model' => $model,
            'notice_id' => $notice_id,
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
        $model->shopping_instruction_id = $instruction_id;

        if ($model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['product', 'company_id' => $model->id]);
        }

        return $this->render('company', [
            'model' => $model
        ]);
    }

    public function actionCompanyView($id)
    {
        return $this->render('company-view', [
            'model' => $this->getModel(Company::className(), $id)
        ]);
    }

   

    public function actionProduct($company_id)
    {
        //$id = Yii::$app->request->get('id');
       $company = Company::findOne($company_id);
       $user = User::findOne(Yii::$app->user->id);
       
        $modelsPrevent = [new Product];
        if (Yii::$app->request->post()) {
            $modelsPrevent = Model::createMultiple(Product::classname(),$modelsPrevent);
            Model::loadMultiple($modelsPrevent, $this->request->post());
            foreach($modelsPrevent as $key=>$product) {
                $product->shopping_company_id = $company['id']; 
                $product->created_by = $user['id'];
                $product->updated_by = $product->created_by;     
            }    
            //$valid = Model::validateMultiple($modelsPrevent);
            if (Model::validateMultiple($modelsPrevent)) {
                $transaction = \Yii::$app->db->beginTransaction();
                
                try {
                        foreach ($modelsPrevent as $key=>$product) {
                            $product->s_photo = UploadedFile::getInstance($product, "[{$key}]photo");                
                            if($product->s_photo)  {
                                $product->photo = $product->s_photo->name;
                            }   
                            $product->s_photo_check = UploadedFile::getInstance($product, "[{$key}]photo_chek");                
                            if($product->s_photo_check)  {
                                $product->photo_chek = $product->s_photo_check->name;
                            }                                               
                           $product->save(false);
                        }
                        $transaction->commit();
                       return $this->redirect(['product-view', 'shopping_company' => $company_id]);
                    // }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }
            }
        
        }
        return $this->render('product', [            
            'modelsPrevent' => $modelsPrevent,
        ]);
    }

    // public function actionProduct($company_id)
    // {
    //     $model = new Product();
    //     $model->shopping_company_id = $company_id;

    //     if ($model->load($this->request->post()) && $model->save()) {
    //         return $this->redirect(['/shopping/index']);
    //     }

    //     return $this->render('product', [
    //         'model' => $model
    //     ]);
    // }

    public function actionProductView($shopping_company)
    {
        return $this->render('product-view', [
            'model' => Company::findOne($shopping_company),
           
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
