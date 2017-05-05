<?php

namespace app\controllers;

use app\models\Course;
use app\models\Post;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;

class PostController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->with('author', 'tags', 'storages')
                ->where(['post_type' => Post::STATUS_COMMON])
                ->orderBy('post_date DESC'),
            'pagination' => [
                'pageSize' => 15,
            ],
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

    public function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    //['id' => $id, 'course_status' => [Course::STATUS_CLOSE, Course::STATUS_OPEN_REG]]
}
