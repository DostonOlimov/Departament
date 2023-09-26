<?php

use common\models\actselection\SelectedProduct;
use common\models\Countries;
use common\models\identification\Identification;
use common\models\normativedocument\SelectedNormativeDocument;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\actselection\SelectedProduct $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Selected Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
// debug($actSelectionModel->id);
?>
<div class="selected-product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ortga', Yii::$app->request->referrer, ['class' => 'btn btn-info'])?>

        <?php if ($model->getPermissionInspector('update',$actSelectionModel->status) == true):?>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?php endif ?>
        <?php if ($model->getPermissionInspector('delete', $actSelectionModel->status) == true):?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif ?>
                
        <?php if ($identificationModel) : ?>
            <?php $count = (
                SelectedNormativeDocument::find()->where(['identification_id' => $identificationModel->id])->count() == 
                SelectedNormativeDocument::find()->where(['identification_id' => $identificationModel->id, 'status' => $model::DOCUMENT_STATUS_CONFIRMED])->count()) ?
                1 : 0 ; ?>
            <?php if ($identificationModel->status <> $model::DOCUMENT_STATUS_CONFIRMED && $count == 1) : ?>
                <?= Html::a('Tasdiqlash', ['change-status', 'id' => $model->id, 'status' => $model::DOCUMENT_STATUS_CONFIRMED], ['class' => 'btn btn-info']) ?>
            <?php endif ?>
        <?php endif ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'act_selection_id',
            'name',
            'batch_number',
            // 'ctry_ogn_code',
            [
                'attribute' => 'ctry_ogn_code',
                'value' => function($model){
                    return (Countries::findOne($model->ctry_ogn_code))?Countries::findOne($model->ctry_ogn_code)->name:'';
                } 
            ],
            'mfr_name',
            'mfr_id',
            'mfrd_date',
            // 'exptr_ctry_code',
            [
                'attribute' => 'exptr_ctry_code',
                'value' => function($model){
                    return (Countries::findOne($model->exptr_ctry_code))?Countries::findOne($model->exptr_ctry_code)->name:'';
                } 
            ],
            'imptr_name',
            'imptr_id',
            'prod_netto',
            'xtra_value',
            'xtra_unit_om',
            'cnfea_code',
            'bar_code',
            [
                'attribute' => 'identification.status',
                'value' => function($model){
                    if($model->identification){
                        return $model->getStatusSpan($model->identification->status);
                        }
                },
                'format' => 'raw',   
            ],
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
    $button = $identificationModel->status;
    echo $this->render('/normativedocument/selected-normative-document/index', compact(
            'model',
            'identificationModel',
            'searchModel',
            'dataProvider',
            'button'

        ));} ?>

</div>
