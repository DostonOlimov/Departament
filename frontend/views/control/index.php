<?php

use common\models\control\Company;
use common\models\control\Instruction;
use common\models\control\Measure;
use common\models\control\PrimaryData;
use frontend\models\StatusHelper;
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
<div class="company-index m-5">

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
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttonOptions' => [
                    'class' => 'text-primary'
                ],
                /*'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('', $url);
                    },
                ],*/
                'urlCreator' => function ($action, $searchmodel, $key, $index) {
                    if ($action === 'view') {
                        $url = Url::to(['control/instruction-view', 'id' => $searchmodel->id]);
                        return $url;
                    }
                }
            ],
            [
                'label' => 'Xyus nomi',
                'value' => function ($model) {
                    $company = Company::findOne(['control_instruction_id' => $model->id]);
                    if ($company) {
                        return Html::a($company->name, ['/control/instruction-view', 'id' => $model->id], ['class' => 'text-primary']);
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
                        return Html::a($company->inn, ['/control/instruction-view', 'id' => $model->id], ['class' => 'text-primary']);
                    }
                    return '';
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Xyus yuridik manzili',
                'value' => function ($model) {
                    $company = Company::findOne(['control_instruction_id' => $model->id]);
                    if ($company) {
                        return $company->address;
                    }
                    return '';
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Xyus faoliyat turi',
                'value' => function ($model) {
                    $company = Company::findOne(['control_instruction_id' => $model->id]);
                    if ($company) {
                        return $company->type;
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
            [   
                'label' => 'Asos',
                'value' => function (Instruction $model) {
                    return Instruction::getType($model->type);
                }
            ],
            [
                'label' => 'Status',
                'value' => function ($model) {
                   // $company_id = Company::findOne(['control_instruction_id' => $model->id])->id;
                   // $data = PrimaryData::findOne(['company_id' => $company_id ]);
                   
                        return StatusHelper::getLabel($model->general_status);
                   /* }
                    else
                    {
                        return 'yangi tekshiruv';
                    }
                    */
                },
                'format' => 'raw'
            ],
        ],
    ]); ?>


</div>
