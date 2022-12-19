<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model PrimaryData */

use common\models\control\PrimaryData;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use common\models\NdType;
use yii\widgets\ActiveForm;

//$this->title = 'Birlamchi ma`lumotlar';
//$this->params['breadcrumbs'][] = $this->title;

?>

<?php DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_inner_2',
    'widgetBody' => '.container-rooms_2',
    'widgetItem' => '.room-item_2',
    'limit' => 5,
    'min' => 1,
    'insertButton' => '.add-room_2',
    'deleteButton' => '.remove-room_2',
    'model' => $pro_cer[0],
    'formId' => 'dynamic-form',
    'formFields' => [
        'number_reestr',
        'date_to',
        'date_from'
    ],
]); ?>
 <h5 style="color:black;display:inline;">Mahsulot sertifikat(lar)i</h5>
 <button type="button" class="add-room_2 btn btn-success btn-xs" style ="display:inline">
                        <span class="fa fa-plus"></span>
                    </button>
    <table class="table table-bordered">
        <thead>
        </thead>
        <tbody class="container-rooms_2">
        <?php foreach ($pro_cer as $indexRoom => $modelRoom): ?>
            <tr class="room-item_2 ">
                <td class="vcenter">
                    <div class="row">
                        <div class="col-sm-4">
                            <?= $form->field($modelRoom, "[{$primaryIndex}][{$indexRoom}]number_reestr")->textInput(['type' => 'number']); ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($modelRoom, "[{$primaryIndex}][{$indexRoom}]date_to")->textInput(['type' => 'date']) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($modelRoom, "[{$primaryIndex}][{$indexRoom}]date_from")->textInput(['type' => 'date']) ?>
                        </div>
                    </div>
                </td>
                <td class="text-center vcenter" style="width: 90px;">
                    <button type="button" class="add-room_2 btn btn-success btn-xs">
                        <span class="fa fa-plus"></span>
                    </button>
                    <button type="button" class="remove-room_2 btn btn-danger btn-xs mt-3 ">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php DynamicFormWidget::end(); ?>