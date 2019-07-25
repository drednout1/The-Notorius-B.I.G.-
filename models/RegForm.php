<?php

namespace app\models;

use Yii;
use yii\base\Model;

class RegForm extends Model
{
    public $login;
    public $pass;
    public $email;
    public $role;
    public $rememberMe = true;

    
    public function rules() 
    {
        return [
            [['login', 'pass', 'role', 'email'], 'required'],
            [['login', 'pass', 'email'], 'string',  'min' => 6 , 'max' => 20],
            ['login', 'unique', 'targetClass' => users::class],
            ['email', 'unique', 'targetClass' => users::class],
        ];
    }

}
