<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\actselection\SelectedProduct $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Selected Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="selected-product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ortga', ['actselection/act-selection/view', 'id' => $model->act_selection_id], ['class' => 'btn btn-info']) ?>
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
            'act_selection_id',
            'name',
            'batch_number',
            'ctry_ogn_code',
            'mfr_name',
            'mfr_id',
            'mfrd_date',
            'exptr_ctry_code',
            'imptr_name',
            'imptr_id',
            'prod_netto',
            'xtra_value',
            'xtra_unit_om',
            'cnfea_code',
            'bar_code',
        ],
    ]) ?>
    <?php
    if($nd_status == false){
    ?>
        <p>
            <?= Html::a('Normativ hujjatlarni biriktirish', ['identification/identification/create', 'selected_product_id' => $model->id], ['class' => 'btn btn-success']) ?>
        <p>
    <?php }
    else {
    echo $this->render('/normativedocument/selected-normative-document/index', compact(
            'model',
            'searchModel',
            'dataProvider'

        ));} ?>

</div>
