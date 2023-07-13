<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\normativedocument\NormativeDocumentContent $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Normative Document Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="normative-document-content-view">

    <p>
        <?= Html::a('Ortga', ['normativedocument/normative-document-section/view', 'id' => $model->document_section_id], ['class' => 'btn btn-info']) ?>
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
                'attribute' =>'parent_id',
                'visible' => $model->parent_id !== null,
            ],
            'document_section_id',
            'content:ntext',
            // 'position',
            // [
            //     'label' => 'Biriktirilgan ko\'rsatkichlar',
            //     'value' => 1
            // ],
        ],
    ]) ?>
    <?php if(!$model->parent_id){
        echo Html::a('Ko\'rsatkich qo\'shish', ['create-indicator', 'parent_id' => $model->id], ['class' => 'btn btn-primary']);
    } 
?>

</div>
