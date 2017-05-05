<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\User;
use app\models\Avatar;
use app\modules\admin\models\UserSearch;
use yii\base\ErrorException;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize = 25;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $model->scenario = User::SCENARIO_CREATE;

        if (Yii::$app->request->isAjax) {
            if ($model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->resume = UploadedFile::getInstance($model, 'resume');
            $avatar = Yii::$app->request->post('avatar');
            if (!empty($avatar)) {
                $model->user_photo = $avatar;
            }
            if ($model->validate()) {
                $model->save();
                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = User::SCENARIO_UPDATE;
        $model->provideInterests();

        if (Yii::$app->request->isAjax) {
            if ($model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->resume = UploadedFile::getInstance($model, 'resume');
            $avatar = Yii::$app->request->post('avatar');
            if (!empty($avatar)) {
                $model->user_photo = $avatar;
            }
            if ($model->validate()) {
                $model->save();
                return $this->redirect(['index']);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionMultiDelete()
    {
        if (Yii::$app->request->isAjax) {
            $values = Yii::$app->request->post('mass');
            if (!empty($values)) {
                Yii::$app->db->createCommand()->delete(User::tableName(), ['in', 'id', $values])->execute();
                return 'Files deleted';
            } else {
                return 'Nothing to delete';
            }
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionImageUpload() {
        $model = new Avatar();
        $model->user_photo = UploadedFile::getInstanceByName('Avatar[user_photo]');
        $imageName = $model->upload();
        if ($imageName) {
            return Json::encode([
                'files' => [[
                    'name' => $imageName,
                ]]
            ]);
        } else {
            throw new ErrorException('Failed to save image');
        }
    }

    public function actionImageDelete() {
        $model = new Avatar();
        $imageName = Yii::$app->request->post('name');
        $userid = Yii::$app->request->post('uid');
        if (!empty($userid)) {
            Yii::$app->db->createCommand()->update('user', ['user_photo' => 'user-default.png'], ['id' => $userid])->execute();
        }
        if ($model->deleteImage($imageName)) {
            return 'Ok';
        } else {
            return 'Fail';
        }
    }

}
