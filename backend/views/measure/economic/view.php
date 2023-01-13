<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\control\Instruction;
use common\models\User;

/** @var yii\web\View $this */
/** @var common\models\measure\Economics $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Economics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="economics-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Davlat nazorati buyruq kodi',
                'value' => function ($model) {
                    $name =  Instruction::findOne([$model->control_instruction_id]);
                    if($name) {
                        return $name->command_number;
                    }
                   // return $re_users;
                },
             ],
            'first_warn_date:date',
            'warn_number',
            'eco_date:date',
            'eco_number',
            'eco_quantity',
            'eco_amount',
            [
                'attribute' => 'created_by',
                'label' => 'Mutaxassis',
                'value' => function ($model) {
                    $re_users = '';
                    $name =  User::findOne([$model->created_by]);
                    if($name) {
                        $re_users .= $name->username;
                    }
                    return $re_users;
                },
             ],
            'created_at:date',
            'updated_at:date',
        ],
    ]) ?>

</div>
