<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\prevention\Prevention $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bartaraf etish ko\'rsatmasi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = '№'.' '. $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="prevention-view">

    

    <p>
        <?= Html::a(Yii::t('app', 'Tahrirlash'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
           
            'message_date',
            'comment',
            'inspector_name',
           // 'inspectors',
        ],
    ]) ?>

</div>