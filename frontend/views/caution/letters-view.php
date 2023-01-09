<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\widgets\StepsPrevention;
use yii\bootstrap4\Breadcrumbs;


$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ogohlantirish_xati'), 'url' => ['letters']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$this->title = Yii::t('app', 'Bartaraf_etish');
?>
<div class="row">
    <div class="col-sm-4">
        <?= StepsPrevention::widget([
                        
        ])?>
    </div>

    <div class="col-sm-8" style="margin-left:-30px">
    
                    <?php
                        echo Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            'options' => [
                                'class' => 'p-2 bg-primary breadcrumb float-sm-right'
                            ]
                        ]);
                        ?>
                
        <?= DetailView::widget([
            'model' => $model,
            
            'attributes' => [
                [
                    'label' => '№',
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
            
                //'created_at',
                'letter_date',
                'letter_number',
                'file',
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
</div>
