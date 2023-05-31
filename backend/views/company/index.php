<?php

use common\models\Company;
use common\models\Region;
use kartik\export\ExportMenu;
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
<div class="company-index">

    <p>
        <?= Html::a('Yaratish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'stir',
            'company_name',
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
            //'status',
            //'created_by',
            //'updated_by',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Company $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
