<?php

use common\models\control\PrimaryProduct;
use common\models\types\ProductSubposition;
use common\models\control\PrimaryProductNd;
use common\models\NdType;
use common\models\Countries;
use common\models\control\Company;
use common\models\control\PrimaryData;
use frontend\widgets\Steps;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\control\PrimaryProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Mahsulotlar';
$this->params['breadcrumbs'][] = $this->title;
$primaryData = PrimaryData::findOne(['id' => $primary_data_id]);
?>


<div class="page1-1 row">
  <?= Steps::widget([
        'control_instruction_id' => Company::findOne($primaryData->control_company_id)->control_instruction_id,
        'control_company_id' => $primaryData->control_company_id,
    ]) ?>
    
<div class="col-8">
<h1><?= Html::encode($this->title) ?></h1>

<hr>

        <?=  GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'headerRowOptions' => ['style' => 'background-color: #198754;'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'label' => 'Mahsulot turi',
                        'value' => function($pro) {
                            $data = ProductSubposition::find()->where(['kode' => $pro->product_type_id])->one();
                            if($data){
                                return $result = '<span>' . $data->name. '</span><br>';
                            }
                            return 'aniqlanmadi';
                        },
                        'format' => 'raw'
                    ],
                    'product_name',
                    [
                        'label' => 'Mahsulot ishlab chiqarilgan mamlakat',
                        'value' => function($pro) {
                            $data = Countries::find()->where(['id' => $pro->made_country])->one();
                            $result = '<span>' . $data->name. '</span><br>';
                            return $result;
                        },
                        'format' => 'raw'
                    ],
                 
                  /*  [
                        'attribute' => 'residue_quantity',
                        'value' => function ($pro) {
                            return $pro->residue_quantity ? $pro->residue_quantity . ' so\'m' : '';
                        }

                    ],
                    [
                        'attribute' => 'residue_amount',
                        'value' => function ($pro) {
                            $mesure = PrimaryProduct::getMeasure($pro->product_measure);
                            return $pro->residue_amount ? $pro->residue_amount. ' '.$mesure : '';
                        }

                    ],
                    [
                        'attribute' => 'year_quantity',
                        'value' => function ($pro) {
                            return $pro->year_quantity ? $pro->year_quantity . ' so\'m' : '';
                        }

                    ],
                    [
                        'attribute' => 'year_amount',
                        'value' => function ($pro) {
                            $mesure = PrimaryProduct::getMeasure($pro->product_measure);
                            return $pro->year_amount ? $pro->year_amount. ' '.$mesure:'';
                        }

                    ],*/
                //    'exsist_certificate',
                    'codetnved',
                    [
                        'attribute' => 'photo',
                        'value' => function (PrimaryProduct $model) {
                            $model->img = $model->photo;
                            return $model->img ? '<a class="btn btn-info" target="_blank" href="' . $model->getUploadedFileUrl('img') . '" >Yuklash</a>' : '';
                        },
                        'format' => 'raw'
                    ],
                    [
                        'label' => 'Normativ hujjat(lar) turi va nomi',
                        'value' => function($pro) {
                            $data = PrimaryProductNd::find()->where(['control_primary_product_id' => $pro->id])->all();
                            $result = '';
                            foreach ($data as $da) {
                                $type = NdType::find()->where(['id' => $da->type_id])->one();
                                $result .= '<span>' . $type->name . ' - ' . $da-> name . ',' . '</span><br>';
                            }
                            return $result;
                        },
                        'format' => 'raw'
                    ],
                    [
                        'attribute' => 'Sinov laboratoriyasi xulosasi',
                       /* 'class' => 'yii\grid\ActionColumn',
                        'template' => '{view}',
                        'buttonOptions' => [
                            'class' => 'text-primary'
                        ],
                        'urlCreator' => function ($action, $searchmodel, $key, $index) {
                            if ($action === 'view') {
                                $url = Url::to(['view', 'id' => $searchmodel->id]);
                                return $url;
                            }
                        },*/
                        'value' => function (PrimaryProduct $model) {
                            
                            return Html::a('Yangilash', ['/control/primary-products/update', 'id' => $model->id,], ['class' => 'btn btn-primary']) ;
                        },
                        'format' => 'raw'
                    ],
                    [
                        'attribute' => 'Tashqi ko\'rinish bo\'yicha yaroqligi',
                        'value' => function (PrimaryProduct $model) {
                            
                            return Html::a('Yangilash', ['/control/primary-products/update', 'id' => $model->id,], ['class' => 'btn btn-primary']) ;
                        },
                        'format' => 'raw'
                    ],
                    [
                        'attribute' => 'Mahsulotga oid sertifikatlar',
                        'value' => function (PrimaryProduct $model) {
                            
                            return Html::a('Yangilash', ['/control/primary-products/update', 'id' => $model->id,], ['class' => 'btn btn-primary']) ;
                        },
                        'format' => 'raw'
                    ],
                    [
                        'attribute' => 'Tahrirlash',
                        'value' => function (PrimaryProduct $model) {
                            
                            return Html::a('Yangilash', ['/control/primary-products/update', 'id' => $model->id,], ['class' => 'btn btn-primary']) ;
                        },
                        'format' => 'raw'
                    ]
                ],
            ]);
        ?>
    <div>
<div>   

  <?= $this->render('_form', [
        'model' => $modelCreate,
    ]) ?>
</div>
    </div>

