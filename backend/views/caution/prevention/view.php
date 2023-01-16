<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap4\Breadcrumbs;
use common\models\prevention\Prevention;
use yii\helpers\Url;
/** @var yii\web\View $this */
/** @var common\models\prevention\Prevention $model */

$this->title = 'Yozma ko\'rsatma № '.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bartaraf etish ko\'rsatmasi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = '№'.' '. $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="prevention-view">
    <?php
    echo Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        'options' => [
        'class' => 'breadcrumb float-sm-right'
                ]
        ]);
    ?>
<p>
       
        <?= Html::a(Yii::t('app', 'Tahrirlash'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?php if(empty($model->file)):?>
            <?= Html::a(Yii::t('app', 'File yuklash'), ['uploads', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?php endif;?>
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
           
            //'message_date',
            //'created_at',
            'created_at',
            //'file',
            [
                'attribute' => 'file',
                'value' => function(Prevention $model) {
                    $model->s_file = $model->file;
                    return $model->s_file ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('s_file') . '" download>Yuklash<a/>' : 'Yuklanmagan';

                },
                'format' => 'raw'
            ],

            'comment',
            [
                'attribute'=> 'created_by',
                'value'=> function($data){
                    return $data ? $data->user->name . ' '.$data->user->surname :'';
                }
            ]
        ],
    ]) ?>
    
    

</div>
