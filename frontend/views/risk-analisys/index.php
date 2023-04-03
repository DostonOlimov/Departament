<?php

use common\models\RiskAnalisys;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\RiskAnalisysSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Risk Analisys';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="risk-analisys-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Risk Analisys', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'company_id',
            'risk_analisys_date',
            'risk_analisys_number',
            //'criteria',
            //'created_by',
            //'updated_by',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, RiskAnalisys $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
            [
                'label' => 'Mezon qo\'shish',
                'value' => function ($model) {
                  
                    {
                        return Html::a('Yaratish', ['add-criteria', 'id' => $model->id], ['class' => 'btn btn-success']);
                    }
                },
                'format' => 'raw'
            ],
        ],
    ]); ?>


</div>
