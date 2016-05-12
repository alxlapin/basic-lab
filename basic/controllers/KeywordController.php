<?php

namespace app\controllers;

use app\models\Keyword;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;


class KeywordController extends Controller
{
    public function actionIndex($id)
    {
        $model = $this->findModel($id);

        $dataProvider = new ActiveDataProvider([
            'query' =>  $model->getPublications(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider, 'model' => $model]);
    }

    public function findModel($id)
    {
        if (($model = Keyword::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
