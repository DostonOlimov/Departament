<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap4\Breadcrumbs;
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

            'comment',
            [
                'attribute'=> 'created_by',
                'value'=> function($data){
                    return $data ? $data->user->name . ' '.$data->user->surname :'';
                }
            ]
        ],
    ]) ?>
    
    <div class="embed-responsive embed-responsive-16by9">
    <?php if(!empty($model->file)):?>
    <iframe class="iframemargins" src="<?php echo Url::to("@frontend/web/uploads/caution_prevention/{$model->file}", true);?>" 
        title="PDF in an i-Frame" frameborder="0" scrolling="auto" width="100%" 
        height="600px">
    </iframe>
    <?php endif;?>
    </div>

</div>
