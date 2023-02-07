<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\shopping\ShoppingNotice $model */

$this->title = 'Tahrirlash bildirgi: №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tahrirlash bildirgi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="shopping-notice-update">

<?php $form = ActiveForm::begin(); ?>    

    <?= $form->field($model, 'status')->dropdownList([                           
        '1' => 'Tasdiqlangan',        
            ]
    );?>
    <?= $form->field($model, 'attachment_user_id')->dropdownList(                           
        ArrayHelper::map($users = User::findAll(['status'=>10]), 'id',function ($users) {
            return $users->name.' '.$users->surname;
         }), ['class' => 'form-control', 'prompt' => '- - -']       
            
    );?>
    <?= $form->field($model, "updated_by")->dropdownList([                           
                User::findOne(Yii::$app->user->id)->id => User::findOne(Yii::$app->user->id)->name . ' ' . User::findOne(Yii::$app->user->id)->surname
    ]);?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
