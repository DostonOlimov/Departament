<?php
use frontend\widgets\StepsRiskAnalisys;
use yii\widgets\DetailView;
use common\models\Region;
use common\models\Company;
use common\models\RiskAnalisysCriteria;
use common\models\RisksCriteria;
use yii\grid\GridView;
use yii\helpers\Html;







$company = Company::findOne(['id' => $company_id]);
$criteria = RisksCriteria::findOne(['risk_analisys_id' => $id]);
$risk_analisys_criteria = RiskAnalisysCriteria::findone(['id' => $model->id]);
if ($criteria){
    $view_id = $id;
}
else {
    $view_id = null;
}
?>
<div class="risk-analisys-view">
<div class="row">
    <div class="col-3 mt-5">
        <?php echo StepsRiskAnalisys::widget([
            'company_id' => $company_id,
            'id' => $id,
            'view_id' => $view_id,
            ])?>
    </div>
    <div class="col-6 mt-5">
        <?= DetailView::widget([
            'model' => $company,
            'attributes' => 
            [
                'company_name',
                'stir',
                'region_id',
                'address',
                'registration_date',
                [
                    'attribute' => 'status',
                    'value' => $company->getStatus($company->status),
                ],
                'ifut',
            ],
            ]) ?>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => 
                    [
                        
                        // 'id',
                        'risk_analisys_date',
                        'risk_analisys_number',
                        [
                            'label' => 'To\'plagan ball',
                            'value' => function($model){
                                $criteria = new RisksCriteria;
                                return $criteria->getCriteriaBall($model->id);
                            }
                            ]
                            
                            ]
                            ]) ?>
            <?php 

            if($view_id) {
            echo Html::a('Yuklab olish', ['document','id' => $id], ['class' => 'btn btn-primary']);
            echo  GridView::widget([
            'dataProvider' => $dataProvider,
            'headerRowOptions' => ['style' => 'background-color: #0072B5'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
            // 'id', 
            'criteria_id',
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
</div>
</div>

