<?php

/* @var $this yii\web\View */
/* @var $model Instruction */

use common\models\shopping\Instruction;
use common\models\shopping\ShoppingNotice;
use frontend\widgets\StepsShopping;
use yii\widgets\MaskedInput;
use common\models\user;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="page1-1 row ">

    <?= StepsShopping::widget([
        'shopping_instruction_id' => null,
        'shopping_company_id' => null,
    ]) ?>

    <?php $form = ActiveForm::begin() ?>

    <div class="row">
        <div class="col-sm-12">
        <?= $form->field($model, "notice_id")->dropdownList([                           
                ShoppingNotice::findOne($notice_id)->id => ShoppingNotice::findOne($notice_id)->notice_number 
            ]);?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'card_number')->widget(MaskedInput::className(),[
        'mask' => '9999-999999999999'
    ]) ?>
        </div>
       
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'card_given_date')->textInput(['type'=>'date']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
        <?= $form->field($model, "created_by")->dropdownList([                           
                User::findOne(Yii::$app->user->id)->id => User::findOne(Yii::$app->user->id)->name . ' ' . User::findOne(Yii::$app->user->id)->surname
            ]);?>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <input type="submit" class="btn btn-info br-btn" value="Saqlash">
        </div>
    </div>

    <?php ActiveForm::end() ?>

</div>
