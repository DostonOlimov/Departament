<?php

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
        <?php echo DetailView::widget([
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
                ],
            ]); ?>
        
    </div>
</div>