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
                'url' => 'http://dltest.ru/images/uploaded/',
                'path' => '@webroot/images/uploaded',
            ],
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetAction',
                'url' => 'http://dltest.ru/images/uploaded/',
                'path' => '@webroot/images/uploaded',
                'type' => GetAction::TYPE_IMAGES
            ]
        ];
    }

    public function actionIndex()
    {
        return $this->redirect(['post/index'], 301);
    }
}
