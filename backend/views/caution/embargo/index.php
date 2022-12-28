<?php

use common\models\embargo\Embargo;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Taqiqlash ko\'rsatmasi');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="embargo-index">

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
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
            //'status',
            //'message_date',
            'inspector_name',
            //'inspectors',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Embargo $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
