<?php
use frontend\widgets\StepsRiskAnalisys;
use yii\widgets\DetailView;
use common\models\Region;
use common\models\Company;
use common\models\RisksCriteria;

$company = Company::findOne(['id' => $company_id]);
$criteria = RisksCriteria::findOne(['risk_analisys_id' => $id]);
if ($criteria){
    $view_id = $id;
}
else {
    $view_id = null;
}
?>

<div class="row">
    <div class="col-3 mt-5">
        <?php echo StepsRiskAnalisys::widget([
            'company_id' => $company_id,
            'id' => $id,
            'view_id' => $view_id,
            ])
        // echo debug($model);die;?>
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