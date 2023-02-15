<?php

use yii\helpers\Html;
use common\models\control\Company;
use common\models\control\PrimaryData;
use frontend\widgets\Steps;

/** @var yii\web\View $this */
/** @var common\models\control\PrimaryProduct $model */

$this->title = 'Mahsulot qo\'shish';
$this->params['breadcrumbs'][] = ['label' => 'Primary Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$primaryData = PrimaryData::findOne(['id' => $primary_data_id]);
?>


<div class="page1-1 row">
  <?= Steps::widget([
        'control_instruction_id' => Company::findOne($primaryData->control_company_id)->control_instruction_id,
        'control_company_id' => $primaryData->control_company_id,
    ]) ?>
    <div class="col-8">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>

