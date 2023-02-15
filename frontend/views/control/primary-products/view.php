<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\control\Company;
use common\models\control\PrimaryData;
use frontend\widgets\Steps;

/** @var yii\web\View $this */
/** @var common\models\control\PrimaryProduct $model */

$this->title = $model->product_name;
$this->params['breadcrumbs'][] = ['label' => 'Primary Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$primaryData = PrimaryData::findOne(['id' => $primary_data_id]);
?>
<div class="page1-1 row">
  <?= Steps::widget([
        'control_instruction_id' => Company::findOne($primaryData->control_company_id)->control_instruction_id,
        'control_company_id' => $primaryData->control_company_id,
    ]) ?>
    <div class="col-8">
    <h1><?= Html::encode($this->title) ?></h1>

    <p> <?= Html::a('Asosiyga qaytish', ['index', 'primary_data_id' => $primary_data_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Tahrirlash', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('O\'chirish', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'control_primary_data_id',
            'product_type_id',
            'product_name',
            'made_country',
            'product_measure',
            'residue_amount',
            'residue_quantity',
            'potency',
            'year_amount',
            'year_quantity',
            'labaratory_checking',
            'certification',
            'photo',
            'quality',
            'cer_amount',
            'cer_quantity',
            'description:ntext',
            'codetnved:ntext',
        ],
    ]) ?>

</div>
