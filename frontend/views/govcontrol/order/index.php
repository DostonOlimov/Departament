<?php

use common\models\govcontrol\Order;
use frontend\widgets\StepsReestr;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\OrderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
// debug($cont);
?>
<div class="order-index row">
<div class="col-3">
        <?= StepsReestr::widget([])?>
    </div>
    <div class="col-9">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'headerRowOptions' => ['style' => 'background-color: #0072B5'],  
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'parent_id',
            [
                'attribute' => 'status',
                'filter' => $searchModel->getDocumentStatus(null),
                'value' => function($model){
                    if($model->status){
                        return $model->getStatusSpan($model->status);
                    }
                },
                'format' => 'raw',   
            ],
            'gov_control_program_id',
            [
                'class' => ActionColumn::class,
                'buttonOptions' => ['class' => 'text-primary'],
                'template' => '{view}',
                'urlCreator' => function ( $action, Order $model) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
            'control_period_from',
            'control_period_to',
            //'control_date_from',
            //'control_date_to',
            //'ombudsman_code_date',
            //'ombudsman_code_number',
        ],
    ]); ?>


</div>
</div>
