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
    

    const DOCUMENT_STATUS_NEW = 1;
    const DOCUMENT_STATUS_SENT = 2;
    const DOCUMENT_STATUS_RETURNED = 3;
    const DOCUMENT_STATUS_DENIED = 4;
    const DOCUMENT_STATUS_CONFIRMED = 5;
    const DOCUMENT_STATUS_READ = 6;
    const DOCUMENT_STATUS_NOTREAD = 7;
    const DOCUMENT_STATUS_INPROGRESS = 8;


    const ALL_ACTIVITY = 0;
    const PRODUCTION_ACTIVITY = 10;
    const SERVICE_ACTIVITY = 20;
    const TRADE_ACTIVITY = 21;
    const IMPORT_ACTIVITY = 22;
    const SERTIFICATION_ACTIVITY = 23;
    const TESTING_ACTIVITY = 24;

    const TECHNIC_AND_STANDARD_FIELD = 1;
    const SERTIFICATION_FIELD = 2;
    const METROLOGY_FIELD = 3;
    const ACCREDITATION_FIELD = 4;
    const MASS_MEDIA_FIELD = 5;

    const OBJECT_DOESNT_EXIST = 0;
    const OBJECT_EXISTS = 1;
    const OBJECT_WITH_CONTRACT = 2;
    

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        if ($this->hasAttribute('created_at') && $this->hasAttribute('updated_at')) {
            $behaviors['timestamp'] = [
                'class' => \yii\behaviors\TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
            ];
        }
        if ($this->hasAttribute('created_by') && $this->hasAttribute('updated_by')) {
            $behaviors['blameable'] = [
                'class' => \yii\behaviors\BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ];
        }
        return $behaviors;
    }

    public function AttributeLabels()
    {
        return [
            //Common
            'id' => 'ID',
            'status' => 'Holati',
            'created_by' => 'Yaratgan foydalanuvchi',
            'updated_by' => 'Yangilagan foydalanuvchi',
            'created_at' => 'Yaratilgan sana',
            'updated_at' => 'Yangilangan sana',
            'comment' => 'Izoh',
            'company_type_id' => 'Tashkilot faoliyat turi',
            'company_id' => 'Tashkilot nomi',
            'gov_control_order_id' => 'Tekshiruv raqami',
            'real_control_date_from' => 'Haqiqatda tekshirish boshlanish sanasi',
            'real_control_date_to' => 'Haqiqatda tekshirish tugash sanasi',
            'act_selection_id' => 'Namuna tanlab olish dalolatnomasi raqami',
            'summary_user_id' => 'Umumlashtiruvchi',
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
            self::SENTABR_UZ => 'sentabr',
            self::OKTABR_UZ => 'oktabr',
            self::NOYABR_UZ => 'noyabr',
            self::DEKABR_UZ => 'dekabr',
        ];

        if ($type === null) {
            return $arr;
        }
        
        return $arr[$type];
    }
    public static function getDocumentStatus($type = null)
    {
        $arr = [
            self::DOCUMENT_STATUS_NEW => 'Yangi',
            self::DOCUMENT_STATUS_SENT => 'Jo\'natilgan',
            self::DOCUMENT_STATUS_RETURNED => 'Qaytarilgan',
            self::DOCUMENT_STATUS_DENIED => 'Rad etilgan',
            self::DOCUMENT_STATUS_CONFIRMED => 'Tasdiqlangan',
            self::DOCUMENT_STATUS_READ => 'O\'qilgan',
            self::DOCUMENT_STATUS_NOTREAD => 'O\'qilmagan',
            self::DOCUMENT_STATUS_INPROGRESS => 'Jarayonda',
        ];

        if ($type === null) {
            return $arr;
        }
        
        return $arr[$type];
    }
    public static function getObject($type = null)
    {
        $arr = [
            self::OBJECT_DOESNT_EXIST => 'Mavjud emas',
            self::OBJECT_EXISTS => 'Mavjud',
            self::OBJECT_WITH_CONTRACT => 'Shartnoma asosida',
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
                    'mfrd_date', 'start_date', 'end_date', 'risk_analisys_date'
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
            'last_gov_control_date', 'mfrd_date', 'start_date', 'end_date', 'risk_analisys_date'
        ],'integertotime'],
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

    public static function getUsers()
    {
        $result = [];
        foreach (User::find()->where(['role' => 'inspector', 'status' => User::STATUS_ACTIVE])->all() as $user){
            $result[$user->id] = $user->name . ' ' . $user->surname;
        }
        return $result;
    }
    public function getCriteriaBall($risk_analisys_id, $category_id = null)
    
    {
        // debug($category_id);
        $criteria_ids = $this->getCriteriaByCategory($category_id);
        // debug($criteria_ids);
        $search = ($criteria_ids)?
        ['risk_analisys_id' => $risk_analisys_id,'criteria_id' => $criteria_ids ]:
        ['risk_analisys_id' => $risk_analisys_id];
        // debug($search);
        $criteria = RisksCriteria::find()
        ->where($search)
        ->select('criteria_id')
        ->asArray()
        ->all();
        // debug($criteria);
        $score_sum = 0;
        foreach($criteria as $criterion){
            $score_sum += RiskAnalisysCriteria::findOne($criterion['criteria_id'])
            ->criteria_score ?? 0;
        }
        // debug($score_sum);
        return $score_sum;
    }
    public function getCriteriaByCategory($criteria_category_id){
        $arr = RiskAnalisysCriteria::find()
        ->where(['criteria_category' => $criteria_category_id])
        ->select('id')
        ->asArray()
        ->all();
        foreach($arr as $key => $value){
            $arr[$key] = $value['id'];
        }
        return $arr;
        // debug($arr);
    }

    
    public static function getField($type = null)
    {
        $arr = [
    
            self::TECHNIC_AND_STANDARD_FIELD => 'Texnik jihatdan tartibga solish va standartlashtirish sohasida qonun buzilish',
            self::SERTIFICATION_FIELD => 'Sertifikatlashtirish sohasidagi qonun buzilish',
            self::METROLOGY_FIELD => 'Metrologiya sohasidagi qonun buzilish',
            self::ACCREDITATION_FIELD => 'Muvofiqlikni baholashda qonun buzish',
            self::MASS_MEDIA_FIELD=>'Ommaviy axborot vositalari va ijtimoiy tarmoqlarda mahsulot 
            va xizmatlar yuzasidan qonun buzilish',
        ];
    
        if ($type === null) {
            return $arr;
        }
    
        return $arr[$type];
    }
    public static function getCompanyField($type = null)
    {
        $arr = [
            self::PRODUCTION_ACTIVITY => "Ishlab chiqaruvchi",
            self::SERVICE_ACTIVITY => "Xizmat ko'rsatuvchi",
            self::TRADE_ACTIVITY => 'Savdo',
            self::IMPORT_ACTIVITY => "Importyor",
            self::SERTIFICATION_ACTIVITY => 'Sertifikatlashtirish organi',
            self::TESTING_ACTIVITY => 'Sinov laboratoriyasi',
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }

    public static function getStatusSpan($status)
    {
        $class = 'secondary';
                switch ($status) {

                    case self::DOCUMENT_STATUS_CONFIRMED:
                        $class = 'success';
                        break;
                    
                    case self::DOCUMENT_STATUS_INPROGRESS:
                        $class = 'secondary';
                        break;
                        
                    case self::DOCUMENT_STATUS_NEW:
                        $class = 'warning';
                        break;
                    case self::DOCUMENT_STATUS_SENT:
                        $class = 'info';
                        break;                        
                }
        return '<span class="badge badge-pill badge-' . $class . '">' . self::getDocumentStatus($status) . '</span><br>';

    }
    public static function getPermissionAdmin($action, $status)
    {
        $permission = [
                            'update' => false,
                            'create_order' => false,
                            'confirm' => false,
                            'return' => false,
                            'deny' => false,
                            'delete' => false,
                        ];

                switch ($status) {

                    case self::DOCUMENT_STATUS_NEW:
                        $permission['delete'] = true;
                        break;

                    case self::DOCUMENT_STATUS_SENT:
                        // $permission['delete'] = true;
                        $permission['deny'] = true;
                        $permission['return'] = true;
                        $permission['update'] = true;
                        $permission['confirm'] = true;
                        break;    

                    case self::DOCUMENT_STATUS_CONFIRMED:
                        $permission['update'] = true;
                        break;
                    
                    case self::DOCUMENT_STATUS_INPROGRESS:
                        $permission['delete'] = true;
                        $permission['update'] = true;
                        break;
                    case self::DOCUMENT_STATUS_RETURNED:
                        $permission['update'] = true;
                        $permission['delete'] = true;
                        $permission['confirm'] = true;

                        break;
                        
                }

                return $permission[$action];

    }

    public static function getPermissionInspector($action, $status)
    {
        $permission = [
                            'update' => false,
                            'create_order' => false,
                            'confirm' => false,
                            'send' => false,
                            'delete' => false,
                            'download' => false,
                        ];

                switch ($status) {

                    case self::DOCUMENT_STATUS_NEW:
                        $permission['send'] = true;
                        $permission['delete'] = true;
                        $permission['update'] = true;
                        break;

                    case self::DOCUMENT_STATUS_SENT:

                        break;    

                    case self::DOCUMENT_STATUS_CONFIRMED:
                        $permission['download'] = true;
                        $permission['create_order'] = true;
                        break;
                    
                    case self::DOCUMENT_STATUS_INPROGRESS:
                        $permission['delete'] = true;
                        $permission['update'] = true;
                        break;

                    case self::DOCUMENT_STATUS_RETURNED:
                        $permission['send'] = true;
                        $permission['delete'] = true;
                        $permission['update'] = true;
                        break;

                    case self::DOCUMENT_STATUS_DENIED:
                        $permission['delete'] = true;
                        break;
                        
                }

                return $permission[$action];

    }
    public function getUserPosition()
    {
        return $this->hasOne(UserPosition::class, ['id' => 'position_id']);
    }

    public static function getUserFormated($user_id, $format = 'name surname', $upper_case = false)
    {
        $user = User::find()->joinWith('userPosition')->where(['user.id' => $user_id])->one();

        $name = !empty($user->name) ? $user->name : '';
        $sname = !empty($user->surname) ? $user->surname : '';
        $fname = !empty($user->fathers_name) ? $user->surname : '';
        
        if($upper_case === true){
            $name = strtoupper($name);
            $sname = strtoupper($sname);
            $fname = strtoupper($fname);
        }
            switch($format){
                case 'name surname' :               return $name.' '.$sname; break;
                case 'n. surname' :                 return substr($name, 0, 1).' '.$sname; break;
                case 'name surname fathers_name' :  return $name.' '.$sname.' '.$fname; break;
                case 'n. s. fathers_name' :         return substr($name, 0, 1).' '.substr($sname, 0, 1).' '.$fname; break;
                case 'name' :                       return  $name; break;
                case 'username' :                   return $user->username; break;
            }
    }

    public function getListOfUnitOfMeasurement($value = null){
        $arr = [
            100 => 'm',
            101 => 'm2',
            102 => 'm3',
            200 => 'kg',
            300 => 'dona',
            301 => 'qadoq',

        ];
        if($value){
            return $arr[$value];
        }
        return $arr;
    }
}

?>