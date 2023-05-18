<?php

use yii\helpers\Html;
use frontend\widgets\StepsRiskAnalisys;
use common\models\RisksCriteria;

/** @var yii\web\View $this */
/** @var common\models\RiskAnalisys $model */

$this->title = 'Xavf tahlili yaratish';
$this->params['breadcrumbs'][] = ['label' => 'Risk Analisys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="risk-analisys-create row">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="col-3 mt-5">
                <?= StepsRiskAnalisys::widget([
                'company_id' => $model->company_id,
                'id' => $model->id,
                'view_id' => RisksCriteria::findOne(['risk_analisys_id' => $model->id]) ? $model->id : null,
                ])?>
        </div>
    <div class="col-6 mt-5">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
     </div>

</div>
