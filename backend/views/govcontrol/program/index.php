<?php

use common\models\Company;
use common\models\govcontrol\Program;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\ProgramSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tekshiruv dasturlari';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-index">

    <p>
        <?= Html::a('Yaratish', ['company-search'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'company_id',
            [
                'attribute' => 'company_id',
                'value' => function(Program $model){
                    return 
                    Html::a(Company::findOne($model->company_id)->company_name, 
                    Url::to(['view', 'id' => $model->id]));
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'company_type_id',
                'filter' => $searchModel->getCompanyField(),
                'value' => function(Program $model){
                    return $model->getCompanyField($model->company_type_id);
                },
            ],
            // [
            //     'class' => ActionColumn::class,
            //     'template' => '{view}',
            //     'urlCreator' => function ($action, Program $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'id' => $model->id]);
            //      }
            // ],
            
            [
                'attribute' => 'gov_control_type',
                'filter' => $searchModel->getGovcontrolType(),
                'value' => function(Program $model){
                    return $model->getGovcontrolType($model->gov_control_type);
                }
            ],
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
        ],
    ]); ?>


</div>
