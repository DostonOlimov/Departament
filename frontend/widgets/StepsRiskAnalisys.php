<?php

namespace frontend\widgets;

use yii\bootstrap4\Widget;
use yii\helpers\VarDumper;
use common\models\RiskAnalisys;

class StepsRiskAnalisys extends Widget
{

    // public $caution_instruction_id;
    public $id;
    public $company_id;
    public $view_id;

    public function run()
    {
        // VarDumper::dump($this->company_id);die;
        //debug($this->risk_company_id);
        // if ($company_id){
        //      return $this->render('sidebar_risk-analisys', 'company_id' => $this->company_id);
        //  }
        //  else{
        return $this->render('sidebar_risk-analisys', [
            'company_id' => $this->company_id,
            'id' => $this->id,
            'view_id' => $this->view_id,
        ]);
    //  }
    }

}