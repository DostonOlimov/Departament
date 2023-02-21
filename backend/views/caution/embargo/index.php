<?php

use common\models\embargo\Embargo;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\models\User;
use yii\bootstrap4\Breadcrumbs;
use kartik\export\ExportMenu;

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

<?php $gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
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
            'attribute'=> 'XYUS nomi',
            'value' => function ($data) {
                return $data ? $data->instruction->controlCompany->name : '';
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
            'value' => function($model){
                if($model->status == null){
                    return '<span class="btn btn-warning text-dark btn-block">Jarayonda</span>';
                //return $model->status ? '<span class="text-primary">Tasdiqlangan</span>':'<span class="text-warning">Jarayonda</span>'?:'<span class="text-alert">Bekor qilingan</span>';
                }elseif($model->status == 1){
                    return '<span class="btn btn-primary text-light btn-block">Tasdiqlangan</span>';
                }else{
                    return '<span class="btn btn-alert text-dark btn-block">Bekor qilingan</span>';   
                }
            },
            
            'format' => 'raw',
        ],
       // 'message_date',
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
                if($model->status == 1){               
                return $user ? $user->name .' '.$user->surname :'';
                }return '';
            }
        ],
        //'created_at',
        'message_date',
    ['class' => 'yii\grid\ActionColumn'],
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
                'attribute'=> 'Xyus nomi',
                'headerOptions' => ['style' => 'color: #007bff'],
                'value' => function ($data) {
                    return $data ? $data->instruction->controlCompany->name : '';
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
           // 'message_date',
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
