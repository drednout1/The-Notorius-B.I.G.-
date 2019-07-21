<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\UploadForm;
use app\models\Files;
use yii\web\UploadedFile;


class FilesController extends Controller
{
    
    public function actionFilesUpload()
    {
        $model = new UploadForm();

        $id = \yii::$app->session->get('id');
        $user_id = \yii::$app->session->get('user_id');

        if (Yii::$app->request->isPost && $id) {
            $model->load(Yii::$app->request->post());
            $model->validate();
        
            $model->pdfFile = UploadedFile::getInstance($model, 'pdfFile');
        
            $newFile = new Files();
            $newFile->fileName = $model->pdfFile->baseName;
            $newFile->country = $model->country;
            $newFile->email = $model->email;
            $newFile->user_id = $id;
            $newFile->inWork = '0';
            $newFile->save();
        };

        $tasks = files::findAll([
            'user_id' => $id,
        ]);

        if (Yii::$app->request->isPost && $model->upload()) {
            return $this->redirect('\web\files\files-upload');   
        };

        if($get = Yii::$app->request->get('task')){

            $task = files::findOne([
                'fileName' => $get,
                'user_id' => $id,
            ]);

            $task->delete();
            
            return $this->redirect('\web\files\files-upload'); 
        };

        return $this->render('upload', [
            'model' => $model,
            'tasks' => $tasks,]);
        }
    
}
        
    

