<?php

namespace app\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $login;
    public $pass;
    public $user_id;
    public $rememberMe = true;

    
    public function rules() 
    {
        return [
            [['login', 'pass', 'user_id'], 'required'],
            [['login', 'pass',], 'string',  'min' => 6 , 'max' => 20],
        ];
    }
}
