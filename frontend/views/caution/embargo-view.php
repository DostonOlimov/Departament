<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\control\Company;
use common\models\prevention\Prevention;
use common\models\control\Instruction;
use common\models\embargo\Embargo;
use common\models\User;
use frontend\widgets\StepsReestr;
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Url;


/** @var yii\web\View $this */
/** @var common\models\embargo\Embargo $model */
if($model->status == 2){
    $this->title = $model->instruction->controlCompany->name;
}else{
    $this->title = $model->message_number; 
}
// $this->title = $model->instruction->controlCompany->name;
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
                        'value'=>function($model){
                            if($model->status === 1){
                            return $model->message_number;
                            }else{
                                return '';
                            }
                        }
                    ],
                   
                        
                        [
                            'label' => 'Korxona',
                            'value' => function ($data) {   
                                return $data ? $data->instruction->controlCompany->name : '';
                            }
                        ],
                        [
                            'label' => 'Korxona INN',
                            'value' => function ($data) {
                                return $data ? $data->instruction->controlCompany->inn : '';
                            }
                        ],
            
                        [
                            'label' => 'Korxona manzili',
                            'value' => function ($data) {
                                return $data ? $data->instruction->controlCompany->address : '';
                            }
                        ],
                        [
                            'label' => 'Korxona telefon raqami',
                            'value' => function ($data) {
                                return $data ? $data->instruction->controlCompany->phone : '';
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
                                return '<span class="btn btn-warning text-dark">Jarayonda</span>';
                            //return $model->status ? '<span class="text-primary">Tasdiqlangan</span>':'<span class="text-warning">Jarayonda</span>'?:'<span class="text-alert">Bekor qilingan</span>';
                            }elseif($model->status == 1){
                                return '<span class="btn btn-primary text-light">Tasdiqlangan</span>';
                            }else{
                                return '<span class="btn btn-danger text-light">Bekor qilingan</span>';   
                            }
                        },
                        
                        'format' => 'raw',
                    ],
                    //'status',
                    [
                        'attribute' => 'file',
                        'value' => function ($model) {
                            $model->s_file = $model->file;
                            return $model->s_file ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('s_file') . '" download>Yuklash<a/>' : 'Yuklanmagan';
    
                        },
                        'format' => 'raw'
                    ],
                    
                    
                    [
                        'attribute'=> 'created_by',
                        'value'=> function($model){
                            $user = User::findOne($model->created_by);
                            return $user ? $user->name .' '.$user->surname :'';
                        }
                        ],
                        [
                            'attribute'=> 'updated_by',
                            'value'=> function($model){
                                $user = User::findOne($model->updated_by);
                                          
                                return $user ? $user->name .' '.$user->surname :'';
                            }
                            
                        ],
                    //'created_at',
                    'updated_at',
                ],
            ]) ?>
            
    </div>

</div>
