<?php

namespace app\controllers;

use app\models\User;
use app\models\PasswordChangeForm;
use yii\base\ErrorException;
use yii\filters\AccessControl;
use yii\helpers\Json;
use app\models\Avatar;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

class ProfileController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'model' => $this->findModel(),
        ]);
    }

    public function actionUpdate()
    {
        $model = $this->findModel();
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

    public function actionPasswordChange()
    {
        $user = $this->findModel();
        $model = new PasswordChangeForm($user);

        if ($model->load(Yii::$app->request->post()) && $model->changePassword()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('passwordChange', [
                'model' => $model,
            ]);
        }
    }

    private function findModel()
    {
        return User::findOne(Yii::$app->user->identity->getId());
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
