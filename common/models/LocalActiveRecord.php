<?php 
namespace common\models;

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
            //RiskAnalisys
            'company_id' => 'Tashkilot nomi',
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
            'position_id' => 'Lavozimi',
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
}

?>