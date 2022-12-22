<?php

/* @var $this yii\web\View */

/* @var $model Measure */

use common\models\control\Measure;
use frontend\widgets\Steps;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

$this->title = 'Ko\'rsatilgan ta`sir choralar';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .label{
        font-size: 25px;
        color:black;
        padding:10px;
        width:540px;
    }
</style>
    <div class="page1-1 row ">


        <?= Steps::widget([
            'control_instruction_id' => $model->controlCompany->controlInstruction->id,
            'control_company_id' => $model->control_company_id,
        ]) ?>
        <?php $form = ActiveForm::begin([
            'enableClientValidation' => false
        ]); ?>

        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <?= $form->field($model, 'type')->checkboxList(Measure::typeList(), [
                    'onchange' => "inputGenerate(event)"
                ])->label('Ko\'rilgan ta`sir choralar') ?>
            </div>


        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-6" >
                <hr>
                <div id="titleOv" style="color: #000;"></div>
                <?= $form->field($model, 'ov_date')->widget(DatePicker::className()) ?>
                <?= $form->field($model, 'ov_quantity')->textInput(['type'=>'number']) ?>
                <?= $form->field($model, 'ov_name')->textInput() ?>
            </div>
            <div class="col-sm-6 col-lg-6">
                <hr>
                <div id="titlePerson" style="color: #000;"></div>
                <?= $form->field($model, 'person')->textInput() ?>
                <?= $form->field($model, 'number_passport')->widget(MaskedInput::className(), [
                    'mask' => 'AA9999999'
                ]) ?>
                <?= $form->field($model, 'fine_amount')->textInput() ?>
                <div class = "row" id = "mjtk" style="display:none">
                <label>MJtK moddasi</label>
                <div class="col-sm-4">
                <?= $form->field($model, 'm212')->dropDownList([0 => '- - -',1=>'1-qismi', 2 => '2-qismi',3=>'3-qismi',4=>'4-qismi'],);?>
                </div>
                <div class="col-sm-4">
                <?= $form->field($model, 'm213')->dropDownList([0 => '- - -',1=>'1-qismi', 2 => '2-qismi']);?>
                </div>
                <div class="col-sm-4">
                <?= $form->field($model, 'm214')->dropDownList([0 => '- - -',1=>'1-qismi', 2 => '2-qismi']);?>
                </div>
                <table style="color:black;">
                <tr><td class = "label">Tushuntirish xati</td><td><?= $form->field($model, 'explanation_letter')->fileInput()->label(false) ?></td></tr>
                <tr><td class = "label">Talabnoma</td><td><?= $form->field($model, 'claim')->fileInput()->label(false) ?></td></tr>
                <tr><td class = "label">Sud xati</td><td><?= $form->field($model, 'court_letter')->fileInput()->label(false) ?></td></tr>
                </table>
                </div>
            </div>
            <div class="col-sm-6 col-lg-6">
            <hr>
                <div id="titleEco" style="color: #000;"></div>
                <?= $form->field($model, 'first_warn_date')->widget(DatePicker::className()) ?>
                <?= $form->field($model, 'warn_number')->textInput(['type' => 'number']) ?>
                <?= $form->field($model, 'eco_date')->widget(DatePicker::className())  ?>
                <?= $form->field($model, 'eco_number')->textInput(['type' => 'number']) ?>
                <?= $form->field($model, 'eco_quantity')->textInput() ?>
                <?= $form->field($model, 'eco_amount')->textInput() ?>
            </div>
            <div class="col-sm-12 col-lg-6">
                <hr>
                <div id="titleRe" style="color: #000;"> </div>
                <?= $form->field($model, 'realization_date')->widget(DatePicker::className()) ?>
                <?= $form->field($model, 'realization_number')->textInput(['type'=>'number']) ?>
                <div class="row" id="products" style="display:none;" >
        <?php foreach ($products as $key => $stan) :?> 
            <div class="panel-body"> 
                    <div class="pull-right">
                        <button type="button" onclick="plusPro(this)" class="add-item_2 btn btn-success btn-xs"><i class="fa fa-plus"></i></button>
                        <button type="button" onclick="minusPro(this)" class="remove-item_2 btn btn-danger btn-xs" id="removeBtn"><i class="fa fa-minus"></i></button>
                     </div>  
                     <div class = "products"> 
                        <div class = "row">   
                        <label>Mahsulot nomi:</label>
                        <label class="form-control" style = "background-color:rgb(57, 71, 227); color:white;" readonly><?= $stan['product_name'] ?></label>
                        <?= $form->field($stan, "[{$key}]product_id")->hiddenInput(['value'=> $stan['product_id']])->label(false);?>
                        <?= $form->field($stan, "[{$key}]amount")->textInput(['type'=>'number']) ?>
                        <?= $form->field($stan, "[{$key}]quantity")->textInput(['type'=>'number']) ?>
                        </div>
                    </div>
                 </div>
                    <?php endforeach; ?>
            </div>
            </div>
        </div>
        <div class="col-6 mt-4">
            <input type="submit" class="btn btn-info br-btn" value="Saqlash">
        </div>

        <?php ActiveForm::end(); ?>

    </div>
    <script>
        const showing = (a,b,c,d,e,f) => {
            $(`.field-measure-${a}`).show()
            $(`.field-measure-${b}`).show()
            $(`.field-measure-${c}`).show()
            $(`.field-measure-${d}`).show()
            $(`.field-measure-${e}`).show()
            $(`.field-measure-${f}`).show()
        }
        const removing = (a,b,c,d,e,f) => {
            $(`.field-measure-${a}`).hide()
            $(`.field-measure-${b}`).hide()
            $(`.field-measure-${c}`).hide()
            $(`.field-measure-${d}`).hide()
            $(`.field-measure-${e}`).hide()
            $(`.field-measure-${f}`).hide()
        }
        const MJ = (s) => s ?  showing('person', 'number_passport', 'fine_amount',): removing('person', 'number_passport', 'fine_amount')
        const OV = (s) => s ?   showing('ov_date', 'ov_quantity', 'ov_name'):  removing('ov_date', 'ov_quantity', 'ov_name')
        const Three = (s) => s ?   showing('realization_date','realization_number'):  removing('realization_date','realization_number')
        const Eco = (s) => s ?   showing('first_warn_date', 'warn_number', 'eco_date','eco_number','eco_quantity','eco_amount'):  removing('first_warn_date', 'warn_number', 'eco_date','eco_number','eco_quantity','eco_amount')

        function inputGenerate(event) {
            let val = event.target.value , checked = event.target.checked
           // alert(event.path[2].children[child].children[0].checked)
           // const threeChange = (child) => event.path[2].children[child].children[0].checked
            if (checked && val == 1) {

                let node = document.createElement("span");
                node.setAttribute("id", "span1");// Create a <li> node
                let textnode = document.createTextNode("O'.V taqiqlash.");         // Create a text node
                node.appendChild(textnode);                              // Append the text to <li>
                document.getElementById("titleOv").appendChild(node);

                OV(true)
            }

            if(checked===false && val==1){
                $("#span1").remove();
                OV(false)
            }

            if (checked && val== 3) {
                let person = document.createElement("span");
                person.setAttribute("id", "span3");// Create a <li> node
                let personText = document.createTextNode("Jarimaga tortilgan shaxs.");         // Create a text node
                person.appendChild(personText);                              // Append the text to <li>
                document.getElementById("titlePerson").appendChild(person);

                let mj = document.getElementById("mjtk");
                mj.style.display="flex";
                MJ(1)
            }
            if(checked===false && val==3)
            {
                let mj = document.getElementById("mjtk");
                mj.style.display="none";
            }

            if (checked && val== 2) {
                let re2 = document.createElement("span");
                re2.setAttribute("id", "span2");// Create a <li> node
                let reText = document.createTextNode("Realizatsiyani taqiqlash. ");         // Create a text node
                re2.appendChild(reText);                              // Append the text to <li>
                document.getElementById("titleRe").appendChild(re2);

                let mj = document.getElementById("products");
                mj.style.display="flex";
                Three(true)
            }

            if(checked===false && val==2){
                $("#span2").remove();
                let mj = document.getElementById("products");
                mj.style.display="none";
                Three(false)
            }

            if (checked && val== 4) {
                let re4 = document.createElement("span");
                re4.setAttribute("id", "span4");// Create a <li> node
                let re4Text = document.createTextNode("Iqtisodiy jarima. ");         // Create a text node
                re4.appendChild(re4Text);                              // Append the text to <li>
                document.getElementById("titleEco").appendChild(re4);
                Eco(true)
            }

            if(checked===false && val==4){
                $("#span4").remove();
                Eco(false)
            }

          /*  if (checked && val== 5) {
                let re5 = document.createElement("span");
                re5.setAttribute("id", "span5");// Create a <li> node
                let re5Text = document.createTextNode("Savdodan chiqarish. ");         // Create a text node
                re5.appendChild(re5Text);                              // Append the text to <li>
                document.getElementById("titleRe").appendChild(re5);
            }

            if(checked===false && val==5){
                $("#span5").remove();
            }*/

            if (checked === false && val == 3) {
                $("#span3").remove();
                MJ(0)
            }
         /*   if (checked && val != 3 && val != 1) {
                Three(true)
            }
            if (threeChange(1) === false && threeChange(3) === false && threeChange(4) === false ) {
                Three(false)
            }*/
        }
function findParent(elem, className){
        if (elem.parentNode.classList.contains(className)){
            return elem.parentNode;
        }

        return findParent(elem.parentNode,className);

    }
 function plusPro(e) {
        obj = findParent(e, 'panel-body');  
        var collection =  obj.getElementsByClassName("products");
        for (var i=0;i<collection.length;i++)
        {
            collection[i].style.display = 'flex';
        }
        }
function minusPro(e){
    obj = findParent(e, 'panel-body'); 
            let inputs = obj.getElementsByClassName('products');
            for (let i = 0; i < inputs.length; i++) {
                inputs[i].style.display = 'none';
            }
    }
    </script>
<?php
$this->registerJs('
    $(".field-measure-person").hide()
    $(".field-measure-number_passport").hide()
    $(".field-measure-fine_amount").hide()
    
    $(".field-measure-first_warn_date").hide()
    $(".field-measure-warn_number").hide()
    $(".field-measure-eco_date").hide()
    $(".field-measure-eco_number").hide()
    $(".field-measure-eco_quantity").hide()
    $(".field-measure-eco_amount").hide()

    $(".field-measure-ov_date").hide()
    $(".field-measure-ov_quantity").hide()
    $(".field-measure-ov_name").hide()

    $(".field-measure-realization_date").hide()
    $(".field-measure-realization_number").hide()
');

?>  