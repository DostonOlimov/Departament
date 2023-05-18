<?php

use common\models\control\Company;
use common\models\control\Instruction;
use common\models\control\Measure;
use common\models\control\PrimaryData;
use common\models\RiskAnalisysCriteria;
use frontend\models\StatusHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use frontend\widgets\StepsRiskAnalisys;

/* @var $this yii\web\View */
/* @var $searchModel common\models\control\InstructionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Korxonalar';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="row">
    <div class="col-3 mt-5">
        <?php echo StepsRiskAnalisys::widget([
            'company_id' => $model->company_id,
            'id' => $model->id,
            'view_id' => 1,
            ])
        // echo debug($model);die;?>
    </div>
    <div class="col-6 mt-5">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'headerRowOptions' => ['style' => 'background-color: #0072B5'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

            // 'id', 
            // 'criteria_id',
            [
                'attribute' => 'criteria_id',
                'value' => function ($model){
                    $criteria = RiskAnalisysCriteria::findone(['id' => $model->criteria_id]);
                    return $criteria->document_paragraph  . " . ". $criteria->criteria . " (" . $criteria->criteria_score . " ball)";
                }
            ],
            'comment', 
            // 'risk_analisys_id', 

        
            ],
        ]); ?>

    </div>
</div>
