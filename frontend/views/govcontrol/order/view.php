<?php

use frontend\widgets\StepsGovControl;
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
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    

    <div class="row">
        <div class="col-5 mt-5">
            <?php echo StepsGovControl::widget([
                ])?>
    </div>
    <div class="col-5 mt-5">
        
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
            ],
    ]) ?>
        
    </div>
</div>
</div>
</div>
