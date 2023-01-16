<?php

use common\models\control\Caution;
use common\models\control\Company;
use common\models\control\Defect;
use common\models\control\Identification;
use common\models\control\Instruction;
use common\models\control\InstructionUser;
use common\models\control\Laboratory;
use common\models\control\Measure;
use common\models\control\PrimaryData;
use common\models\control\PrimaryOv;
use common\models\control\PrimaryProduct;
use common\models\control\ControlProductLabaratoryChecking;
use common\models\control\ControlProductCertification;
use frontend\models\LaboratoryHelper;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\control\Instruction */

$this->title = 'Davlat nazorati o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = ['label' => 'Korxonalar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="instruction-view">

    <p>
        <?= Html::a('Yangilash', ['/control/instruction/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Inspektorlar qo\'shish', ['/control/instruction-user/index', 'instruction_id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
            if ($model->general_status == Instruction::GENERAL_STATUS_SEND) {
                echo Html::a('Tasdiqlash', ['/control/control/done', 'id' => $model->id], ['class' => 'btn btn-warning']);
            }
        ?>
        <?php if ($model->general_status !== Instruction::GENERAL_STATUS_DONE){
        echo  Html::a('Hamma ma`lumotni o\'chirish', ['/control/instruction/delete', 'id' => $model->id], [
            'class' => 'btn btn-danger float-right',
            'data' => [
                'confirm' => 'Haqiqatan ham bu elementni o‘chirmoqchimisiz?',
                'method' => 'post',
            ],
        ]); } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            [
                'attribute' => 'base',
                'value' => function ($model) {
                    return Instruction::getBase($model->base);
                }
            ],
            [
                'attribute' => 'type',
                'value' => function ($model) {
                    return Instruction::getType($model->type);
                }
            ],
            'letter_date:date',
            'letter_number',
            'command_date:date',
            'command_number',
            'checkup_begin_date:date',
            [
                'attribute' => 'checkup_duration',
                'value' => function ($model) {
                    return $model->checkup_duration.'-kun';
                }
            ],
            [
                'attribute' => 'real_checkup_date',
                'value' => function(Instruction $model) {
                    return $model->real_checkup_date ? $model->real_checkup_date : 'Boshlanmagan';
                }
            ],
            [
                'attribute' => 'checkup_finish_date',
                'value' => function(Instruction $model) {
                    return $model->checkup_finish_date ? $model->checkup_finish_date : 'Yakunlanmagan';
                }
            ],
            'checkup_duration_start_date:date',
            'checkup_duration_finish_date:date',
            'who_send_letter',
            [
                'attribute' => 'Tekshiruv predmeti',
                'value' => function ($model) {
                    
                    $result = '';
                    $model->checkup_subject = explode('.', substr($model->checkup_subject, 0));
                  //  \yii\helpers\VarDumper::dump($model->checkup_subject);die;
                    foreach ($model->checkup_subject as $key => $type) {
                        $t=$key+1;
                        if($type){
                        $result .= $t.' - '. Instruction::getSubject($type) . "</br>";
                        }
                    }
                    return $result;
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Inspektorlar',
                'value' => function ($model) {
                    $users = InstructionUser::find()->where(['instruction_id' => $model->id])->all();
                    $result = '';
                    foreach ($users as $user) {
                        $result .= '<span class="text-secondary">' . $user->user->name . ' ' . $user->user->surname . '</span><br>';
                    }
                    return $result;
                },
                'format' => 'raw'
            ],
        ],
    ]) ?>

</div>


<?php
$company = Company::findOne(['control_instruction_id' => $model->id]);
if ($company) { ?>
    <hr>
    <h2>Xyus to'g'risida ma`lumot</h2>
    <div class="company-view">
        <p>
            <?= Html::a('Yangilash', ['/control/company/update', 'id' => $company->id], ['class' => 'btn btn-primary']) ?>
         
        </p>
        <?= DetailView::widget([
            'model' => $company,
            'attributes' => [
                'name',
                'inn',
                'soogu',
                'ifut',
                'thsht',
                'address',
                'type',
                'ownername',
                [
                    'label' => 'Hudud',
                    'value' => function (Company $model) {
                        return $model->region->name;
                    }
                ],
                [
                    'attribute' => 'phone',
                    'value' => function (Company $model) {
                        return $model->phoneNumber;
                    },
                ],
                'address',
                [
                    'label' => 'Mutaxasis',
                    'value' => function (Company $model) {
                        return $model->createdBy->username;
                    },
                ],
            ],
        ]) ?>
    </div>

    <?php
    $primaryData = PrimaryData::findOne(['control_company_id' => $company->id]);
    if ($primaryData) { ?>
        <hr>
        <h2>Birlamchi ma`lumotlar</h2>
        <div class="company-view">
            <p>
                <?= Html::a('Yangilash', ['/control/primary-data/update', 'id' => $primaryData->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Mahsulotlar', ['/control/primary-products/index', 'primary_data_id' => $primaryData->id], ['class' => 'btn btn-info']) ?>
                <?= Html::a('O\'lchov vositalari', ['/control/primary-ov/index', 'primary_data_id' => $primaryData->id], ['class' => 'btn btn-info']) ?>
            </p>
            <?= DetailView::widget([
                'model' => $primaryData,
                'attributes' => [
                    [
                        'attribute' => 'laboratory',
                        'value' => function ($model) {
                            return PrimaryData::getLab($model->laboratory);
                        }
        
                    ],
                    [
                        'attribute' => 'smt',
                        'value' => function ($model) {
                            return PrimaryData::getSMT($model->smt);
                        }
        
                    ],
                ]
            ]) ?>
        </div>
    <?php 

 $primaryDataId = PrimaryData::findOne(['control_company_id' => $company->id])->id;
 $products = PrimaryProduct::find()->where(['control_primary_data_id' => $primaryDataId])->all();

 if ($products) { ?>
    <hr>
    <h2>Mahsulotlar sifati</h2>
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
                            }
                        ],
                        [
                            'attribute' => 'cer_quantity',
                            'value' => function ($mod) {
                                if($mod){return $mod->cer_amount;}
                               
                            }
                        ],
                        [
                            'attribute' => 'Nomuvofiqlik sababi',
                            'value' => function ($mod) {
                                
                                $result = '';
                                $mod->defect_type = explode('.', substr($mod->defect_type, 0));
                                foreach ($mod->defect_type as $key => $type) {
                                    $t=$key+1;
                                    if($type){
                                    $result .= $t.' - '. PrimaryProduct::getDefect($type) . "; ";
                                    }
                                }
                                return $result;
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
                            else{return 'Kiritilmagan';}
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
       echo " <h4 style = 'color:blue;'>Mahsulot(lar) sertifikatlari</h4>";
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
}
?> 
<?php
}
    $laboratory = Laboratory::findOne(['control_company_id' => $company->id]);
    if ($laboratory) { ?>
        <hr>
        <h2>Namuna olish va laboratoriya natijalari</h2>
        <div class="company-view">
            <p>
                <?= Html::a('Yangilash', ['/control/laboratory/update', 'id' => $laboratory->id], ['class' => 'btn btn-primary']) ?>
            </p>
            <?= DetailView::widget([
                'model' => $laboratory,
                'attributes' => [
                    [
                        'attribute' => 'dalolatnoma',
                        'value' => function (Laboratory $model) {
                            return $model->dalolatnoma ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('dalolatnoma') . '" download>Yuklash<a/>' : LaboratoryHelper::getForm($model->id, 'dalolatnoma');
                        },
                        'format' => 'raw'
                    ],
                    [
                        'attribute' => 'bayonnoma',
                        'value' => function (Laboratory $model) {
                            return $model->bayonnoma ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('bayonnoma') . '" download>Yuklash<a/>' : LaboratoryHelper::getForm($model->id, 'bayonnoma');
                        },
                        'format' => 'raw'
                    ],
                    [
                        'attribute' => 'out_bayonnoma',
                        'value' => function (Laboratory $model) {
                            return $model->out_bayonnoma ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('out_bayonnoma') . '" download>Yuklash<a/>' : LaboratoryHelper::getForm($model->id, 'out_bayonnoma');
                        },
                        'format' => 'raw'
                    ],
                    [
                        'attribute' => 'out_dalolatnoma',
                        'value' => function (Laboratory $model) {
                            return $model->out_dalolatnoma ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('out_dalolatnoma') . '" download>Yuklash<a/>' : LaboratoryHelper::getForm($model->id, 'out_dalolatnoma');
                        },
                        'format' => 'raw'
                    ],
                    [
                        'attribute' => 'finish_dalolatnoma',
                        'value' => function (Laboratory $model) {
                            return $model->finish_dalolatnoma ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('finish_dalolatnoma') . '" download>Yuklash</a>' : '';
                        },
                        'format' => 'raw'
                    ],
                ],
            ]) ?>
        </div>
    <?php }

    $defect = Defect::findOne(['control_company_id' => $company->id]);
    if ($defect) { ?>
        <hr>
        <h2>Aniqlangan kamchiliklar</h2>
        <div class="result-view">
            <p>
                <?= Html::a('Yangilash', ['/control/defect/update', 'id' => $defect->id], ['class' => 'btn btn-primary']) ?>
            </p>
            <?= DetailView::widget([
                'model' => $defect,
                'attributes' => [
//            'id',
                    [
                        'attribute' => 'type',
                        'value' => function (Defect $model) {
                            $result = '';
                            preg_match_all('!\d+!', $model->type, $matches);
                            foreach ($matches[0] as $type) {
                                $result .= '<label>' . Defect::typeList($type) . '</label><br>';
                            }
                            //}
                            return $result;
                        },
                        'format' => 'raw'
                    ],
                    'description:text',
                
                ],
            ]) ?>
        </div>
    <?php }

    $measure = Measure::findOne(['control_company_id' => $company->id]);

    if ($measure) { ?>
        <hr>
        <h2>Ko'rilgan ta`sir choralar</h2>
        <div class="result-view">
            <p>
                <?= Html::a('Yangilash', ['/control/measure/update', 'id' => $measure->id], ['class' => 'btn btn-primary']) ?>
            </p>
            <?= DetailView::widget([
                    'model' => $measure,
                    'attributes' => [
//            'id',
                        [
                            'attribute' => 'type',
                            'value' => function (Measure $model) {
                                $res = '';
                                if ($model->type) {
                                    foreach (explode(',', $model->type) as $type) {
                                        $res .= '<label>' . Measure::typeList($type) . '</label><br>';
                                    }
                                }
                                return $res;
                            },
                            'format' => 'raw'
                        ],
                        'ov_date',
                        'ov_quantity',
                        'ov_name',
                        'realization_date',
                        'realization_number',
                        'person',
                        'number_passport',
                        'fine_amount',
                        [
                            'attribute' => 'band_mjtk',
                            'value' => function ($model) {
                                
                                $result = '';
                                $model->band_mjtk = explode(',', substr($model->band_mjtk, 1));
                               // \yii\helpers\VarDumper::dump($model->band_mjtk);die;
                            if($model->band_mjtk[0]){$result .= ' MJtK ning 212-moddasi '. $model->band_mjtk[0]. '-qismi;</br>';}
                            if($model->band_mjtk[1]){$result .= ' MJtK ning 213-moddasi '. $model->band_mjtk[1]. '-qismi;</br>';}
                            if($model->band_mjtk[2]){$result .= ' MJtK ning 214-moddasi '. $model->band_mjtk[2]. '-qismi;';}
                                return $result;
                            },
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'explanation_letter',
                            'value' => function ( $model) {
                                return $model->explanation_letter ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('explanation_letter') . '" download>Yuklash<a/>' : 'Yuklanmagan';
                            },
                            'format' => 'raw'
                        ],
                        [
                            'attribute' => 'court_letter',
                            'value' => function ( $model) {
                                return $model->court_letter ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('court_letter') . '" download>Yuklash<a/>' : 'Yuklanmagan';
                            },
                            'format' => 'raw'
                        ],
                        [
                            'attribute' => 'claim',
                            'value' => function (   $model) {
                                return $model->claim ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('claim') . '" download>Yuklash<a/>' : 'Yuklanmagan';
                            },
                            'format' => 'raw'
                        ],
                        'first_warn_date',
                        'warn_number',
                        'eco_date',
                        'eco_number',
                        'eco_quantity',
                        'eco_amount'
                    ],
                ]
            ) ?>
        </div>
    <?php }
} ?>
