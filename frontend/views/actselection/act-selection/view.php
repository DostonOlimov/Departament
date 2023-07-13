<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\actselection\ActSelection $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Act Selections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="act-selection-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?= Html::a('Ortga', ['actselection/act-selection/index', 'gov_control_order_id' => $model->gov_control_order_id], ['class' => 'btn btn-info']) ?>
        <?php // echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php // echo Html::a('Delete', ['delete', 'id' => $model->id], [
        //     'class' => 'btn btn-danger',
        //     'data' => [
        //         'confirm' => 'Are you sure you want to delete this item?',
        //         'method' => 'post',
        //     ],
        // ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'gov_control_order_id',
        ],
    ]) ?>
    <?= $this->render('/actselection/selected-product/index', compact(
            'model',
            'searchModel',
            'dataProvider'

        )); ?>

</div>
