<?php

use common\models\normativedocument\NormativeDocument;
use common\models\normativedocument\NormativeDocumentSection;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\normativedocument\NormativeDocumentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Me\'yoriy hujjatlar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="normative-document-index">

    <p>
        <?= Html::a('Yaratish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'category_id',
            'determination',
            'name:ntext',
            [
                'attribute' => 'category_id',
                'value' => function(NormativeDocument $model){
                    return $model->getNormativeDocumentType($model->category_id);
                },
                'filter' => NormativeDocument::getNormativeDocumentType(),
            ],
            'activation_date',
            //'activation_info:ntext',
            //'deactivation_date',
            //'deactivation_info:ntext',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, NormativeDocument $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
            [
                'label' => 'Boblar',
                'value' => function (NormativeDocument $model) {
                    $nd = '';
                    $normative_documents = NormativeDocumentSection::findAll(['normative_document_id'=>$model->id]);
                    foreach ($normative_documents as $normative_document) {
                        $nd .= "<strong>".$model->getSectionType($normative_document->section_category_id)."</strong>".
                        ' - '.$normative_document->section_number.
                        '. '.$normative_document->section_name."<br>";
                    }
                    return $nd;
                },
                'format' => 'raw'
            ],
        ],
    ]); ?>


</div>
