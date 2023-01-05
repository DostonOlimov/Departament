<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\prevention\Prevention $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bartaraf_etish'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$this->title = Yii::t('app', 'Bartaraf_etish');
?>
<div class="container">


    <?= DetailView::widget([
        'model' => $model,
        
        'attributes' => [
            [
                'label' => 'Yozma ko\'rsatma raqami',
                'value' => function ($data) {
                   // $prevention = Prevention::findOne(['id' => $model->id]);
                    return $data ? $data->id : '';
                }
            ],
            [
                'label' => 'Korxona',
                'value' => function ($data) {
                    //$company = Company::findOne(['id' => $model->companies_id]);
                    return $data ? $data->company->name : '';
                }
            ],
            [
                'label' => 'Korxona INN',
                'value' => function ($data) {
                    //$company = Company::findOne(['id' => $model->companies_id]);
                    return $data ? $data->company->inn : '';
                }
            ],

            [
                'label' => 'Korxona manzili',
                'value' => function ($data) {
                    //$company = Company::findOne(['id' => $model->companies_id]);
                    return $data ? $data->company->address : '';
                }
            ],
            [
                'label' => 'Korxona telefon raqami',
                'value' => function ($data) {
                    // $company = Company::findOne(['id' => $model->companies_id]);
                    return $data ? $data->company->phone : '';
                }
            ],

            [
                'label' => 'Tekshiruv kodi',
                'value' => function ($data) {
                    // $instruction = Instruction::findOne(['id' => $model->instructions_id]);
                    return $data ? $data->instruction->command_number : '';
                }
            ],
           
            'created_at',
            'updated_at',
            'comment',
            [
                'attribute'=> 'created_by',
                'value' => function ($data) {
                   // $instruction = Instruction::findOne(['id' => $model->instructions_id]);
                    return $data ? $data->user->name .' '. $data->user->surname  : '';
                }
            ],
        ],
    ]) ?>

</div>
