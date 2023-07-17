<?php

use common\models\govcontrol\Order;
use frontend\widgets\StepsGovControl;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\OrderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Davlat nazorati buyug\'lari';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
   


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'headerRowOptions' => ['style' => 'background-color: #0072B5'],  
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'parent_id',
            'gov_control_program_id',
            'control_period_from',
            'control_period_to',
            'control_date_from',
            'control_date_to',
            'ombudsman_code_date',
            'ombudsman_code_number',
            [
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions' => [
                    'class' => 'text-primary'
                ],
                'urlCreator' => function ($action, Order $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
