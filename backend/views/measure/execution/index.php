<?php

use common\models\measure\Executions;
use common\models\measure\CourtDecision;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\models\User;

/** @var yii\web\View $this */
/** @var common\models\measure\ExecutionsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Ma\'muriy bayonnomalar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="executions-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'person',
            'number_passport',
            [
                'attribute' => 'created_by',
                'label' => 'Mutaxassis',
                'value' => function ($model) {
                    $re_users = '';
                    $name =  User::findOne([$model->created_by]);
                    if($name) {
                        $re_users .= $name->username;
                    }
                    return $re_users;
                },
             ],
            //'updated_by',
            'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Executions $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
            [  'label' => 'Sud qarori',
            'value' => function($model){
            $decision = CourtDecision::findOne(['execution_id' => $model->id]);
             return  $decision ? Html::a('<span>Ko\'rish</span> ', ['..\court-decision\view','id'=>$model->id], ['title' => 'view','class'=>'btn btn-success'])
             : Html::a('<span>Qo\'shish</span> ', ['..\court-decision\create','id'=>$model->id], ['title' => 'view','class'=>'btn btn-success']);
           
        },
            'format'=>'raw',
        ],
        ],
    ]); ?>


</div>
