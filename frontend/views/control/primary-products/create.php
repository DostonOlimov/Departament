<?php

use yii\helpers\Html;
use common\models\control\Company;
use common\models\control\PrimaryData;
use frontend\widgets\Steps;
use common\models\NdType;
use common\models\control\PrimaryProduct;
use common\models\control\PrimaryProductNd;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\models\types\ProductSubposition;
use common\models\Countries;
use yii\helpers\Url;


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
    <h1 style="display:inline;"><?= Html::encode($this->title) ?></h1>


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

<?=  GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'headerRowOptions' => ['style' => 'background-color: #198754;'],
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
                    [
                        'attribute' => 'Sinov laboratoriyasi xulosasi',
                       /* 'class' => 'yii\grid\ActionColumn',
                        'template' => '{view}',
                        'buttonOptions' => [
                            'class' => 'text-primary'
                        ],
                        'urlCreator' => function ($action, $searchmodel, $key, $index) {
                            if ($action === 'view') {
                                $url = Url::to(['view', 'id' => $searchmodel->id]);
                                return $url;
                            }
                        },*/
                        'value' => function (PrimaryProduct $model) {
                            
                            return Html::a('Yangilash', ['/control/primary-products/update', 'id' => $model->id,], ['class' => 'btn btn-primary']) ;
                        },
                        'format' => 'raw'
                    ],
                    [
                        'attribute' => 'Tashqi ko\'rinish bo\'yicha yaroqligi',
                        'value' => function (PrimaryProduct $model) {
                            
                            return Html::a('Yangilash', ['/control/primary-products/update', 'id' => $model->id,], ['class' => 'btn btn-primary']) ;
                        },
                        'format' => 'raw'
                    ],
                    [
                        'attribute' => 'Mahsulotga oid sertifikatlar',
                        'value' => function (PrimaryProduct $model) {
                            
                            return Html::a('Yangilash', ['/control/primary-products/update', 'id' => $model->id,], ['class' => 'btn btn-primary']) ;
                        },
                        'format' => 'raw'
                    ],
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, PrimaryProduct $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id,'primary_data_id' => $model->control_primary_data_id]);
                         }
                    ],
                ],
            ]);
        ?>
</div>
</div>
