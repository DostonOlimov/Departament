<?php

use common\models\normativedocument\NormativeDocumentSection;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\normativedocument\NormativeDocumentSection $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Normative Document Sections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="normative-document-section-view">

    <p>
        <?= Html::a('Ortga', ['normativedocument/normative-document/view', 'id' => $model->normative_document_id], ['class' => 'btn btn-info']) ?>
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
            'normative_document_id',
            [
                'attribute' => 'section_category_id',
                'value' => function(NormativeDocumentSection $model){
                    return $model->getSectionType($model->section_category_id);
                }
            ],
            'section_number',
            'section_name',
        ],
    ]) ?>
    <?php
    echo $this->render('/normativedocument/normative-document-content/index', 
    compact(
        'dataProvider', 
        'searchModel', 
        'model')) ?>

</div>
