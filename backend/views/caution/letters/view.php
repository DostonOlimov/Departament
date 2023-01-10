<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\bootstrap4\Breadcrumbs;

/** @var yii\web\View $this */
/** @var common\models\caution\CautionLetters $model */

$this->title = 'Ogohlantirish xati №'.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ogohlantirish xati №'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="caution-letters-view">
    <p>
        
    <?php echo Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'options' => [
                    'class' => 'breadcrumb float-sm-right text-primary'
                ]
            ]);
            ?>
    <?= Html::a(Yii::t('app', 'Tahrirlash'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    
    <?= Html::a(Yii::t('app', 'File yuklash'), ['uploads', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        
    </p>

    <?= DetailView::widget([
            'model' => $model,
            
            'attributes' => [
                [
                    'label' => '№',
                    'value' => function ($data) {
                    // $prevention = Prevention::findOne(['id' => $model->id]);
                        return $data ? $data->id : '';
                    }
                ],
                [
                    'label' => 'Korxona',
                    'value' => function ($data) {
                        //$company = Company::findOne(['id' => $model->companies_id]);
                        return $data ? $data->company->name : '';
                    }
                ],
                [
                    'label' => 'Korxona INN',
                    'value' => function ($data) {
                        //$company = Company::findOne(['id' => $model->companies_id]);
                        return $data ? $data->company->inn : '';
                    }
                ],

                [
                    'label' => 'Korxona manzili',
                    'value' => function ($data) {
                        //$company = Company::findOne(['id' => $model->companies_id]);
                        return $data ? $data->company->address : '';
                    }
                ],
                [
                    'label' => 'Korxona telefon raqami',
                    'value' => function ($data) {
                        // $company = Company::findOne(['id' => $model->companies_id]);
                        return $data ? $data->company->phone : '';
                    }
                ],
            
                //'created_at',
                'letter_date',
                'letter_number',
                //'file',
                'comment',
                [
                    'attribute'=> 'created_by',
                    'value' => function ($data) {
                    // $instruction = Instruction::findOne(['id' => $model->instructions_id]);
                        return $data ? $data->user->name .' '. $data->user->surname  : '';
                    }
                ],
            ],
        ]) ?>
        <?php if(!empty($model->file)):?>
        <iframe class="iframemargins" src="<?php echo Url::to("@web/uploads/caution_letter/{$model->file}", true);?>" 
            title="PDF in an i-Frame" frameborder="0" scrolling="auto" width="100%" 
            height="600px">
        </iframe>
        <?php endif;?>

</div>
