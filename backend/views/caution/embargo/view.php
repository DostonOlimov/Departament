<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Url;
use common\models\User;
use common\models\embargo\Embargo;

/** @var yii\web\View $this */
/** @var common\models\embargo\Embargo $model */

$this->title = 'Yozma ko\'rsatma № '.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Taqiqlash ko\'rsatmasi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="embargo-view">
<?php
    echo Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => [
        'class' => 'breadcrumb float-sm-right'
                ]
        ]);
    ?>
    <p>
        <?php if($model->status == 0):?>
        <?= Html::a(Yii::t('app', 'Tahrirlash'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif;?>
        <?php if($model->status == 1):?>
            <?php if(empty($model->file)):?>
        <?= Html::a(Yii::t('app', 'File yuklash'), ['uploads', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif;?>
        <?php endif;?>
        <!--?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?-->
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'Tekshiruv kodi',
                'value' => function ($data) {
                    return $data ? $data->instruction->command_number : '';
                }
            ],
            [
                'attribute' => 'Korxona nomi',
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
                        return '<span class="btn btn-alert text-dark">Bekor qilingan</span>';   
                    }
                },
                
                'format' => 'raw',
            ],
            [
                'attribute' => 'file',
                'value' => function(Embargo $model) {
                    $model->s_file = $model->file;
                    return $model->s_file ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('s_file') . '" download>Yuklash<a/>' : 'Yuklanmagan';

                },
                'format' => 'raw'
            ],
            //'file',
            //'message_date',
            //'created_at',
            'updated_at',
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
                        if($model->status == 1){               
                        return $user ? $user->name .' '.$user->surname :'';
                        }return '';
                    }
                ],
            
           // 'inspectors',
        ],
    ]) ?>
   


</div>
