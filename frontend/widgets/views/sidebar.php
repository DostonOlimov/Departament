<?php
/**@var $control_company_id */
/**@var $control_instruction_id */

use common\models\control\Company;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use common\models\control\PrimaryProduct;
use common\models\control\InstructionType;
use common\models\control\PrimaryData;

$action = Yii::$app->controller->action->id;
$type = InstructionType::findOne(['instruction_id'=>$control_instruction_id]);

$hrefIns = ($control_instruction_id) ? '/control/instruction-view?id=' . $control_instruction_id : '/control/instruction';
$classIns = ($action == 'instruction' || $action == 'instruction-view') ? 'active' : ($control_instruction_id ? 'actived' : '');

$hrefCom = ($control_company_id) ?  Url::to(['/control/company-view', 'id' => $control_company_id])  : Url::to(['/control/company', 'instruction_id' => $control_instruction_id]);
$classCom = ($action == 'company' || $action == 'company-view') ? 'active' : ($control_instruction_id ? 'actived' : 'disabled');

$hrefPrimary = '';
$classPrimary = 'disabled';

$hrefProduct = '';
$classProduct = 'disabled';

$hrefIdentification = '';
$classIdentification = 'disabled';

$hrefLab = '';
$classLab = 'disabled';
$controlCompany = Company::findOne($control_company_id);
$t = true;
if($type->canceled == 0) {
if ($control_company_id) {
    $data = PrimaryData::findOne(['control_company_id' => $control_company_id]);
    $hrefPrimary = $controlCompany->primaryData ? Url::to(['/control/primary-data-view', 'id' => $controlCompany->primaryData->id]) : Url::to(['/control/primary-data', 'company_id' => $control_company_id]);
    $classPrimary = ($action == 'primary-data' || $action == 'primary-data-view') ? 'active' : ($control_company_id ? 'actived' : 'disabled');

    if($controlCompany->primaryData)
    {
        if($type){
        if($type->product == 0) {
            $hrefLab = $controlCompany->laboratory ? Url::to(['/control/laboratory-view', 'id' => $controlCompany->laboratory->id]) : Url::to(['/control/laboratory', 'company_id' => $control_company_id]);
            $classLab = ($action == 'laboratory' || $action == 'laboratory-view') ? 'active' : ($controlCompany->primaryData ? 'actived' : 'disabled');          
             $t = false;
        }
        }
        $hrefProduct =  Url::to(['/control/primary-products/index', 'primary_data_id' => $data->id]) ;
        $classProduct = ($action == 'primary-products/index' ) ? 'active' : ($data ? 'actived' : 'disabled');
    if($data->identification_status)

        $hrefIdentification = $data->identification_status ? Url::to(['/control/identification-view', 'id' => $control_company_id]) : Url::to(['/control/identification', 'company_id' => $control_company_id]);
        $classIdentification = ($action == 'identification' || $action == 'identification-view') ? 'active' : ( $data->identification_status ? 'actived' : 'disabled');
    if($t){
        $hrefLab = $controlCompany->laboratory ? Url::to(['/control/laboratory-view', 'id' => $controlCompany->laboratory->id]) : Url::to(['/control/laboratory', 'company_id' => $control_company_id]);
        $classLab = ($action == 'laboratory' || $action == 'laboratory-view') ? 'active' : ($data->identification_status ? 'actived' : 'disabled');
    }
    }
   
}
?>



    <div class="col-3  list-group margin-topSite">
    <a href="javascript:void(0);" class="list-group-item list-group-item-action notHover">Davlat nazorati</a>
    <a href="<?= $hrefIns ?>" class="list-group-item list-group-item-action <?= $classIns ?> ">Davlat nazorati o'tkazish uchun asos</a>
    <a href="<?= $hrefCom ?>" class="list-group-item list-group-item-action <?= $classCom ?> ">XYUS to'g'risida ma'lumot</a>
    <a href="<?= $hrefPrimary ?>" class="list-group-item list-group-item-action <?= $classPrimary ?> ">Birlamchi ma'lumotlar</a>

<?php if($type->product == 1): ?>
    <a href="<?= $hrefProduct ?>" class="list-group-item list-group-item-action <?= $classProduct ?> ">Mahsulotlar</a>
    <a href="<?= $hrefIdentification ?>" class="list-group-item list-group-item-action <?= $classIdentification ?> ">Mahsulotning tashqi ko'rinishi va<br> markirovkasi bo'yicha ma'lumot (identifikatsiya)</a>
<?php else : 
 endif;?>  
    <a href="<?= $hrefLab ?>" class="list-group-item  list-group-item-action <?= $classLab ?> ">Na'muna olish va labaratoriya natijalari </a>
    <a href="index" class="list-group-item  list-group-item-action actived  ">Barcha tekshiruvlar </a>
</div>
<?php }
else {
$hrefLab = $controlCompany->laboratory ? Url::to(['/control/laboratory-view', 'id' => $controlCompany->laboratory->id]) : Url::to(['/control/laboratory', 'company_id' => $control_company_id]);
$classLab = ($action == 'laboratory' || $action == 'laboratory-view') ? 'active' : ($control_instruction_id ? 'actived' : 'disabled');
?>
<div class="col-3  list-group margin-topSite">
    <a href="javascript:void(0);" class="list-group-item list-group-item-action notHover">Davlat nazorati</a>
    <a href="<?= $hrefIns ?>" class="list-group-item list-group-item-action <?= $classIns ?> ">Davlat nazorati o'tkazish uchun asos</a>
    <a href="<?= $hrefCom ?>" class="list-group-item list-group-item-action <?= $classCom ?> ">XYUS to'g'risida ma'lumot</a>
    <a href="<?= $hrefLab ?>" class="list-group-item  list-group-item-action <?= $classLab ?> ">Na'muna olish va labaratoriya natijalari </a>
    <a href="index" class="list-group-item  list-group-item-action actived  ">Barcha tekshiruvlar </a>
</div>
<?php
}
?>
