<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Region;
use common\models\User;

/** @var yii\web\View $this */
/** @var common\models\Company $model */

$this->title = $model->company_name.' ma\'lumotlarini yangilash';
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="company-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'stir',
            'company_name',
            'registration_date',
            [
                'attribute' => 'region_id',
                'value' => function($model){
                    return Region::findOne(['id' => $model->region_id])->name ;
                }
            ],
            'address',
            'thsht',
            'ifut',
            'ownername',
            'phone',
            [   
                'attribute' => 'status',
                'value' => $model->getStatus($model->status),
            ],
            [
                'attribute' => 'created_by',
                'value' => function($model){
                    return User::findOne(['id' => $model->created_by])->name ;
                }
            ],
            [
                'attribute' => 'updated_by',
                'value' => function($model){
                    return User::findOne(['id' => $model->created_by])->name ;
                }
            ],
            // 'created_by',
            // 'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
