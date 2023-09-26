<?php

use common\models\Company;
use common\models\govcontrol\Program;
use common\models\govcontrol\ProgramData;
use common\models\govcontrol\ProgramProperty;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\Program $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="program-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if ($model->getPermissionAdmin('update',$model->status) == true):?>
            <?= Html::a('Yangilash', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif ?>

        <?php if ($model->getPermissionAdmin('create_order',$model->status) == true):?>
            <?= Html::a('Buyrug\' yaratish', ['govcontrol/order/create', 'gov_control_program_id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?php endif ?>

        <?php if ($model->getPermissionAdmin('confirm',$model->status) == true):?>
            <?= Html::a('Tasqidlash', ['change-status', 'id' => $model->id, 'status' => $model::DOCUMENT_STATUS_CONFIRMED], ['class' => 'btn btn-primary']) ?>
        <?php endif ?>
            
        <?php if ($model->getPermissionAdmin('return',$model->status) == true):?>
            <?= Html::a('Tahrirlashga qaytarish', ['change-status', 'id' => $model->id, 'status' => $model::DOCUMENT_STATUS_RETURNED], ['class' => 'btn btn-primary']) ?>
        <?php endif ?>

        <?php if ($model->getPermissionAdmin('deny',$model->status) == true):?>
            <?= Html::a('Rad etish', ['change-status', 'id' => $model->id, 'status' => $model::DOCUMENT_STATUS_DENIED], ['class' => 'btn btn-danger']) ?>
        <?php endif ?>

        <?php if ($model->getPermissionAdmin('delete',$model->status) == true):?>
            <?= Html::a('O\'chirish', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                    ],
                    ]) ?>
        <?php endif ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'company_id',
                'value' => function($model){
                    return Company::findOne($model->company_id)->company_name;
                }
            ],
            [
                'attribute' => 'company_type_id',
                'value' => function($model){
                    return $model->getCompanyField($model->company_type_id);
                }
            ],
            
            [
                'attribute' => 'gov_control_type',
                'value' => function($model){
                    return $model->getGovcontrolType($model->gov_control_type);
                }
            ],
            [
                'attribute' => 'status',
                'value' => function($model){
                    if($model->status){
                        if($model->status){
                            return $model->getStatusSpan($model->status);
                        }
                    }
                },
                'format' => 'raw',   
            ],
            'created_at',
            'updated_at',
            [
                'attribute' => 'created_by',
                'value' => function($model){
                    return $model->getUserFormated($model->created_by, 'name surname');
                }
            ],
            [
                'attribute' => 'updated_by',
                'value' => function($model){
                    return $model->getUserFormated($model->updated_by, 'name surname');
                }
            ],
        ],
    ]) ?><br>
    <?php foreach ($dataProviders as $key => $dataProvider) : ?>
        <h6> <?php echo $key.'.'.ProgramData::getCategory($key); ?></h6>
        <?= GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'headerRowOptions' => ['style' => 'background-color: #0072B5', ],
                'showHeader' => false,
                'summary' => false,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    // 'id',
                    // 'gov_control_program_id',
                    // 'program_data_id',
                    [
                        'attribute' => 'program_data_id',
                        
                        'value' => function(ProgramProperty $model){
                            $program_data = ProgramData::findOne($model->program_data_id);
                            return $program_data->content;
                        }
                ],
                    // 'comment:ntext',
                    // 'created_at',
                    //'updated_at',
                    //'created_by',
                    //'updated_by',
                    // [
                    //     'class' => ActionColumn::className(),
                    //     'urlCreator' => function ($action, ProgramProperty $model, $key, $index, $column) {
                    //         return Url::toRoute([$action, 'id' => $model->id]);
                    //      }
                    // ],
                ],
            ]); ?>
    <?php endforeach ?>

</div>
