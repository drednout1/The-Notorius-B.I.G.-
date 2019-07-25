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

        if ($model->load(Yii::$app->request->post()) && $model->validate()) 
        {
            $user = Users::findOne([
                'role' => $model->role,
                'login' => $model->login,
                'pass' => $model->pass,
            ]);

            $hash = Yii::$app->getSecurity()->generatePasswordHash($model->pass);
            $hashPass = Yii::$app->getSecurity()->validatePassword($model->pass, $hash);

            if (isset($user)) 
            {
                \yii::$app->session->set('role', $user->role);
                \yii::$app->session->set('id', $user->id);
                $SessRole = \yii::$app->session->get('role');
            };

            if (isset($user->login) == $model->login && $hashPass && $SessRole == 1) {
                return $this->redirect('table/common');  
            } elseif (isset($user->login) == $model->login && $hashPass && $SessRole == 2) {
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

        if ($model->load(Yii::$app->request->post()) && $model->validate()) 
        {
            $hashPass = Yii::$app->getSecurity()->generatePasswordHash($model->pass);
            $alreadyRegister = Users::findOne([
                'login' => $model->login,
                'email' => $model->email,
                'hashPass' => $model->pass,
                'pass' => $model->pass,]);

                if (isset($alreadyRegister->email) == $model->email &&
                isset($alreadyRegister->login) == $model->login) 
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
                        $newUser->role = $model->role;
                        $newUser->userOrder = '0';
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
        ]);
    }

    public function actionLogout()
    {
        if ($session = Yii::$app->session) 
        {
            $session->remove('user_id');
            $session->close();
                $session->destroy();
                return $this->redirect('/web');
        };
    }
}

?>