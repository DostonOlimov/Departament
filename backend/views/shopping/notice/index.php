<?php

use common\models\shopping\ShoppingNotice;
use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\shopping\ShoppingNoticeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Shopping Notices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shopping-notice-index">

    <p>
        <?= Html::a('Create Shopping Notice', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'notice_number',
            'notice_sum',
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
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttonOptions' => [
                    'class' => 'text-primary'
                ],
                /*'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('', $url);
                    },
                ],*/
                'urlCreator' => function ($action, $searchmodel, $key, $index) {
                    if ($action === 'update') {
                        $url = Url::to(['update', 'id' => $searchmodel->id]);
                        return $url;
                    }
                }
            ],
        ],
    ]); ?>


</div>
