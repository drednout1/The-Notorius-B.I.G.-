<?php

namespace app\models;

use Yii;
use yii\base\Model;

class RegForm extends Model
{
    public $login;
    public $pass;
    public $email;
    public $user_id;
    public $rememberMe = true;

    
    public function rules() 
    {
        return [
            [['login', 'pass', 'user_id', 'email'], 'required'],
            [['login', 'pass', 'email'], 'string',  'min' => 6 , 'max' => 20],
            ['login', 'unique', 'targetClass' => users::class],
        ];
    }

}
