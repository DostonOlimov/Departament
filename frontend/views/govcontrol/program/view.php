<?php

use common\models\Company;
use common\models\govcontrol\ProgramData;
use common\models\govcontrol\ProgramProperty;
use common\models\govcontrol\ProgramPropertySearch;
use yii\debug\models\timeline\DataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var common\models\govcontrol\Program $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
// debug($dataProviders);
// debug($model);
?>
<div class="program-view container">

<h3>
    <div class="">
        O'zekiston texnik jihatdan tartibga solish agentligining davlat nazorati departamenti tomonidan 
        <span><?= $company->address?></span>da joylashgan <span><?= $company->company_name?></span> 
        (STIR: <span><?= $company->stir?></span>, IFUT: <span><?= $company->ifut?></span>) da texnik jihatdan tartibga solish, 
        standartlashtirish, sertifikatlashtirish va metrologiya qoida va me'yorlariga rioya etilishi yuzasidan tekshirish
    </div>
    <div style="text-align:center">
    <b>DASTURI</b>
    </div>
</h3>

    <p>
        <?php if($model->status == $model::DOCUMENT_STATUS_CONFIRMED) :?>
            <?= Html::a('Buyrug\' yaratish', ['govcontrol/order/create', 'gov_control_program_id' => $model->id], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Yuklab olish', ['govcontrol/program/document', 'id' => $model->id], ['class' => 'btn btn-info'])?>
            <?php endif ?>
        <?php if ($model->status == $model::DOCUMENT_STATUS_NEW or $model->status == $model::DOCUMENT_STATUS_RETURNED) : ?>
            <?= Html::a('Rahbarga yuborish', ['govcontrol/program/view', 'id' => $model->id, 'status' => $model::DOCUMENT_STATUS_SENT], ['class' => 'btn btn-success']) ?>
            
            <?= Html::a('O\'chirish', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif ?>
        
        <?php 
        // echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']); 
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'company_id',
                'value' => function($model){
                    return Company::findOne($model->company_id)->company_name;
                }
            ],
            [
                'attribute' => 'company_type_id',
                'value' => function($model){
                    return $model->getCompanyType($model->company_type_id);
                }
            ],
            
            [
                'attribute' => 'gov_control_type',
                'value' => function($model){
                    return $model->getGovcontrolType($model->gov_control_type);
                }
            ],
            [
                'attribute' => 'status',
                'value' => function($model){
                    return $model->getDocumentStatus($model->status);
                },
            ],
        ],
    ]) ?>
    <br>
    <?php
    $number = 0; 
    // debug($dataProvider);
    // debug(ProgramData::getCategory());
    foreach ($dataProviders as $key => $dataProvider){ ?>
        <h6> <?php
        echo $key.'.'.ProgramData::getCategory($key); ?></h6>

<?php
// $searchModel = new ProgramPropertySearch();
// $searchModel->gov_control_program_id = $model->id;
// $dataProvider = $searchModel->search($this->request->queryParams);
echo GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        // 'header' => false,
        'showHeader' => false,
        'headerRowOptions' => ['style' => 'background-color: #0072B5', ],
        'summary' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'gov_control_program_id',
            // 'program_data_id',
            [
                'attribute' => 'program_data_id',
                
                'value' => function(ProgramProperty $model){
                    $program_data = ProgramData::findOne($model->program_data_id);
                    return $program_data->content;
                }
        ],
            // 'comment:ntext',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            // [
            //     'class' => ActionColumn::className(),
            //     'urlCreator' => function ($action, ProgramProperty $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'id' => $model->id]);
            //      }
            // ],
        ],
    ]); ?>
        
    <?php } ?>

</div>
