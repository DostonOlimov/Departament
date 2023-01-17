<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\control\Company;
use common\models\prevention\Prevention;
use common\models\control\Instruction;
use common\models\embargo\Embargo;
use frontend\widgets\StepsReestr;
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Url;


/** @var yii\web\View $this */
/** @var common\models\embargo\Embargo $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Taqiqlash'), 'url' => ['embargo']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="col-3">
        <?= StepsReestr::widget([])?>
    </div>

    <div class="col-sm-8">
        <p>
            <!--?= $model->status;?-->
            <?php if($model->status == 0):?>
            <?= Html::a(Yii::t('app', 'Tahrirlash'), ['embargo-update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?php endif;?>
            <?php
            echo Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                 'options' => [
                'class' => 'p-2 bg-primary breadcrumb float-sm-right'
                        ]
                ]);
            ?>
        </p>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'label' => 'Yozma ko\'rsatma raqami',
                        'value' => function ($data) {   
                            return $data ? $data->id : '';
                        }
                    ],
                        
                        [
                            'label' => 'Korxona',
                            'value' => function ($data) {   
                                return $data ? $data->company->name : '';
                            }
                        ],
                        [
                            'label' => 'Korxona INN',
                            'value' => function ($data) {
                                return $data ? $data->company->inn : '';
                            }
                        ],
            
                        [
                            'label' => 'Korxona manzili',
                            'value' => function ($data) {
                                return $data ? $data->company->address : '';
                            }
                        ],
                        [
                            'label' => 'Korxona telefon raqami',
                            'value' => function ($data) {
                                return $data ? $data->company->phone : '';
                            }
                        ],
            
                        [
                            'label' => 'Tekshiruv kodi',
                            'value' => function ($data) {
                                return $data ? $data->instruction->command_number : '';
                            }
                        ],

                    
                    'comment:ntext',
                    [
                        'attribute' => 'status',
                        'value' => function($model){
                            if($model->status == null){
                                return '<span class="text-warning">Jarayonda</span>';
                            //return $model->status ? '<span class="text-primary">Tasdiqlangan</span>':'<span class="text-warning">Jarayonda</span>'?:'<span class="text-alert">Bekor qilingan</span>';
                            }elseif($model->status == 1){
                                return '<span class="text-primary">Tasdiqlangan</span>';
                            }else{
                                return '<span class="text-alert">Bekor qilingan</span>';   
                            }
                        },
                        
                        'format' => 'raw',
                    ],
                    //'status',
                    
                    [
                        'attribute'=> 'created_by',
                        'value' => function ($data) {
                        // $instruction = Instruction::findOne(['id' => $model->instructions_id]);
                            return $data ? $data->user->name .' '. $data->user->surname  : '';
                        }
                    ],
                    //'created_at',
                    'updated_at',
                ],
            ]) ?>
            
    </div>

</div>
