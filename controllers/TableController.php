<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Files;
use app\models\UploadNotarius;
use yii\web\UploadedFile;
use app\models\orders;

class TableController extends Controller
{
    
    public function actionCommon()
    {
        $user_id = \yii::$app->session->get('role');
        $id = \yii::$app->session->get('id');

        $getOnWork = files::findAll([
            'inWork' => '1',
        ]);  
        
        if ($getFile = Yii::$app->request->get('file')) 
        {
            $memorize = files::findOne([
                'inWork' => '1',
                'id' =>  $getFile,
            ]);

        if (isset($memorize)) 
        {
            \yii::$app->session->set('citizen', $memorize->id);
        };

        if (files::findOne($getFile)) 
        {
            $takeOnWork = files::findOne($getFile);
            $takeOnWork->inWork = '1';
            $takeOnWork->id = $id;
            $takeOnWork->save();

            return $this->redirect('common');
        }};
        
        return $this->render('common', [
            'tasks' => $getOnWork
            ]);
        }


    public function actionList()
    {

        $id = \yii::$app->session->get('id');
        $citizen = \yii::$app->session->get('citizen');

        $model = new UploadNotarius();
        $tasklist = files::findAll([
            'inWork' => '1',
            'id' => $id
        ]);
        
        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            $model->validate();
            $model->pdfFile = UploadedFile::getInstance($model, 'pdfFile');
            $model->upload();

            $order = Orders::findAll([
                'id' => $citizen,
            ]);
            
            $findTask = files::findOne([
                'inWork' => '1',
                'id' => $id,
                'fileName' => $model->pdfFile->baseName,
            ]);

            if ($model->pdfFile->baseName == isset($findTask->fileName))
             {
                $update = files::findOne($findTask);
                $update->inWork = '2';
                $update->id = $citizen;
                $update->save();
            } else {
                return $this->render('list', [
                    'tasks' => $tasklist,
                    'model' => $model,
                    'error' => 'error',
                ]);
            }
        }
    
        return $this->render('list', [
            'tasks' => $tasklist,
            'model' => $model
            ]);
    }

    public function actionDownload()
    {
        $getFile = Yii::$app->request->get('file');
        return \Yii::$app->response->sendFile('uploads/' .  $getFile . '.pdf');
        return $this->redirect('list');
    }

    public function actionDone()
    {
        $getFile = Yii::$app->request->get('file');
        return \Yii::$app->response->sendFile('uploadsNot/' .  $getFile . '.pdf');
        return $this->redirect('tasks');
    }

    public function actionTasks()
    {
        $id = \yii::$app->session->get('id');

        $allTasks = files::findAll([
            'id' => $id
        ]);
        
        $done = files::findAll([
            'inWork' => '2',
            'id' => $id
        ]);
        
            if($done){
                return $this->render('tasks', [
                    'tasks' => $done,
                    'done' => 'done'
                    ]);
            }

        return $this->render('tasks', [
            'tasks' => $allTasks,
            ]);
        
    }

}