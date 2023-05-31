<?php

use common\models\Company;
use common\models\Region;
use common\models\RiskAnalisys;
use common\models\RiskAnalisysCriteria;
use common\models\RisksCriteria;
use common\models\User;
use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\RisksCriteriaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Xavf tahlili natijalari';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="risks-criteria-index">

    <p>
        <!-- <?= Html::a('Create Risks Criteria', ['create'], ['class' => 'btn btn-success']) ?> -->
        <?= Html::a('Xavf tahlili', Url::to(['risk-analisys/index']), ['class' => 'btn btn-info']) ?>
    </p>


    <?php 
    $serial_column = [[
        'class' => 'yii\grid\SerialColumn']
    ];
    $grid_column = [
        // 'id',
        // 'risk_analisys_id',
        [
            'attribute' => 'risk_analisys_number',
            'value' => function($model){
                return RiskAnalisys::findOne(['id' => $model->risk_analisys_id])->risk_analisys_number;
            }
        ],
        [
            'attribute' => 'company_id',
            'value' => function($model){
                $risk_analisys = RiskAnalisys::findOne(['id' => $model->risk_analisys_id]);
                $company = Company::findOne($risk_analisys->company_id);
                return $company->company_name;
            }
        ],
        [
            'attribute' => 'STIR',
            'value' => function($model){
                $risk_analisys = RiskAnalisys::findOne(['id' => $model->risk_analisys_id]);
                $company = Company::findOne($risk_analisys->company_id);
                return $company->stir;
            }
        ],
        [
            'attribute' => 'region_id',
            'value' => function($model){
                $risk_analisys = RiskAnalisys::findOne(['id' => $model->risk_analisys_id]);
                $company = Company::findOne($risk_analisys->company_id);
                $region = Region::findOne($company->region_id);
                return $region->name;
            }
        ],
        [
            'attribute' => 'risk_analisys_date',
            'value' => function($model){
                return RiskAnalisys::findOne(['id' => $model->risk_analisys_id])->risk_analisys_date;
            }
        ],
        // 'criteria_id',
        [
            'attribute' => 'document_paragraph',
            'value' => function($model){
                $risk_analisys = RiskAnalisysCriteria::findOne(['id' => $model->criteria_id]);
                
                return $risk_analisys->document_paragraph;
            }
        ],
        'comment',
        [
            'attribute' => 'criteria_score',
            'value' => function($model){
                $risk_analisys = RiskAnalisysCriteria::findOne(['id' => $model->criteria_id]);
                
                return $risk_analisys->criteria_score;
            }
        ],
        [
            'attribute' => 'created_by',
            'value' => function($model){
                $risk_analisys = RiskAnalisys::findOne(['id' => $model->risk_analisys_id]);
                $user = User::findOne($risk_analisys->created_by);
                return $user->name. ' '. $user->surname;
            }
        ],
    ];
    $action_column = [['class' => ActionColumn::class,
    'urlCreator' => function ($action, RisksCriteria $model, $key, $index, $column) {
        return Url::toRoute([$action, 'id' => $model->id]);
     }]
        
        ];
    $grid_columns = array_merge(
        $serial_column, 
        $grid_column,
        $action_column
    );
    // debug($grid_columns);
    
    ?>
    <?= ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' =>$grid_columns,
        'filename' => $this->title.' '. date('d.m.Y'),])?>
        
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $grid_columns
    ]); ?>


</div>
