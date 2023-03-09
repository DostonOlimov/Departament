<?php

use common\models\RiskAnalisysCriteria;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use common\models\User;
use common\models\Region;

/** @var yii\web\View $this */
/** @var common\models\RiskAnalisysCriteriaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Xavf tahlili mezonlari';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="risk-analisys-criteria-index">
<?php $gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
        
    'document_paragraph',
        
        ['attribute'=> 'criteria_category',
            'value'=> function($model){
                $model = RiskAnalisysCriteria::getField($model->criteria_category);
                return $model;}],
        
        'criteria',
        
        ['attribute'=> 'company_field_category',
                'value'=> function($model){
                    $model = RiskAnalisysCriteria::getActivity($model->company_field_category);
                    return $model;}],
        
        'criteria_score',

        ['class' => ActionColumn::className(),
                'urlCreator' => function ($action, RiskAnalisysCriteria $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);}],
];
?>
    <p>
        <?= Html::a('Yaratish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php    echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
]);?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'document_paragraph',
            
            [
                'attribute'=> 'criteria_category',
                'value'=> function($model){
                    $model = RiskAnalisysCriteria::getField($model->criteria_category);
                    return $model;
                }
                ],
            
            'criteria',
            [
                'attribute'=> 'company_field_category',
                'value'=> function($model){
                    $model = RiskAnalisysCriteria::getActivity($model->company_field_category);
                    return $model;
                }
                ],
            'criteria_score',
            
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, RiskAnalisysCriteria $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
