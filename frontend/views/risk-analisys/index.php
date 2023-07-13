<?php

use common\models\RiskAnalisys;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\models\Company;
use common\models\User;
/** @var yii\web\View $this */
/** @var common\models\RiskAnalisysSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Xavf tahlili';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="risk-analisys-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Yaratish', ['search'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'headerRowOptions' => ['style' => 'background-color: #0072B5'],       
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'company_id',
                'value' => function($model){
                    return Company::findOne(['id' => $model->company_id])->company_name;
                }
            ],
            'risk_analisys_date',
            [
                'class' => ActionColumn::class,
                'buttonOptions' => [
                    'class' => 'text-primary'
                ],
                'urlCreator' => function ($action, RiskAnalisys $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                 'template' => '{view}',
                ],
                //'criteria',
                ['attribute' => 'created_by',
                'value' => function($model){
                    $user = User::findOne(['id' => $model->created_by]);
                    return $user->name ." ". $user->surname;}
                ],
                //'updated_by',
                'created_at',
                //'updated_at',
        ]]
    ); ?>


</div>
