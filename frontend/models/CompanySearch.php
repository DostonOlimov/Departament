<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class CompanySearch extends Model
{
    public $stir;
    // public $email;
    // public $subject;
    // public $body;
    // public $verifyCode;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['stir',], 'required'],
            [['stir'],'integer'],
         
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'stir' => 'Korxona STIR',
        ];
    }

}
