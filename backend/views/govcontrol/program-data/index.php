<?php

use common\models\govcontrol\ProgramData;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\ProgramDataSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tekshiruv dasturi shablonlari';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-data-index">

    <p>
        <?= Html::a('Yaratish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'content:ntext',
            'document_refer_id',
            // 'status',
            [
                'attribute' => 'status',
                'value' => function(ProgramData $model){
                    return $model->getStatus($model->status);
                }
            ],
            'comment:ntext',
            //'category_id',
            [
                'attribute' => 'category_id',
                'value' => function(ProgramData $model){
                    return $model->getCategory($model->category_id);
                }
            ],
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, ProgramData $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
