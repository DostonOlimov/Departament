<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\widgets\StepsRiskAnalisys;
use common\models\RiskAnalisysCriteria;
use common\models\RisksCriteria;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\RiskAnalisys $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Risk Analisys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="risk-analisys-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget(['model' => $model,
        'attributes' => [
            // 'id',
            // 'company_id',
            'risk_analisys_date',
            'risk_analisys_number',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
            [
                'label' => 'To\'plagan ball',
                'value' => function($model){
                    $criteria = new RisksCriteria;
                    return $criteria->getCriteriaBall($model->id);
                }
                ]
        ],
    ]) ?>



<?php

if ($criteria){
    $view_id = $model->id;
}
else {
    $view_id = null;
}
?>
        <?= DetailView::widget([
            'model' => $company,
            'attributes' => 
            [
                'company_name',
                'stir',
                'region_id',
                'address',
                'registration_date',
                // [
                //     'attribute' => 'status',
                //     'value' => $company->getStatus($company->status),
                // ],
                'ifut',
                
            ],
            ]) ?>

            <?php 

            if($view_id) {
                echo Html::a('Yuklab olish', ['document','id' => $model->id], ['class' => 'btn btn-primary']);
            echo  GridView::widget([
            'dataProvider' => $dataProvider,
            'headerRowOptions' => ['style' => 'background-color: #0072B5'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
            // 'id', 
            // 'criteria_id',
            [
                'attribute' => 'criteria_id',
                'value' => function($criteria)
                {
                    return $criteria->getCriterion($criteria->criteria_id);
                },
            ],
            'comment',
        ],
        ]
    );} ?>
</div>


