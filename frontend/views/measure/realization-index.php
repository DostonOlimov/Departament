<?php

use common\models\control\Company;
use common\models\control\Instruction;
use common\models\control\Measure;
use frontend\models\StatusHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use frontend\widgets\StepsReestr;
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
<h2>Realizatsiyani taqiqlash</h2>

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
                        return Html::a($company->name, ['/control/company-view', 'id' => $model->id], ['class' => 'text-primary']);
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
                        return Html::a($company->inn, ['/control/company-view', 'id' => $model->id], ['class' => 'text-primary']);
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
                'label' => 'Realizatsiyani taqiqlash',
                'value' => function ($model) {
                    $company = Company::findOne(['control_instruction_id' => $model->id]);
                    if ($company) {
                        return Html::a('qo\'shish', ['/control/company-view', 'id' => $model->id], ['class' => 'text-primary']);
                    }
                    return '';
                },
                'format' => 'raw',
            ],
        ],
    ]); ?>


</div>
