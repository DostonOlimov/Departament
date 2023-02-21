<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\control\Instruction;
use common\models\control\Company;
use common\models\control\PrimaryData;
use frontend\widgets\Steps;
use common\models\types\ProductSubposition;
use common\models\control\PrimaryProduct;
use common\models\Countries;
use common\models\control\PrimaryProductNd;
use common\models\NdType;
use common\models\control\ControlProductCertification;

/** @var yii\web\View $this */
/** @var common\models\control\PrimaryProduct $model */

$this->title = $model->product_name;
$this->params['breadcrumbs'][] = ['label' => 'Primary Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$primaryData = PrimaryData::findOne(['id' => $primary_data_id]);
$instruction = Instruction::findOne(Company::findOne($primaryData->control_company_id)->control_instruction_id);
?>
<div class="page1-1 row">
  <?= Steps::widget([
        'control_instruction_id' => Company::findOne($primaryData->control_company_id)->control_instruction_id,
        'control_company_id' => $primaryData->control_company_id,
    ]) ?>
    <div class="col-8">
    <h1><?= Html::encode($this->title) ?></h1>

    <p> <?= Html::a('Asosiyga qaytish', ['index', 'primary_data_id' => $primary_data_id], ['class' => 'btn btn-primary']) ?>
       <?php if($instruction->general_status == Instruction::GENERAL_STATUS_IN_PROCESS) :?>
        <?= Html::a('Tahrirlash', ['update', 'id' => $model->id,'primary_data_id' => $primary_data_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('O\'chirish', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]); endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => 'Mahsulot turi',
                'value' => function($model) {
                    $data = ProductSubposition::find()->where(['kode' => $model->product_type_id])->one();
                    if($data){
                        return $result = '<span>' . $data->name. '</span><br>';
                    }
                    return 'aniqlanmadi';
                },
                'format' => 'raw'
            ],
            'product_name',
            [
                'label' => 'Mahsulot ishlab chiqarilgan mamlakat',
                'value' => function($model) {
                    $data = Countries::find()->where(['id' => $model->made_country])->one();
                    $result = '<span>' . $data->name. '</span><br>';
                    return $result;
                },
                'format' => 'raw'
            ],
         
            [
                'attribute' => 'residue_quantity',
                'value' => function ($model) {
                    return $model->residue_quantity ? $model->residue_quantity . ' so\'m' : '';
                }

            ],
            [
                'attribute' => 'residue_amount',
                'value' => function ($model) {
                    $mesure = PrimaryProduct::getMeasure($model->product_measure);
                    return $model->residue_amount ? $model->residue_amount. ' '.$mesure : '';
                }

            ],
            [
                'attribute' => 'year_quantity',
                'value' => function ($model) {
                    return $model->year_quantity ? $model->year_quantity . ' so\'m' : '';
                }

            ],
            [
                'attribute' => 'year_amount',
                'value' => function ($model) {
                    $mesure = PrimaryProduct::getMeasure($model->product_measure);
                    return $model->year_amount ? $model->year_amount. ' '.$mesure:'';
                }

            ],
            [
                'label' => 'Normativ hujjat(lar) turi va nomi',
                'value' => function($pro) {
                    $data = PrimaryProductNd::find()->where(['control_primary_product_id' => $pro->id])->all();
                    $result = '';
                    foreach ($data as $da) {
                        $type = NdType::find()->where(['id' => $da->type_id])->one();
                        $result .= '<span>' . $type->name . ' - ' . $da-> name . ',' . '</span><br>';
                    }
                    return $result;
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'photo',
                'value' => function (PrimaryProduct $model) {
                    $model->img = $model->photo;
                    return $model->img ? '<a class="btn btn-info" target="_blank" href="' . $model->getUploadedFileUrl('img') . '" >Yuklash</a>' : '';
                },
                'format' => 'raw'
            ],
            'potency',
            [
                'attribute' => 'labaratory_checking',
                'value' => function ($model) {
                    if($model->labaratory_checking == 1)
                    return  'Taqdim etilgan' ;
                    else{
                        return 'Taqdim etilmagan';
                    }
                }

            ],
            [
                'attribute' => 'exsist_certificate',
                'value' => function ($model) {
                    $data = ControlProductCertification::findAll(['product_id'=>$model->id]);
                   if($data){
                    $result = '';
                    foreach ($data as $da) {
                        $result .= '<span> Reestr raqami : ' . $da->number_reestr . ';  Berilgan sanasi:'. $da->date_to.  ';  Amal qilish sanasi:'. $da->date_from.'</span><br>';
                    }
                    return $result;
                   }
                   else{
                       return 'Mavjud emas';
                   }
                },
                'format' => 'raw'

            ],
           // 'exsist',
           // 'cer_amount',
           // 'cer_quantity',
           //   'description:ntext',
            'codetnved:ntext',
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    if($model->created_at)
                    return Yii::$app->formatter->asDate($model->created_at, 'dd.MM.yyyy') ;
                }

            ],
            
            
        ],
    ]) ?>

</div>
