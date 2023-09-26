<?php

use frontend\widgets\StepsGovControl;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\PrimaryData $model */

$this->title = 'Update Primary Data: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Primary Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="primary-data-create row">
    <div class="col-3 mt-5">
        <?php echo StepsGovControl::widget(
            [
                'gov_control_order_id' => $model->gov_control_order_id,
            ]
            )?>
    </div>
        <div class="col-6 mt-5">
            <?= $this->render('_form1', [
            'model' => $model,
        ]) ?>

    </div>
</div>
