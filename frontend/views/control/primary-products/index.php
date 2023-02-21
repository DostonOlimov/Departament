<?php

use common\models\control\PrimaryProduct;
use common\models\types\ProductSubposition;
use common\models\control\PrimaryProductNd;
use common\models\control\Instruction;
use common\models\NdType;
use common\models\Countries;
use common\models\control\Company;
use common\models\control\PrimaryData;
use frontend\widgets\Steps;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use frontend\assets\AppAsset;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\control\PrimaryProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Mahsulotlar';
$this->params['breadcrumbs'][] = $this->title;
AppAsset::register($this);

$primaryData = PrimaryData::findOne(['id' => $primary_data_id]);
$product = PrimaryProduct::findOne(['control_primary_data_id' => $primary_data_id]);

?>


<div class="page1-1 row sss">
  <?= Steps::widget([
        'control_instruction_id' => Company::findOne($primaryData->control_company_id)->control_instruction_id,
        'control_company_id' => $primaryData->control_company_id,
    ]) ?>
    
<div class="col-8">
<h1><?= Html::encode($this->title) ?></h1>
<hr>
<div class="pull-right">
    <?php if($primaryData->identification_status == 0) { echo  Html::a('Mahsulot qo\'shish', ['/control/primary-products/create','primary_data_id'=>$primary_data_id], ['class' => 'btn btn-primary']) ;}?>
   </div>
        <?=  GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'headerRowOptions' => ['style' => 'background-color: #0072b5 '],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'label' => 'Mahsulot turi',
                        'value' => function($pro) {
                            $data = ProductSubposition::find()->where(['kode' => $pro->product_type_id])->one();
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
                        'value' => function($pro) {
                            $data = Countries::find()->where(['id' => $pro->made_country])->one();
                            $result = '<span>' . $data->name. '</span><br>';
                            return $result;
                        },
                        'format' => 'raw'
                    ],
                    'codetnved',
                    [
                        'attribute' => 'photo',
                        'value' => function (PrimaryProduct $model) {
                            $model->img = $model->photo;
                            return $model->img ? '<a class="btn btn-info" target="_blank" href="' . $model->getUploadedFileUrl('img') . '" >Yuklash</a>' : '';
                        },
                        'format' => 'raw'
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
                    'control_primary_data_id',           
                    [  'label' => 'Normativ hujjat(lar) turi va nomi',
                        'value' => function($pro){
                            $instruction = Instruction::findOne(Company::findOne(PrimaryData::findOne($pro->control_primary_data_id)->control_company_id)->control_instruction_id);
                        if($instruction->general_status == Instruction::GENERAL_STATUS_IN_PROCESS){
                         return   Html::a('<span class="fa fa-eye"></span> ', ['view','id'=>$pro->id,'primary_data_id' => $pro->control_primary_data_id], ['title' => 'view','class'=>'btn btn-success']).' '.
                            Html::a('<span class="fa fa-pencil"></span> ', ['update','id'=>$pro->id,'primary_data_id' => $pro->control_primary_data_id], ['title' => 'edit','class'=>'btn btn-info']).' '.
                            Html::a('<span class="fa fa-trash"></span> ', ['delete', 'id' => $pro->id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]);
                        }
                        else{
                            return Html::a('<span class="fa fa-eye"></span> ', ['view','id'=>$pro->id,'primary_data_id' => $pro->control_primary_data_id], ['title' => 'view','class'=>'btn btn-success']);
                        }
                    },
                        'format'=>'raw',
                    ],
                   

                ],
            ]);
        ?>
    <div>
<div>   
<?php if($product && $primaryData->identification_status != 1) {
    echo Html::a('Mahsulot qo\'shishni yakunlash', ['/control/identification','company_id'=>$primaryData->control_company_id], ['class' => 'btn btn-danger']);
    } 
    ?>
</div>
</div>

