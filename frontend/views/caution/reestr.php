<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use frontend\widgets\StepsReestr;


/** @var yii\web\View $this */
/** @var common\models\prevention\PreventionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Bartaraf etish ko\'rsatmasi');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-4">
        <?= StepsReestr::widget([
                
        ])?>
    </div>
     <div class="col-sm-8">       
        </div>


</div>
