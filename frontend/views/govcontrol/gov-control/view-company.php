<?php
use frontend\widgets\StepsRiskAnalisys;
use yii\widgets\DetailView;
use common\models\Region;
use common\models\Company;
use common\models\RisksCriteria;
use frontend\widgets\StepsGovControl;

?>

<div class="row">
    <div class="col-3 mt-5">
        <?php echo StepsGovControl::widget([
            'gov_control_order_id' => $model->id,
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
    </div>
</div>