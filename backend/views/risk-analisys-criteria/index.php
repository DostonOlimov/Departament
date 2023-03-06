<?php

use common\models\RiskAnalisysCriteria;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use kartik\export\ExportMenu;

/** @var yii\web\View $this */
/** @var common\models\RiskAnalisysCriteriaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Xavf tahlili mezonlari';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="risk-analisys-criteria-index">
<?php $gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'region_id',
            'value' => function ( $model) {
                return Region::findOne($model->region_id)->name;
            },
            'format' => 'raw',
        ],
        'name',
        [
            'attribute'=> 'created_by',
            'value'=> function($model){
                $user = User::findOne($model->created_by);
                return $user ? $user->name .' '.$user->surname :'';
            }
            ],
        [
            'attribute'=> 'updated_by',
            'value'=> function($model){
                $user = User::findOne($model->updated_by);
                return $user ? $user->name .' '.$user->surname :'';
            }
            ],
];
?>
    <p>
        <?= Html::a('Yaratish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'document_paragraph',
            'criteria_category',
            'criteria',
            'company_field_category',
            'criteria_score',
            //'created_by',
            //'updated_by',
            'created_at',
            'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, RiskAnalisysCriteria $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
