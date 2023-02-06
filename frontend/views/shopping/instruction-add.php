<?php

use common\models\shopping\Instruction;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\User;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use frontend\widgets\StepsShopping;
use common\models\Region;
use common\models\shopping\Company;
use common\models\shopping\ShoppingNotice;
use common\models\shopping\Product;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\shopping\InstructionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .pagination li a {
        padding: 2px 5px;
    }

    .pagination li.active {
        background-color: #1AB475;
    }

    .pagination li a {
        color: black;
    }

    .pagination li a:hover {
        background-color: grey;
    }
</style>
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <?= StepsShopping::widget([
                    'shopping_instruction_id' => null,
                    'shopping_company_id' => null,
        ]) ?>

        <div class="col-8"> 
            
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'headerRowOptions' => ['style' => 'background-color: #0072B5;color:#fff'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    
                    [
                        'attribute' => 'notice_id',
                        'label' => 'Bildirgi raqami',
                        'value' => function (Instruction $model) {
                            return $model->notice_id ? $model->shoppingNotice->notice_number : '';
                        }, 
                    ],
                    [
                        'attribute' => 'region_id',
                        'label' => 'Hudud',
                        'value' => function (Instruction $model) {
                            return $model->company ? $model->company->region->name : '';
                        }, 
                        
                    ],
                    [
                        'attribute' => 'name',
                        'label' => 'Xyus nomi',
                        'value' => function (Instruction $model) {
                            return $model->company ? $model->company->name : '';
                        }, 
                        'filter' => Html::activeInput('text',$searchModel, 'name', ['class' => 'form-control']),
                        'format' => 'raw',
                    ],
                    
                    [
                        'attribute' => 'inn',
                        'label' => 'Xyus inn',
                        'value' => function (Instruction $model) {
                            return $model->company ? $model->company->inn : '';
                        },
                        'filter' => Html::activeInput('text',$searchModel, 'inn', ['class' => 'form-control']),
                        'format' => 'raw',
                    ],
                    [
                        'label' => 'Xyus yuridik manzili',
                        'value' => function ($model) {
                            $company = Company::findOne(['shopping_instruction_id' => $model->id]);
                            if ($company) {
                                return $company->address;
                            } else {
                                return '';
                            }
                        },
                        'format' => 'raw',
                    ],
                    
                    [
                        'attribute' => 'created_by',
                        'label' => 'Mutaxasis',
                        'value' => function ($model) {
                            return $model->createdBy->username .' '.$model->createdBy->surname ;
                        },
                        
                    ],
                    [
                        'label' => 'Status',
                        'value' => function ($model) {
                            $company = Company::findOne(['shopping_instruction_id' => $model->id]);
                            if ($company) {
                                if (Product::findOne(['shopping_company_id' => $company->id])) {
                                    return '<label style="color: blue">Bajarildi</labelsty>';
                                } else {
                                    return '<label style="color: orange">Jarayonda</labelsty>';
                                }
                            } else {
                                return '<label style="color: orange">Jarayonda</labelsty>';
                            }
                        },
                        'format' => 'raw'
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view}',
                        'buttonOptions' => [
                            'class' => 'text-primary'
                        ],
                        
                        'urlCreator' => function ($action, $searchmodel, $key, $index) {
                            if ($action === 'view') {
                                $url = Url::to(['instruction-view', 'id' => $searchmodel->id]);
                                return $url;
                            }
                        }
                    ],
                    // [
                    //     'class' => ActionColumn::className(),
                    //     'urlCreator' => function ($action, Instruction $model, $key, $index, $column) {
                    //         return Url::toRoute([$action, 'id' => $model->id]);
                    //     }
                    // ],
                ],
            ]); ?>

        </div>
    </div>
