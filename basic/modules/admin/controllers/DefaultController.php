<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use vova07\imperavi\actions\GetAction;

class DefaultController extends Controller
{

    public function actions() {
        return [
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url' => '/images/', // Directory URL address, where files are stored.
                'path' => '@webroot/images' // Or absolute path to directory where files are stored.
            ],
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetAction',
                'url' => '/images/',
                'path' => '@webroot/images',
                'type' => GetAction::TYPE_IMAGES
            ]
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
