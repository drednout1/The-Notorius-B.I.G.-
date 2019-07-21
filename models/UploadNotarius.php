<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadNotarius extends Model
{
    /**
     * @var UploadedFile
     */
    public $pdfFile;

    public function rules()
    {
        return [
            [['pdfFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg']];
    }
    
    public function upload()
    {
        if ($this->validate()){
            $this->pdfFile->saveAs('uploadsNot/' . $this->pdfFile->baseName . '.' . $this->pdfFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
