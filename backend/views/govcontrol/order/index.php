<?php

use common\models\govcontrol\Order;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\OrderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tekshiruv buyrug\'lari';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">



    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'id',
                'value' => function($model){
                    return 
                    Html::a($model->id, 
                    Url::to(['view', 'id' => $model->id]));
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'gov_control_program_id',
                'value' => function($model){
                    return 
                    Html::a($model->gov_control_program_id, 
                    Url::to(['govcontrol/program/view', 'id' => $model->gov_control_program_id]));
                },
                'format' => 'raw'
            ],
            // 'gov_control_program_id',
            [
                'attribute' => 'order_number',
                'value' => function($model){
                    return($model->order_number) ? $model->getGovControlPrefix($model->order_prefix).'-'.$model->order_number : $model->order_number;
                }
            ],
            // 'parent_id',
            'control_period_from',
            'control_period_to',
            //'control_date_from',
            //'control_date_to',
            //'ombudsman_code_date',
            //'ombudsman_code_number',
            'created_at',
            [
                'attribute' => 'status',
                'filter' => $searchModel->getDocumentStatus(null),
                'value' => function($model){
                    if($model->status){
                        if($model->status){
                            return $model->getStatusSpan($model->status);
                        }
                    }
                },
                'format' => 'raw',   
            ],
            // [
            //     'class' => ActionColumn::class,
            //     'urlCreator' => function ($action, Order $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'id' => $model->id]);
            //      }
            // ],
        ],
    ]); ?>


</div>
