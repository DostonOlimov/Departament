<?php
use common\models\control\InstructionUser;
use common\models\control\Instruction;
use common\models\User;
use frontend\widgets\Steps;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model Instruction */

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page1-1 row">
<?= Steps::widget([
        'control_instruction_id' => $id,
        'control_company_id' => $company_id,
    ]) ?>

    <?php $form = ActiveForm::begin() ?>
    <div class="row">
        <div class="col-sm-9">
            <?= $form->field($model, 'finish_date')->widget(DatePicker::className(),['pluginOptions' => [
        'autoclose' => true,
        'format' => 'dd.mm.yyyy'
    ]]) ?>
        </div>
    </div>
    <div class="col-12">
        <input type="submit" class="btn btn-info br-btn" value="Yakunlash">
    </div>
    <?php ActiveForm::end() ?>

</div>
