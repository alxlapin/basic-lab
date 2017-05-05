<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class Avatar extends Model {

    public $user_photo;

    public function rules()
    {
        return [
            [['user_photo'], 'image', 'extensions' => 'png, jpg, jpeg, gif', 'maxSize' => 1024 * 1024 * 2],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $basePath = Yii::getAlias('@webroot') . '/images/users/';
            do {
                $imageName = $this->generateImageName();
            } while (file_exists($basePath . $imageName));
            $imageFullPath = $basePath . $imageName;
            $imageThumbPath = $basePath . 'thumbs/' . $imageName;
            $image = new \Imagick($this->user_photo->tempName);
            $image->cropThumbnailImage(120, 120);
            $image->writeImage($imageFullPath);
            $image->cropThumbnailImage(45, 45);
            $image->writeImage($imageThumbPath);
            return $imageName;
        }
        else {
            return false;
        }
    }

    public function generateImageName()
    {
        $imageName = uniqid(time()) . '.jpg';
        return $imageName;
    }

    public function deleteImage($imageName)
    {
        $basePath = Yii::getAlias('@webroot') . '/images/users/';
        $imageFullPath = $basePath . $imageName;
        $imageThumbPath = $basePath . 'thumbs/' . $imageName;
        if (is_file($imageFullPath)) {
            unlink($imageFullPath);
        }
        if (is_file($imageThumbPath)) {
            unlink($imageThumbPath);
        }
        return true;
    }
}