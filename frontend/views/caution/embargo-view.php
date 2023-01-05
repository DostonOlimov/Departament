<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\control\Company;
use common\models\prevention\Prevention;
use common\models\control\Instruction;
use common\models\embargo\Embargo;
use frontend\widgets\StepsEmbargo;
use yii\bootstrap4\Breadcrumbs;


/** @var yii\web\View $this */
/** @var common\models\embargo\Embargo $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Taqiqlash'), 'url' => ['embargo']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="col-4">
            <?= StepsEmbargo::widget([
                    
            ])?>     
     </div>

    <div class="col-sm-8" style="margin-left:-30px;">
        <p>
            <!--?= $model->status;?-->
            <?php if($model->status == 0):?>
            <?= Html::a(Yii::t('app', 'Tahrirlash'), ['embargo-update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?php endif;?>
            <?php
            echo Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                 'options' => [
                'class' => 'breadcrumb float-sm-right'
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
                            if($model->status==1){
                            return $model->status==1 ? '<span class="text-primary">Tasdiqlangan</span>':'<span class="text-warning">Jarayonda</span>'?:'<span class="text-alert">Bekor qilingan</span>';
                            }elseif($model->status==2){
                                return $model->status==2 ? '<span class="text-danger">Bekor qilingan</span>':'<span class="text-warning">Jarayonda</span>'?:'<span class="text-alert">Bekor qilingan</span>';  
                            }else{
                                return $model->status==0 ? '<span class="text-warning">Jarayonda</span>':'<span class="text-warning">Jarayonda</span>'?:'<span class="text-alert">Bekor qilingan</span>';   
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
