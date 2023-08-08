<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\identification\IdentificationContent $model */

$this->title = 'Create Identification Content';
$this->params['breadcrumbs'][] = ['label' => 'Identification Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
// debug($model);
?>
<?php $form = ActiveForm::begin(); ?>
<div class="identification-content-create container">
    <h3>Mahsulot: <?= $selected_product->name ?></h3>
    <br>
    <h3>Me'yoriy hujjat: <?= $nd->determination.' - '.$nd->name ?></h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="col-2">Bob nomi</th>
                <th class="col-4">Band nomi</th>
                <th class="col-5">Amaldagi holat</th>
                <th class="col-1">Muvofiqlik</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ( $model as $key => $value) :  ?>
                <?= $form->field($value, "[{$key}]selected_normative_document_id")->hiddenInput()->label(false) ?>
                <?= $form->field($value, "[{$key}]normative_document_content_id")->hiddenInput()->label(false) ?>
                <!-- col-1 -->
                    <th>
                        <small>
                            <?= $value->section_name ?>
                        </small>
                    </th>
                <!-- col-2 -->
                <th>
                    <small>
                        <?= $value->name ?>
                    <small>
                        <?= $form->field($value, "[{$key}]status")->checkbox([
                            // 'label' => $value->name,
                            'label' => '',
                            'checked' => false,
                            'uncheck' => 0,
                        ])->label(false); ?>
                </th>
                <!-- col-3 -->
                <th>
                    <?= $form->field($value, "[{$key}]comment")->textArea()->label(false) ?>
                </th>
                <!-- col-4 -->
                <th>
                    <?= $form->field($value, "[{$key}]conformity")->dropDownList($value->getConformity(), ['prompt' => ''])->label(false) ?>
                </th>
        </tbody>
    <?php endforeach; ?>

    <div class="form-group">
    <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>
    </div>
    <?php ActiveForm::end(); ?>
    
    </div>
    
    
    

   
   
