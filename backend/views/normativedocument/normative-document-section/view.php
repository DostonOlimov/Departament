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
<div class="normative-document-section-view row">

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
    </div>
    <div class="row">
    <div class="col-1">
            <?= Html::a('Band yaratish', 
            ['normativedocument/normative-document-content/create' , 'document_section_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </div>

    <div class="col-2">
        <?= Html::a('Quyi turuvchi bob qo\'shish', ['create-lower-section', 'parent_id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </div>


    </div>
        <?php
        echo $this->render('/normativedocument/normative-document-content/index', 
        compact(
            'dataProvider',
            'searchModel', 
            'model',
        ) ) ?>

</div>
