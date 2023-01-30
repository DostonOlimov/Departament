<?php

/* @var $this yii\web\View */

/* @var $model PrimaryData */

use common\models\control\PrimaryData;
use common\models\control\PrimaryOv;
use common\models\control\PrimaryProduct;
use common\models\control\PrimaryProductNd;
use common\models\control\ControlProductCertification;;
use common\models\types\ProductSubposition;
use common\models\Countries;
use frontend\widgets\Steps;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\NdType;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="page1-1 row">

    <?= Steps::widget([
        'control_instruction_id' => $model->controlCompany->control_instruction_id,
        'control_company_id' => $model->control_company_id,
    ]) ?>
    <div class="col-8">
    <h3>Korxona haqida</h3>
    <?= DetailView::widget([
        'model' => $model,
        
        'attributes' => [
            [
                'attribute' => 'laboratory',
                'value' => function ($model) {
                    return PrimaryData::getLab($model->laboratory);
                }

            ],
            [
                'attribute' => 'smt',
                'value' => function ($model) {
                    return PrimaryData::getSMT($model->smt);
                }

            ],
        ],
    ]) ?>


        <h3>O'lchov vositalari</h3>
        <?php
        //\yii\helpers\VarDumper::dump(PrimaryOv::findOne(['control_primary_data_id' => $model->id]),12,true);die;
        if ($ovs = PrimaryOv::findAll(['control_primary_data_id' => $model->id])) {

            echo GridView::widget([
                'dataProvider' => $dataOv,
//                    'filterModel' => $searchOv,
                'headerRowOptions' => ['style' => 'background-color: #198754;'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'measurement',
                    'compared',
                    'invalid',
                    'uncompared',
                    'invalid',
                    'unworked',
                    [
                        'attribute' => 'type',
                        'value' => function (PrimaryOv $model) {
                            return PrimaryOv::getType($model->type);
                        }
                    ]
                ],
            ]);
        }
        ?>

        <hr>
        <?php
        echo $model->id;
        if ($product = PrimaryProduct::findAll(['control_primary_data_id' => $model->id])) {
            echo "<h3>Mahsulot</h3>";
            echo GridView::widget([
                'dataProvider' => $dataProduct,
//                    'filterModel' => $searchProduct,
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
                 
                    [
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

                    ],
                    'codetnved',
                 /*   
                    [
                        'label' => 'Mahsulotning majburiy sertifikat reestr raqam(lar)i',
                        'value' => function($pro) {
                            $data = ControlProductCertification::find()->where(['product_id' => $pro->id])->all();
                           
                            $result = '';
                            foreach ($data as $da) {
                                
                                $result .= '<span>' . $da->number_reestr  . ',</span><br>';
                            }
                            return $result;
                        },
                        'format' => 'raw'
                    ],
                */
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
                        'attribute' => 'photo',
                        'value' => function (PrimaryProduct $model) {
                            $model->image = $model->photo;
                            return $model->image ? '<a class="btn btn-info" target="_blank" href="' . $model->getUploadedFileUrl('image') . '" >Yuklash</a>' : '';
                        },
                        'format' => 'raw'
                    ],
                ],
            ]);

        }
        ?>


    </div>
   
</div>
