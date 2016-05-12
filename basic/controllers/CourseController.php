<?php

namespace app\controllers;

use app\models\Course;
use app\modules\admin\models\RequestCourse;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class CourseController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Course::find()
                ->where(['<>', 'course_status', Course::STATUS_CLOSE])
                ->orderBy('created_at DESC'),
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $requestModel = new RequestCourse();
        $statusString = 'notsaved';

        if (Yii::$app->request->isPjax) {
            if ($requestModel->load(Yii::$app->request->post())) {
                $requestModel->request_course_id = $model->id;
                $requestModel->save();
                $statusString = 'saved';
            }
        }

        return $this->render('view', [
            'model' => $model,
            'requestModel' => $requestModel,
            'statusString' => $statusString,
        ]);
    }

    public function findModel($id)
    {
        if (($model = Course::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
