<?php

use common\models\Company;
use common\models\RiskAnalisys;
use common\models\User;
use kartik\date\DatePicker;
use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\RiskAnalisysSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Xavf tahlili';
$this->params['breadcrumbs'][] = $this->title;
$gridColumns = 
[
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
        'attribute' => 'summary_user_id',
        'value'  => function(RiskAnalisys $model){
            $summary_user = User::findOne($model->summary_user_id);
            if(!$summary_user){
                return "Kiritilmagan";
            }
            return ($summary_user->name).' '.($summary_user->surname) ?? "Xatolik";
        }
        
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
];

?>
<div class="risk-analisys-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="col-3">
    <?= $form->field($searchModel, 'start_date')->label(false)->widget(DatePicker::class, [
        'options' => ['placeholder' => 'Boshlanish vaqti'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd.mm.yyyy'
            ]
        ]); ?>
    </div>
    <div class="col-3">
        <?= $form->field($searchModel, 'end_date')->label(false)->widget(DatePicker::class, [
            'options' => ['placeholder' => 'Tugash vaqti'],
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd.mm.yyyy'
                ]
            ]); ?>  
    </div>
    <div class="form-group">
    <p>

        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
        </p>
<p>
    
    <?php ActiveForm::end(); ?>
    <?php echo ExportMenu::widget(['dataProvider' => $dataProvider,
            'columns' => $gridColumns,
            'filename' => 'Foydalanuvchilar ro\'yxati '. date('d.m.Y'),
        ]); ?>
</p>

    <p>
        <?= Html::a('Yaratish', ['search'], ['class' => 'btn btn-success']) ?>
    </p>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,   
            
            'columns' => [
                $gridColumns[0],
                $gridColumns[1],
                $gridColumns[2],
                $gridColumns[3],
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
                $gridColumns[4],
                $gridColumns[5],
                
                
                    ]]
                ); ?>


</div>
</div>
