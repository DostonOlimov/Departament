<?php
use common\models\shopping\Instruction;
use common\models\shopping\ShoppingNotice;
use kartik\date\DatePicker;
use common\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\shopping\Instruction */

$this->title = 'Xaridni yakunlash: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Nazorat xaridi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['/shopping/shopping/view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="instruction-update">

<div class="shopping-instruction-form">

<?php $form = ActiveForm::begin() ?>

<div class="row">
    <div class="col-sm-12">
        <?= $form->field($model, 'card_return_date')->textInput(['type'=>'date']) ?>
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


</div>
