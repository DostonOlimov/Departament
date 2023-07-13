<?php

namespace frontend\widgets;

use yii\bootstrap4\Widget;
use yii\helpers\VarDumper;

class StepsGovControl extends Widget
{

    public $gov_control_order_id;

    public function run()
    {
        return $this->render('sidebar_gov-control',
        [
            'gov_control_order_id' => $this->gov_control_order_id,
        ]);
    }

}
