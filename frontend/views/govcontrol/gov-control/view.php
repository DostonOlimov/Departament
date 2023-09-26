<?php

use common\models\AttachedExecutor;
use frontend\widgets\StepsGovControl;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\Order $model */

?>
<div class="gov-control-view row">
    <div class="col-3 mt-5">
        <?php echo StepsGovControl::widget(
            [
                'gov_control_order_id' => $model->id,
            ]
            )?>
    </div>
    <div class="col-6 mt-5">
    <h3>Tekshiruv dasturi to'g'risidagi ma'lumotlar</h3>
        <?php echo DetailView::widget([
                    'model' => $program,
                    'attributes' => [
                        'id',
                        [
                            'attribute' => 'status',
                            'value' => function($program){
                                if($program->status){
                                    return $program->getStatusSpan($program->status);
                                }
                            },
                            'format' => 'raw',   
                        ],
                        'created_at',
                        'created_by',
                ],
            ]); ?>
    <h3>Tekshiruv buyrug'i to'g'risidagi ma'lumotlar</h3>
        <?php echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'parent_id',
                        [
                            'attribute' => 'order_number',
                            'value' => function($model){
                                return($model->order_number) ? $model->getGovControlPrefix($model->order_prefix).'-'.$model->order_number : $model->order_number;
                            }
                        ],
                        'gov_control_program_id',
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
                                    return $model->getStatusSpan($model->status);
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
            ]); ?>
        
    </div>
</div>