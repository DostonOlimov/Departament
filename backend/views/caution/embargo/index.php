<?php

use common\models\embargo\Embargo;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap4\Breadcrumbs;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Taqiqlash ko\'rsatmasi');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="embargo-index">
<?php
            echo Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                 'options' => [
                'class' => 'breadcrumb float-sm-right'
                        ]
                ]);
            ?>

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

           // 'id',
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
                'attribute'=> 'companies_id',
                'value' => function ($data) {
                    return $data ? $data->company->name : '';
                }
            ],
            [
                'attribute'=> 'instructions_id',
                'value' => function ($data) {
                    return $data ? $data->instruction->command_number : '';
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
           // 'message_date',
            [
                'attribute'=> 'created_by',
                'value'=> function($data){
                    return $data ? $data->user->name .' '.$data->user->surname :'';
                }
            ],
            [
                'attribute'=> 'updated_by',
                'value'=> function($data){
                    if($data->status==1){
                    return $data ? $data->user->name .' '.$data->user->surname :'';
                    } return '';
                }
            ],
            //'created_at',
            'message_date',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttonOptions' => [
                    'class' => 'text-primary'
                ],
                /*'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('', $url);
                    },
                ],*/
                'urlCreator' => function ($action, $searchmodel, $key, $index) {
                    if ($action === 'view') {
                        $url = Url::to(['view', 'id' => $searchmodel->id]);
                        return $url;
                    }
                }
            ],
        ],
    ]); ?>


</div>
