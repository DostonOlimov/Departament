<?php

/* @var $this yii\web\View */

/* @var $model PrimaryData */

use common\models\control\PrimaryData;
use common\models\control\PrimaryOv;
use common\models\control\PrimaryProduct;
use common\models\control\PrimaryProductNd;
use common\models\control\MandatoryCertification;
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
    <div class="col-6">
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
                            return $pro->residue_quantity . ' so\'m';
                        }

                    ],
                    [
                        'attribute' => 'residue_amount',
                        'value' => function ($pro) {
                            $mesure = PrimaryProduct::getMeasure($pro->product_measure);
                            return $pro->residue_amount . ' '.$mesure;
                        }

                    ],
                    [
                        'attribute' => 'year_quantity',
                        'value' => function ($pro) {
                            return $pro->year_quantity . ' so\'m';
                        }

                    ],
                    [
                        'attribute' => 'year_amount',
                        'value' => function ($pro) {
                            $mesure = PrimaryProduct::getMeasure($pro->product_measure);
                            return $pro->year_amount . ' '.$mesure;
                        }

                    ],
                    'potency',

                    [
                        'label' => 'Normativ hujjat(lar) turi va nomi',
                        'value' => function($pro) {
                            $data = PrimaryProductNd::find()->where(['control_primary_product_id' => $pro->id])->all();
                            $result = '';
                            foreach ($data as $da) {
                                $type = NdType::find()->where(['id' => $da->type_id])->one();
                                $result .= '<span>' . $type->name . '  ' . $da-> name . ',' . '</span><br>';
                            }
                            return $result;
                        },
                        'format' => 'raw'
                    ],
                    [
                        'label' => 'Mahsulot rasmi',
                        'value' => function($pro) {
                            if($pro->photo){
                                return $result = '<img src="../../../web/uploads/images/3160_eti.jpg'. '" alt="Italian Trulli">';
                            }
                            return 'rasm yo\'q';
                        },
                        'format' => 'raw'
                    ],
                    
        [

            'attribute' => 'img',

            'format' => 'html',

            'label' => 'ImageColumnLable',

            'value' => function ($pro) {
                return yii\helpers\Url::base().'/uploads/images/';

                return Html::img(Yii::getAlias('@frontend') . '/web/uploads/images/'. $pro['photo'],

                    ['width' => '60px']);

            },

        ],
                  
                ],
            ]);

        }
        ?>


    </div>
   
</div>
