<?php

use common\models\govcontrol\ProgramData;
use common\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\ProgramData $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Program Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="program-data-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'id',
            'content:ntext',
            'document_refer_id',
            // 'status',
            [
                'attribute' => 'status',
                'value' => function(ProgramData $model){
                    return $model->getStatus($model->status);
                }
            ],
            'comment:ntext',
            // 'category_id',
            [
                'attribute' => 'category_id',
                'value' => function(ProgramData $model){
                    return $model->getCategory($model->category_id);
                }
            ],
            'created_at',
            'updated_at',
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
        ],
    ]) ?>

</div>
