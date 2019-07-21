<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\Users;
use app\models\RegForm;

class AuthController extends Controller
{
    public function actionIndex()
    {
        $model = new LoginForm();

        if ($post = $model->load(Yii::$app->request->post()) && $model->validate()) 
        {
            $user = Users::findOne([
                'user_id' => $model->user_id,
                'login' => $model->login,
                'pass' => $model->pass,
            ]);

            if($user->login != $model->login && $user->pass != $model->pass){
                return $this->render('index' , [
                    'model' => $model,
                    'reg' => 'reg']);
            };

            \yii::$app->session->set('user_id', $user->user_id);
            \yii::$app->session->set('id', $user->id);
        };

        $user1 = \yii::$app->session->get('user_id');
                    
        if ($post && $user1 == 0) {
            return $this->redirect('\web\table\common');        
            } 
                elseif ($post && $user1 == 1) {
                    return $this->redirect('\web\files\files-upload');
                };
        
        return $this->render('index' , [
            'model' => $model,
        ]);
    }      

    public function actionRegister()
    {
        $model = new RegForm();

        $users = Users::find()->all();

        if (\Yii::$app->request->post()){
            $model->load(Yii::$app->request->post());
            $model->validate();    
        };
        
        if (Users::findOne([
            'login' => $model->login,
            'email' => $model->email,
            'pass' => $model->pass,])) 
        {
            return $this->render('register' , [
                'model' => $model,
                'log' => 'log'
                ]);
                

        } else if($model->load(Yii::$app->request->post())){
            $newUser = new Users();
            $newUser->login = $model->login;
            $newUser->pass = $model->pass;
            $newUser->email = $model->email;
            $newUser->user_id = $model->user_id;
            $newUser->save();
        
            return $this->render('register' , [
                        'model' => $model,
                        'reg' => 'reg']);
                    };
            
        return $this->render('register' , [
            'model' => $model,
            'users' => $users,
        ]);
    }
}

?>