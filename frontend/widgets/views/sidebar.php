<?php
/**@var $control_company_id */
/**@var $control_instruction_id */

use common\models\control\Company;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use common\models\control\PrimaryProduct;

$action = Yii::$app->controller->action->id;

$hrefIns = ($control_instruction_id) ? '/control/instruction-view?id=' . $control_instruction_id : '/control/instruction';
$classIns = ($action == 'instruction' || $action == 'instruction-view') ? 'active' : ($control_instruction_id ? 'actived' : '');

$hrefCom = ($control_company_id) ?  Url::to(['/control/company-view', 'id' => $control_company_id])  : Url::to(['/control/company', 'instruction_id' => $control_instruction_id]);
$classCom = ($action == 'company' || $action == 'company-view') ? 'active' : ($control_instruction_id ? 'actived' : 'disabled');

$hrefPrimary = '';
$classPrimary = 'disabled';

$hrefIdentification = '';
$classIdentification = 'disabled';

$hrefLab = '';
$classLab = 'disabled';

$hrefDef = '';
$classDef = 'disabled';

$hrefCaution = '';
$classCaution = 'disabled';

$hrefMeasure = '';
$classMeasure = 'disabled';

if ($control_company_id) {
    $controlCompany = Company::findOne($control_company_id);

    $hrefPrimary = $controlCompany->primaryData ? Url::to(['/control/primary-data-view', 'id' => $controlCompany->primaryData->id]) : Url::to(['/control/primary-data', 'company_id' => $control_company_id]);
    $classPrimary = ($action == 'primary-data' || $action == 'primary-data-view') ? 'active' : ($control_company_id ? 'actived' : 'disabled');
    $identification = false;
    if($controlCompany->primaryData)
    {
        $primaryData = PrimaryProduct::findAll(['control_primary_data_id' => $controlCompany->primaryData->id ]);
        foreach($primaryData as $key => $value) 
        {
            $identification = false;
            if($value->quality !== null)
            {
               $identification = true;
            }
        }
    }
    $hrefIdentification = $identification ? Url::to(['/control/identification-view', 'id' => $control_company_id]) : Url::to(['/control/identification', 'company_id' => $control_company_id]);
    $classIdentification = ($action == 'identification' || $action == 'identification-view') ? 'active' : ($controlCompany->primaryData ? 'actived' : 'disabled');

    $hrefLab = $controlCompany->laboratory ? Url::to(['/control/laboratory-view', 'id' => $controlCompany->laboratory->id]) : Url::to(['/control/laboratory', 'company_id' => $control_company_id]);
    $classLab = ($action == 'laboratory' || $action == 'laboratory-view') ? 'active' : ($identification ? 'actived' : 'disabled');

    $hrefDef = $controlCompany->defect ? Url::to(['/control/defect-view', 'id' => $controlCompany->defect->id]) : Url::to(['/control/defect', 'company_id' => $control_company_id]);
    $classDef = ($action == 'defect' || $action == 'defect-view') ? 'active' : ($controlCompany->laboratory  ? ($controlCompany->laboratory -> finish_dalolatnoma ? 'actived' : 'disabled') : 'disabled');

  /*  $hrefCaution = $controlCompany->caution ? Url::to(['/control/caution-view', 'id' => $control_company_id]) : Url::to(['/control/caution', 'company_id' => $control_company_id]);
    $classCaution = ($action == 'caution' || $action == 'caution-view') ? 'active' : ($controlCompany->defect ? 'actived' : 'disabled');
    $classCaution = $controlCompany->defect ? ($controlCompany->defect->type == ".4" ? 'disabled' : $classCaution) : $classCaution;
    */
    $hrefMeasure = $controlCompany->measure ? Url::to(['/control/measure-view', 'id' => $controlCompany->measure->id]) : Url::to(['/control/measure', 'company_id' => $control_company_id]);
    $classMeasure = ($action == 'measure' || $action == 'measure-view') ? 'active' : ($controlCompany->defect ? 'actived' : 'disabled');
    $classMeasure = $controlCompany->defect ? ($controlCompany->defect->type == ".4" ? 'disabled' : $classMeasure) : $classMeasure;
}
?>

<div class="col-3  list-group margin-topSite">
    <a href="javascript:void(0);" class="list-group-item list-group-item-action notHover">Davlat nazorati</a>
    <a href="<?= $hrefIns ?>" class="list-group-item list-group-item-action <?= $classIns ?> ">Davlat nazorati o'tkazish uchun asos</a>
    <a href="<?= $hrefCom ?>" class="list-group-item list-group-item-action <?= $classCom ?> ">XYUS to'g'risida ma'lumot</a>
    <a href="<?= $hrefPrimary ?>" class="list-group-item list-group-item-action <?= $classPrimary ?> ">Birlamchi ma'lumotlar</a>
    <a href="<?= $hrefIdentification ?>" class="list-group-item list-group-item-action <?= $classIdentification ?> ">Mahsulotning tashqi ko'rinishi va<br> markirovkasi bo'yicha ma'lumot (identifikatsiya)</a>
    <a href="<?= $hrefLab ?>" class="list-group-item  list-group-item-action <?= $classLab ?> ">Na'muna olish va labaratoriya natijalari </a>
    <a href="index" class="list-group-item  list-group-item-action actived  ">Barcha tekshiruvlar </a>
</div>
