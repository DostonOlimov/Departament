<?php

use common\models\measure\Executions;
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
            'fine_amount',
            'paid_amount',
            //'band_mjtk',
            //'explanation_letter',
            //'claim',
            //'court_letter',
            //'person_position:ntext',
            //'first_date',
            //'caution_number',
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
        ],
    ]); ?>


</div>
