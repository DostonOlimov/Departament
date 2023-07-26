<?php

use common\models\RiskAnalisys;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\models\Company;
use common\models\User;
use kartik\date\DatePicker;
use kartik\export\ExportMenu;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\RiskAnalisysSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Xavf tahlili';
$this->params['breadcrumbs'][] = $this->title;


?>

<div class="risk-analisys-export">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php 
    
    // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php $form = ActiveForm::begin([
    // 'action' => ['index'],
    // 'method' => 'get',
]); ?>
    <div class="col-3">
        <?= $form->field($model, 'start_date')->label(false)->widget(DatePicker::class, [
            'options' => ['placeholder' => 'Boshlanish vaqti'],
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd.mm.yyyy'
                ]
            ]); ?>
    </div>
    <div class="col-3">
        <?= $form->field($model, 'end_date')->label(false)->widget(DatePicker::class, [
            'options' => ['placeholder' => 'Tugash vaqti'],
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd.mm.yyyy'
                ]
            ]); 
            // echo Html::a('Yuklab olish', ['document','id' => 1], ['class' => 'btn btn-primary']);
            ?>  
            <?php echo Html::submitButton('Yuklab olish', ['class' => 'btn btn-primary']) ?>
    </div>
        <?php ActiveForm::end(); ?>


</div>



