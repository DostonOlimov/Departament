<?php

use common\models\AttachedExecutor;
use common\models\User;
use frontend\widgets\StepsGovControl;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\Order $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
// debug(Yii::$app->request->url);
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?php if ($model->getPermissionInspector('download',$model->status) == true):?>
            <?= Html::a('Yuklab olish', [Yii::$app->request->url
                // 'document', 'id' => $model->id
                ], ['class' => 'btn btn-info'])?>
        <?php endif ?>

        <?php if ($model->getPermissionInspector('send',$model->status) == true):?>
            <?= Html::a('Rahbarga yuborish', ['change-status', 'id' => $model->id, 'status' => $model::DOCUMENT_STATUS_SENT], ['class' => 'btn btn-primary']) ?>
        <?php endif ?>

        <?php if ($model->getPermissionInspector('update',$model->status) == true):?>
            <?= Html::a('yangilash', ['update', 'id' => $model->id], ['class' => 'btn btn-info'])?>
        <?php endif ?>  

        <?php if ($model->getPermissionInspector('delete',$model->status) == true):?>
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
                'parent_id',
                'gov_control_program_id',
                'control_period_from',
                'control_period_to',
                'control_date_from',
                'control_date_to',
                'ombudsman_code_date',
                'ombudsman_code_number',
                [
                    'attribute' => 'order_number',
                    'value' => function($model){
                        return($model->order_number) ? $model->getGovControlPrefix($model->order_prefix).'-'.$model->order_number : $model->order_number;
                    }
                ],
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
                'created_at',
                'updated_at',
                [
                    'attribute' => 'created_by',
                    'value' => function($model){
                        return $model->getUserFormated($model->created_by, 'name surname');
                    }
                ],
                [
                    'attribute' => 'updated_by',
                    'value' => function($model){
                        return $model->getUserFormated($model->updated_by, 'name surname');
                    }
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
</div>
</div>
