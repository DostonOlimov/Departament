<?php

/* @var $this yii\web\View */
/* @var $model Identification */

use common\models\control\Company;
use common\models\control\ControlProductLabaratoryChecking;
use common\models\control\ControlProductCertification;
use frontend\widgets\Steps;
use frontend\models\IdentificationHelper;
use yii\widgets\DetailView;
use yii\grid\GridView;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="page1-1 row ">

    <?= Steps::widget([
        'control_instruction_id' => Company::findOne($id) ? Company::findOne($id)->control_instruction_id : null,
        'control_company_id' => $id,
    ]) ?>
     <div class="col-6">
     <h4 style = 'color:blue;'>Tashqi ko’rinish bayonnomasi</h4>
        <?php
        if ($products)
            foreach ($products as $key => $mod) {
                echo DetailView::widget([
                    'model' => $mod,
                    'attributes' => [
//            'id',
                       'product_name:text',
                        [
                            'attribute' => 'quality',
                            'value' => function ($mod) {
                                if($mod->quality == 1){return 'Muvofiq';}
                                else {return 'NoMuvofiq';}
                            }
                        ],
                        'description:text',
                        [
                            'attribute' => 'cer_amount',
                            'value' => function ($mod) {
                                if($mod){return $mod->cer_amount;}
                                else {return 'ko\'rsatilmagan';}
                            }
                        ],
                        [
                            'attribute' => 'cer_quantity',
                            'value' => function ($mod) {
                                if($mod){return $mod->cer_amount;}
                                else {return 'ko\'rsatilmagan';}
                            }
                        ],
                      
                        
                    ],
                ]) ;
            }

        ?>
    <h4 style = 'color:blue;'>Sinov labalatoriyasi xulosasi</h4>
    <?php 
    
         foreach ($products as $key => $value) 
         {
          $labs = ControlProductLabaratoryChecking::findOne(['product_id' => $value->id]);
          if ($labs){
           
            $labs->product_name = $value->product_name;
            echo DetailView::widget([
                'model' => $labs,
                'attributes' => [
//            'id',
                    'product_name:text',             
                    [
                        'attribute' => 'quality',
                        'value' => function ($labs) {
                            if($labs->quality == 1){return 'Muvofiq';}
                            elseif($labs->quality == 0){return 'NoMuvofiq';}
                            else{return IdentificationHelper::getForm($labs->id, 'quality');}
                        },
                        'format' => 'raw',
                    ],
                    'description:text',
                ],
            ]) ;
        }
      
    }
?>
    <?php 
     foreach ($products as $key => $value) 
        {
            $cer = ControlProductCertification::findAll(['product_id' => $value->id]);
           
        if ($cer)
       echo " <h4 style = 'color:blue;'>Majburiy sertifikatlashtirish</h4>";
        foreach ($cer as $key => $mod) {
            $mod->product_name = $value->product_name;
            echo DetailView::widget([
                'model' => $mod,
                'attributes' => [
//            'id',
                    'product_name:text',
                    'number_reestr:text',
                    'date_to:text',
                    'date_from:text',
                ],
            ]) ;
        }

    }
   
?> 
    </div>
</div>
