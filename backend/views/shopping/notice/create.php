<?php
use common\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\shopping\ShoppingNotice $model */

$this->title = 'Bildirgi qo\'shish';
$this->params['breadcrumbs'][] = ['label' => 'Shopping Notices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shopping-notice-create">
<?php $form = ActiveForm::begin(); ?>
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
        <?php $form = ActiveForm::begin(); ?>    

    <?= $form->field($model, 'status')->dropdownList([                           
        '1' => 'Tasdiqlangan',
        
            ]
    );?>
        <?= $form->field($model, 'attachment_user_id')->textInput() ?>
        <?= $form->field($model, "updated_by")->dropdownList([                           
                    User::findOne(Yii::$app->user->id)->id => User::findOne(Yii::$app->user->id)->name . ' ' . User::findOne(Yii::$app->user->id)->surname
        ]);?>

    
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
