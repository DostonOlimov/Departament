<?php

use common\models\Company;
use frontend\widgets\StepsRiskAnalisys;
use yii\widgets\DetailView;
use common\models\Region;
use common\models\RiskAnalisys;
use common\models\RisksCriteria;
use yii\helpers\Html;
?>
<div class="risk-analisys-view">
    <div class="row">
        <div class="col-3 mt-5">
                <?= StepsRiskAnalisys::widget([
                'company_id' => $model->company_id,
                'id' => $model->id,
                'view_id' => RisksCriteria::findOne(['risk_analisys_id' => $model->id]) ? $model->id : null,
                ])?>
        </div>
        <div class="col-6 mt-5">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => 
                [
                    [
                        'attribute' => 'Kompaniya nomi',
                        'value' => Company::find($model->company_id)->one()->company_name ?? '',
                    ],
                    
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
    </div>    
    </div>
</div>