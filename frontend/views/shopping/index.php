<?php

use common\models\shopping\Company;
use common\models\shopping\Instruction;
use common\models\shopping\Product;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\shopping\InstructionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Korxonalar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index m-5">

    <p>
        <?= Html::a('Qo\'shish', ['/shopping/instruction'], ['class' => 'btn btn-success'])  ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'headerRowOptions' => ['style' => 'background-color: #0072B5'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Hudud',
                'value' => function ($model) {
                    $company = Company::findOne(['shopping_instruction_id' => $model->id]);
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
                        $url = Url::to(['shopping/instruction-view', 'id' => $searchmodel->id]);
                        return $url;
                    }
                }
            ],
            [
                'label' => 'Xyus nomi',
                'value' => function ($model) {
                    $company = Company::findOne(['shopping_instruction_id' => $model->id]);
                    if ($company) {
                        return Html::a($company->name, ['/shopping/instruction-view', 'id' => $model->id], ['class' => 'text-primary']);
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Xyus inn',
                'value' => function ($model) {
                    $company = Company::findOne(['shopping_instruction_id' => $model->id]);
                    if ($company) {
                        return Html::a($company->inn, ['/shopping/instruction-view', 'id' => $model->id], ['class' => 'text-primary']);
                    }
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Xyus yuridik manzili',
                'value' => function ($model) {
                    $company = Company::findOne(['shopping_instruction_id' => $model->id]);
                    if ($company) {
                        return $company->address;
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Mahsulot nomi',
                'value' => function ($model) {
                    return '';
                }
            ],
            [
                'label' => 'Asos',
                'value' => function ($model) {
                    return Instruction::getType($model->base);
                }
            ],
            [
                'label' => 'Status',
                'value' => function ($model) {
                    $company = Company::findOne(['shopping_instruction_id' => $model->id]);
                    if ($company) {
                        if (Product::findOne(['shopping_company_id' => $company->id])) {
                            return '<label style="color: blue">Bajarildi</labelsty>';
                        } else {
                            return '<label style="color: orange">Jarayonda</labelsty>';
                        }
                    } else {
                        return '<label style="color: orange">Jarayonda</labelsty>';
                    }
                },
                'format' => 'raw'
            ],
            //'created_by',
            //'updated_by',
            //'created_at',
            //'updated_at',

//            'phone',
        ],
    ]); ?>


</div>
