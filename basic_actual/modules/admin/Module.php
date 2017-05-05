<?php

namespace app\modules\admin;

use Yii;
use yii\filters\AccessControl;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\admin\controllers';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    public function init()
    {
        parent::init();
        $this->layout = 'main';
        $this->defaultRoute = 'post/index';
        // custom initialization code goes here
    }
}
