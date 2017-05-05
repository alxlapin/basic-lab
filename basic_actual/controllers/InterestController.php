<?php

namespace app\controllers;

use app\models\Interest;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;


class InterestController extends Controller
{
    public function actionIndex($id)
    {
        $model = $this->findModel($id);

        $dataProvider = new ActiveDataProvider([
            'query' =>  $model->getUsers(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider, 'model' => $model]);
    }

    public function findModel($id)
    {
        if (($model = Interest::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}