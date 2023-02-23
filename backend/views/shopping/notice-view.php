<?php

use common\models\Region;
use common\models\shopping\Company;
use common\models\shopping\Instruction;
use common\models\shopping\ShoppingNotice;
use common\models\shopping\Product;
use common\models\shopping\ProductSearch;
use common\models\User;

//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\Breadcrumbs;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel common\models\shopping\InstructionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Korxonalar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">
    <p>
        <?= Html::a('Bildirgi status', ['/shopping/notice/index'], ['class' => 'btn btn-success']) ?>
        
    </p>

    <?php $gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    [
        'label' => 'Bildirgi raqami',
        'value' => function ($model) {
            $instruction = Instruction::findOne(['id' => $model->id]);
            if ($instruction->notice_id) {
                return $instruction->shoppingNotice->notice_number;
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
            return $model ? $model->createdBy->name .' '.$model->createdBy->surname : '' ;
        },
        'filter' => Html::activeDropDownList($searchModel, 'created_by', ArrayHelper::map(User::find()->all(), 'id', 'username'), ['class' => 'form-control', 'prompt' => '- - -'])
    ],

    [
        'attribute' => 'region_id',
        'label' => 'Hudud',
        'value' => function (Instruction $model) {
            return $model->company ? $model->company->region->name : '';
        }, 
        'filter' => Html::activeDropDownList($searchModel, 'region_id', ArrayHelper::map(Region::find()->all(), 'id', 'name'), ['class' => 'form-control', 'prompt' => '- - -'])
    ],
    // [
    //     'class' => 'yii\grid\ActionColumn',
    //     'template' => '{view}',
    //     'buttonOptions' => [
    //         'class' => 'text-primary'
    //     ],
    //     /*'buttons' => [
    //         'view' => function ($url, $model) {
    //             return Html::a('', $url);
    //         },
    //     ],*/
    //     'urlCreator' => function ($action, $searchmodel, $key, $index) {
    //         if ($action === 'view') {
    //             $url = Url::to(['view', 'id' => $searchmodel->id]);
    //             return $url;
    //         }
    //     }
    // ],
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
        'label' => 'Xarid raqami',
        'value' => function ($model) {
            $instruction = Instruction::findOne(['id' => $model->id]);
            if ($instruction) {
                return $instruction->id;
            }
        },
        'format' => 'raw'
    ],
    [
        'label' => 'Xarid sanasi',
        'value' => function ($model) {
            $instruction = Instruction::findOne(['id' => $model->id]);
            if ($instruction) {
                return $instruction->created_at;
            }
        },
        'format' => 'date'
    ],
    [
        'class' => 'kartik\grid\ExpandRowColumn',
        //'width' => '50px',
        'value' => function ($model, $key, $index, $column) {
            if ($model->status === 'FEATURED') { // keep it expanded for specific rows
                return GridView::ROW_EXPANDED;
            }
            return GridView::ROW_COLLAPSED;
        },
        'detail' => function ($model, $key, $index, $column) {
            $company = Company::find()->where(['shopping_instruction_id'=>$model->id])->all();

            $searchModel = new ProductSearch();
            
            foreach($company as $com){
                $searchModel->shopping_company_id = $com->id;
            }
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
          return Yii::$app->controller->renderPartial('/shopping/product/notice-pro',
           [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        
           ]);
        
        },
       // 'headerOptions' => ['class' => 'kartik-sheet-style'] 
        ],

    
];

// Renders a export dropdown menu
echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'clearBuffers' => true, //optional
]);?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax'=>true,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],
           
            [
                'label' => 'Bildirgi raqami',
                'value' => function ($model) {
                    $instruction = Instruction::findOne(['id' => $model->id]);
                    if ($instruction->notice_id) {
                        return $instruction->shoppingNotice->notice_number;
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
                    return $model ? $model->createdBy->name .' '.$model->createdBy->surname : '' ;
                },
                'filter' => Html::activeDropDownList($searchModel, 'created_by', ArrayHelper::map(User::find()->all(), 'id', 'username'), ['class' => 'form-control', 'prompt' => '- - -'])
            ],

            [
                'attribute' => 'region_id',
                'label' => 'Hudud',
                'value' => function (Instruction $model) {
                    return $model->company ? $model->company->region->name : '';
                }, 
                'filter' => Html::activeDropDownList($searchModel, 'region_id', ArrayHelper::map(Region::find()->all(), 'id', 'name'), ['class' => 'form-control', 'prompt' => '- - -'])
            ],
            // [
            //     'class' => 'yii\grid\ActionColumn',
            //     'template' => '{view}',
            //     'buttonOptions' => [
            //         'class' => 'text-primary'
            //     ],
            //     /*'buttons' => [
            //         'view' => function ($url, $model) {
            //             return Html::a('', $url);
            //         },
            //     ],*/
            //     'urlCreator' => function ($action, $searchmodel, $key, $index) {
            //         if ($action === 'view') {
            //             $url = Url::to(['view', 'id' => $searchmodel->id]);
            //             return $url;
            //         }
            //     }
            // ],
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
                'label' => 'Xarid raqami',
                'value' => function ($model) {
                    $instruction = Instruction::findOne(['id' => $model->id]);
                    if ($instruction) {
                        return $instruction->id;
                    }
                },
                'format' => 'raw'
            ],
            [
                'label' => 'Xarid sanasi',
                'value' => function ($model) {
                    $instruction = Instruction::findOne(['id' => $model->id]);
                    if ($instruction) {
                        return $instruction->created_at;
                    }
                },
                'format' => 'date'
            ],
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                //'width' => '50px',
                'value' => function ($model, $key, $index, $column) {
                    if ($model->status === 'FEATURED') { // keep it expanded for specific rows
                        return GridView::ROW_EXPANDED;
                    }
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function ($model, $key, $index, $column) {
                    $company = Company::find()->where(['shopping_instruction_id'=>$model->id])->all();
    
                    $searchModel = new ProductSearch();
                    
                    foreach($company as $com){
                        $searchModel->shopping_company_id = $com->id;
                    }
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                  return Yii::$app->controller->renderPartial('/shopping/product/notice-pro',
                   [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                
                   ]);
                
                },
               // 'headerOptions' => ['class' => 'kartik-sheet-style'] 
                ],

            
            
            
           
            
        ],
    ]); ?>


</div>
