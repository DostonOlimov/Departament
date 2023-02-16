<?php

use common\models\shopping\Company;
use common\models\shopping\Instruction;
use common\models\shopping\Product;
use common\models\shopping\ShoppingNotice;
use common\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\profilactic\Instruction */

$this->title = 'Profilaktika uchun asos';
$this->params['breadcrumbs'][] = ['label' => 'Korxonalar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
    <div class="instruction-view">

        <p>
            <?= Html::a('Yangilash', ['/shopping/instruction/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Hamma ma`lumotni o\'chirish', ['/shopping/instruction/delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Haqiqatan ham bu elementni o‘chirmoqchimisiz?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
           'id',
                [
                    'attribute' => 'notice_id',
                    'value' => function ($model) {
                        
                        return $model->shoppingNotice->notice_number;
                    }
                ],
                // 'letter_date:date',
                // 'letter_number',
           'card_number',
           'card_given_date',
           'card_return_date',
           [
            'attribute' => 'created_by',
            
                'value'=> function($model){
                    $user = User::findOne($model->created_by);
                    return $user ? $user->name .' '.$user->surname :'';
                }
            
        ],
        //    'updated_by',
        //    'created_at',
        //    'updated_at',
            ],
        ]) ?>

    </div>


<?php
$company = Company::findOne(['shopping_instruction_id' => $model->id]);
if ($company) { ?>
    <hr>
    <h2>Xyus to'g'risida ma`lumot</h2>
    <div class="company-view">
        <p>
            <?= Html::a('Yangilash', ['/shopping/company/update', 'id' => $company->id], ['class' => 'btn btn-primary']) ?>
        </p>
        <?= DetailView::widget([
            'model' => $company,
            'attributes' => [
                'name',
                'inn',
                [
                    'attribute' => 'phone',
                    'value' => function (Company $model) {
                        return $model->phoneNumber;
                    },
                ],
                [
                    'label' => 'Hudud',
                    'value' => function (Company $model) {
                        return $model->region->name;
                    }
                ],
                'after',
                'address',
                [
                    'label' => 'Mutaxasis',
                    'value' => function (Company $model) {
                        return $model->createdBy->username;
                    },
                ],
            ],
        ]) ?>
    </div>

    <?php

$answers = Product::find()->where(['shopping_company_id' => $company->id])->all();
if ($answers) { ?>        
    <div class="company-view">
    <h2 >Mahsulotlar</h2>
            <p>
                <?= Html::a('Yangilash', ['/shopping/product/update', 'shopping_company_id' => $company->id], ['class' => 'btn btn-primary']) ?>
            </p>
        <?php foreach($answers as $answer):?>
        <hr>
        <?= DetailView::widget([
            'model' => $answer,
            'attributes' => [ 
               'name',
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

$labs = Product::find()->where(['shopping_company_id' => $company->id])->all();

if ($answers[0]->lab_conclusion) { ?>        
    <div class="company-view">
    <h2 >Laboratoriya</h2>
            <p>
                <?= Html::a('Yangilash', ['/shopping/product/update', 'shopping_company_id' => $company->id], ['class' => 'btn btn-primary']) ?>
            </p>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Laboratoriya xulosasi:</h5>
                </div>
                <div class="card-body">                    
                    <p class="card-text"><?= $company->lab_comment;?></p>                    
                </div>
            </div>
        <?php foreach($answers as $answer):?>
        <hr>
        <?= DetailView::widget([
            'model' => $answer,
            'attributes' => [ 
               'name',
                'lab_conclusion',
                // 'sum',
                // 'created_by',
                // 'purchase_date',
                // 'production_date',
                // 'product_lot'

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


   
} ?>