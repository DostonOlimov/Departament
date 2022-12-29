<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\embargo\Embargo $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Taqiqlash ko\'rsatmasi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="embargo-view">


    <p>
        <?php if($model->status === 0):?>
        <?= Html::a(Yii::t('app', 'Tahrirlash'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
                    return $data ? $data->company->name : '';
                }
            ],            
            'comment:ntext',
            'message_number',
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
            'message_date',
            'inspector_name',
           // 'inspectors',
        ],
    ]) ?>

</div>
