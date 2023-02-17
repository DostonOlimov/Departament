<?php

use common\models\control\Company;
use common\models\control\Instruction;
use common\models\User;
use common\models\shopping\ShoppingNotice;
use common\models\shopping\ShoppingNoticeSearch;
use frontend\widgets\StepsShopping;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\control\InstructionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Korxonalar';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .pagination li a {
        padding: 2px 5px;
    }

    .pagination li.active {
        background-color: #1AB475;
    }

    .pagination li a {
        color: black;
    }

    .pagination li a:hover {
        background-color: grey;
    }
</style>
<div class="row">
    <?= StepsShopping::widget([
               // 'shopping_instruction_id' => null,
               // 'shopping_company_id' => null,
    ]) ?>

    <div class="col-8"> 
    <p>
        <?= Html::a('Bildirgi qo\'shish', ['/shopping/notice'], ['class' => 'btn btn-success'])  ?>
        <!--?= Html::a('Qo\'shish', ['/shopping/instruction'], ['class' => 'btn btn-success'])  ?-->
    </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'headerRowOptions' => ['style' => 'background-color: #0072B5'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'label' => 'Bildirgi raqami',
                        'value' => function ($model) {
                            $notice = ShoppingNotice::findOne(['id' => $model->id]);
                            // echo '<pre>';
                            // var_dump($company->region->name);die();
                            // echo '</pre>';
                            return $notice ? $notice->notice_number : '';
                        }
                    ],
                    [
                        'label' => 'Bildirgi summasi',
                        'value' => function ($model) {
                            $notice = ShoppingNotice::findOne(['id' => $model->id]);
                            if ($notice) {
                                return $notice->notice_sum;
                            }
                            return '';
                        },
                        'format' => 'raw',
                    ],
                    [
                        'label' => 'Tasdiqlagan shaxs',
                        'value' => function ($model) {
                            $user = User::findOne($model->attachment_user_id);
                            return $user ? $user->name .' '.$user->surname :'';
                        }
                    ],
                    

                    [
                        'label' => 'Nazorat xaridi',
                        'value' => function ($model) {
                            $shopping = ShoppingNotice::findOne(['id' => $model->id]);
                            if ($shopping) {
                                return Html::a('Batafsil', ['/shopping/instruction-add','notice_id' => $model->id], ['class' => 'btn bg-primary','style'=>'font-weight:bold; color:white;']);
                            }
                            return '';
                        },
                        'format' => 'raw',
                    ],

                    [
                        'label' => 'Nazorat xaridi qo\'shish',
                        'value' => function ($model) {
                            $notice = ShoppingNotice::findOne(['id' => $model->id]);
                            if ($notice) {
                                return Html::a('<i class="fa fa-plus" aria-hidden="true"></i>', ['/shopping/instruction', 'notice_id' => $model->id], ['class' => 'btn bg-success','style'=>'font-weight:bold; color:white;']);
                            }
                            return '';
                        },
                        'format' => 'raw',
                    ],
                ],
            ]); ?>
    </div>
</div>
