<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Files;
use app\models\UploadNotarius;
use yii\web\UploadedFile;


class TableController extends Controller
{
    
    public function actionCommon()
    {
        $user_id = \yii::$app->session->get('user_id');
        $id = \yii::$app->session->get('id');

        $getOnWork = files::findAll([
            'inWork' => '0',
        ]);  
        
        if ($getFile = Yii::$app->request->get('file')) 
        {
            $memorize = files::findOne([
                'inWork' => '0',
                'id' =>  $getFile,
            ]);

            \yii::$app->session->set('citizen', $memorize->user_id);

            $update = files::findOne($getFile);
            $update->inWork = '1';
            $update->user_id = $id;
            $update->save();

            return $this->redirect('\web\table\common');
        }
        
        return $this->render('common', [
            'tasks' => $getOnWork
            ]);
        }


    public function actionList()
    {

        $id = \yii::$app->session->get('id');
        $citizen = \yii::$app->session->get('citizen');

        $model = new UploadNotarius();
        
        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            $model->validate();
            $model->pdfFile = UploadedFile::getInstance($model, 'pdfFile');
            $model->upload();

            $findTask = files::findOne([
                'inWork' => '1',
                'user_id' => $id,
                'fileName' => $model->pdfFile->baseName
            ]);

            if ($model->pdfFile->baseName == $findTask->fileName)
             {
                $update = files::findOne($findTask);
                $update->inWork = '0';
                $update->user_id = $citizen;
                $update->save();
            } else {
                echo 'Братан, загрузи тот же файл!';
                exit();
            };
        };

        $tasklist = files::findAll([
            'inWork' => '1',
            'user_id' => $id
        ]);
        
        return $this->render('list', [
            'tasks' => $tasklist,
            'model' => $model
            ]);
    }

    public function actionDownload()
    {
        $getFile = Yii::$app->request->get('file');
        return \Yii::$app->response->sendFile('uploads/' .  $getFile . '.jpg');
        return $this->redirect('\web\table\list');
    }

}