<?php

use common\models\identification\IdentificationContent;
use common\models\normativedocument\NormativeDocumentContent;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\identification\IdentificationContentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tashqi ko\'rinish bayonnomasi';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    /* h1{} */
</style>
<div class="identification-content-index container">


    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php  // echo Html::a('Qo\'shish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'headerRowOptions' => ['style' => 'background-color: #0072B5'],  
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'selected_normative_document_id',
            // 'normative_document_content_id',
            [
                'attribute' => 'normative_document_content_id',
                'value' => function(IdentificationContent $model){
                    $normative_document_content = NormativeDocumentContent::findOne($model->normative_document_content_id);
                    return $normative_document_content->content??'';
                }
            ],
            'comment:ntext',
            // 'conformity',
            [
                'attribute' => 'conformity',
                'value' => function(IdentificationContent $model){
                    return $model->getConformity($model->conformity);
                }
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{update}',
                'buttonOptions' => [
                    'class' => 'text-primary'
                ],
                'urlCreator' => function ($action, IdentificationContent $model, $key, $index, $column) {
                    return Url::toRoute(['identification/identification-content/'.$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
