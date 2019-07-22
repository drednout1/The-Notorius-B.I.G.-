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

            $hash = Yii::$app->getSecurity()->generatePasswordHash($model->pass);
            $hashPass = Yii::$app->getSecurity()->validatePassword($model->pass, $hash);

            \yii::$app->session->set('user_id', $user->user_id);
            \yii::$app->session->set('id', $user->id);
            $user1 = \yii::$app->session->get('user_id');

            if ($user->login == $model->login && $hashPass && $user1 == 0) {
                return $this->redirect('table\common');  
            } elseif ($user->login == $model->login && $hashPass && $user1 == 1) {
                            return $this->redirect('files/files-upload');
                        };

            if(isset($user->login) != $model->login ){
                return $this->render('index' , [
                    'model' => $model,
                    'reg' => 'reg']);
            };
        };

        return $this->render('index' , [
            'model' => $model,
        ]);
    }      

    public function actionRegister()
    {
        $model = new RegForm();

        $users = Users::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) 
        {
            $hashPass = Yii::$app->getSecurity()->generatePasswordHash($model->pass);
            $alreadyRegister = Users::findOne([
                'login' => $model->login,
                'email' => $model->email,
                'hashPass' => $model->pass,
                'pass' => $model->pass,]);

                if ($alreadyRegister->email == $model->email &&
                $alreadyRegister->login == $model->login) 
                {
                    return $this->render('register' , 
                    [
                        'model' => $model,
                        'log' => 'log'
                    ]);
                } else {
                    $newUser = new Users();
                        $newUser->login = $model->login;
                        $newUser->pass = $model->pass;
                        $newUser->hashPass = $hashPass;
                        $newUser->email = $model->email;
                        $newUser->user_id = $model->user_id;
                        $newUser->save();
                    
                        return $this->render('register' , 
                        [
                            'model' => $model,
                            'reg' => 'reg'
                        ]);
                };                     
        }          
        return $this->render('register' , [
            'model' => $model,
            'users' => $users,
        ]);
    }
}

?>