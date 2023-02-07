<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
use yii\bootstrap4\Breadcrumbs;

/** @var yii\web\View $this */
/** @var common\models\caution\CautionLetters $model */

$this->title = Yii::t('app', 'Tahrirlash ogohlantirish xati: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ogoghantirish xati'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '№'.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Tahrirlash');
?>
<?php echo Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'options' => [
                    'class' => 'breadcrumb float-sm-right text-primary'
                ]
            ]);
            ?>
<div class="caution-letters-update">
<div class="caution-letters-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'letter_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'letter_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'updated_by')->dropdownList([                           
            User::findOne(Yii::$app->user->id)->id => User::findOne(Yii::$app->user->id)->name . ' ' . User::findOne(Yii::$app->user->id)->surname
            
            ]);?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
    

</div>
