<?php

use common\models\Company;
use common\models\govcontrol\Program;
use frontend\widgets\StepsReestr;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\ProgramSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tekshiruv dasturlari';
$this->params['breadcrumbs'][] = $this->title;
// debug($dataProvider->getModels()[3]);
?>
<div class="program-index row">
    <div class="col-3">
        <?= StepsReestr::widget([
            
            ])?>
    </div>
    <div class="col-9">
        <h3><?= $this->title ?></h3>
    <p>
        <?= Html::a('Yaratish', ['company-search'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'headerRowOptions' => ['style' => 'background-color: #0072B5'],       
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'company_id',
            [
                'attribute' => 'govControlOrders',
                'label' => 'Buyruqlar soni',
                'value' => function($model){
                    return count($model->govControlOrders);
                }
            ],
            [
                'attribute' => 'status',
                'value' => function($model){
                    if($model->status){
                        return $model->getStatusSpan($model->status);
                    }
                },
                'format' => 'raw',   
            ],
            [
                'attribute' => 'company_id',
                'value' => function(Program $model){
                    return Company::findOne($model->company_id)->company_name;
                }
            ],
            [
                'class' => ActionColumn::class,
                'template' => '{view}',
                'buttonOptions' => ['class' => 'text-primary'],
                'urlCreator' => function ($action, Program $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
                ],
                [
                'attribute' => 'company_type_id',
                'value' => function(Program $model){
                    return $model->getCompanyField($model->company_type_id);
                }
            ],
            
            [
                'attribute' => 'gov_control_type',
                'value' => function(Program $model){
                    return $model->getGovcontrolType($model->gov_control_type);
                }
            ],
        ],
    ]); ?>


    </div>
</div>
