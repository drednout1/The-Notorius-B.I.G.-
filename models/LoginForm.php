<?php

namespace app\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $login;
    public $pass;
    public $role;
    public $rememberMe = true;

    
    public function rules() 
    {
        return [
            [['login', 'pass', 'role'], 'required'],
            [['login', 'pass',], 'string',  'min' => 6 , 'max' => 20],
        ];
    }
}
