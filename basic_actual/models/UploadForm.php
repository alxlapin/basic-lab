<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    public $fileInfo = [];

    /**
     * @var UploadedFile[]
     */
    public $files;

    public function rules()
    {
        return [
            [['files'], 'file', 'skipOnEmpty' => true, 'extensions' => 'doc, docx, pdf', 'maxFiles' => 0],
        ];
    }

    public function upload()
    {
        global $fileInfo;

        if ($this->validate()) {
            foreach ($this->files as $file) {
                $fileCode = uniqid(time());
                $file->saveAs(Yii::getAlias("@webroot") .'/documents/news/' . $fileCode . '.' . $file->extension);
                $fileInfo[] = [$file->baseName, '/documents/news/' . $fileCode . '.' . $file->extension];
            }
            return $fileInfo;
        } else {
            return false;
        }
    }
}