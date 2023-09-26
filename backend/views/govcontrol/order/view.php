<?php

use common\models\AttachedExecutor;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\Order $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?php if ($model->getPermissionAdmin('update',$model->status) == true):?>
            <?= Html::a('Yangilash', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif ?>

        <?php if ($model->getPermissionAdmin('confirm',$model->status) == true):?>
            <?= Html::a('Tasqidlash', ['confirm', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif ?>
            
        <?php if ($model->getPermissionAdmin('return',$model->status) == true):?>
            <?= Html::a('Tahrirlashga qaytarish', ['change-status', 'id' => $model->id, 'status' => $model::DOCUMENT_STATUS_RETURNED], ['class' => 'btn btn-primary']) ?>
        <?php endif ?>

        <?php if ($model->getPermissionAdmin('deny',$model->status) == true):?>
            <?= Html::a('Rad etish', ['change-status', 'id' => $model->id, 'status' => $model::DOCUMENT_STATUS_DENIED], ['class' => 'btn btn-danger']) ?>
        <?php endif ?>

        <?php if ($model->getPermissionAdmin('delete',$model->status) == true):?>
            <?= Html::a('O\'chirish', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                    ],
                    ]) ?>
        <?php endif ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'gov_control_program_id',
            'parent_id',
            [
                'attribute' => 'order_number',
                'value' => function($model){
                    return($model->order_number) ? $model->getGovControlPrefix($model->order_prefix).'-'.$model->order_number : $model->order_number;
                }
            ],
            'control_period_from',
            'control_period_to',
            'control_date_from',
            'control_date_to',
            'ombudsman_code_date',
            'ombudsman_code_number',
            [
                'attribute' => 'status',
                'value' => function($model){
                    if($model->status){
                        if($model->status){
                            return $model->getStatusSpan($model->status);
                        }
                    }
                },
                'format' => 'raw',   
            ],
            [
                'attribute' => 'executors',
                'value' => function($model){
                    $users = AttachedExecutor::find()->where(['gov_control_order_id' => $model->id])->all();
                    $result = '';
                    foreach($users as $user){
                        $result .= '<span class="badge badge-pill badge-info">' . $user->user->name . ' ' . $user->user->surname . '</span><br>';
                    }
                    return $result;
                    // debug($result);

                },
                'format' => 'raw'
            ],
        ],
    ]) ?>

</div>
