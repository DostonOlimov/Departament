<?php

use common\models\Company;
use common\models\RiskAnalisys;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\models\User;
use kartik\export\ExportMenu;

/** @var yii\web\View $this */
/** @var common\models\RiskAnalisysSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Xavf tahlili';
$this->params['breadcrumbs'][] = $this->title;
// debug($dataProvider);
?>
<div class="risk-analisys-index">

    <!-- <p>
        <?= Html::a('Yaratish', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->
    <p>
        <?= Html::a('Me\'zonlar', Url::to(['risk-criteria/index']), ['class' => 'btn btn-info']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'company_id',
                'value' => function($model){
                    return Company::findOne(['id' => $model->company_id])->company_name;
                }
            ],
            
            'risk_analisys_date',
            'risk_analisys_number',
            [
                'attribute' => 'created_by',
                'value' => function($model){
                    $user = User::findOne(['id' => $model->created_by]);
                    return $user->name.' '.$user->surname;

                }
            ],
            //'updated_by',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, RiskAnalisys $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
