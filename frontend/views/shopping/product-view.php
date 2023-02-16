<?php

/* @var $this yii\web\View */
/* @var $model Product */

use common\models\shopping\Product;
use frontend\widgets\StepsShopping;
use yii\widgets\DetailView;
use yii\helpers\Html;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="page1-1 row ">

    <?= StepsShopping::widget([
        'shopping_instruction_id' => $model->shopping_instruction_id,
        'shopping_company_id' => $model->id,
    ]) ?>

    <div class="col-6">
<?php
    $answers = Product::find()->where(['shopping_company_id' => $model->id])->all();
    if ($answers) { ?>        
        <div class="company-view">
            <?php foreach($answers as $answer):?>
                <h3 >Mahsulot nomi: <span class="text-primary"><?= $answer->name;?></span></h3>
            <?= DetailView::widget([
                'model' => $answer,
                'attributes' => [ 
                    'measure',
                    'quantity',
                    'sum',
                    'created_by',
                    'purchase_date',
                    'production_date',
                    'product_lot'


                    // [
                    //     'attribute' => 'photo',
                    //     'value' => function (Product $model) {
                    //         return '<img src="' . $model->getThumbFileUrl('photo', 'sm') . '" >';
                    //     },
                    //     'format' => 'raw'
                    // ],
                    // [
                    //     'attribute' => 'photo_chek',
                    //     'value' => function (Product $model) {
                    //         return '<img src="' . $model->getThumbFileUrl('photo', 'sm') . '" >';
                    //     },
                    //     'format' => 'raw'
                    // ],
                ],
            ]) ?>
            
            <?php endforeach;?>
        </div>
    <?php }
 ?>
    </div>

</div>
