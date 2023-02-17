<?php

/* @var $this yii\web\View */
/* @var $model Product */

use common\models\shopping\Product;
use frontend\widgets\StepsShopping;
use common\models\shopping\Company;
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
$company = Company::findOne($model->id);
    $answers = Product::find()->where(['shopping_company_id' => $model->id])->all();
    if ($answers) { ?>        
        <div class="company-view">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Laboratoriya xulosasi</h5>
                </div>
                <div class="card-body">                    
                    <p class="card-text"><?= $company->lab_comment;?></p>                    
                </div>
            </div>
            <hr>
            
            
            <?php foreach($answers as $answer):?>
            <?= DetailView::widget([
                'model' => $answer,
                'attributes' => [
                    'name',
                    'lab_conclusion',

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
