<?php

use common\models\identification\LaboratoryConclusion;
use common\models\identification\LaboratoryProtocol;
use common\models\normativedocument\NormativeDocument;
use frontend\widgets\StepsGovControl;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\identification\LaboratoryConclusionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Laboratory xulosalari';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laboratory-conclusion-index row">

    <div class="col-3 mt-5">
        <?php echo StepsGovControl::widget(compact('gov_control_order_id'))?>
    </div>
    <div class="col-3 mt-5">
    <h3>Sinov laboratoriyasi bayonnomalari</h3>
    <!-- <p>
        <?= Html::a('Create Laboratory Conclusion', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'headerRowOptions' => ['style' => 'background-color: #0072B5'], 
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'name',
            [
                'attribute' => 'name',
                'value' => function($model){
                    // debug($model->laboratoryProtocol);
                    // $flag = (LaboratoryProtocol::findOne(['selected_product_id' => $model->id])) ? true : false;
                    if ($model->laboratoryProtocol){
                        return 
                        Html::a($model->name, 
                        Url::to(['identification/laboratory-protocol/view', 'id' => $model->laboratoryProtocol->id]),
                        ['class' => 'text-primary']);
                    }
                    else{
                        return 
                        Html::a($model->name, 
                        Url::to(['identification/laboratory-protocol/create', 'selected_product_id' => $model->id]),
                        ['class' => 'text-primary']);
                    }
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'normative_documents',
                'value' => function($model){
                    $result = '';
                    $contents = ArrayHelper::map($model->laboratoryProtocolContents, 'id', 'normative_document_id', 'normative_document_id');
                    $contents= array_keys($contents);
                    $nds = ArrayHelper::map(NormativeDocument::findAll(['id' => $contents]), 'id', 'determination');
                    foreach($nds as $key => $determination){
                        $result .= '<span class="badge badge-pill badge-info">' . $determination. '</span><br>';
                    }
                    return $result;
                    // debug($model->laboratoryProtocolContents);
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'indicators',
                'value' => function($model){
                    $result = '';
                    if($model->laboratoryProtocolContents){
                        foreach($model->laboratoryProtocolContents as $content){
                            $result .= '<span class="badge badge-pill badge-info">'.$content->indicator_name.'</span><br>';
                        }
                        return $result;
                    }
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'status',
                'value' => function($model){
                    if ($model->laboratoryProtocol){
                        return $model->getStatusSpan($model->laboratoryProtocol->status);
                    }
                },
                'format' => 'raw',

            ]
        ],
    ]); ?>
</div>


</div>
