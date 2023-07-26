<?php

use common\models\RiskAnalisys;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\models\Company;
use common\models\User;
use kartik\date\DatePicker;
use kartik\export\ExportMenu;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\RiskAnalisysSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Xavf tahlili';
$this->params['breadcrumbs'][] = $this->title;
// debug($searchModel);


?>

<div class="risk-analisys-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php 
    
    // echo $this->render('_search', ['model' => $searchModel]); ?>




    <p>
        <?= Html::a('Yaratish', ['search'], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?= Html::a('Yuklab olish (ilova-1)', ['export'], ['class' => 'btn btn-info']) ?>
    </p>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            // 'filterModel' => $searchModel,
            'headerRowOptions' => ['style' => 'background-color: #0072B5'],       
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'company_id',
                    'value' => function($model){
                        return Company::findOne(['id' => $model->company_id])->company_name;
                    }
                ],
                'risk_analisys_date',
                'risk_analisys_number',
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
                // 'summary_user_id',
                [
                    'attribute' => 'summary_user_id',
                    'value'  => function(RiskAnalisys $model){
                        $summary_user = User::findOne($model->summary_user_id);
                        if(!$summary_user){
                            return "Kiritilmagan";
                        }
                        return ($summary_user->name).' '.($summary_user->surname) ?? "Xatolik";
                    }
                    
                ],
                // 'criteria',

                // 'created_by',
                
                ['attribute' => 'created_by',
                'value' => function($model){
                        $user = User::findOne(['id' => $model->created_by]);
                        return $user->name ." ". $user->surname;}
                    ],
                    //'updated_by',
                    // 'created_at',
                    //'updated_at',
            ]
                ]); ?>


</div>
</div>



