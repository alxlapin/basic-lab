<?php

namespace app\controllers;

use app\models\Project;
use app\modules\admin\models\RequestProject;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class ProjectController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Project::find()->with('authors', 'publications.authors', 'posts')
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
        $requestModel = new RequestProject();
        $statusString = 'notsaved';

        if (Yii::$app->request->isPjax) {
            if ($requestModel->load(Yii::$app->request->post())) {
                $requestModel->request_project_id = $model->id;
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
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
