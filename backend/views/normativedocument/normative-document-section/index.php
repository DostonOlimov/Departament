<?php

use common\models\normativedocument\NormativeDocumentSection;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\normativedocument\NormativeDocumentSectionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Me\'yoriy hujjat boblari';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="normative-document-section-index">

    <p>
        <?= Html::a('Bob yaratish', ['normativedocument/normative-document-section/create', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'parent_id',
            [
                'attribute' => 'parent_id',
                'value' => function(NormativeDocumentSection $model){
                    $model = NormativeDocumentSection::findOne($model->parent_id);
                    return ($model)?$model->section_number.'. '.$model->section_name:'';
                }
            ],
            // 'normative_document_id',
            // 'section_category_id',
            [
                'attribute' => 'section_category_id',
                'value' => function(NormativeDocumentSection $model){
                    return $model->getSectionType($model->section_category_id);
                }
            ],
            [
                'attribute' => 'section_name',
                'value' => function(NormativeDocumentSection $model){
                    return $model->section_number.'. '.$model->section_name;
                }
            ],
            // 'section_number',
            // 'section_name',
            // 'position',
            [
                'class' => ActionColumn::class,
                'buttons' => [
                    'down' => function ($url, $model, $key) {
                        return Html::a(
                            '<span class="fa fa-arrow-circle-down"></span>',
                            ['normativedocument/normative-document-section/'.'down', 'id' => $model->id],
                            ['title' => 'Pastga']
                        );
                    },
                ],
                'template' => '{down} {view} {update} {delete}',
                'urlCreator' => function ($action, NormativeDocumentSection $model, $key, $index, $column) {
                    return Url::toRoute(['normativedocument/normative-document-section/'.$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
    


</div>
,