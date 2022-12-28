<?php

use common\models\prevention\Prevention;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Bartaraf etish ko\'rsatmasi');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prevention-index">

    



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=> 'instructions_id',
                'value' => function ($data) {
                    return $data ? $data->instruction->command_number : '';
                }
            ],
            [
                'attribute'=> 'companies_id',
                'value' => function ($data) {
                    return $data ? $data->company->name : '';
                }
            ],
            'message_date',
            //'comment:ntext',
            //'inspector_name',
            //'inspectors',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Prevention $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
