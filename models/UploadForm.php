<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $pdfFile;
    public $country;
    public $email;

    public function rules()
    {
        return [
            [['pdfFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['country', 'email'], 'required'],
            ['email', 'email']];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->pdfFile->saveAs('uploads/' . $this->pdfFile->baseName . '.' . $this->pdfFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
