<?php

use common\models\identification\IdentificationContent;
use common\models\normativedocument\SelectedNormativeDocument;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\normativedocument\SelectedNormativeDocumentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Selected Normative Documents';
$this->params['breadcrumbs'][] = $this->title;
// debug($model->act_selection_id);
?>
<div class="selected-normative-document-index">

    <p>
        <?= Html::a('Me\'yoriy hujjat qo\'shish', ['create', 'act_selection_id' => $model->act_selection_id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'headerRowOptions' => ['style' => 'background-color: #0072B5'],  
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'identification_id',
            [
                'class' => ActionColumn::class,
                'template' => '{view}',
                'buttonOptions' => [
                    'class' => 'text-primary',
                    
                ],
                'urlCreator' => function ($action, SelectedNormativeDocument $model, $key, $index, $column) {
                    $identification_content = IdentificationContent::findOne(['selected_normative_document_id' => $model->id]);
                    if($identification_content){
                        return Url::toRoute(['identification/identification-content/index', 'id' => $model->id]);
                    }
                    else{
                        return Url::toRoute(['identification/identification-content/create', 'id' => $model->id]);
                    } 
                 }
            ],
            'normative_document_id',
        ],
    ]); ?>


</div>
