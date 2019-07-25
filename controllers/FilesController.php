<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\UploadForm;
use app\models\Files;
use yii\web\UploadedFile;
use app\models\orders;

class FilesController extends Controller
{
    
    public function actionFilesUpload()
    {
        $id = \yii::$app->session->get('id');
        $sessRole = \yii::$app->session->get('role');

        $model = new UploadForm();

        if (Yii::$app->request->isPost && $id) {
            $model->load(Yii::$app->request->post());
            $model->validate();
        
            $model->pdfFile = UploadedFile::getInstance($model, 'pdfFile');

            $order = new orders();

            $order->id = $id;
            $order->save();
        
            $newFile = new Files();
            $newFile->fileName = $model->pdfFile->baseName;
            $newFile->country = $model->country;
            $newFile->email = $model->email;
            $newFile->id = $id;
            $newFile->inWork = '0';
            $newFile->userOrder = $order->userOrder;
            $newFile->save();
        };

        $tasks = files::findAll([
            'id' => $id,
        ]);

        if (Yii::$app->request->isPost && $model->upload()) {
            return $this->redirect('files-upload');   
        };

        if($get = Yii::$app->request->get('task')){

            $task = files::findOne([
                'fileName' => $get,
                'id' => $id,
            ]);

            if ($task) {
                $task->delete();
            };

            return $this->redirect('files-upload'); 
        };

        return $this->render('upload', [
            'model' => $model,
            'tasks' => $tasks,]);
        }
    
}
        
    

