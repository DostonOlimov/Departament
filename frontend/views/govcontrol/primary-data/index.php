<?php

use common\models\govcontrol\PrimaryData;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\PrimaryDataSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Primary Datas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="primary-data-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Primary Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'company_type_id',
            'gov_control_order_id',
            'real_control_date_from',
            'real_control_date_to',
            //'quality_management_system',
            //'product_exists',
            //'laboratory_exists',
            //'last_gov_control_date',
            //'last_gov_control_number',
            //'comment:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, PrimaryData $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
