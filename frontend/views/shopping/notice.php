<?php

/* @var $this yii\web\View */
/* @var $model Instruction */

use frontend\widgets\StepsShopping;
use common\models\User;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="page1-1 row ">

    <?= StepsShopping::widget([
        'shopping_instruction_id' => null,
        'shopping_company_id' => null,
    ]) ?>
    
    <?php $form = ActiveForm::begin(); ?>
        <h3 class="text-primary">Bildirgi qo'shish</h3>
        <div class="row">
            <div class="col-sm-12">
                <?= $form->field($model, 'notice_number')->textInput() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?= $form->field($model, 'notice_sum')->textInput() ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
            <?= $form->field($model, "created_by")->dropdownList([                           
                User::findOne(Yii::$app->user->id)->id => User::findOne(Yii::$app->user->id)->name . ' ' . User::findOne(Yii::$app->user->id)->surname
            ]);?>
            </div>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
