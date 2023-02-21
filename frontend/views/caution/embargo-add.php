<?php

use common\models\embargo\Embargo;
use common\models\control\Company;
use common\models\control\Instruction;
use yii\helpers\Html;
use common\models\User;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use frontend\widgets\StepsReestr;
use yii\grid\GridView;
use yii\bootstrap4\Breadcrumbs;



/** @var yii\web\View $this */
/** @var common\models\embargo\EmbargoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Taqiqlash');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

    <div class="col-3">
        <?= StepsReestr::widget([])?>
    </div>
    <div class="col-sm-8"> 
            <?php
                echo Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'options' => [
                        'class' => 'p-2 bg-primary breadcrumb float-sm-right'
                        ]
                    ]);
                ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?> 
       
                

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'headerRowOptions' => ['style' => 'background-color: #0072B5'],
            'columns' => [
              
               
                [
                    'attribute'=> 'message_number',
                    'value'=>function($model){
                        if($model->status === 1){
                        return $model->message_number;
                        }else{
                            return '';
                        }
                    }
                ],

                [
                    'label' => 'Tekshiruv kodi',
                    'attribute' => 'instructions_id',
                    'value' => function ($data) {
                        // $instruction = Instruction::findOne(['id' => $model->instructions_id]);
                        return $data ? $data->instruction->command_number : '';
                    }
                ],
                [
                    'attribute'=> 'XYUS nomi',
                    'headerOptions' => ['style' => 'color: #fff'],
                    'value' => function ($data) {
                        //$company = Company::findOne(['id' => $model->companies_id]);
                        return $data ? $data->instruction->controlCompany->name : '';
                    }
                ],
                [
                    'attribute' => 'status',
                    'value' => function($model){
                        if($model->status == null){
                            return '<span class="btn btn-warning text-dark btn-block">Jarayonda</span>';
                        //return $model->status ? '<span class="text-primary">Tasdiqlangan</span>':'<span class="text-warning">Jarayonda</span>'?:'<span class="text-alert">Bekor qilingan</span>';
                        }elseif($model->status == 1){
                            return '<span class="btn btn-primary text-light btn-block">Tasdiqlangan</span>';
                        }else{
                            return '<span class="btn btn-danger text-light btn-block">Bekor qilingan</span>';   
                        }
                    },
                    
                    'format' => 'raw',
                ],
               
                
                [
                    'attribute'=> 'created_by',
                    'value'=> function($model){
                        $user = User::findOne($model->created_by);
                        return $user ? $user->name .' '.$user->surname :'';
                    }
                    ],
                    [
                        'attribute'=> 'updated_by',
                        'value'=> function($model){
                            $user = User::findOne($model->updated_by);
                                  
                            return $user ? $user->name .' '.$user->surname :'';
                          
                        }
                    ],
                // //'created_at',
                // 'updated_at',
                 [
                    'class' => ActionColumn::className(),
                    'template' => '{view}',
                    'buttonOptions' => [
                        'class' => 'text-primary'
                    ],
                    'urlCreator' => function ($action, Embargo $model, $key, $index) {
                        if ($action === 'view') {
                            $url = Url::to(['caution/embargo-view', 'id' => $model->id]);
                            return $url;
                        }
                       
                    }
                ],
            ],
        ]); ?>

    </div>


</div>
