<?php

use yii\helpers\Html;
use common\models\User;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;

//use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var common\models\prevention\Prevention $model */
$this->title = Yii::t('app', 'File yuklash');
?>
 <?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'file')->widget(FileInput::className(),[
    'options'=>['accept'=>'pdf/*','doc/*','docx/*'],
    'pluginOptions' => [
        'showUpload' => false,
       // 'uploadUrl' => Url::to(['/site/upload']),
        'allowFileExtensions' => ['pdf'],
        'maxFileSize' => 3000
    ],
    ])?>
<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>  