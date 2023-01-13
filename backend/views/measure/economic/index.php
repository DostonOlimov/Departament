<?php

use common\models\measure\Economics;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\measure\EconomicsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Iqtisodiy jarimalar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="economics-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
           // 'control_instruction_id',
            //'first_warn_date:date',
            'warn_number',
            'eco_date:date',
            'eco_number',
          //  'eco_quantity',
           // 'eco_amount',
            //'created_by',
            //'updated_by',
            'created_at:date',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Economics $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
