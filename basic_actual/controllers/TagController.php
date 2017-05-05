<?php

namespace app\controllers;

use app\models\Tag;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;


class TagController extends Controller
{
    public function actionIndex($id)
    {
        $model = $this->findModel($id);

        $dataProvider = new ActiveDataProvider([
            'query' =>  $model->getPosts(),
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider, 'model' => $model]);
    }

    public function findModel($id)
    {
        if (($model = Tag::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}