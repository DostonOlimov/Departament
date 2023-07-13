<?php

use common\models\normativedocument\NormativeDocumentContent;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\normativedocument\NormativeDocumentContentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="normative-document-content-index">


    <p>
        <?= Html::a('Band yaratish', 
        ['normativedocument/normative-document-content/create' , 'document_section_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'parent_id',
            // 'document_section_id',
            'content:ntext',
            // 'position',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, NormativeDocumentContent $model, $key, $index, $column) {
                    return Url::toRoute(['normativedocument/normative-document-content/'.$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
