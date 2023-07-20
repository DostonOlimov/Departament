<?php

use common\models\normativedocument\NormativeDocumentContent;
// use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap4;
use yii\bootstrap4\Html;

/** @var yii\web\View $this */
/** @var common\models\normativedocument\NormativeDocumentContentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="normative-document-content-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // [
            //     'attribute' => 'parent_id',
            //     'visible' => $parent_id_visible
            // ],
            // 'document_section_id',
            [
                'attribute' =>'content',
                'value' => function(NormativeDocumentContent $model){
                    return ($model->parent_id)? '- '.$model->content: $model->content;
                }
            ],
            // 'position',
            [
                'class' => ActionColumn::class,
                'buttons' => [
                    'custom' => function ($url, $model, $key) {
                        return Html::a(
                            '<span class="fa fa-arrow-circle-down"></span>',
                            ['normativedocument/normative-document-content/'.'down', 'id' => $model->id],
                            ['title' => 'Pastga']
                        );
                    },
                ],
                'template' => '{custom} {view} {update} {delete}',
                'urlCreator' => function ($action, NormativeDocumentContent $model, $key, $index, $column) 
                {
                    return Url::toRoute(['normativedocument/normative-document-content/'.$action, 'id' => $model->id
                ]);
                },
        ],
    ]]); ?>


</div>
