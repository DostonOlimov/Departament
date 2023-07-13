<?php

use common\models\normativedocument\NormativeDocument;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\normativedocument\NormativeDocument $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Normative Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="normative-document-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?= Html::a('Ortga', ['normativedocument/normative-document/index'], ['class' => 'btn btn-info']) ?>
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
            [
                'attribute' => 'category_id',
                'value' => function(NormativeDocument $model){
                    return $model->getNormativeDocumentType($model->category_id);
                }
            ],
            'determination',
            'name:ntext',
            'activation_date',
            'activation_info:ntext',
            'deactivation_date',
            'deactivation_info:ntext',
        ],
    ]) ?>
    <?php
    echo $this->render('/normativedocument/normative-document-section/index', 
    compact(
        'dataProvider', 
        'searchModel', 
        'model')) ?>

</div>
