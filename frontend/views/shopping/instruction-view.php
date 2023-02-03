<?php

/* @var $this yii\web\View */
/* @var $model Instruction */

use common\models\shopping\Instruction;
use common\models\shopping\Company;
use frontend\widgets\StepsShopping;
use common\models\shopping\ShoppingNotice;
use yii\widgets\DetailView;
use common\models\User;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;

$company = Company::findOne(['shopping_instruction_id' => $model->id])
?>


<div class="page1-1 row ">

    <?= StepsShopping::widget([
        'shopping_instruction_id' => $model->id,
        'shopping_company_id' => $company ? $company->id : null,
    ]) ?>

    <div class="col-6">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
            'id',
            [
                'attribute'=> 'notice_id',
                'value'=> function($model){
                    $notice = ShoppingNotice::findOne($model->notice_id);
                    return $notice ? $notice->notice_number :'';
                }
                ],
            'card_number',
            'card_given_date',  
                [
                'attribute'=> 'created_by',
                'value'=> function($model){
                    $user = User::findOne($model->created_by);
                    return $user ? $user->name .' '.$user->surname :'';
                }
                ],               
            ],
        ]) ?>
    </div>

</div>
