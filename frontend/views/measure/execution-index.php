<?php

use common\models\control\Company;
use common\models\control\Instruction;
use common\models\measure\Executions;
use common\models\control\Measure;
use frontend\widgets\StepsReestr;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\control\InstructionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Korxonalar';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .pagination li a {
        padding: 2px 5px;
    }

    .pagination li.active {
        background-color: #1AB475;
    }

    .pagination li a {
        color: black;
    }

    .pagination li a:hover {
        background-color: grey;
    }
</style>
<div class="row">
<div class="col-3 mt-5">
<?= StepsReestr::widget([])?>
</div>
<div class="col-9">
<h2>Ma'muriy bayonnomalar</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'headerRowOptions' => ['style' => 'background-color: #0072B5'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          [
                'label' => 'Hudud',
                'value' => function ($model) {
                    $company = Company::findOne(['control_instruction_id' => $model->id]);
                    return $company ? $company->region->name : '';
                }
            ],
              [
                'label' => 'Xyus nomi',
                'value' => function ($model) {
                    $company = Company::findOne(['control_instruction_id' => $model->id]);
                    if ($company) {
                        return $company->name;
                       // return Html::a($company->name, ['/control/company-view', 'id' => $company->id], ['class' => 'text-primary']);
                    }
                    return '';
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Xyus inn',
                'value' => function ($model) {
                    $company = Company::findOne(['control_instruction_id' => $model->id]);
                    if ($company) {
                        return $company->inn;
                       // return Html::a($company->inn, ['/control/company-view', 'id' => $company->id], ['class' => 'text-primary']);
                    }
                    return '';
                },
                'format' => 'raw',
            ],
            [   
                'label' => 'Buyruq nomeri',
                'value' => function (Instruction $model) {
                    return $model->command_number;
                }
            ],
            [
                'label' => 'Ma\'muriy jarimalar',
                'value' => function ($model) {
                    $ex = Executions::findOne(['control_instruction_id' => $model->id]);
                    if ($ex) {
                        return Html::a('Ko\'rish&nbsp&nbsp&nbsp&nbsp', ['/measure/execution-view', 'id' => $model->id], ['class' => 'btn bg-primary','style'=>'font-weight:bold; color:white;']);
                    }
                    else
                    {
                        return Html::a('Qo\'shish', ['/measure/execution', 'id' => $model->id], ['class' => 'btn bg-success','style'=>'font-weight:bold; color:white;']);
                    }
                   
                },
                'format' => 'raw',
            ],
        ],
    ]); ?>
    </div>  
</div>
