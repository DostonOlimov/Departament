<?php

use common\models\actselection\ActSelection;
use frontend\widgets\StepsGovControl;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\actselection\ActSelectionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Namuna tanlab olish dalolatnomalari';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="act-selection-index row">
<div class="col-3 mt-5">
        <?php echo StepsGovControl::widget(
            [
                'gov_control_order_id' => $order->id,
            ]
            )?>
    </div>
        <div class="col-6 mt-5">
    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Yaratish', ['create', 'gov_control_order_id' => $order->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'headerRowOptions' => ['style' => 'background-color: #0072B5'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'gov_control_order_id',
            [
                'class' => ActionColumn::class,
                'buttonOptions' => ['class' => 'text-primary'],
                'urlCreator' => function ($action, ActSelection $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
</div>
