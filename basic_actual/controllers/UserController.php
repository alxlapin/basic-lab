<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class UserController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()->where(['visibility' => User::STATUS_VISIBLE]),
            'pagination' => [
                'pageSize' => 20,
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
