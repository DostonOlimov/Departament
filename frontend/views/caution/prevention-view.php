<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\widgets\StepsPrevention;
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\prevention\Prevention $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bartaraf_etish'), 'url' => ['prevention']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$this->title = Yii::t('app', 'Bartaraf_etish');
?>
<div class="row">
    <div class="col-sm-4">
        <?= StepsPrevention::widget([
                        
        ])?>
    </div>

    <div class="col-sm-8" style="margin-left:-20px">
    
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
            
                //'created_at',
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
         <?php if(!empty($model->file)):?>
        <iframe class="iframemargins" src="<?php echo Url::to("@web/uploads/caution_prevention/{$model->file}", true);?>" 
            title="PDF in an i-Frame" frameborder="0" scrolling="auto" width="100%" 
            height="600px">
        </iframe>
        <?php endif;?>
        </div>
    </div>
</div>
