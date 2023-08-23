<?php

use common\models\Company;
use common\models\Region;
use frontend\widgets\StepsReestr;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\CompanySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tashkilotlar ro\'yxati';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index row">
    <div class="col-3">
        <?= StepsReestr::widget([
            
            ])?>
    </div>
    <div class="col-9">
        <h3><?= $this->title?></h3>
    <p>
        <?= Html::a('Yaratish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'headerRowOptions' => ['style' => 'background-color: #0072B5'],       
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'stir',
            'company_name',
            [
                'class' => ActionColumn::className(),
                'template' => '{view}',
                'buttonOptions' => [
                    'class' => 'text-primary',
                ],
                'urlCreator' => function ($action, Company $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
            'registration_date',
            [
                'attribute' => 'region_id',
                'value' => function($model){
                    return Region::findOne(['id' => $model->region_id])->name ;
                }
            ],
            
            //'address',
            //'thsht',
            //'ifut',
            //'ownername',
            //'phone',
            [   
                'attribute' => 'status',
                'value' => function (Company $model) {
                    return $model->getStatus($model->status);
                },
            ],
            // 'created_by',
            //'updated_by',
            //'created_at',
            'updated_at',
        ],
    ]); ?>


    </div>
</div>
