<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadUserFile extends Model
{

    /**
     * @var UploadedFile[]
     */
    public $resume;
    public $photo;

    public function rules()
    {
        return [
            [['resume'], 'file', 'skipOnEmpty' => true, 'extensions' => 'doc, docx, pdf'],
            [['photo'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif', 'maxSize' => 1024 * 1024],
        ];
    }

    public function upload()
    {
        global $fileInfo;

        if ($this->validate()) {
            foreach ($this->files as $file) {
                $fileCode = uniqid(time());
                $file->saveAs('documents/' . $fileCode . '.' . $file->extension);
                $fileInfo[] = [$file->baseName . '.' . $file->extension, 'documents/' . $fileCode . '.' . $file->extension];
            }
            return $fileInfo;
        } else {
            return false;
        }
    }
}