<?php

use common\models\embargo\Embargo;
use common\models\control\Company;
use common\models\control\Instruction;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use frontend\widgets\StepsEmbargo;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\embargo\EmbargoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Embargos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

     <div class="col-3">
            <?= StepsEmbargo::widget([
                    
            ])?>     
     </div>
    <div class="col-sm-8"> 
            <p>
                <?= Html::a(Yii::t('app', 'Ko\'rsatma qo\'shish'), ['search'], ['class' => 'btn btn-success']) ?>
            </p>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?> 
       
                

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            
            'filterModel' => $searchModel,
            'headerRowOptions' => ['style' => 'background-color: #0072B5'],
            'columns' => [
                //  ['class' => 'yii\grid\SerialColumn2',
                //     'headerOptions' => ['style'=> 'color: #fff']
                    
                //  ],
        
                // [
                //     'class' => 'yii\grid\DataColumn', 
                //     'headerOptions' => ['style'=> 'color: #fff'],
                //     'attribute' => 'id',
                //     'value' => function ($model) {
                //         if($model->status === 1){
                //            if(!empty($model)){
                //             return $model ? $model->id: '';
                //            }
                //         }else{
                //            return '';
                //         }
                //     },
                // ],
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
               // 'message_number',

                
              
                

                [
                    //'label' => 'Tekshiruv kodi',
                    'attribute' => 'instructions_id',
                    'value' => function ($model) {
                        $instruction = Instruction::findOne(['id' => $model->instructions_id]);
                        return $instruction ? $instruction->command_number : '';
                    }
                ],

                'message_date',

                [
                    'attribute' => 'companies_id',
                   // 'filter' => ['jarayonda','tasdiqlangan'],
                    'value' => function ($model) {
                        $company = Company::findOne(['id' => $model->companies_id]);
                        return $company ? $company->name : '';
                    }
                ],
                [
                    'attribute' => 'status',
                    //'value' => function($data){return $data->status ? '<span class="text-primary">Tasdiqlangan</span>' : '<span class="text-warning">Jarayonda</span>'?:'<span class="text-alert">Bekor qilingan</span>';},
                    'value' => function($model){
                        if($model->status==1){
                        return $model->status==1 ? '<span class="text-primary">Tasdiqlangan</span>':'<span class="text-warning">Jarayonda</span>'?:'<span class="text-alert">Bekor qilingan</span>';
                        }elseif($model->status==2){
                            return $model->status==2 ? '<span class="text-danger">Bekor qilingan</span>':'<span class="text-warning">Jarayonda</span>'?:'<span class="text-alert">Bekor qilingan</span>';  
                        }else{
                            return $model->status==0 ? '<span class="text-warning">Jarayonda</span>':'<span class="text-warning">Jarayonda</span>'?:'<span class="text-alert">Bekor qilingan</span>';   
                        }
                    },
                    
                    'format' => 'raw',
                   
                ],
              //  'status',
              //  'message_date',
                //'inspector_name',
                [
                    'class' => ActionColumn::className(),
                    'template' => '{view}',
                    'buttonOptions' => [
                        'class' => 'text-primary'
                    ],
                    'urlCreator' => function ($action, Embargo $model, $key, $index) {
                        if ($action === 'view') {
                            $url = Url::to(['embargo/view', 'id' => $model->id]);
                            return $url;
                        }
                        // return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>

    </div>


</div>
