<?php 
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * No comment yet.
 */



class LocalActiveRecord extends ActiveRecord
{
    const YANVAR_UZ = 1;
    const FEVRAL_UZ = 2;
    const MART_UZ = 3;
    const APREL_UZ = 4;
    const MAY_UZ = 5;
    const IYUN_UZ = 6;
    const IYUL_UZ = 7;
    const AVGUST_UZ = 8;
    const SENTABR_UZ = 9;
    const OKTABR_UZ = 10;
    const NOYABR_UZ = 11;
    const DEKABR_UZ = 12;

    const ALL_ACTIVITY = 0;
    const PRODUCTION_ACTIVITY = 10;
    const SERVICE_ACTIVITY = 20;
    const TRADE_ACTIVITY = 21;
    const IMPORT_ACTIVITY = 22;
    const SERTIFICATION_ACTIVITY = 23;
    const TESTING_ACTIVITY = 24;

    public function AttributeLabels()
    {
        return [
            //Common
            'id' => 'ID',
            'status' => 'Status',
            'created_by' => 'Yaratgan foydalanuvchi',
            'updated_by' => 'Yangilagan foydalanuvchi',
            'created_at' => 'Yaratilgan sana',
            'updated_at' => 'Yangilangan sana',
            'comment' => 'Izoh',
            'company_type_id' => 'Tashkilot faoliyat turi',
            'company_id' => 'Tashkilot nomi',
            'gov_control_order_id' => 'Tekshiruv raqami',
            'real_control_date_from' => 'Haqiqatda tekshiriv boshlanish sanasi',
            'real_control_date_to' => 'Haqiqatda tekshiriv tugash sanasi',
            'act_selection_id' => 'Namuna tanlab olish dalolatnomasi raqami',
            //RiskAnalisys
            'risk_analisys_date' => 'Xavf tahlili sanasi',
            'risk_analisys_number' => 'Xavf tahlili raqami',
            'criteria' => 'Mezon',
            'criteria_id' => 'Mezon',
            //Company
            'stir' => 'STIR',
            'company_name' => 'Tashkilot nomi',
            'registration_date' => 'Ro\'yxatdan o\'tgan sana',
            'region_id' => 'Hudud nomi',
            'address' => 'Manzili',
            'thsht' => 'THSHT',
            'ifut' => 'IFUT',
            'ownername' => 'Rahbar',
            'phone' => 'Tel. raqami',
            // User
            'username' => 'Login',
            'pass' => 'Parol',
            'surname' => 'Familiyasi',
            'fathers_name' => 'Otasining ismi',
            'role' => 'Rol',
            'position' => 'Lavozimi(to\'liq)',
            'position_id' => 'Lavozimi(id)',
            'alias' => 'Lavozimi',
        ];
    }

    public static function getDate_uz($type = null)
    {
        $arr = [
            self::YANVAR_UZ => 'yanvar',
            self::FEVRAL_UZ => 'fevral',
            self::MART_UZ => 'mart',
            self::APREL_UZ => 'aprel',
            self::MAY_UZ => 'may',
            self::IYUN_UZ => 'iyun',
            self::IYUL_UZ => 'iyul',
            self::AVGUST_UZ => 'avgust',
            self::SENTABR_UZ => 'senrtabr',
            self::OKTABR_UZ => 'oktabr',
            self::NOYABR_UZ => 'noyabr',
            self::DEKABR_UZ => 'dekabr',
        ];

        if ($type === null) {
            return $arr;
        }
        
        return $arr[$type];
    }

    public function getPhoneNumber($value = null)
    {
        if($value === null){
            return $value; 
        }
        if(strlen($value) <> 9){
            return null; 
        }
        return '(' . substr($value,0, 2) . ')-' . substr($value,2,3) . '-' .
            substr($value,5,2) . '-' . substr($value,7,2);
    }

    public function trimPhoneNumber($value)
    {
        return substr(preg_replace('#[^0-9]#', '', $value),-9);
    }
    
    public function beforeSave($insert)
    {
        $array = 
        [
            [['phone'],'trimPhoneNumber'],
            [
                [
                    'registration_date', 'created_at', 'updated_at', 'control_period_from', 
                    'control_period_to', 'control_date_from', 'control_date_to', 
                    'ombudsman_code_date', 'activation_date', 'deactivation_date', 
                    'real_control_date_from', 'real_control_date_to', 'last_gov_control_date', 
                    'mfrd_date'
                ],'strtotime'
            ],
            [['ownername'], 'strtoupper'],
        ];

        foreach($array as $onearray){
            foreach($onearray[0] as $attribute){
                $function = $onearray[1];
                if(isset($this->$attribute)){
                    if(!empty($this->$attribute)){
                        if($function == 'trimPhoneNumber'){
                            $this->$attribute = $this->$function($this->$attribute);
                                }
                        else{$this->$attribute = $function($this->$attribute);}
                    }
                }
            }
        }
        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        $array = 
        [
            [['created_at', 'updated_at', 'registration_date', 'control_period_from',
            'control_period_to', 'control_date_from', 'control_date_to', 'ombudsman_code_date',
            'activation_date', 'deactivation_date', 'real_control_date_from', 'real_control_date_to', 
            'last_gov_control_date', 'mfrd_date'],'integertotime'],
            [['phone'], 'getPhoneNumber'],
        ];

        foreach($array as $onearray){
            foreach($onearray[0] as $attribute){
                $function = $onearray[1]; 
                if(isset($this->$attribute)){
                    if($function == 'integertotime'){
                        $this->$attribute = $this->$attribute ? Yii::$app->formatter->asDate($this->$attribute, 'dd.MM.yyyy') : $this->$attribute;
                            }
                    else if($function == 'getPhoneNumber'){
                        $this->$attribute = $this->$function($this->$attribute);
                            }
                    else{$this->$attribute = $function($this->$attribute);}
                }
            }
        }
        parent::afterFind(); // TODO: Change the autogenerated stub
    }
    public static function getActivity($type = null)
    {
        $arr = [
    
            self::ALL_ACTIVITY => 'Barcha faoliyat turlari',
            self::PRODUCTION_ACTIVITY => 'Ishlab chiqarish',
            self::SERVICE_ACTIVITY => 'Xizmat ko\'rsatish',
            self::TRADE_ACTIVITY => 'Savdo',
            self::IMPORT_ACTIVITY => 'Import',
            self::SERTIFICATION_ACTIVITY => 'Sertifikatlashtirish idorasi',
            self::TESTING_ACTIVITY => 'Sinov laboratoriyasi',
        ];
    
        if ($type === null) {
            return $arr;
        }
    
        return $arr[$type];
    }
}

?>